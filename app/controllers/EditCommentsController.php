<?php

class EditCommentsController extends PageController{


	public function __construct($dbc){

		//Run the parent constructer
		parent::__construct();
		
		$this->dbc = $dbc;

		$this->mustBeLoggedIn();

		$this->mustOwnComment();

		//Did the user submit the form?
		if(isset ($_POST['edit-comment']) ){
			$this->processComment();
		}
	}

	public function buildHTML() {
		//Instantiate (create instance of) Plates library
		$plates = new League\Plates\Engine('app/templates');

		echo $this->plates->render('edit-comments', $this->data);
	}

	private function mustOwnComment(){

		$userID =$_SESSION['user_id'];

		//Get the comment ID
		$commentID = $this->dbc->real_escape_string($_GET['commentid']);
		$privilege = $_SESSION['privilege'];

		//Get the comment details
		$sql = "SELECT comment, recipe_id
				FROM comments 
				WHERE comments.id = $commentID
				AND comments.user_id = $userID ";

		// If the user is not an admin
		if( $privilege != 'admin' ) {
			$sql .= " AND user_id = $userID";
		}

		//Run the query and capture the result
		$result = $this->dbc->query( $sql );

		//if there is not a result
		if(!$result || $result->num_rows == 0 ){
			header('Location: index.php?page=fullrecipepage&recipe_id=[recipe_id]');
		} else{
			$theComment = $result->fetch_assoc();

			$this->data['comment'] = $theComment['comment'];
			$this->data['recipe_id'] = $theComment['recipe_id'];
		}
	}

	private function processComment() {

		$totalErrors = 0;

		//Check the length
		if( strlen( $_POST['comment']) > 2000){
			$totalErrors++;
			$this->data['commentError']	= '<p>Must be less than 2000 characters</p>';
		}
		
		//If all is good. update the database
		if( $totalErrors == 0 ){

			//Get the comment ID
			$commentID = $_GET['id'];

			//Get the comment
			$comment = $this->dbc->real_escape_string($_POST['comment']);

			//Prepare the SQL
			$sql = "UPDATE comments
					SET comment = '$comment',
					updated_at = CURRENT_TIMESTAMP
					WHERE id = $commentID"; 
				
			$this->dbc->query($sql);

			//redirect user back to the recipe that has their comment
			header('Location: index.php?page=fullrecipepage&recipe_id='.$this->data['recipe_id']);
		}

	}
}