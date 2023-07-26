<?php
// Including the database connection
require_once 'connect.php';

// Mesajları veritabanından çekiyoruz
$query = "SELECT id, subject, message, fullname FROM posts WHERE `read` = 1";
$stmt = $conn->prepare($query);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    
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

    <div class="blog-post-wrapper">
        <div class="container mt-4">
            <div class="blog-post-container">
                <div class="blog-post-top-title">
                    Blog
                    <a href="create_post.php" class="btn btn-block btn-info">Create Post</a>
                </div>
                <div class="blog-post-row">
                    <div class="row">
                        <?php foreach ($posts as $post): ?>
                            <div class="blog-post col-md-6">
                                <a href="blog-text.php?id=<?php echo $post['id']; ?>">
                                    <div class="blog-post-text">
                                        <div class="blog-post-title">
                                            <?php echo $post['subject']; ?>
                                        </div>
                                        <div class="blog-post-description">
                                            <?php echo $post['message']; ?>
                                        </div>
                                        <div class="blog-post-meta-info">
                                            <ul>
                                                <li>
                                                    <div class="blog-post-meta-dot">
                                                        ·
                                                    </div>
                                                    <div class="blog-post-author">
                                                        <?php echo $post['fullname']; ?>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container-fluid mt-5"></div>
            <hr>
        </div>
        <div class="container text-center mt-5 mb-5" >
            <div class="copyright">
                © 2021 All rights reserved.
            </div>   
        </div>
        
    </footer>

</body>

</html>
