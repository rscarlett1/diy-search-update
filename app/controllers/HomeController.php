<?php

class HomeController extends PageController {

	//Properties
	private $emailMessage;
	
	//Constructor
	public function __construct($dbc){

	parent::__construct();	

	}

	//Methods (functions)
	public function buildHTML() {

		//Instantiate (create instance of) Plates library
		$plates = new League\Plates\Engine('app/templates');

		echo $plates->render('home');
	}
}