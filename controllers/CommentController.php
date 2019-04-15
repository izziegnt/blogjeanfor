<?php
class CommentController
{
    protected $errors;
        
    public function addComment()
  	{			
		$errors = [];

		if(!isset($_POST['author']) || empty($_POST['comment']) || !isset($_POST['comment']) || empty($_POST['comment'])) { 
			$errors = "Veuillez remplir tous les champs !";}

		if(!preg_match('`^[[:alnum:]]{3,15}$`',$_POST['author'])) {
			$errors = "Pseudo incorrect";
			return $errors;
		}

		if(!isset($_POST['post_id']) || empty($_POST['post_id'])) { 
			$errors = "Il n'y a pas d'articles pour ce commentaire";
		}

		if(empty($errors)) {
			$commentManager = new CommentManager();
			$commentManager->addComment($_POST['author'], $_POST['comment'], $_POST['post_id']);
  		}
  	}
        
 public function getReportedComments()
  	{
  		$commentManager = new CommentManager();
  		return $commentManager->getreportedComments();
  	}

  	public function reportComment($id)
  	{
  		$commentManager = new CommentManager();
        return $commentManager->reportComment($id);    
  	}
    
    public function deleteComment($id)
    {
        $commentManager = new CommentManager();
        $commentManager->deleteComment($id);
    }
    
     public function moderateComment($id)
    {
        $commentManager = new CommentManager();
        $commentManager->moderateComment($id);
    }
   public function errors()
   {
       return $this->errors;
   }
}