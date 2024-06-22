<?php
	session_start();
	class User {
		private $db;

		public function __construct($dbConfig) {
			try {
				$this->db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db_name']);
			} catch(Exception $e) {
				die("Błędne połączenie z bazą danych: " . $e->getMessage());
			}
		}

		public function create($name, $surname, $password, $email, $role) {
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$stmt = $this->db->prepare("INSERT INTO users (name, surname, password, email, role) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param("sssss", $name, $surname, $password, $email, $role);
			$result = $stmt->execute();
			$stmt->close();
			header("location: /git/login");
			return $result;

		}

		public function login($email, $password){
			$stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$result = $stmt->get_result();
			$user = $result->fetch_assoc();
			//print_r($user);

			if ($user && password_verify($password, $user['password'])) {
				//prawidłowo zalogowany użytkownik
				$_SESSION['email'] = $user['email'];
				$_SESSION['role'] = $user['role'];
				$_SESSION['id'] = $user['id'];
				header("location: ./app/views/home.php");
			}else{
				echo 'Błędny login lub hasło<hr><br>';

			}
		}

	}