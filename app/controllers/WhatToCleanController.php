<?php
//child controller
class WhatToCleanController extends PageController{

	public function __construct($dbc){

		//Run the parent constructer
		parent::__construct();
		
		$this->dbc = $dbc;

		//If you are not logged in (no id in the SESSION not logged in) 
		//Can be cipped to other pages that they have no access too
		$this->mustBeLoggedIn();
	}

	public function buildHTML() {
		//Instantiate (create instance of) Plates library
		$plates = new League\Plates\Engine('app/templates');

		//Get latest recipes
		//$this->getLatestRecipes();

		echo $this->plates->render('what-to-clean');
	}
}