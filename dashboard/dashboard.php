<?php
session_start();
include("../common/connection.php");
include('../class/dashboard.php');
$obb = new dashboard($connect);
// Logout logic
if (!empty($_GET['log'])) 
{
    session_destroy();
    header('Location: ../index.php');
    exit();
}
if (!empty($_GET['did'])) 
{
    $result = $obb->deletepost($_GET['did']);
    if ($result) {
        header('Location: dashboard.php?lag=1&msg=user deleted successfully.');
        exit();
    } else {
        header('Location: dashboard.php?lag=1&msg=user not deleted. Please try again.');
        exit();
    }
}


$limit = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); 
$offset = ($page - 1) * $limit; 
$uid = $_SESSION['user_data']['uid'];
$totalBlogs = $obb->getTotalBlogs($uid);
$totalPages = ceil($totalBlogs / $limit); 
$blogs = $obb->recentpost($uid, $limit, $offset); 
// Fetch total counts
$totalPosts = $obb->getTotalPosts($uid);
$totalViewers = $obb->getTotalViewers($uid);
$totalComments = $obb->getTotalComments($uid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogged Website</title>
    <link rel="stylesheet" href="../css/styles.css?v=1.2">
    <link rel="stylesheet" href="../css/dashboard.css?v=1.4">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include('../common/header.php'); ?>
    <div class="container">
        <?php include('../common/category.php'); ?>
        <main class="content">
            <h2>Recent Posted Blogs</h2><br>
            <p>Discover the latest insights and articles from various categories. Enjoy reading our handpicked blogs!</p><br>
            <div class="statistics">
                <div class="stat-item">
                    <h3>Total Posts</h3>
                    <p><?php echo $totalPosts; ?></p>
                </div>
                <div class="stat-item">
                    <h3>Total Viewers</h3>
                    <p><?php echo $totalViewers; ?></p>
                </div>
                <div class="stat-item">
                    <h3>Total Comments</h3>
                    <p><?php echo $totalComments; ?></p>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Excerpt</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($blogs)) {
                        foreach ($blogs as $blog) {
                            echo "<tr>
                                    <td><img src='../{$blog['image']}' alt='{$blog['title']}' class='blog-image'></td>
                                    <td>{$blog['title']}</td>
                                    <td>{$blog['author']}</td>
                                    <td>" . date('F d, Y', strtotime($blog['created_at'])) . "</td>
                                    <td>{$blog['excerpt']}</td>
                                    <td>
                                        <div class='action-buttons'>
                                            <a href='addpost.php?lag=1&eid=" . $blog['blog_id'] . "' class='edit-btn'>Edit</a>
                                            <a href='dashboard.php?lag=1&did=" . $blog['blog_id'] . "' class='delete-btn'>Delete</a>
                                        </div>
                                    </td>
                                  </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php include('pagination.php'); ?>
        </main>
    </div>
    <?php include('../common/footer.php'); ?>
</body>
</html>
