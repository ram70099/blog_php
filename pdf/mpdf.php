<?php
require_once __DIR__ . '/../vendors/autoload.php';
include("../common/connection.php");
include('../class/blog.php');

$obb = new blogs($connect);

if (isset($_GET['id'])) {
    $blogId = $_GET['id'];
    $blog = $obb->readmore($blogId);
} else {
    $category = $_GET['category'];
    $blogs = $obb->readcategory($category); // Change this to fetch all blogs for the category
}

if ($blogs) {
    $mpdf = new \Mpdf\Mpdf();
    
    // Initialize the HTML variable
    $html = '
        <style>
            body { font-family: sans-serif; }
            .blog-image { width: 100%; height: auto; margin-bottom: 20px; }
            .blog-content { margin: 20px 0; }
            .category { font-style: italic; color: #555; }
            h1 { color: #333; }
        </style>';

    // Add a title for the PDF
    $html .= '<h1>Blogs in ' . htmlspecialchars($category) . ' Category</h1>';

    // Iterate through all blogs and append to the HTML
    foreach ($blogs as $blog) {
        $html .= '
            <h2>' . htmlspecialchars($blog['title']) . '</h2>
            <p class="category"><strong>Category:</strong> ' . htmlspecialchars($blog['category']) . '</p>
            <img src="../' . htmlspecialchars($blog['image']) . '" alt="' . htmlspecialchars($blog['title']) . '" class="blog-image">
            <p><strong>By:</strong> ' . htmlspecialchars($blog['author']) . '</p>
            <p><strong>Date:</strong> ' . date('F d, Y', strtotime($blog['created_at'])) . '</p>
            <div class="blog-content">
                ' . $blog['content'] . '
            </div>
            <hr>'; // Add a horizontal line between blogs
    }

    // Write HTML to the PDF
    $mpdf->WriteHTML($html);
    $mpdf->Output('blogs-' . htmlspecialchars($category) . '.pdf', 'I');
}
