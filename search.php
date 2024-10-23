<?php
    include('common/connection.php')
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
    

?>