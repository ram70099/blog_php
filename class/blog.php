<?php
class blogs 
{
    private $conn;
    function __construct($dbConnection) 
    {
        $this->conn = $dbConnection; 
    }
    function addpost($title, $author, $category, $content, $excerpt, $file,$uid)
    {
        $image_path = "";
        $target_dir = "uploads/";
        $image_name = basename($file['name']);
        $image_path = $target_dir . $image_name;
        move_uploaded_file($file['tmp_name'], $image_path);
        $sql = "INSERT INTO blogs (uid ,title, author, category, content, image, excerpt) VALUES ('$uid','$title', '$author', '$category', '$content', '$image_path', '$excerpt')";
        if ($this->conn->query($sql)) 
        {
            return true; 
        } 
        else 
        {
            return false;
        }
    }
    function editpost($id)
    {
        $sql = "SELECT * FROM blogs WHERE uid = $id";
        $result = $this->conn->query($sql); 
        if ($result->num_rows > 0) 
        {
            $data = [];
            while ($blog = $result->fetch_assoc()) 
            {
                $data[] = $blog; 
            }
            return $data; 
        } 
        else 
        {
            return []; 
        }
    }

    function display($category) 
    {
        $sql = "SELECT * FROM blogs WHERE category = '$category' AND approved = 1 ORDER BY created_at DESC"; 
        $result = $this->conn->query($sql); 
        if ($result->num_rows > 0) 
        {
            $blogs = [];
            while ($blog = $result->fetch_assoc()) 
            {
                $blogs[] = $blog; 
            }
            return $blogs; 
        } 
        else 
        {
            return []; 
        }
    }
    function readmore($postId )
    {
        
            $sql = "SELECT * FROM blogs WHERE blog_id = $postId";
        
        
            $result = $this->conn->query($sql);
            if ($result->num_rows == 1) 
            {
                $post = $result->fetch_assoc();
                return $post;
            }
    }
    public function readcategory($category)
{
    $sql = "SELECT * FROM blogs WHERE category = '$category'";
    $result = $this->conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        return $result;
    }
}


    function home() 
    {
        $sql = "SELECT * FROM blogs where approved = 1 ORDER BY RAND() LIMIT 3";
        $result = $this->conn->query($sql);
        
        if ($result) {
            $blogs = [];
            while ($blog = $result->fetch_assoc()) {
                $blogs[] = $blog;
            }
            return $blogs; 
        } else {
            return [];
        }
    }
    public function addveiw($blogId, $userId) {
        // Check if a view entry already exists for the blog by the user (if you track by user)
        $query = "SELECT * FROM view WHERE blog_id = $blogId AND uid = $userId";
        $result = $this->conn->query($query);
        
        if ($result->num_rows > 0) {
            // If the view entry exists, update the views count
            $query = "UPDATE view SET views = views + 1 WHERE blog_id = $blogId AND uid = " . ($userId !== null ? $userId : 'NULL');
        } else {
            // If the view entry does not exist, insert a new record
            $query = "INSERT INTO view (blog_id, uid, views) VALUES ($blogId, " . ($userId !== null ? $userId : 'NULL') . ", 1)";
        }
        
        return $this->conn->query($query);
    }
    function addComment($postId, $author, $content) {
        $query = "INSERT INTO comments (post_id, author, content) VALUES ($postId, '$author', '$content')";
        if ($this->conn->query($query) === TRUE)
        {
            return true; 
        } 
        else 
        {
            return false;
        }
    }
    function displaycomment($postId,$uid) {
        $query = "SELECT * FROM comments WHERE post_id = '$postId' AND uid = '$uid' "; 
        $result = $this->conn->query($query);
        if ($result) 
        {
            $comments = []; // Initialize the comments array
            while ($comment = $result->fetch_assoc()) 
            {
                $comments[] = $comment; // Add each comment to the array
            }
            return $comments; 
        } 
        else 
        {
            return []; // Return an empty array if no comments found or on error
        }
    }
    public function addvisiters() {
        $query = "SELECT * FROM visiters ";
        $result = $this->conn->query($query);
    
        if ($result->num_rows > 0) {
            $query = "UPDATE visiters SET views = views + 1 ";
        } else {
            $query = "INSERT INTO visiters (views) VALUES (1)";
        }
    
        return $this->conn->query($query);
    }
    
}
?>