<?php
class User
{
   private $_login;
   private $_password; 
    
    


    
  // SETTERS
	public function setId($id)
	{
		$id = (int) $id;

		if($id > 0)
		{
			$this->_id = $id;
		}
	}
	public function setLogin($login)
	{
		if (is_string($login))
		{
			$this->_login = $login;
		}
	}
	public function setPassword($password)
	{
		if (is_string($password))
		{
			$this->_password = $password;
		}
	}
	//GETTERS
	public function id()
	{
		return $this->_id;
	}
	public function login()
	{
		return $this->_login;
	}
	public function password()
	{
		return $this->_password;
	}
}

 
  