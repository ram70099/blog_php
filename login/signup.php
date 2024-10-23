<?php
    session_start();
    include('../common/connection.php');
    include('../class/loginc.php');
    $obb = new User($connect);
    if (isset($_POST['signup'])) 
    {
        $message = $obb->signup($_POST['name'], $_POST['email'], $_POST['password']);
    }
    include('../googleapi.php');
    include('../facebookapi.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" href="../css/style2.css?v=1.1">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">    
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="POST">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="name" placeholder="User name" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <input type="hidden" name="signup" value="1">
                <button type="submit">Sign up</button>
            </form>
            <div class="social-login">
                <a href="<?php echo $client->createAuthUrl(); ?>" class="google-login"><img src="../images/gogle.png" alt="Login with Google" style="width: 200px; height: 35px;"/></a>
                <a href="<?php echo $loginUrl; ?>" class="facebook-login"><img src="../images/fb1.png" alt="Login with FB" style="width: 200px; height: 37px;,margin:auto;"/></a>
            </div>
        </div>
    </div>
</body>
</html>