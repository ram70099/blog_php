<?php
session_start();
include("../common/connection.php");
include('../class/visiters.php');
$obb = new visiter($connect);
// Logout logic
if (!empty($_GET['log'])) {
    session_destroy();
    header('Location: ../index.php');
    exit();
}

$totalPosts = $obb->getTotalPosts();
$totalViewers = $obb->getTotalViewers();
$totalComments = $obb->getTotalComments();
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
            <h2>Total Blogs</h2><br>
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
        </main>
    </div>
    <?php include('../common/footer.php'); ?>
</body>
</html>
