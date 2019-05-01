<?php
class CommentController
{
    protected $errors;
    
    public function addComment($safeInput)
  	{			
		$errors = [];
           
		if ($safeInput['author'] === null || $safeInput['comment'] === null) 
        { 
			$errors = "Veuillez remplir tous les champs !";}

		if(!preg_match('`^[[:alnum:]]{3,15}$`',$safeInput['author'])) {
			$errors = "Pseudo incorrect";
			return $errors;
		}

		if ($safeInput['post_id'] === null) { 
			$errors = "Il n'y a pas d'articles pour ce commentaire";
		}

		if(empty($errors)) {
			$commentManager = new CommentManager();
			$commentManager->addComment($safeInput['author'], $safeInput['comment'], $safeInput['post_id']);
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
