<?php

use Intervention\Image\ImageManager;

class EditPostController extends PageController{

	private $acceptableImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/tiff'];

	
	public function __construct($dbc){

		//Run the parent constructer
		parent::__construct();
		
		$this->dbc = $dbc;

		$this->mustBeLoggedIn();

		//Did the user submit the edit form?
		if( isset( $_POST['edit-post']) ){
			$this->processPostEdit();
		}

		//get info about the post
		$this->getPostInfo();

	}

	public function buildHTML() {


		echo $this->plates->render('edit-post', $this->data);
	}

	private function getPostInfo(){

		//Get the recipe id from the Get array
		$recipeID = $this->dbc->real_escape_string($_GET['id']);

		//Get the User ID
		$userID = $_SESSION['user_id'];

		//Prepare the query
		$sql = "SELECT user_id, title, description, method, image 
				FROM recipe_database 
				WHERE recipe_id = $recipeID ";

		if($_SESSION['privilege'] != 'admin'){		
			
			$sql .= "AND user_id = $userID";
		}
		
		$result = $this->dbc->query($sql);

		//If the query failed
		if(!$result || $result->num_rows == 0 ){
			//Send the user back to the recipe post page
			//OR the post was deleted
			header('Location: index.php?page=fullrecipepage&id=$recipeID');

		} else {
			//what if user 
			if( isset($_POST['edit-post']) ){

				$this->data['post'] = $_POST;

				//Use the original
				$result = $result->fetch_assoc();

				$this->data['originalTitle'] = $result['title'];

				//Make sure we use the current image otherwise it disapears
				$this->data['post']['image'] = $result['image'];
			
				
			} else{
				//use the original title
				$result = $result->fetch_assoc();

				$this->data['post'] = $result;

				$this->data['originalTitle'] = $result['title'];
			}

		}
	}

	private function processPostEdit() {

			// Validation
			$totalErrors = 0;
			
			$title = trim($_POST['title']);
			$desc = trim($_POST['description']);
			$method = trim($_POST['method']);

			// Title
			if( strlen($title) > 100 ) {
				$totalErrors++;
				$this->data['titleError'] = '<p>At must be less than 100 characters</p>';
			}

			// Description
			if( strlen($desc) > 1000 ) {
				$totalErrors++;
				$this->data['descError'] = '<p>At most less than 1000 chatacters</p>';
			}

			if( strlen( $method ) == 0){
				$totalErrors++;
				$this->data['methodError'] = "<p>This is a required field</p>";
			}

			// Make sure the user has provided an image
			if ( $_FILES['image']['name'] != ''){
			
				if( in_array( $_FILES['image']['error'], [1,3,] ) ) {
					// Show error message
					// Use a switch to generate the appropriate error message
					$this->data['imageMessage'] = 'Image failed to upload';
					$totalErrors++;
				} elseif( !in_array( $_FILES['image']['type'], $this->acceptableImageTypes ) ) {
					$this->data['imageMessage'] = 'Must be an image (jpg, gif, png, tiff etc)';
					$totalErrors++;
				}
			}

			//If there are no errors
			if( $totalErrors == 0 ) {

				$recipeID = $this->dbc->real_escape_string($_GET['id']);

				//Delete old images
				//They are wasting space
				$sql = "SELECT image FROM recipe_database WHERE recipe_id = $recipeID
				 ";

				$result = $this->dbc->query($sql);

				//Extract the data
				$result = $result->fetch_assoc();
				//Get the image name
				$imageName = $result['image'];

				if( $_FILES['image']['name'] != '' ) {

					// Instance of Intervention Image
					$manager = new ImageManager();

					// Get the file that was just uploaded
					$image = $manager->make( $_FILES['image']['tmp_name'] );

					$fileExtension = $this->getFileExtension( $image->mime() );

					$fileName = uniqid();

					$image->save("img/uploads/original/$fileName$fileExtension");

					$image->resize(400, null, function ($constraint) {
					     $constraint->aspectRatio();
					});

					$image->save("img/uploads/recipes/$fileName$fileExtension");

					$image->resize(800, null, function ($constraint) {
					     $constraint->aspectRatio();
					});

					$image->save("img/uploads/post-size/$fileName$fileExtension");

					unlink("img/uploads/original/$imageName");
					unlink("img/uploads/post-size/$imageName");
					unlink("img/uploads/recipes/$imageName");
					

					//Change the ImageName to be the new file name
					$imageName = $fileName.$fileExtension;
				}




				//Filter the data
				$title = $this->dbc->real_escape_string($title);
				$desc = $this->dbc->real_escape_string($desc);
				$method = $this->dbc->real_escape_string($method);

				$userID = $_SESSION['user_id'];

				//Prepare the SQL
				$sql = "UPDATE recipe_database
						SET title = '$title',
							description = '$desc',
							image = '$imageName',
							method = '$method'
						WHERE recipe_id = '$recipeID' ";

				if($_SESSION['privilege'] != 'admin') {
					$sql .= "AND user_id = $userID'";
				}
						

			
				$this->dbc->query($sql);

				if( $this->dbc->affected_rows == 0 ) {
					$this->data['updateError'] = '<p>Sorry, nothing changed</p>';
				}else{
				//Redirect the user to the post page
				header("Location: index.php?page=fullrecipepage&recipe_id=$recipeID");
				}
			}
	
		}

			private function getFileExtension( $mimeType ) {

			switch($mimeType) {

			case 'image/png':
				return '.png';
			break;

			case 'image/gif':
				return '.gif';
			break;

			case 'image/jpeg':
				return '.jpg';
			break;

			case 'image/bmp':
				return '.bmp';
			break;

			case 'image/tiff':
				return '.tif';
			break;

		}

	}
}










