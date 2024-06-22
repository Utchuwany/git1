<?php
	require_once BASE_PATH . '/app/models/User.php';
	

	class UserController {
		private $userModel;

		public function __construct() {
			$this->userModel = new User(require BASE_PATH . '/app/config/database.php');
		}

		public function register() {
			$errors = [];
			$data = [];

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				//print_r($_POST);

				$data['name'] = htmlspecialchars(trim($_POST['name']));
				$data['surname'] = htmlspecialchars(trim($_POST['surname']));
				$data['password'] = htmlspecialchars(trim($_POST['password']));
				$data['email'] = htmlspecialchars(trim($_POST['email']));				
				$data['role'] = htmlspecialchars(trim($_POST['role']));

				if (empty($data['name']) || !preg_match('/^[a-zA-Z]{2,}$/', $data['name'])) {
					$errors['name'] = 'Imie użytkownika jest nieprawidłowa';
				}

				if (empty($data['surname']) || !preg_match('/^[a-zA-Z]{2,}$/', $data['name'])) {
					$errors['surname'] = 'Nazwisko użytkownika jest nieprawidłowa';
				}

				if (empty($data['password']) || strlen($data['password']) < 5) {
					$errors['password'] = 'Hasło nie spełnia wymagań';
				}

				if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$errors['email'] = 'Email jest nieprawidłowy';
				}

				print_r($errors);

				if (empty($errors)) {
					$hash = password_hash($data['password'], PASSWORD_ARGON2ID);
					$this->userModel->create($data['name'], $data['surname'], $hash, $data['email'], $data['role']);
				}
			}

			require_once BASE_PATH . '/app/views/register.php';
		}

		public function login() {
			$errors = [];
			$data = [];

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				//print_r($_POST);

				$data['email'] = htmlspecialchars(trim($_POST['email']));
				$data['password'] = htmlspecialchars(trim($_POST['password']));
				

				if (empty($data['email'])) {
					$errors['email'] = 'Podany email użytkownika jest pusty';
				}

				if (empty($data['password'])) {
					$errors['password'] = 'Hasło użytkownika jest puste';
				}

				

				if (empty($errors)) {
					$email = $_POST['email'];
					$password = $_POST['password'];
					$this->userModel->login($email, $password);
				} else{
					print_r($errors);
				}
			}

			require_once BASE_PATH . '/app/views/login.php';
		}

		

	}