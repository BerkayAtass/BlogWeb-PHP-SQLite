<?php
    //starting the session
    session_start();
 
    //including the database connection
    require_once 'connect.php';
 
    if (isset($_POST['register'])) {
        // Setting variables
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
 
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
 
        // Check if the email is already registered in the database
        $query = "SELECT COUNT(*) as count FROM users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // If the email is already registered, redirect the user to the login page with an error message
            $_SESSION['error'] = "This email is already registered. Please log in instead.";
            header('location: login.php');
            exit;
        }

        // Insertion Query with prepared statements
        $query = "INSERT INTO `users` (username, email, password) VALUES(:username, :email, :password)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
	
        // Check if the execution of query is success
        if ($stmt->execute()) {
            // Setting a 'success' session to save our insertion success message.
            $_SESSION['success'] = "Successfully created an account";
 
            // Redirecting to the login.php page
            header('location: login.php');
        }
        
    }
?>
