<?php

class RecipesController extends PageController{


	public function __construct($dbc){

		//Run the parent constructer
		parent::__construct();
		
		$this->dbc = $dbc;

		$this->getLatestRecipes();
	}

	public function buildHTML() {
		//Instantiate (create instance of) Plates library
		$plates = new League\Plates\Engine('app/templates');

		echo $this->plates->render('recipes', $this->data);
	}



	private function getLatestRecipes(){

		$type = $_GET['type'];

		//Prepare some SQL
		$sql = "SELECT recipe_id, title, description, category, image, first_name, last_name, recipe_database.user_id 
				FROM recipe_database
				JOIN users
				ON recipe_database.user_id = users.user_id
				WHERE category = '$type'";

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


	private function getuUsersDetails(){

		$usersID = $this->dbc->real_escape_string( $_GET['username'] );

		//Prepare some SQL
		$sql = "SELECT first_name, last_name 
				FROM users
				JOIN recipe_database
				ON users = users.id
				WHERE recipe_database.user_id = $usersID";

			die($sql);

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
}