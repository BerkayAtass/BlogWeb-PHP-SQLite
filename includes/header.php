<?php
    //starting the session
    
    // Starting the session if it is not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    //including the database connection
    require_once 'connect.php';
 
    // Check if the user is logged in and admin status
    $isUserLoggedIn = false;
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

        if ($count > 0) {
            $isUserLoggedIn = true;
        } else {
            // Invalid user ID in session, logout the user
            unset($_SESSION['user_id']);
        }
    }

?>



<header>
    <div class="container">
        <div class="header-wrapper mt-5">
            <div class="row header-content">
                <div class="header-title col-md-8">
                    <a href="index.php"><S>Super</S> Normal Blog</a>
                </div>
                <div class="header-menu col-md-4">
                    <ul>
                        <li>
                            <a href="index.php" style="opacity: 100%;">Home</a>
                        </li>
                        <?php if ($isUserLoggedIn): ?>
                        <li>
                            <a href="blog.php">Blog</a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="about.php">About</a>
                        </li>
                        <?php if ($isUserLoggedIn): ?>
                            <?php if ($isAdmin): ?>
                                <li>
                                    <a href="admin_index.php" style="color: #03b6fc; opacity: 100%;">Admin Panel</a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="contact.php">Contact</a>
                            </li>
                            <li>
                                <a href="logout.php">Log Out</a>
                            </li>
                        <?php endif; ?>
                        <?php if (!$isUserLoggedIn): ?>
                            <li>
                                <a href="login.php">Login</a>
                            </li>
                            <li>
                                <a href="register.php">Register</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
