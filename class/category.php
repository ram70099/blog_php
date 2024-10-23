<?php
class category
{
    private $conn;

    function __construct($dbConnection) 
    {
        $this->conn = $dbConnection; 
    }

    function getcategory($id = null) {
        if ($id) {
            // Fetch a single category if an ID is provided
            $query = "SELECT * FROM categories WHERE cid = $id"; // cid is assumed to be the category ID column
            $result = $this->conn->query($query);
            
            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc(); // Return the single category as an associative array
            } else {
                return null; // Return null if no category is found
            }
        } else {
            // Fetch all categories if no ID is provided
            $query = "SELECT * FROM categories";
            $result = $this->conn->query($query);
            
            if ($result) {
                $data = []; // Initialize an array to hold the category data
                while ($category = $result->fetch_assoc()) {
                    $data[] = $category; // Add each category to the array
                }
                return $data; // Return the array of categories
            } else {
                return []; // Return an empty array if there is an error
            }
        }
    }
    
    function addcategory($category) {
        $query = "INSERT INTO categories (category_name) VALUES ('$category')";
        if ($this->conn->query($query) === TRUE)
        {
            return true; 
        } 
        else 
        {
            return false;
        }
    }
    public function updatecategory($category, $id) {
        $query = "UPDATE categories SET category_name='$category' WHERE cid = $id";
        
        // Execute the query
        $result = mysqli_query($this->conn, $query);
        
        // Return true if the query was successful, otherwise false
        return $result ? true : false;
    }
    function deleteCategory($category_id) {
        $query = "DELETE FROM categories WHERE cid = $category_id";
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