<?php
require_once('model/Manager.php');
require_once('model/Post.php');
class CommentManager extends Manager
{
    public function getComments($postId)
    {      
        $var = [];
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, post_id, author, comment, comment_date
        FROM comments WHERE post_id = :post_id ORDER BY comment_date DESC');
        $comments->bindValue(':post_id', $postId, PDO::PARAM_INT);
        $comments->execute();
        while($data = $comments->fetch(PDO::FETCH_ASSOC))
        {        
        $var[] = new Comment($data);
        }
        
        return $var;
    }
    
    public function getComment($post_id, $author, $comment)
    {
        $comment = "";
        
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, comment, comment_date FROM comments WHERE id = :id, post_id = :post_id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':post_id', $post_id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        $comment = new Comment($data);
        
        
        $req->closeCursor();
        return $data;
        
    }
    public function addComment($author, $comment, $post_id)
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare('INSERT INTO comments (post_id, author, comment, comment_date) VALUES (:post_id, :author, :comment, NOW())');
        $stmt->bindValue(':author', $author, PDO::PARAM_STR);
        $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
       
        $stmt->execute();
        
    }
    
    public function editComment($newauthor, $newcomment)
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare('UPDATE comments SET newauthor=:newauthor, newcomment=:newcomment, comment_date= NOW() WHERE id=?');
        $stmt->execute(array($author, $comment));
    }
    
    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $stmt = $db->exec('DELETE FROM comments WHERE id ='.$id);
    }
    

    public function getReportedComments()
    {
        
        $reportedComments = [];
        
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT * FROM comments WHERE report_nb >0 ORDER BY report_nb DESC');
       
        $stmt->execute();
        while($data = $stmt->fetch(PDO::FETCH_ASSOC))
        {        
        $reportedComments[] = new Comment($data);
        }
        $stmt->closeCursor();
        return $reportedComments;
    }
 	

  	 public function reportComment($id) {
        $db = $this->dbConnect();
        $stmt = $db->prepare('UPDATE comments SET report_nb = report_nb+1  WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

     public function moderateComment($id) {
        $db = $this->dbConnect();
        $stmt = $db->prepare('UPDATE comments SET report_nb = 0  WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}
