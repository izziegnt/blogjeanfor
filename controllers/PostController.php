<?php

class PostController
{
    
    function displayPosts()
  {
    global $path;
    $postManager = new PostManager;
    $posts = $postManager->getPosts();
    
    require('views/mainView.php');    
  }
    
    function singlePost($id)
  {
    global $path;  
    $postManager = new PostManager;
    $post = $postManager->getPost($id);
    $commentManager = new CommentManager;
    $comments = $commentManager->getComments($id);
    
    require('views/singlePostView.php');    
    }
    
   public function editPost($post)
  	{
  		$postManager = new PostManager();
  		return $postManager->editPost($post);  
  	}
    
    public function deletePost($id)
    {
        $postManager = new postManager();
        $postManager->deletepost($id);
    }
    
    public function addPost($post)
    {
        $postManager = new postManager();
        $postManager->addPost($post);
    }
    
    public function onePost($id)
    {
        $postManager = new PostManager;
        return $postManager->getPost($id);     
    }
}
