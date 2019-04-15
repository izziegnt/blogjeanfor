<?php
require_once('model/Manager.php');
class Post extends Manager
{
    private $_errors = [];
    private $_id;
    private $_title;
    private $_content;
    private $_creation_date;
    
  	const TITRE_INVALIDE = 1;
  	const CONTENU_INVALIDE = 2;

    
    public function __construct($data = [])
    {
        
        if (!empty($data)) {
            
            $this->hydrate($data);
        }
        
    }
    public function hydrate($data)
    {
        foreach($data as $key => $value)
        {
          $method = 'set'.ucfirst($key);
            
          if (method_exists($this, $method))
          {
             $this->$method($value);
          }
        }
    }
    
    public function isNew()
	{
		return empty($this->_id);
	}

	public function isValid()
   {
     return !(empty($this->_title) || empty($this->_content));
   }
  
    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0)
       {
        $this->_id = $id;
       }
    }
    public function setTitle($title)
    {
        if(is_string($title))
        {
        $this->_title = $title;
        }
        else
        {
            $this->_errors[] = self::TITRE_INVALIDE;
        }
    }
    
    public function setContent($content)
    {
        if(is_string($content))
        {
        $this->_content = $content;
        }
        else 
        {
            $this->_errors[] = self::CONTENU_INVALIDE;
        }
    }
    
    public function setCreation_date($creation_date)
    {
        
        $this->_creation_date = new DateTime($creation_date);  
    }
    
    public function errors()
	{
	    return $this->_errors;
	} 
    
    public function id()
    {
        return $this->_id;
    }
    public function title()
    {
        return $this->_title;
    }
    public function content()
    {
        return $this->_content;
    }
    public function creation_date()
    {
        return $this->_creation_date->format('j m Y');
    }
    

}