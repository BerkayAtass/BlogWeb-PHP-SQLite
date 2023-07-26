<?php
    //starting the session
    session_start();
 
    // Unset and destroy the session variables to logout the user
    unset($_SESSION['user_id']);
    session_destroy();

    // Redirect the user to the login page or any other desired page after logout
    header('location: index.php');
    exit;
?>
