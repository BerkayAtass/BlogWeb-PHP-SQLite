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

// Mesajları veritabanından çekiyoruz
$query = "SELECT id, subject, message, fullname, read FROM posts";
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
    <title>Posts</title>

    <link rel="shortcut icon" href="assets/img/icon/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
</head>

<body>

    <?php include("includes/admin_header.php"); ?>  

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Post Info</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Read</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($posts as $post): ?>
                            <tr>
                                <td><?php echo $post['id']; ?></td>
                                <td><?php echo $post['fullname']; ?></td>
                                <td><?php echo $post['subject']; ?></td>
                                <td><?php echo $post['message']; ?></td>
                                <td><?php echo $post['read']; ?></td>
                                <td>
                                    <form action="edit_post.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $post['id']; ?>">
                                        <button type="submit" class="btn btn-block btn-warning">Edit</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="delete_post.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
                                        <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
