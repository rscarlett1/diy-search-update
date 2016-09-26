<?php

use Intervention\Image\ImageManager;

class AccountController extends PageController{

	private $acceptableImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/tiff'];

	public function __construct($dbc){

		//Run the parent constructer
		parent::__construct();
		
		$this->dbc = $dbc;

		$this->mustBeLoggedIn();

		// Did the user submit new contact details?
		if( isset( $_POST['update-contact'] ) ) {
			$this->processNewContactDetails();
		}

		//Did the user submit a new recipe
		if( isset($_POST['submit-recipe']) ){
			$this->processUploadedRecipe();
		}
	}

	public function buildHTML() {

		//Instantiate (create instance of) Plates library
		$plates = new League\Plates\Engine('app/templates');

		echo $this->plates->render('account', $this->data);
	}

	private function processNewContactDetails() {

		// Validation
		$totalErrors = 0;

		//validate the first name
		if (empty ( $_POST['first-name'] )){
			$this->data['firstNameMessage'] = '<p>You must enter your new first name</p>';
		}

		if (empty ( $_POST['last-name'] )){
			$this->data['lastNameMessage'] = '<p>You must enter your new last name</p>';
		}

		if( strlen($_POST['first-name']) > 50 ) {
			
			$this->data['firstNameMessage'] = '<p>Must be at most 50 characters</p>';
			$totalErrors++;
		}

		// Validate the last name
		if( strlen($_POST['last-name']) > 50 ) {
			$this->data['lastNameMessage'] = '<p>Must be at most 50 characters</p>';
			$totalErrors++;
		}

		// If totalErrors is still 0 (yay!)
		if( $totalErrors == 0 ) {
			// Form validation passed!
			// Time to update the database
			$firstName = $this->dbc->real_escape_string($_POST['first-name']);
			$lastName = $this->dbc->real_escape_string($_POST['last-name']);

			$userID = $_SESSION['user_id'];

			//Prepare the SQL
			$sql = "UPDATE users
					SET first_name = '$firstName',
						last_name = '$lastName'
					WHERE users.user_id = $userID  ";
			
			// Run the query
			$this->dbc->query( $sql );

			$result = $this->dbc->query($sql);

			
			if( $firstName && $lastName ) {
				$this->data['postMessage'] = 'Your name was successfully updated';
			} else {
				$this->data['postMessage'] = 'Sorry! Something went wrong!';
			}
		}
	}

	private function processUploadedRecipe() {

		//echo '<pre>';
		//print_r($_POST);
		//die();
		
		//Count errors
		$totalErrors = 0;

		$recipetitle = trim($_POST['recipe-title']);
		$recipedesc = trim($_POST['recipe-desc']);
		$recipemethod = trim($_POST['recipe-methods']);

		//Title
		if( strlen(  $recipetitle  ) == 0 ) {
			$this->data['titleMessage'] = '<p>Required field</p>' ;
			$totalErrors++;
		} elseif( strlen( $recipetitle ) > 100){
			$this->data['titleMessage'] = '<p>Cannot be more than 100 Characters</p>';
			$totalErrors++;
		}

		//Description
		if ( strlen ( $recipedesc )  == 0 ){
			$this->data['descMessage'] = '<p>Required field</p>' ;
			$totalErrors++;
		} elseif( strlen( $recipedesc) > 1000 ){
			$this->data['descMessage'] = '<p>Cannot be more than 100 Characters</p>';
			$totalErrors++;
		}

		//Method
		if ( strlen ( $recipemethod ) == 0 ){
			$this->data['methodMessage'] = '<p>Required field</p>' ;
			$totalErrors++;
		}

		// Make sure the user has provided an image
		if( in_array( $_FILES['image']['error'], [1,3] ) ) {
			// Show error message
			// Use a switch to generate the appropriate error message
			$this->data['imageMessage'] = 'Image failed to upload';
			$totalErrors++;
		} elseif( !in_array( $_FILES['image']['type'], $this->acceptableImageTypes ) ) {
			$this->data['imageMessage'] = 'Must be an image (jpg, gif, png, tiff etc)';
			$totalErrors++;
		}

		//If there are no errors
		if( $totalErrors == 0 ) {

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

						
			//Filter the data

			$recipetitle = $this->dbc->real_escape_string($recipetitle);
			$recipedesc = $this->dbc->real_escape_string($recipedesc);
			$recipemethod = $this->dbc->real_escape_string($recipemethod);

			// Get the ID of logged in user
			$userID = $_SESSION['user_id'];

			// SQL (INSERT)
			$sql = "INSERT INTO recipe_database (recipe_database.user_id, title, description, method, image)
					VALUES ('$userID', '$recipetitle', '$recipedesc', '$recipemethod', '$fileName$fileExtension')";

			$this->dbc->query( $sql );

			// Make sure it worked
			if( $this->dbc->affected_rows ) {
				$recipe_id = $this->dbc->insert_id;
				header("Location: index.php?page=fullrecipepage&recipe_id=$recipe_id");
			} else {
				$this->data['recipeUploadMessage'] = 'Something went wrong!';
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