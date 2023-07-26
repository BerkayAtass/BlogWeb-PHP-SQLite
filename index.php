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
    <title>Home</title>

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
    <div class="person-info-wrapper">
        <div class="container">
            <div class="person-info-container">
                <div class="row">
                    <div class="person-photo col-md-5">
                        <img src="assets/img/profile.jpg" alt="" srcset="">
                    </div>
                    <div class="person-info-text col-md-7">
                        <div class="person-job">
                            Web Developer
                        </div>
                        <div class="person-name">
                            <h1>Name Surname</h1>
                        </div>
                        <div class="person-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod asperiores labore beatae,
                            velit officia eum est repellat veritatis. Odio, id magnam eveniet enim architecto
                            reprehenderit neque consectetur porro atque odit.
                        </div>
                        <div class="person-social-link">
                            <ul>
                                <li>
                                    <a href="#"><i class="flaticon-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="flaticon-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="flaticon-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="flaticon-youtube"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="flaticon-linkedin-1"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="flaticon-github"></i></a>
                                </li>
                                <li>
                                    <a href="mailto:#"><i class="flaticon-mail-1"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-post-wrapper">
        <div class="container mt-4">
            <div class="blog-post-container">
                <div class="blog-post-top-title">
                    Blog
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


</body>

</html>