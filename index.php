<?php
session_start();
$path = "blogjeanfor";
spl_autoload_register(function ($class) {

    $sources = array("controllers/$class.php", "model/$class.php" );

    foreach ($sources as $source) {
        if (file_exists($source)) {
            require_once $source;
        }
    }
});

    $array = explode("/", filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW));
  
$url = array_slice($array, 2); 
    
try {
    if (isset($url[0]))
    {
      switch ($url[0]) {
        case "accueil":
              $postController = new PostController;
              $postController->displayPosts();
              break;
        case "postsimple":
            
              $safeInput = filter_input_array(INPUT_POST, [ 
       'author'  => FILTER_SANITIZE_STRING,
       'comment' => FILTER_SANITIZE_STRING,
       'addComment' => FILTER_SANITIZE_STRING,
       'post_id' => FILTER_SANITIZE_NUMBER_INT 
       ]);
              
              
            if(isset($url[1]) && ($url[1] > 0))
            { //die(var_dump($safeInput));
                if ($safeInput['addComment'] !== null)
                {
                    if ($safeInput['author'] !== null && $safeInput['comment'] !== null) {
            
                        $commentController = new CommentController;
                        $commentController->addComment($safeInput);
                        if(!empty($commentController->errors())){
                            $commentController->errors();
                        }  
                    }
            
                }
            if (isset($url[2])) 
            {
                $cutUrl = explode("=", $url[2]);
               
                if($cutUrl[0] == 'report')
                {
                $commentController = new CommentController; 
                $commentController->reportComment($cutUrl[1]);
                    
                }
                
            }
            $postController = new PostController;
            $postController->singlePost($url[1]); 
            }
              
            else 
            {
                throw new Exception('La page est introuvable.. !');
            }
            break;
            
          case "admin":
            
              if(!isset($_SESSION['login']) && !empty($_POST)) 
              {   
                
               $userController = new UserController;
               $check = $userController->checkUser();
        
              }
              
              if(!isset($_SESSION['login']) && empty($_POST))
              {
                  require('views/loginView.php');
              }
              
              if((isset($_SESSION['login'])))
              {  
                
                $adminController = new AdminController($url);
                $adminController->getAdminPage();
              } 
            break;
                   
        default:  
                  $postController = new PostController;
                  $postController->displayPosts();                                
      }
    }     
}   
catch(Exception $e)
{
    echo 'Erreur : ' .$e->getMessage();
}
