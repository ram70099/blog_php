<?php
class login 
{
    private $conn;

    function __construct($dbConnection) 
    {
        $this->conn = $dbConnection; 
    }
    function signup($name, $email, $password)
    {
        $token = bin2hex(random_bytes(16));
        $sql = "INSERT INTO signup (name, email, password, verification_token) VALUES ('$name', '$email', '$password', '$token')";
        $result = $this->conn->query($sql);
        if ($result) {
            $this->send($email, $token);
                $users = []; // Initialize an array to hold the user data
                while ($user = $result->fetch_assoc()) 
                { // Fetch each row as an associative array
                    $users[] = $user;
                    session_start();
                    $_SESSION['uid']= $users['uid'];// Add the user to the array
                }
            return "Signup successful!";
        } else {
            return "Signup not successful: ";
        }
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
    function login($email, $password) {
        $sql = "SELECT * FROM signup WHERE email='$email'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) 
        {
            $user = $result->fetch_assoc();
            if ($user['is_verified'] == 1) 
            {
                session_start(); 
                $_SESSION['username'] = $user['name'];
                $_SESSION['user_data'] = $user; 
                $_SESSION['role'] = $user['role'];
                return true; 
            } 
            else 
            {
                return 'Please verify your email'; 
            }
        } 
        else 
        {
            return 'No user found with this email'; 
        }
    }
    function contact($name, $email, $subject, $message,$table) 
    {
        global $token;
        $sql = "INSERT INTO $table (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
        if ($this->conn->query($sql)) 
        {
            $this->send($email, $token);
            return true; 
        } 
        else 
        {
            return false;
        }
    }
}
?>