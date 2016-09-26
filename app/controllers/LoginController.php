<?php

class LoginController extends PageController{

	public function __construct($dbc){

		//Make sure the PageControllers constructer still runs
		parent::__construct();

		//Save database connection
		$this->dbc = $dbc;
		// var_dump($_POST);
		//If the login form has been submitted
		if(isset( $_POST['login'] ) ) {
			$this->processLoginForm();
		}

	}

	public function buildHTML() {
		//Instantiate (create instance of) Plates library
		//$plates = new League\Plates\Engine('app/templates');

		echo $this->plates->render('login', $this->data);
	}

	private function processLoginForm() {
		$totalErrors = 0;

		//Make sure email address is provided	
		if( strlen( $_POST['email'] ) < 6 ){
			//Prepare error messages
			$this->data['emailMessage'] = 'Invalid E-mail';
			$totalErrors++;
		}

		if( strlen ( $_POST['password'] ) < 8 ) {
			$this->data['passwordMessage'] = 'Invalid password must be more than 8 characters';
			$totalErrors++;
		}

		// If there are no errors
		if( $totalErrors === 0) {

			//Check the database for the Email address
			//Get the hashed password too
			$filteredEmail = $this->dbc->real_escape_string( $_POST['email'] );

			// Prepare SQL query

			$sql = "SELECT user_id, password, privilege
					FROM users
					WHERE email = '$filteredEmail' ";
			// die($sql);

			//Run the query
			$result = $this->dbc->query( $sql );

			//Is there a result?
			if ( $result->num_rows == 1 ){

				//Check the password
				$userData = $result->fetch_assoc();

				$passwordResult = password_verify( $_POST['password'], $userData['password'] );

				// If the result was good
				if( $passwordResult == true ) {
					// Log the user in
					$_SESSION['user_id'] = $userData['user_id'];
					$_SESSION['privilege'] = $userData['privilege'];

					header('Location: index.php?page=what-to-clean');

				} else {
					// Prepare error message
					$this->data['loginMessage'] = 'E-Mail or Password incorrect';
				}


			} else {

				// Credentials do not match our records
				$this->data['loginMessage'] = 'E-Mail or Password incorrect';

			}

		}

	}
}



