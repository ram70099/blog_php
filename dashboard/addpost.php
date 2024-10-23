<?php
    session_start();
    include("../common/connection.php");
    include("../class/blog.php");
    $blog = new blogs($connect);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $message=$blog->addpost($_POST['title'],$_POST['author'],$_POST['category'],$_POST['content'],$_POST['excerpt'],$_FILES['image'],$_SESSION['user_data']['uid']);
        if ($message === true) 
        {
            header('Location:http://localhost/blog/dashboard/dashboard.php?lag=1');
        } 
        else 
        {
            echo "<script>alert('New post Not added!');</script>";
        }
        $connect->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="../css/post.css?v=1.1">
    <script src="https://cdn.tiny.cloud/1/cryl9extu64qm6m5abvkf98a4e2ut37sqxw7koum5kw2d9do/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="../tiny JS/scripts.js" defer></script>

</head>
<body>
    <div class="form-container">
    <input type="hidden" name="uid" value="<?php $_SESSION['user_data']['uid'] ?>" >
        <h1>Add New Post</h1>
        <form id="addPostForm" action="addpost.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="postTitle">Title:</label>
                <input type="text" id="postTitle" name="title" required>
            </div>
            <div>
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="clothes">Clothes</option>
                    <option value="electronics">Electronics</option>
                    <option value="books">Books</option>
                    <option value="furniture">Furniture</option>
                    <option value="sports">Sports</option>
                    <option value="accessories">Accessories</option>
                </select>
            </div>
            <div>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div>
                <label for="excerpt">Excerpt:</label>
                <input type="text" id="excerpt" name="excerpt" required>
            </div>
            <div>
                <label for="summary">Post Summary:</label>
                <textarea id="summary" name="content" rows="3" required></textarea>
            </div>
            
            <div>
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div>
                <label for="content">Content:</label>
                <textarea id="content" name="content"></textarea>
            </div>
            <div>
                
                <?php if (empty($_SESSION['username'])) { ?>
					<a href="login/login.php"><input type="button" value="First Login to Add Post"></a>
				<?php } else { ?>
					<button type="submit" name="addpost">Add Post</button>
				<?php } ?>
            </div>
        </form>
    </div>
</body>
</html>
