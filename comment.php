<?php
    session_start();
    include("common/connection.php");
    include('class/blog.php');
    $blog = new blogs($connect);
    $comments=[];
    if (isset($_GET['id'])) {
        $post_id = $_GET['id'];
        $uid = $_SESSION['user_data']['uid'];

        // Fetch comments for the post
        $comments = $blog->displaycomment($post_id,$uid);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $message=$blog->addComment( $_POST['post_id'], $_POST['author'],  $_POST['content']);
        if (isset($message)) {
            header("Location: comment.php?id=" . $_POST['post_id']);
            exit();
        } else {
            echo "<script>alert(\"Comment not added\");</script>";
        }
        $stmt->close();
    }
?>
<link rel="stylesheet" href="css/comment.css?v=1.1">
<!-- Display Comments -->
<div class="comments-section">
    <h2>Comments</h2>
    <?php if (!empty($comments)): ?>
        <ul>
            <?php foreach ($comments as $comment): ?>
                <li>
                    <strong><?php echo $comment['author']; ?></strong>: 
                    <p><?php echo $comment['content']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No comments yet. Be the first to comment!</p>
    <?php endif; ?>
</div>
<form action="comment.php" method="POST" class="comment-form">
    <input type="hidden" name="post_id" value="<?php echo $_GET['id']; ?>">
    <div class="form-group">
        <label for="author">Your Name</label>
        <input type="text" name="author" id="author" placeholder="Enter your name" required>
    </div>
    <div class="form-group">
        <label for="content">Your Comment</label>
        <textarea name="content" id="content" rows="5" placeholder="Enter your comment" required></textarea>
    </div>
        <?php if (empty($_SESSION['username'])) { ?>
			<a href="login/login.php"><input type="button" value="First Login to Add comments"></a>
		    <?php } else { ?>
			<button type="submit" class="submit-btn">Submit Comment</button>
		<?php } ?>
</form>


