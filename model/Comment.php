<?php
require_once('model/Manager.php');
class Comment extends Manager
{
    private $_id;
    private $_post_id;
    private $_author;
    private $_comment;
    private $_comment_date;
    private $_report_nb;
    
    
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
    
    public function setId($id)
	{
		$id = (int) $id;

		if($id > 0)
		{
			$this->_id = $id;
		}
	}
	public function setPost_id($post_id)
	{
		$post_id = (int) $post_id;
		if($post_id > 0)
		{
			$this->_post_id = $post_id;
		}
	}
	public function setAuthor($author)
	{
		if (is_string($author))
		{
			$this->_author = $author;
		}
	}
	public function setComment($comment)
	{
		if (is_string($comment))
		{
			$this->_comment = $comment;
		}
	}
	public function setComment_date($date)
	{
		$this->_comment_date = new DateTime($date);
	}
   
    public function setReport_nb($report_nb)
    {
        $report_nb = (int) $report_nb;
        if($report_nb >= 0)
        {
        $this->_report_nb = $report_nb;
        }
    }
    public function id()
    {
        return $this->_id;
    }
    public function post_id()
    {
        return $this->_post_id;
    }
    public function author()
    {
        return $this->_author;
    }
    public function comment()
    {
        return $this->_comment;
    }
    public function comment_date()
    {
        return $this->_comment_date->format('j m Y');
    }
    public function report_nb()
    {
        return $this->_report_nb;
    }
}