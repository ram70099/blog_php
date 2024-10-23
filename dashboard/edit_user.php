<?php
session_start();
include("../common/connection.php");
include('../class/loginc.php');
$obb = new User($connect);
$delete = new Delete($connect);

if (!empty($_GET['log'])) {
    session_destroy();
    header('location:../index.php');
}

$name = '';
$email = '';
$action = 'add';  // Default action is add

// Check if `eid` is provided in the URL for editing
if (isset($_GET['eid'])) {
    $id = $_GET['eid'];
    // Get the current user details based on the ID
    $user = $obb->getUserById($id);
    
    if (!$user) {
        header('Location: user.php?msg=User not found.');
        exit();
    }
    
    // Populate form with user data for editing
    $name = $user['name'];
    $email = $user['email'];
    $action = 'edit'; // Set action to edit
}

// Handle form submission for adding or updating the user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    
    if (isset($_POST['uid'])) { // If uid is set, it's an update
        $id = $_POST['uid'];
        $updateResult = $obb->updateUser($id, $name, $email,$role);
        
        if ($updateResult) {
            header('Location: user.php?lag=1&msg=User updated successfully!');
            exit();
        } else {
            $error = "Error updating user. Please try again.";
        }
    } else { // Otherwise, it's an add user action
        $addResult = $obb->addUser($name, $email,$role);
        
        if ($addResult) {
            header('Location: user.php?lag=1&msg=User added successfully!');
            exit();
        } else {
            $error = "Error adding user. Please try again.";
        }
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
    <link rel="stylesheet" href="../css/dashboard.css?v=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include('../common/header.php'); ?>
    <div class="container">
        <?php include('../common/category.php'); ?>
        
        <main class="content">          
            <h1><?php echo $action === 'edit' ? 'Edit User' : 'Add User'; ?> Details</h1><br>
            
            <!-- Display error message if any -->
            <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

            <!-- User Form -->
            <form method="POST" action="edit_user.php<?php echo isset($id) ? '?eid=' . $id : ''; ?>" class="edit-form">
    <!-- Hidden field for user ID (only for edit) -->
                <?php if ($action === 'edit'): ?>
                    <input type="hidden" name="uid" value="<?php echo $user['uid']; ?>">
                <?php endif; ?>
                
                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>" required>
                
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" required>
                
                <label for="role">Role</label>
                <select name="role" required>
                    <option value="user" >user</option>
                    <option value="admin">admin</option>
                </select><br><br>
                
                <button type="submit" class="btn-update"><?php echo $action === 'edit' ? 'Update User' : 'Add User'; ?></button>
            </form>


            <!-- Back to User List Link -->
            <a href="user.php?lag=1" class="back-link">Back to User List</a>
        </main>
    </div>
    <?php include('../common/footer.php'); ?>
</body>

</html>

