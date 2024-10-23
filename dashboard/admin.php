<?php
session_start();
include("../common/connection.php");
include('../class/approved.php');
$obb = new approved($connect);

if (!empty($_GET['log'])) {
    session_destroy();
    header('location:../index.php');
}
if (isset($_GET['approveid']))
{
    $obb->approvePost($_GET['approveid']);
}
$limit=3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$page = max($page, 1); 
$offset = ($page - 1) * $limit; 
$totalBlogs = $obb->totalnotapproved();
$totalPages = ceil($totalBlogs / $limit); 
$blogs = $obb->notapproved( $limit, $offset); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogged Website </title>
    <link rel="stylesheet" href="../css/styles.css?v=1.3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include('../common/header.php'); ?>
    <div class="container">
        <?php include('../common/category.php'); ?>
        <main class="content">
            <h2>Welcome to Our Blog</h2>
            <p>Discover the latest insights and articles from various categories. Enjoy reading our handpicked blogs!</p>
            
            <h2>Random Blogs</h2>
            <section class="blog-posts">
                <?php  
                foreach ($blogs as $blog) {
                    echo "<article class='blog-post'>
                            <img src='../{$blog['image']}' alt='{$blog['title']}' class='blog-image'>
                            <div class='blog-content'>
                                <h3>" . $blog['title'] . "</h3>
                                <p><strong>By:</strong> " . $blog['author'] . " | <strong>Date:</strong> " . date('F d, Y', strtotime($blog['created_at'])) . "</p>
                                <p>" . $blog['excerpt'] . "</p>
                                <a href='../readmore.php?id=" . $blog['blog_id'] . "' class='read-more'>Read More</a>
                                <a href='admin.php?lag=1&admin=1&approveid=".$blog['blog_id']."&page={$page}' class='read-more'>Approve</a>
                                
                            </div>
                        </article>";
                } ?>
            </section>
            <?php include('pagination.php'); ?>
        </main>
    </div>
    <?php include('../common/footer.php'); ?>
</body>

</html>
