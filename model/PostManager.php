<?php
require_once('model/Manager.php');
require_once('model/Post.php');
class PostManager extends Manager
{
    public function getPosts()
    {      
        
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, creation_date
        FROM posts ORDER BY id LIMIT 0, 5');
       
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {        
        $posts [] = new Post($data); 
        }
        
        return $posts;
        $req->closeCursor();
        
    }
    
    public function getPost($id)
    {
        $post = "";
        
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, creation_date FROM posts WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        $post = new Post($data);
        
        $req->closeCursor();
        return $post;
        
    }
    
    public function addPost($news)
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare('INSERT INTO posts (title, content, creation_date) VALUES (:title, :content, NOW())');
        $stmt->bindValue(':title', $news->title());
	    $stmt->bindValue(':content', $news->content());
        
        $stmt->execute();
    }
    
    public function editPost($news)
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare('UPDATE posts SET title = :title, content = :content, creation_date = NOW() WHERE id = :id');
	    

	    $stmt->bindValue(':title', $news->title());
	    $stmt->bindValue(':content', $news->content());
        $stmt->bindValue(':id', $news->id(), PDO::PARAM_INT);
	    
        $stmt->execute();
    }
    
    public function save($post)
	{
	    if ($post->isValid())
	    {
	      	$post->isNew() ? $this->addPost($post) : $this->editPost($post);
	    }
	    else
	    {
	      	throw new RuntimeException('L\'article doit être valide pour l\'enregistrement');
	    }
	}
    
    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $stmt = $db->exec('DELETE FROM posts WHERE id ='.(int) $id);
    }
}