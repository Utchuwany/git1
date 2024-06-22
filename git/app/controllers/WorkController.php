<?php
require_once BASE_PATH . '/app/models/WorkRegister.php';

class WorkController{
    private $workModel;
    public function __construct(){
        $this->workModel = new Work(require BASE_PATH . '/app/config/database.php');
    }
    public function addDay(){
        $errors = [];
        $data =[];

        if ($_SERVER['REQUEST_METHOD']==='POST'){

            $data['calendar'] = htmlspecialchars(trim($_POST['calendar']));
            $data['year'] = substr($data['calendar'],0,4);
            $data['month'] = substr($data['calendar'],5,2);
            $data['day'] = substr($data['calendar'],-2);				
            $data['id_worker'] = htmlspecialchars(trim($_POST['id_worker']));
            $data['hours'] = htmlspecialchars(trim($_POST['hours']));
            $data['comment_user'] = "";
            $data['comment_superviser'] = htmlspecialchars(trim($_POST['comment_superviser']));
            $data['comment_admin'] = "";
       
            if (empty($errors)){
                $this->workModel->addDay($data['calendar'],$data['year'],$data['month'],
                $data['day'],$data['id_worker'],$data['hours'],$data['comment_user'],
                $data['comment_superviser'],$data['comment_admin']);
            }
            else{
                print_r($errors);
            }

        }
        require_once BASE_PATH . '/app/views/addDay.php';
    }
    public function showDay(){
        $errors = [];
        $data = [];
        if ($_SERVER['REQUEST_METHOD']=== 'POST'){
            $data['year'] = htmlspecialchars(trim($_POST['year']));
            $data['month'] = htmlspecialchars(trim($_POST['month']));
            $data['id_worker'] = htmlspecialchars(trim($_POST['id_worker']));

            if (empty($errors)){
                $this->workModel->showDay($data['year'],$data['month'],$data['id_worker']);
                
            }
            else{
                print_r($errors);
            }

        }
        require_once BASE_PATH . '/app/views/showDay.php';
    }
    public function showComment() {
        $errors = [];
        $data = [];
        if ($_SERVER['REQUEST_METHOD']=== 'POST'){
            $data['id_worker'] = htmlspecialchars(trim($_POST['id_worker']));

            if (empty($errors)){
                $this->workModel->showComment($data['id_worker']);
                
            }
            else{
                print_r($errors);
            }

        }
        require_once BASE_PATH . '/app/views/showComment.php';
    }

    public function addComment(){
        $errors = [];
        $data =[];

        switch ($_SESSION ['role']) {
            case 'Pracownik':
                if ($_SERVER['REQUEST_METHOD']==='POST'){

                    $data['calendar'] = htmlspecialchars(trim($_POST['calendar'] ?? null));		
                    $data['id_worker'] = htmlspecialchars(trim($_POST['id_worker'] ?? null));
                    $data['comment_user'] = htmlspecialchars(trim($_POST['comment_user'] ?? null));
                    $data['comment_superviser'] = "";
                    $data['comment_admin'] = "";
               
                    if (empty($errors)){
                        $this->workModel->addComment($data['calendar'],$data['id_worker'],$data['comment_user'],$data['comment_superviser'],$data['comment_admin']);
                    }
        
                }
                break;            

            case 'Kierownik':
                if ($_SERVER['REQUEST_METHOD']==='POST'){
                $data['calendar'] = htmlspecialchars(trim($_POST['calendar'] ?? null));		
                $data['id_worker'] = htmlspecialchars(trim($_POST['id_worker'] ?? null));
                $data['comment_user'] = "";
                $data['comment_superviser'] = htmlspecialchars(trim($_POST['comment_superviser'] ?? null));
                $data['comment_admin'] = "";
           
                if (empty($errors)){
                    $this->workModel->addComment($data['calendar'],$data['id_worker'],$data['comment_user'],$data['comment_superviser'],$data['comment_admin']);
                }
            }

            break;

            case 'Administrator':
                if ($_SERVER['REQUEST_METHOD']==='POST'){
                $data['calendar'] = htmlspecialchars(trim($_POST['calendar'] ?? null));		
                $data['id_worker'] = htmlspecialchars(trim($_POST['id_worker'] ?? null));
                $data['comment_user'] = "";
                $data['comment_superviser'] = "";
                $data['comment_admin'] = htmlspecialchars(trim($_POST['comment_admin'] ?? null));
               
                if (empty($errors)){
                  $this->workModel->addComment($data['calendar'],$data['id_worker'],$data['comment_user'],$data['comment_superviser'],$data['comment_admin']);
                }

            }
            break;

            default:
            echo 'Nie udało się pobrać roli';
            break;
        }

        
        
        
        require_once BASE_PATH . '/app/views/addComment.php';
    }
    
}
