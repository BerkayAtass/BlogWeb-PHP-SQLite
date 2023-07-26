<?php
//starting the session
session_start();
//including the database connection
require_once 'connect.php';

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Delete post with the given ID from the posts table
    $delete_query = "DELETE FROM posts WHERE id = :id";
    $stmt = $conn->prepare($delete_query);
    $stmt->bindParam(':id', $delete_id);

    if ($stmt->execute()) {
        // Post successfully deleted, redirect back to post.php
        header('location: post.php');
        exit;
    } else {
        // Error occurred while deleting post
        echo "Error: Unable to delete post.";
    }
}
?>