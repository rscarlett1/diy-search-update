<?php

class FullRecipeController extends PageController{

	public function __construct($dbc){

		//Run the parent constructer
		parent::__construct();
		
		$this->dbc = $dbc;

		//Does the user want to delete this post?
		if( isset($_GET['delete']) ) {
			$this->deletePost();
		}

		//Does the user want to delete this post?
		if( isset($_GET['deleteComment']) ) {
			$this->Deletecomment();
		}

		//Did the user add a comment
		if( isset( $_POST['new-comment'])){
			$this->processNewComment();
		}

		$this->getFullRecipeData();
	}

	public function buildHTML() {
		//Instantiate (create instance of) Plates library
		//$plates = new League\Plates\Engine('app/templates');

		echo $this->plates->render('fullrecipepage', $this->data);
	}

	private function getFullRecipeData(){

		//Filter the id
		$fullrecipeID = $this->dbc->real_escape_string($_GET['recipe_id']);

		//Get info about this recipe
			$sql = "SELECT recipe_id, title, description, method, image, first_name, last_name, recipe_database.user_id 
				FROM recipe_database
				JOIN users
				ON recipe_database.user_id = users.user_id
				WHERE recipe_id = '$fullrecipeID'";

		//Run the SQL
		$result = $this->dbc->query($sql);
		
		//make sure the query worked		
		if( !$result || $result->num_rows == 0 ){ 
			//Redirect user to 404 page
			header('Location: index.php?page=404');
		} else {
			//yay all good
			$this->data['fullrecipepage'] = $result->fetch_all(MYSQLI_ASSOC);
		}

		//Get all the comments
		$sql = "SELECT comments.id, comments.user_id, comment, CONCAT(first_name, ' ', last_name) AS author
		FROM comments
		JOIN users
		ON comments.user_id = users.user_id
		WHERE recipe_id = '$fullrecipeID'
		ORDER BY ceated_at DESC";
		
		$result = $this->dbc->query($sql);
		
		//Extract the data as an associative array
		
		$this->data['allComments'] = $result->fetch_all(MYSQLI_ASSOC);
	}

	private function getRecipePage(){

		$fullrecipeID = $this->dbc->real_escape_string( $_GET['fullrecipeid'] );

		//Prepare some SQL
		$sql = "SELECT recipe_id, title, description, category, method 
				FROM recipe_database
				JOIN users
				ON recipe_database
				WHERE recipe.id = recipe_id";

		//Run the SQL and capture the result
		$result = $this->dbc->query($sql);		


		// If the query failed
		if( !$result || $result->num_rows == 0 ) {
			// Redirect user to 404 page
			header('Location: index.php?page=404');
		} else {
			// Yay!
			$this->data['recipes'] = $result->fetch_all(MYSQLI_ASSOC);
		}
	}

	private function processNewComment(){

		$totalErrors = 0;

		//Validate that the comments have text.
		if (empty ( $_POST['comment'] )){
			$this->data['commentMessage'] = '<p>You must enter a comment</p>';
			$totalErrors++;
		}

		// Validate the maximum length
		if( strlen($_POST['comment']) > 2000 ) {
			$this->data['commentMessage'] = '<p>Must be at most 2000 characters</p>';
			$totalErrors++;
		}

		if( $totalErrors == 0 ) {

			//Filter the comment
			$comment = $this->dbc->real_escape_string($_POST['comment']);

			$userID = $_SESSION['user_id'];

			$recipeID = $this->dbc->real_escape_string($_GET['recipe_id']);

			$sql = "INSERT INTO comments (comment, user_id, recipe_id)
			VALUES ('$comment', $userID, $recipeID)";

			$this->dbc->query($sql);

			//Make sure query worked
			if( $this->dbc->affected_rows ) {
				$this->data['recipeCommentMessage'] = 'Success!';
			} else {
				$this->data['recipeCommentMessage'] = 'Something went wrong!';
			}
		}
	}

	private function deletePost() {

		// If user is not logged in
		if( !isset($_SESSION['user_id']) ) {
			return;
		}

		// Make sure the user owns this post
		$recipeID = $this->dbc->real_escape_string($_GET['recipe_id']);
		$userID = $_SESSION['user_id'];
		$privilege = $_SESSION['privilege'];

		// Delete the image first
		$sql = "SELECT image
				FROM recipe_database
				WHERE recipe_id = $recipeID";

		// If the user is not an admin
		if( $privilege != 'admin' ) {
			$sql .= " AND user_id = $userID";
		}

		// Run this query
		$result = $this->dbc->query($sql);

		// If the query failed
		// Either post doesn't exist, or you don't own the post
		if( !$result || $result->num_rows == 0 ) {
			return;
		}

		$result = $result->fetch_assoc();

		$filename = $result['image'];

		unlink("img/uploads/original/$filename");
		unlink("img/uploads/recipes/$filename");
		unlink("img/uploads/post-images/$filename");

		// Prepare the SQL
		$sql = "DELETE FROM recipe_database
				WHERE recipe_id = $recipeID";

		// Run the query
		$this->dbc->query($sql);

		// Redirect the user back to what-to-clean
		// This recipe is dead :(
		header('Location: index.php?page=what-to-clean');
		die();
	}

	private function Deletecomment(){

		//If the user is logged in
		if( !isset($_SESSION['user_id']) ) {
			return;
		}

		// Make sure the user owns this comment
		
		$recipeID = $this->dbc->real_escape_string($_GET['recipe_id']);
		$commentID = $this->dbc->real_escape_string($_GET['commentid']);
		$userID = $_SESSION['user_id'];
		$privilege = $_SESSION['privilege'];

		$sql = "SELECT id, comment, comments.user_id, recipe_id
				FROM comments
				WHERE id = $commentID
				AND recipe_id = $recipeID";
				
				
		// If the user is not an admin
		if( $privilege != 'admin' ) {
			$sql .= " AND user_id = $userID";
		}

		$result = $this->dbc->query($sql);

		// If the query failed
		// Either post doesn't exist, or you don't own the comment
		if( !$result || $result->num_rows == 0 ) {
			return;
		}

		$recipeID = $this->dbc->real_escape_string($_GET['recipe_id']);
		$commentID = $this->dbc->real_escape_string($_GET['commentid']);
		$userID = $_SESSION['user_id'];
		$privilege = $_SESSION['privilege'];


		// Prepare the SQL
		$sql = "DELETE FROM comments
				WHERE id = $commentID
				AND recipe_id = $recipeID";
								
		 //If the user is not an admin
		if( $privilege != 'admin' ) {
			$sql .= " AND user_id = $userID";
		}

		$this->dbc->query($sql);	
	}
}




