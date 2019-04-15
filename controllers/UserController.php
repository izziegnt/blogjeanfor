<?php
class UserController
{    

  public function checkUser()
  {

  $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);  
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  if($login && $password){
  $userManager = new UserManager();
  $result = $userManager->checkLogin($login, $password);
    
    if (empty($result)){ 
       $this->logout();
       return false;
    }
  $_SESSION['login'] = $login;
    return true;
}
  }
public function logout()
{
    $_SESSION = [];
    session_destroy();
}   
 }