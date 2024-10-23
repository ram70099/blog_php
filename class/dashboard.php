<?php

class dashboard {
    private $conn;
    function __construct($dbConnection) 
    {
        $this->conn = $dbConnection; 
    }
    private function send($to, $token)
    {
        global $user;
        $subject = "Email Verification";  
        $message = "Click here to verify your email: http://localhost/blog/verifymail/verify.php?token=$token";
        $headers = 'From: ramrattan099@gmail.com' . "\r\n" .
                   'Reply-To: ramrattan099@gmail.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
                   

        if(mail($to, $subject, $message, $headers)){  
            echo "Verification email sent successfully...";  
        } else {  
            echo "Sorry, unable to send email...";  
        }  
    }
      
    function recentpost($uid, $limit, $offset) {
        $query = "SELECT * FROM blogs WHERE uid = '$uid' LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
        public function getTotalPosts($uid) {
        $query = "SELECT COUNT(*) as total_posts FROM blogs WHERE uid = $uid";
        $result = $this->conn->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC); // Fetch associative array
        return (int)$row['total_posts']; // Return total_posts as integer
    }
    function getTotalBlogs($uid) {
        $query = "SELECT COUNT(*) as total FROM blogs WHERE uid = '$uid'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['total'];
    }
    
    public function getTotalViewers($blogId) {
        $query = "SELECT SUM(views) as total_views FROM view WHERE uid = $blogId";
            $result = $this->conn->query($query);
            if (!$result) {
            echo "Error: " . $this->conn->error; // Output any SQL errors
            return 0; // Return 0 if there is an error
            }
        $row = $result->fetch_array(MYSQLI_ASSOC);
            return (int) $row['total_views'] ?: 0;  // Use ?: to ensure a default of 0
    }
    
    public function getTotalComments($uid) {
        $query = "SELECT COUNT(*) as total_comments FROM comments WHERE uid = $uid";
        $result = $this->conn->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC); // Fetch associative array
        return (int)$row['total_comments'];
    }
    function deletepost($user_id) {
        $query = "DELETE FROM blogs WHERE id = $user_id";
        if ($this->conn->query($query) === TRUE)
        {
            return true; 
        } 
        else 
        {
            return false;
        }
    }
}   
?>