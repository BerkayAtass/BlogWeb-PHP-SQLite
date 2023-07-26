<?php
//starting the session
session_start();
//including the database connection
require_once 'connect.php';

// Check if the user is logged in and admin status
$isAdmin = false;

if (isset($_SESSION['user_id'])) {
    $email = $_SESSION['user_id'];

    $query = "SELECT COUNT(*) as count, admin FROM `users` WHERE `email` = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch();

    $count = $row['count'];
    $isAdmin = $row['admin'];
} else {
    // Kullanıcı giriş yapmamışsa başka bir sayfaya yönlendir
    header('location: login.php');
    exit;
}

// Check if the blog post ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // If blog post ID is not provided, redirect to blog.php
    header('location: blog.php');
    exit;
}

// Get the blog post ID from the URL
$blog_post_id = $_GET['id'];

// Fetch the blog post from the database
$query = "SELECT id, subject, message, fullname FROM posts WHERE id = :id AND `read` = 1";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $blog_post_id);
$stmt->execute();
$blog_post = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the blog post exists
if (!$blog_post) {
    // If blog post does not exist, redirect to blog.php
    header('location: blog.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Text</title>

    <link rel="shortcut icon" href="assets/img/icon/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
</head>

<body>

    <?php include("includes/header.php"); ?>

    <div class="blog-wrapper">
        <div class="container mt-4">
            <div class="blog-container">
                <div class="blog-top-title">
                    Blog
                </div>
                <div class="blog-container-text">
                    <div class="blog-text-meta-info">
                        <ul>
                            <li>
                                <div class="blog-text-meta-dot">
                                    ·
                                </div>
                                <div class="blog-text-author">
                                    <?php echo $blog_post['fullname']; ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="blog-text-title">
                        <?php echo $blog_post['subject']; ?>
                    </div>
                    <div class="blog-text">
                        <?php echo $blog_post['message']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <!-- Footer content goes here -->
    </footer>

</body>

</html>
