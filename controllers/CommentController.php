<?php
class CommentController
{
    protected $errors;
        
    public function addComment()
  	{			
		$errors = [];
     
       $safeInput = filter_input_array(INPUT_POST, [ 
       'author'  => FILTER_SANITIZE_STRING,
       'comment' => FILTER_SANITIZE_STRING,
       'post_id' => FILTER_SANITIZE_NUMBER_INT
       ]);
        
        
		if(is_null($safeInput['author']) || is_null($safeInput['comment']) || empty($safeInput['author']) || empty($safeInput['comment'])) { 
			$errors = "Veuillez remplir tous les champs !";}

		if(!preg_match('`^[[:alnum:]]{3,15}$`',$safeInput['author'])) {
			$errors = "Pseudo incorrect";
			return $errors;
		}

		if(is_null($safeInput['post_id'])) { 
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
