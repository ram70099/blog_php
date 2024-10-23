<?php
    session_start();
    include("common/connection.php");
    include("class/blog.php");
    $blog = new blogs($connect);
    if (isset($_GET['id'])) 
    {
        $post=$blog->readmore($_GET['id']);
        if ($post) {
            $uid=$_SESSION['user_id']['uid'];
            $blog->addveiw($_GET['id'],$uid);
        }
    } 
    else 
    {
        header('Location: index.php');
        exit();
    }  
        
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title']; ?> - Blog Website</title>
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/styles.css?v=1.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <?php include('common/header.php'); ?>
    <div class="container">
        <main class="blog-content">
            <h1><?php echo $post['title']; ?></h1>
            <p><strong>By:</strong> <?php echo $post['author']; ?> | <strong>Date:</strong>
                <?php echo date('F d, Y', strtotime($post['created_at'])); ?></p>
            <div class="image-excerpt-container">
                <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" class="blog-post-image">
                <p class="excerpt"><?php echo $post['excerpt']; ?>
                    <?php echo $post['content']; ?></p>
            </div>
            <div class="button-container">
                <a href="index.php" class="back-btn">Back to Home</a>
                <a href="comment.php?id=<?php echo $post['blog_id']; ?>" class="comment-btn">Comment Section</a>
                <div class="share-container">
                    <button type="button" class="share-button"
                        onclick="document.getElementById('share-buttons').style.display = (document.getElementById('share-buttons').style.display === 'none' || document.getElementById('share-buttons').style.display === '') ? 'block' : 'none';">
                        Share
                    </button>
                    <div id="share-buttons" class="share-buttons">
                        <p>Share this product:</p>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=http://localhost/blog/readmore.php?id=<?php echo $post['blog_id']; ?>"
                            target="_blank">
                            <img src="images/sharefb.png" alt="Share on Facebook" class="social-icon">
                        </a>
                        <a href="https://wa.me/?text=http://localhost/blog/readmore.php?id=<?php echo $post['blog_id']; ?>"
                            target="_blank">
                            <img src="images/sharewb.jpg" alt="Share on WhatsApp" class="social-icon">
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=http://localhost/blog/readmore.php?id=<?php echo $post['blog_id']; ?>&text="
                            target="_blank">
                            <img src="images/sharetw.png" alt="Share on Twitter" class="social-icon">
                        </a>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <?php include('common/footer.php'); ?>
</body>

</html>