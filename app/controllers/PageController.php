<?php

//parent controller to children with common properties and everything all pages will use

//stops duplication 
abstract class PageController{

	//child controllers can access these files when protected
	protected $title;
	protected $metaDesc;
	protected $dbc;
	protected $plates;
	protected $data = [];

	public function __construct(){

		$this->plates = new League\Plates\Engine('app/templates');
	}

	//Rule to Force children classes to have the buildHTML function
	abstract public function buildHTML();

	public function mustBeLoggedIn(){
		
		if(!isset($_SESSION['user_id']) ){
			//Redirect the user to the login page
			header('Location: index.php?page=home');
		}
	}

	

























}