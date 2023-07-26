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

// Check if the ID parameter exists in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the ID of the user to be deleted
    $userId = $_GET['id'];

    // Prepare the delete query
    $query = "DELETE FROM users WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $userId);

    // Execute the delete query
    if ($stmt->execute()) {
        // Redirect back to the admin_index.php page
        header('location: admin_index.php');
    } else {
        // Handle the error if the delete operation fails
        echo "Error deleting user.";
    }
} else {
    // If the ID parameter is missing, redirect back to the admin_index.php page
    header('location: admin_index.php');
}
?>
