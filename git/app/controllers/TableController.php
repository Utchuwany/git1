<?php
	require_once BASE_PATH . '/app/models/Table.php';
	
	class TableController {
		private $TableModel;

		public function __construct() {
			$this->TableModel = new Table(require BASE_PATH . '/app/config/database.php');
		}
        public function paint(){
           
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $rows = [];
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $tableName = $_POST['tableName'];
                    $rows = $this->TableModel->paint($tableName);
                }

        }
        require_once BASE_PATH . '/app/views/showTable.php';

    }
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tableName = $_POST['tableName'];
            $id = $_POST['id'];
            $data = $_POST['data'];
            $this->TableModel->updateRow($tableName, $id, $data);
            header("Location: /git/showTable");
            exit;
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tableName = $_POST['tableName'];
            $id = $_POST['id'];
            $this->TableModel->deleteRow($tableName, $id);
            header("Location: /git/showTable");
            exit;
        }
    }
    public function showUserById() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id_worker'])) {
                $id = $_POST['id_worker'];
                $user = $this->TableModel->getUserById($id);
                require_once BASE_PATH . '/app/views/showUser.php';
            } else {
                echo "Nieprawidłowe ID użytkownika aaa";
            }
        }
    }

    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $active = $_POST['active'];

            $result = $this->TableModel->updateUser($id, $name, $surname, $email, $role, $active);

            if ($result) {
                echo "Dane użytkownika zostały zaktualizowane.";
            } else {
                echo "Błąd podczas aktualizacji danych użytkownika.";
            }
        }
    }

    public function deleteUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $result = $this->TableModel->deleteUser($id);
            if ($result) {
                echo "Użytkownik został usunięty.";
            } else {
                echo "Błąd podczas usuwania użytkownika.";
            }
        }
    }

}


