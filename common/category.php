<aside class="sidebar">
    <h2>Categories</h2>
    <ul>
        <?php if (!empty($_GET['lag'])) { ?>
            <?php if (isset($_SESSION['user_data'])) {
                $role = $_SESSION['role'];
                if ($role == 'admin') { 
                    ?>
                    <li><a href="user.php?lag=1">User</a></li> 
                    <li><a href="addcategory.php?lag=1">Add category</a></li>
                    <li><a href="admin.php?lag=1&admin=1">For Approved</a></li> 
                    <li><a href="visiters.php?lag=1&">Total Visiters</a></li> 
                    <?php
                } 
            } ?>
            <li><a href="dashboard.php?lag=1">Recent Posts</a></li>
            <li><a href="commentveiw.php?lag=1">Recent Comments</a></li>
            <li><a href="addpost.php?lag=1">Add Post</a></li>
        <?php } else { ?>
            <?php
            $query = "select * from categories";
            $result = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <li><a href="blogsdisplay.php?category=<?php echo $row['category_name']?>"><?php echo $row['category_name']?></a></li>
            <?php } ?>
        <?php } ?>
    </ul>
</aside>
