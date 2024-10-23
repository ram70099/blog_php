<?php
    session_start(); 
    include("common/connection.php");
    include('class/blog.php');
    $blog = new blogs($connect);
    if (!empty($_GET['log'])) 
    {
        session_destroy();
        header('location:index.php');
    }
    $category = $_GET['category'] ?? "Clothes"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogged Website </title>
    <link rel="stylesheet" href="css/styles.css?v=1.4">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
        <?php include('common/header.php'); ?>
        <div class="container">
            <?php include('common/category.php'); ?>
            <main class="content">
                <h2><?php echo htmlspecialchars($category); ?> Category Blogs</h2>
                <p>
                    <?php include('common/blogtitle.php')?>
                </p><br>
                <div class="create-pdf-button-container">
                    <a href="pdf/mpdf.php?category=<?php echo urlencode($category); ?>" class="create-pdf">Create PDF for All Blogs</a>
                </div>
                <section class="blog-posts">
                    <?php $blogs = $blog->display($category);
                        foreach ($blogs as $blog) 
                        {
                            echo "<article class='blog-post'>
                                    <img src='{$blog['image']}' alt='{$blog['title']}' class='blog-image'>
                                        <div class='blog-content'>
                                            <h3>" . $blog['title'] . "</h3>
                                            <p><strong>By:</strong> " . $blog['author'] . " | <strong>Date:</strong> " . date('F d, Y', strtotime($blog['created_at'])) . "</p>
                                            <p>" . $blog['excerpt'] . "</p>
                                            <a href='readmore.php?id=" . $blog['blog_id'] . "' class='read-more'>Read More</a>
                                            <a href='pdf/mpdf.php?id=" . $blog['blog_id'] . "' class='read-more'>Create PDF </a>
                                        </div>
                                </article>";
                        } ?>               
                </section>
            </main>
        </div>
        <?php include('common/footer.php'); ?>   
    </body>
</html>
