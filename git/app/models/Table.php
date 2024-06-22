<?php
class Table{
    private $db;
    public function __construct($dbConfig) {
        try {
            $this->db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db_name']);
        } catch(Exception $e) {
            die("Błędne połączenie z bazą danych: " . $e->getMessage());
        }

    }
    public function paint($tableName) {
        // Lista dozwolonych nazw tabel, aby uniknąć SQL injection
        $allowedTables = ['users', 'work'];
        
        if (!in_array($tableName, $allowedTables)) {
            throw new Exception("Invalid table name");
        }
        
        // Dynamicznie zbudowane zapytanie SQL
        $query = "SELECT * FROM " . $tableName;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }
    public function updateRow($tableName, $id, $data) {
        $allowedTables = ['users','work'];
        
        if (!in_array($tableName, $allowedTables)) {
            throw new Exception("Nie można edytować tabeli");
        }

        $setClause = [];
        $bindParams = [];
        $types = ''; // Inicjalizacja łańcucha typów

        foreach ($data as $column => $value) {
            if ($column === 'password') {
                // Jeśli aktualizujemy hasło, to zastosuj password_hash
                $setClause[] = "password = ?";
                $hashedPassword = password_hash($value, PASSWORD_ARGON2ID);
                $bindParams[] = $hashedPassword;
            } else {
                // W przeciwnym razie, normalnie
                $setClause[] = "$column = ?";
                $bindParams[] = $value;
            }

            // Określenie typu parametru
            if (is_int($value)) {
                $types .= 'i'; // integer
            } elseif (is_double($value)) {
                $types .= 'd'; // double
            } elseif (is_string($value)) {
                $types .= 's'; // string
            } else {
                $types .= 'b'; // blob or unknown
            }
        }

        $setClause = implode(", ", $setClause);
        $query = "UPDATE $tableName SET $setClause WHERE id = ?";

        // Dodanie ID jako ostatni parametr
        $bindParams[] = $id;

        // Dodanie typu dla ID (zakładając, że ID jest typu integer)
        $types .= 'i';

        // Tworzenie tablicy z typami i wartościami
        $bindParams = array_merge([$types], $bindParams);

        $stmt = $this->db->prepare($query);

        // Użycie call_user_func_array do dynamicznego bindowania parametrów
        call_user_func_array(array($stmt, 'bind_param'), $this->refValues($bindParams));

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Metoda pomocnicza do przekazywania referencji do bind_param
    private function refValues($arr){
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }

    public function deleteRow($tableName, $id) {
        $allowedTables = ['users', 'work'];
    
        if (!in_array($tableName, $allowedTables)) {
           throw new Exception("Invalid table name");
      }

      $query = "DELETE FROM $tableName WHERE id = ?";
       $stmt = $this->db->prepare($query);
       $stmt->bind_param("i", $id);

       $result = $stmt->execute();
       $stmt->close();
       return $result;
    }
    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }

    public function updateUser($id, $name, $surname, $email, $role, $active) {
        $query = "UPDATE users SET name = ?, surname = ?, email = ?, role = ?, active = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssii", $name, $surname, $email, $role, $active, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}