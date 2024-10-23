<?php
session_start();
include("common/connection.php");
include('class/blog.php');
$blog = new blogs($connect);
$blog->addvisiters();
if (!empty($_GET['log'])) {
    session_destroy();
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogged Website </title>
    <link rel="stylesheet" href="css/styles.css?v=1.3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">

    
</head>

<body>
    <?php include('common/header.php'); ?>
    <div class="container">
        <?php include('common/category.php'); ?>
        <main class="content">
            <h2>Welcome to Our Blog</h2>
            <p>Discover the latest insights and articles from various categories. Enjoy reading our handpicked blogs!</p>
            
            <h2>Random Blogs</h2>
            <section class="blog-posts" id="data">
            </section>
            <div class="blog-posts d-flex justify-content-center">
                <div class="spinner-border m-5 text-danger" id="loading" role="status" style="display: none;">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

        </main>
        <?php include('common/footer.php'); ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var page_no=1;
        var is_running=false;

        showdata();
        $(window).scroll(function()  {
            if($(window).scrollTop()+$(window).height() > $(document).height()-50)
            {
                if(!is_running)
                {
                    showdata();
                }
                else{
                    var is_running=false;
                }
            }
            
        })

        function showdata()
        {
            is_running=true;
            $("#loading").show();
            $.post("read.php",{page:page_no},(response)=>{
            $("#data").append(response);
            $("#loading").hide();
            is_running=false;
            page_no++;
        })
        }
        


        $(document).ready(function(){
        $('#search').on('input', function() {
            var query = $(this).val();
            if (query != "") {
                $.ajax({
                    url: "autocomplete.php",
                    method: "POST",
                    data: {query: query},
                    success: function(data) {
                        $('#suggestions').fadeIn();
                        $('#suggestions').html(data);
                    }
                });
            } 
            else
            {
                $('#suggestions').fadeOut();
            }
        });

        // Hide suggestions when an item is clicked
        $(document).on('click', 'li', function() {
            $('#search').val($(this).text());
            $('#suggestions').fadeOut();
        });
    });
    </script>
    
</body>

</html>

