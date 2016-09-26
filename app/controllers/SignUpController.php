<?php
//child controller

class SignUpController extends PageController {

	//Properties
	private $firstNameMessage;
	private $lastNameMessage;
	private $emailMessage;
	private $passwordMessage;
	
	//Constructor
	public function __construct($dbc){
		//Run  the parent constructor
		parent::__construct();

		//Save the database connnection for later
		$this->dbc = $dbc;
		//If the user has submmitted the registration form
		if( isset($_POST['signup-submit']) ) {
			$this->validateRegistrationForm();
		}
	}

	public function buildHTML() {
		//Instantiate (create instance of) Plates library
		$plates = new League\Plates\Engine('app/templates');

		//Prepare the container for data
		$data = [];

		//if the first name error
		if($this->firstNameMessage != '') {
			$data['firstNameMessage'] = $this->firstNamelMessage;
		}

		//if there is a last name error
		if($this->lastNameMessage != '') {
			$data['lastNameMessage'] = $this->lastNamelMessage;
		}

		// If there is an E-Mail error
		if($this->emailMessage != '') {
			$data['emailMessage'] = $this->emailMessage;
		}

		// If there is a message for password
		if($this->passwordMessage != '') {
			$data['passwordMessage'] = $this->passwordMessage;
		}
	}

	public function validateRegistrationForm(){

		$totalErrors = 0;

		if( $_POST['email'] == '' ) {
			// E-Mail is invalid
			$this->emailMessage = 'Invalid E-Mail';
			$totalErrors++;
		}


		// Make sure the E-Mail is not in use
		$filteredEmail = $this->dbc->real_escape_string( $_POST['email'] );

		$sql = "SELECT email
				FROM users
				WHERE email = '$filteredEmail'  ";

		// Run the query
		$result = $this->dbc->query($sql);

		// If the query failed OR there is a result
		if( !$result || $result->num_rows > 0 ) {
			$this->emailMessage = 'E-Mail is in use';
			$totalErrors++;
		}

		//Determine if this data is valid to go into the database		

		if( $totalErrors === 0 ) {

			//validation passed!

			
			$firstName = $this->dbc->real_escape_string($_POST['first-name']);
			$lastName = $this->dbc->real_escape_string($_POST['last-name']); 

			//Hash the password
			$hash = password_hash( $_POST['password'], PASSWORD_BCRYPT );


			// Prepare the SQL
			$sql = "INSERT INTO users (first_name, last_name, email, password)
					VALUES ('$firstName', '$lastName', '$filteredEmail', '$hash')";

			// Run the query
			$this->dbc->query($sql);

			// Check to make sure this worked on database

			// Log the user in
			$_SESSION['user_id'] = $this->dbc->insert_id;
			$_SESSION['privilege'] = 'user';

			// Redirect the user to the what to clean page
			header('Location: index.php?page=what-to-clean');
		}		
	}
}
























