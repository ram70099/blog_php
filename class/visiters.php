<?php
class visiter
{
    private $conn;
    function __construct($dbConnection) 
    {
        $this->conn = $dbConnection; 
    }
    public function getTotalPosts()
    {
        $query = "SELECT COUNT(*) as total_posts FROM blogs ";
        $result = $this->conn->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC); // Fetch associative array
        return (int)$row['total_posts']; // Return total_posts as integer
    }
    function getTotalViewers() 
    {
        $query = "SELECT * FROM visiters";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        if ($result) 
        {
                $totalViews = $row['views'];
            }
            return $totalViews; 
        }
    
    
    function getTotalComments() 
    {
        $query = "SELECT COUNT(*) as total_comments FROM comments ";
        $result = $this->conn->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC); // Fetch associative array
        return (int)$row['total_comments'];
    }
    
}

?>