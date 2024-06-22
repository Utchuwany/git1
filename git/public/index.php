<?php
define('BASE_PATH', realpath(dirname(__FILE__).'/..'));

require_once BASE_PATH . '/app/controllers/UserController.php';
require_once BASE_PATH . '/app/controllers/WorkController.php';
require_once BASE_PATH . '/app/controllers/TableController.php';

// Inicjalizacja kontrolerów
$userController = new UserController();
$workController = new WorkController();
$tableController = new TableController();

// Pobranie pełnej ścieżki żądania
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Przekierowanie do odpowiednich metod kontrolerów na podstawie URI
switch ($request_uri) {
    case '/git/register':
        $userController->register();
        break;
    
    case '/git/login':
        $userController->login();
        break;
    
    case '/git/addDay':
        $workController->addDay();
        break;
    
    case '/git/showDay':
        $workController->showDay();
        break;
    
    case '/git/showComment':
        $workController->showComment();
        break;
    
    case '/git/addComment':
        $workController->addComment();
        break;
    
    case '/git/showTable':
        $tableController->paint();
        break;
    
	case '/git/showUser':
		//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$tableController->showUserById();
		//} else {
		//	echo "Nieprawidłowe ID użytkownika eeee";
		//}
		break;
    
    case '/git/updateRow':
        $tableController->update();
        break;
    
    case '/git/deleteRow':
        $tableController->delete();
        break;
    
    default:
        // Obsługa strony startowej lub nieobsłużonych żądań
        // echo "Strona startowa";
        break;
}
?>
