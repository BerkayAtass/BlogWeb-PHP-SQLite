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

if ($isAdmin) {
    // Check if the post id is provided in the request
    if (isset($_POST['edit_id'])) {
        $post_id = $_POST['edit_id'];

        // Update the 'read' column to 1 for the given post id
        $query = "UPDATE posts SET read = 1 WHERE id = :post_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();

        // Redirect back to the list of posts
        header('location: post.php');
        exit;
    } else {
        // If no post id is provided, redirect back to the list of posts
        header('location: post.php');
        exit;
    }
} else {
    // If the user is not an admin, redirect back to the home page
    header('location: index.php');
    exit;
}
