<?php
	define('BASE_PATH', realpath(dirname(__FILE__).'/..'));
	require_once BASE_PATH . '/app/controllers/UserController.php';
	require_once BASE_PATH . '/app/controllers/WorkController.php';
	require_once BASE_PATH . '/app/controllers/TableController.php';
	$userController = new UserController();
	$workController = new WorkController();
	$tableController = new TableController();
	if ($_SERVER['REQUEST_URI'] == '/git/register') {
		$userController->register();
	}	

	if ($_SERVER['REQUEST_URI'] == '/git/login') {
		$userController->login();
	}	

	if ($_SERVER['REQUEST_URI'] == '/git/addDay') {
		$workController->addDay();
	}

	if ($_SERVER['REQUEST_URI'] == '/git/showDay') {
		$workController->showDay();
	}
	if ($_SERVER['REQUEST_URI'] == '/git/showComment') {
		$workController->showComment();
	}

	if ($_SERVER['REQUEST_URI'] == '/git/addComment') {
		$workController->addComment();
	}
	if ($_SERVER['REQUEST_URI'] == '/git/showTable') {
		$tableController->paint();
	}
	if ($_SERVER['REQUEST_URI'] == '/git/showUser') {
		$tableController->showUserById();
	}	
	if ($_SERVER['REQUEST_URI'] == '/git/updateRow') {
		$tableController->update();
	}
	
	if ($_SERVER['REQUEST_URI'] == '/git/deleteRow') {
		$tableController->delete();
	}
	//echo "Strona startowa";