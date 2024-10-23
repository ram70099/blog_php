<?php
session_start();
include("../common/connection.php");
include('../class/approved.php');
$obb = new approved($connect);

if (!empty($_GET['log'])) {
    session_destroy();
    header('location:../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogged Website </title>
    <link rel="stylesheet" href="../css/styles.css?v=1.3">
    <link rel="stylesheet" href="../css/comment.css?v=1.3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include('../common/header.php'); ?>
    <div class="container">
        <?php include('../common/category.php'); ?>
        <main class="content">
            <h2>Welcome to Our Blog</h2>
            <p>Discover the latest insights and articles from various categories. Enjoy reading our handpicked blogs!</p>
            <h2>Recent Blogs</h2>
            <section class="blog-posts">
            <div class="comments-list">
        <?php
        $uid=$_SESSION['user_data']['uid'];
        $comments = $obb->commentshow($uid); 
        foreach ($comments as $comment) {
            echo "<div class='comment'>
                    <div class='comment-author'>{$comment['author']}</div>
                    <div class='comment-date'>" . date('F d, Y', strtotime($comment['created_at'])) . "</div>
                    <div class='comment-content'>{$comment['content']}</div>
                  </div>";
        }
        ?>
    </div>
            </section>
        </main>
    </div>
    <?php include('../common/footer.php'); ?>
</body>

</html>
