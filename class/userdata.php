<?php

class User {
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
    function adduser($name, $email,$role)
    {
        $token = bin2hex(random_bytes(16));
    // Insert the new user into the 'signup' table
    $query = "INSERT INTO signup (name, email,role) VALUES ('$name', '$email','$role')";
    
    // Execute the query
    $result = mysqli_query($this->conn, $query);
    
    // Return true if the query was successful, otherwise false
    if ($result) 
    {
        $this->send($email, $token);
        return true;
    }
    }
    function getUsers() {
        $query = "SELECT * FROM signup"; // Adjust the table name if necessary
        $result = $this->conn->query($query); // Execute the query

        if ($result) {
            $users = []; // Initialize an array to hold the user data
            while ($user = $result->fetch_assoc()) { // Fetch each row as an associative array
                $users[] = $user;
            }
            return $users; // Return the array of users
        } else {
            return []; // Return an empty array if there is an error
        }
    }
    public function getUserById($id) {
        // Correct SQL query using mysqli
        $query = "SELECT * FROM signup WHERE uid = $id";
        $result = $this->conn->query($query);
    
        // Check if result is valid and fetch as associative array
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc(); // Use fetch_assoc() to get associative array
        } else {
            return null; // Return null if no user found
        }
    }
    

    // Function to update a user
    public function updateUser($id, $name, $email,$role) {
        // Prepare the SQL query to update the user information
        $query = "UPDATE signup SET name = '$name', email = '$email', role='$role' WHERE uid = '$id'";
        
        // Execute the query
        $result = mysqli_query($this->conn, $query);
        
        // Return true if the query was successful, otherwise false
        return $result ? true : false;
    }
    function deleteuser($user_id) {
        $query = "DELETE FROM signup WHERE uid = $user_id";
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