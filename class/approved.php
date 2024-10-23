<?php
class approved
{
    private $conn;
    function __construct($dbConnection) 
    {
        $this->conn = $dbConnection; 
    }

    function notapproved($limit, $offset) 
    {
        $sql = "SELECT * FROM blogs WHERE approved = 0 LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($sql);
        
        if ($result) {
            $data = [];
            while ($blog = $result->fetch_assoc()) {
                $data[] = $blog;
            }
            return $data; 
        } else {
            return [];
        }
    }
    function approvePost($id) {
        $id = intval($id); // Ensure the ID is an integer to avoid SQL injection
        $query = "UPDATE blogs SET approved = 1 WHERE blog_id = $id";
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    function totalnotapproved() {
        $query = "SELECT COUNT(*) as total FROM blogs WHERE approved=0";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['total'];
    }
    function commentshow($uid) 
    {
        $sql = "SELECT * FROM comments where uid=$uid";
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
}
?>