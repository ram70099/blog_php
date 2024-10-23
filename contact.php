<?php
include("common/connection.php");
include("class/login.php");
$login = new login($connect);

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $table='about_us';
    $message=$login->contact($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'],$table);
    if ( $message === true) 
    {
        echo "<script>alert('Message sent successfully!');</script>";
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
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="   css/contact.css?v=1.1">
</head>
<body>
    <div class="form-container">
        <h1>Contact Us</h1>
        <form action="contact.php" method="post">
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
    <div class="contact-info">
        <h2>Contact Information</h2>
        <p><i class="fas fa-phone"></i> Phone: +1 234 567 890</p>
        <p><i class="fas fa-envelope"></i> Email: contact@blogsite.com</p>
        <p><i class="fas fa-map-marker-alt"></i> Address: 123 Blog St, City, Country</p>
    </div>
</body>
</html>
