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
        if (isset($_POST['title']))
       {
           
           $news = new Post(
               [
                   'title'=> $_POST['title'],
                   'content'=> $_POST['content']   
               ]
           );
           
        if (isset($_POST['id']))
	{
	    $news->setId($_POST['id']);
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
           
					$cutUrl = explode("=", $this->_url[1]);
           

					$postController = new PostController();
					$commentController = new CommentController();
                    $userController = new UserController;
           
					switch ($cutUrl[0]){
				    case "deletePost":
						$postController->deletePost($cutUrl[1]);
						break;
						case "editPost":
                        
				//		$this->_post = $postController->editPost($cutUrl[1]);
                          //  $postController->editPost($cutUrl[1]);
                         $news = $postController->onePost($cutUrl[1]);
                          
						break;
						case "delete":
						$commentController->deleteComment($cutUrl[1]);
						break;
                        case "moderate":
                        $commentController->moderateComment($cutUrl[1]);
                        break;
                        case "logout=":
						$userController = new UserController();
						$userController->logout();
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
    

 

