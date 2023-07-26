<?php
//starting the session
session_start();
//including the database connection
require_once 'connect.php';

// Check if the user is logged in
$isUserLoggedIn = false;

if (isset($_POST['login'])) {
    // Setting variables
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Select Query with prepared statement for counting the row that has the same value of the given username and hashed password. This query is for checking if the access is valid or not.
    $query = "SELECT COUNT(*) as count, admin, password FROM `users` WHERE `email` = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch();

    $count = $row['count'];
    $admin = $row['admin'];
    $hashedPassword = $row['password'];

    if ($count > 0 && password_verify($password, $hashedPassword)) {
        // Kullanıcının giriş yaptığı kabul ediliyor ve $_SESSION['user_id'] değişkenine kullanıcının kimliği atanıyor
        $_SESSION['user_id'] = $email;

        if ($admin == 1) {
            header('location: admin_index.php');
        } else {
            header('location: index.php');
        }
    } else {
        $_SESSION['error'] = "Invalid username or password";
        header('location: login.php');
    }
}
?>
