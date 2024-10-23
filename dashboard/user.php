<?php
session_start();
include("../common/connection.php");
include('../class/userdata.php');
$obb = new User($connect);

if (!empty($_GET['log'])) {
    session_destroy();
    header('location:../index.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $result = $obb->addUser($name, $email,$role);
    if ($result) {
        $message = "User added successfully!";
    } else {
        $message = "Error adding user. Please try again.";
    } 
}
if (!empty($_GET['did']))
{
    $result = $obb->deleteuser($_GET['did']);
    if ($result) {
        header('Location: user.php?lag=1&msg=user deleted successfully.');
        exit();
    } else {
        header('Location:user.php?lag=1&msg=user not deleted . Please try again.');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogged Website</title>
    <link rel="stylesheet" href="../css/styles.css?v=1.3">
    <link rel="stylesheet" href="../css/dashboard.css?v=1.4">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include('../common/header.php'); ?>
    <div class="container">
        <?php include('../common/category.php'); ?>
        
        <main class="content">          
            <h1>User Table</h1>

            <!-- User Creation Form -->
            <div class="back-link">
                <h2><a href="edit_user.php?lag=1">Add User</a></h2>                
            </div>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Email Verification</th>
                        <th>Registration Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $users = $obb->getUsers(); 
                    foreach ($users as $user) 
                    {
                        echo "<tr>
                                <td>{$user['uid']}</td>
                                <td>{$user['role']}</td>
                                <td>{$user['name']}</td>
                                <td>{$user['email']}</td>
                                <td>{$user['is_verified']}</td>
                                <td>" . date('F d, Y', strtotime($user['created_at'])) . "</td>
                                <td>
                                    <div class='action-buttons'>
                                        <a href='edit_user.php?lag=1&eid=" . $user['uid'] . "' class='edit-btn'>Edit</a>
                                        <a href='user.php?lag=1&did=" . $user['uid'] . "' class='delete-btn'>Delete</a>
                                    </div>
                                </td>

                              </tr>";
                    } ?>
                </tbody>
            </table>
        </main>
    </div>
    <?php include('../common/footer.php'); ?>
</body>

</html>
