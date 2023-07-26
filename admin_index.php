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

        if ($count == 0 || !$isAdmin) {
            // Kullanıcı admin yetkisine sahip değilse veya giriş yapmamışsa başka bir sayfaya yönlendir
            header('location: index.php'); // veya header('location: login.php');
            exit;
        }
    } else {
        // Kullanıcı giriş yapmamışsa başka bir sayfaya yönlendir
        header('location: login.php');
        exit;
    }

    // Kullanıcılar veritabanından çekiliyor
    $query = "SELECT id, username, email, admin FROM users";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

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
                <h2 class="heading-section">Users</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr class="alert" role="alert">
                                <th scope="row"><?php echo $user['id']; ?></th>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo ($user['admin'] == 1) ? 'yes' : 'no'; ?></td>
                               <td>
                                    <!-- Her kullanıcı için ayrı bir "Delete" butonu oluşturuyoruz -->
                                    <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-block btn-danger">Delete</a>
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
