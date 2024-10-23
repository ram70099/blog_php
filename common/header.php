<header>
    <div class="header-container">
        <div class="logo-container">
        <?php if (!empty($_GET['lag'])) { ?>
                <img src="../images/logo.jpg" alt="Website Logo" class="logo">
                <?php } else { ?>
                    <img src="images/logo.jpg" alt="Website Logo" class="logo">
            <?php }?>

            <?php 
                // Set the title based on the current page
                $pageTitle = (strpos($_SERVER['REQUEST_URI'], 'dashboard.php') !== false) ? "Dashboard" : "BLOGGED WEBSITE"; 
            ?>
            <h1><?php echo $pageTitle; ?></h1>
        </div>
        <nav>
            <ul>
            <?php if (!empty($_GET['lag'])) 
            { ?>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="../contact.php">Contact us</a></li>
                <li><a href="dashboard.php?lag=1">Dashboard</a></li>
               
               
                <li>
                    <div class="btn">
                        <?php if (empty($_SESSION['username'])) { ?>
                            <a href="../login/login.php"><input type="button" value="Log in"></a>
                        <?php } else { ?>
                            <a href="../index.php?log=1"><input type="button" value="Log Out <?php echo $_SESSION['username']; ?>"></a>
                        <?php } ?>
                    </div>
                </li>                
                
            <?php } else { ?>
                    <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact us</a></li>
                <?php if (!empty($_SESSION['username'])) { ?>
                    <li><a href="dashboard/dashboard.php?lag=1">Dashboard</a></li>
                <?php }?>
               
                <li>
                    <div class="btn">
                        <?php if (empty($_SESSION['username'])) { ?>
                            <a href="login/login.php"><input type="button" value="Log in"></a>
                        <?php } else { ?>
                            <a href="index.php?log=1"><input type="button" value="Log Out <?php echo $_SESSION['username']; ?>"></a>
                        <?php } ?>
                    </div>
                </li>            <?php }?>
                
            </ul>
            <div class="search-container">
                <form method="GET">
                    <input type="text" id="search" name="query" placeholder="Search..." autocomplete="off" required>
                    <button type="submit">Search</button>
                    <ul id="suggestions" class="suggestions-list" style="display: none;"></ul> <!-- Add this line -->
                </form>
            </div>
        </nav>
    </div>
        </nav>
    </div>
</header>
