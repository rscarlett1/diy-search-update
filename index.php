<?php

session_start();
//make the vendor folder available to use
require 'vendor/autoload.php';
require "app/controllers/PageController.php";

//Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'diy_cleaning_website');

// load appripriate page

//Has the user requested a page?
if( isset($_GET['page']) ){

	//Requested page
	$page = $_GET['page'];

} else {

	//home page
	$page = 'home';
}


// Load appropriate files based on page
switch($page) {

	//Home page
	case 'home':
		require 'app/controllers/HomeController.php';
		$controller = new HomeController($dbc);
	break;

	//About us page
	case 'about-us':
		require 'app/controllers/AboutUsController.php';
		$controller = new AboutUsController($dbc);
	break;

	//what to clean page
	case 'what-to-clean':
		require 'app/controllers/WhatToCleanController.php';
		$controller = new WhatToCleanController($dbc);
	break;

	//contact
	case 'contact-us':
		require 'app/controllers/ContactUsController.php';
		$controller = new ContactUsController($dbc);
	break;

	case 'recipes':
		require 'app/controllers/RecipesController.php';
		$controller = new RecipesController($dbc);
	break;

	case 'login':
		require 'app/controllers/LoginController.php';
		$controller = new LoginController($dbc);
	break;

	case 'signup':
		require 'app/controllers/SignUpController.php';
		$controller = new SignUpController($dbc);
	break;

	case 'account':
		require 'app/controllers/AccountController.php';
		$controller = new AccountController($dbc);
	break;

	case 'kitchen-recipes':
		require 'app/controllers/AccountController.php';
		$controller = new RecipesController ($dbc);
	break;

	case 'fullrecipepage':
		require 'app/controllers/FullRecipeController.php';
		$controller = new FullRecipeController ($dbc);
	break;

	case 'edit-comments':
		require 'app/controllers/EditCommentsController.php';
		$controller = new EditCommentsController ($dbc);
	break;

	case 'edit-post':
		require 'app/controllers/EditPostController.php';
		$controller = new EditPostController ($dbc);
	break;

	case 'search':
		require 'app/controllers/SearchController.php';
		$controller = new SearchController ($dbc);
	break;

	case 'logout':
		unset($_SESSION['user_id']);
		header('Location: index.php');
	break;

	default:
		require 'app/controllers/Error404Controller.php';
		$controller = new Error404Controller ($dbc);
	break;
}

$controller->buildHTML();