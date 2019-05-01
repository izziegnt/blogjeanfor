<?php
class AdminController
{
   private $_login;
   private $_password;
   private $_url;
 
   public function __construct($url)
   {
       $this->_url = $url;

   }
    
   public function getAdminPage()
 {    
       
    $safeInputAdmin = filter_input_array(INPUT_POST, [
    
    'title' => FILTER_SANITIZE_STRING,
    'content' => FILTER_SANITIZE_STRING, 
    'id' => FILTER_SANITIZE_NUMBER_INT
]);
                                         
        if (!is_null($safeInputAdmin['title']))
       {
     
           $news = new Post(
               [
                   'title'=> $safeInputAdmin['title'],
                   'content'=> $safeInputAdmin['content']   
               ]
           );
           
        if (isset($safeInputAdmin['id']))
	{
	    $news->setId($safeInputAdmin['id']);
	}
	  
	if ($news->isValid())
	{
	  	$postManager = new PostManager();
	    $postManager->save($news);
	    
	    $message = $news->isNew() ? 'L\'article a bien été ajouté !' : 'L\'article a bien été mis à jour !';
	    $news = null;
    }
	else
	{
    	$errors = $news->errors();
	}
       }
       
       if(isset($this->_url[1]))
       {
           
           if($this->_url[1] == "logout")
           {

             $userController = new UserController();
             $userController->logout();
             global $path; 
             header('location:/'.$path. '/admin/');
			 return;	
           }
					$cutUrl = explode("=", $this->_url[1]);
           

					$postController = new PostController();
					$commentController = new CommentController();
                    $userController = new UserController;
           
					switch ($cutUrl[0]){
				    case "deletePost":
						$postController->deletePost($cutUrl[1]);
						break;
						case "editPost":
                         $news = $postController->onePost($cutUrl[1]);
						break;
						case "delete":
						$commentController->deleteComment($cutUrl[1]);
						break;
                        case "moderate":
                        $commentController->moderateComment($cutUrl[1]);
                        break;
                
					}
       }
        $reportedComments = $this->reportedComments();
        $posts = $this->listPosts();
        global $path;
        require('views/adminView.php');      
   }  
    
    function listPosts(){
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet
    return $posts;
}
    

    public function reportedComments()
  {    
    $commentController = new CommentController();
    $reportedComments = $commentController->getReportedComments();
    return $reportedComments;
     
   }


    public function setUrl($url)
	{
		 if(is_string($url));
        {
            $this->_url = $url;
        }
	}
	//GETTERS
	public function url()
	{
		return $this->_url;
	}	
}
    

 

