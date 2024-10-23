<?php
    include("common/connection.php");
    include("class/login.php");
    $login = new login($connect);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $message=$login->contact($_POST['name'],$_POST['email'],$_POST['subject'],$_POST['message'],'about_us');
        if ( $message === TRUE) 
        {
            header('Location: index.php');
        } 
        else 
        {
            echo "Please check your email";
        }
        $connect->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="css/about.css?v=1.1">
</head>
<body>

    <div class="about-section">
        <h1>About Us</h1>
        <p>Welcome to my blog website, a platform where we share insightful articles, guides, and opinions on various topics ranging from lifestyle, technology, fashion, and much more. Our mission is to provide valuable content that inspires, educates, and engages our readers. Feel free to get in touch with us if you have any questions or would like to contribute to our blog!</p>
    </div>

    <div class="form-container">
        <h2>Get in Touch or Contribute</h2>
        <form action="about.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">
                <i class="fas fa-paper-plane"></i> Send Message
            </button>
        </form>
    </div>

</body>
</html>
