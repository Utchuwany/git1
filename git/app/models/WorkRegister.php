<?php
//session_start();

class Work{
    private $db;
    public function __construct($dbConfig) {
        try {
            $this->db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db_name']);
        } catch(Exception $e) {
            die("Błędne połączenie z bazą danych: " . $e->getMessage());
        }
    }
    public function addDay($calendar, $year, $month, $day, $id_worker,$hours, $comment_user, $comment_superviser, $comment_admin) {
        $stmt = $this->db->prepare("INSERT INTO work (calendar, year, month, day, id_worker, hours, comment_user, comment_superviser, comment_admin) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siiiiisss", $calendar, $year, $month, $day, $id_worker, $hours,$comment_user, $comment_superviser, $comment_admin);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
        //przekierowanie do jakiejs strony do dodania
    }
    public function showDay($year, $month, $id_worker) {
        if($_SESSION['role']=='pracownik'){
            $stmt = $this->db->prepare("SELECT calendar, hours FROM work WHERE (year = ? AND month=? AND id_worker=?)");
            $stmt->bind_param("sss", $year, $month, $_SESSION['id']);
        }
        else{
            $stmt = $this->db->prepare("SELECT calendar, hours FROM work WHERE (year = ? AND month=? AND id_worker=?)");
            $stmt->bind_param("sss", $year, $month, $id_worker);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        echo "<table border='1'>";
        echo "<tr><th>Data</th><th>Przepracowane godziny</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['calendar']) . "</td>";
            echo "<td>" . htmlspecialchars($row['hours']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        return $result->fetch_all(MYSQLI_ASSOC);
        //przekierowanie do jakiejs strony do dodania
    }
    public function showComment($id_worker) {
        if($_SESSION['role']=='pracownik'){
            $stmt = $this->db->prepare("SELECT calendar, comment_user, comment_superviser, comment_admin FROM work WHERE (id_worker=?)");
            $stmt->bind_param("s", $_SESSION['id']);
        } else {
            $stmt = $this->db->prepare("SELECT calendar, comment_user, comment_superviser, comment_admin FROM work WHERE (id_worker=?)");
            $stmt->bind_param("s", $id_worker);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        echo "<table border='1'>";
        echo "<tr><th>Data</th><th>Komentarz pracownika</th><th>Komentarz kierownika</th><th>Komentarz admina</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['calendar']) . "</td>";
            echo "<td>" . htmlspecialchars($row['comment_user']) . "</td>";
            echo "<td>" . htmlspecialchars($row['comment_superviser']) . "</td>";
            echo "<td>" . htmlspecialchars($row['comment_admin']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addComment($calendar, $id_worker, $comment_user, $comment_superviser, $comment_admin) {

        switch ($_SESSION ['role']) {
            case 'Pracownik':
                $stmt = $this->db->prepare("UPDATE work SET comment_user = ? WHERE id_worker = ? AND calendar = ?");
                $stmt->bind_param("sis",  $comment_user, $id_worker, $calendar);
                $result = $stmt->execute();
                $stmt->close();
                return $result;
                


            case 'Kierownik':
                $stmt = $this->db->prepare("UPDATE work SET comment_superviser = ? WHERE id_worker = ? AND calendar = ?");
                $stmt->bind_param("sis",  $comment_superviser, $id_worker, $calendar);
                $result = $stmt->execute();
                $stmt->close();
                return $result;
                


            case 'Administrator':
                $stmt = $this->db->prepare("UPDATE work SET comment_admin = ? WHERE id_worker = ? AND calendar = ?");
                $stmt->bind_param("sis",  $comment_admin, $id_worker, $calendar);
                $result = $stmt->execute();
                $stmt->close();
                return $result;
                


            default:
            echo 'Nie udało się pobrać roli';
            break;
        }
        
    }
    
}