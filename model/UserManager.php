<?php
require_once "model/Manager.php";
class UserManager extends Manager
{
    
//    public function getUser($login)
//    {
//        $var = "";
//        
//        $db = $this->dbConnect();
//        $stmt = $db->prepare('SELECT login, password FROM users WHERE login = :login');
//        $stmt->bindValue(':username', $login, PDO::PARAM_STR);
//        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
//        $stmt->execute();
//        $data = $req->fetch(PDO::FETCH_ASSOC);
//        
//        
//        $stmt->closeCursor();
//        return $var;
//    }
//    
    public function checkLogin($login, $password)
    {
         {
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT login, password FROM users WHERE login=:login');
             
        $stmt->bindValue(':login', $login);
             
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $admin['password'])){ 
            $adminCredentials = array(
                'login' => $admin['login'],   
            );
            return $adminCredentials;
    } else {
            return false;
        }
         }
    }
    
//    public function secureInput()
//    {
//    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);  
//    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
//    $password = password_hash($password, PASSWORD_DEFAULT);
//        
//        return [
//        "login" => $login,
//        "password" => $password
//        ]
//    
//    }
    
    // faire new user manager appelle secureInput()
        
}
   

  