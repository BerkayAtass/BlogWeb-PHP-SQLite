<?php
// check if the database file exists and create a new one if not
if (!is_file('database/blog.sqlite3')) {
    file_put_contents('database/blog.sqlite3', null);
}

// connecting the database
$conn = new PDO('sqlite:database/blog.sqlite3');

// Setting connection attributes
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Query for creating the users table in the database if it does not exist yet.
$query = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    admin INTEGER DEFAULT 0,
    username TEXT,
    email TEXT UNIQUE,
    password TEXT
);";

// Query for creating the messages table in the database if it does not exist yet.
$query = "CREATE TABLE IF NOT EXISTS messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    fullname TEXT,
    email TEXT NOT NULL,
    subject TEXT,
    message TEXT
);";

$query = "CREATE TABLE IF NOT EXISTS posts (
	id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	subject TEXT,
	message TEXT,
	fullname TEXT,
	read INTEGER DEFAULT 0
);";

// Execute the queries
$conn->exec($query);

// Check if the 'users' table is empty and insert a default admin user if it is.
$query = "SELECT COUNT(*) as count FROM users";
$stmt = $conn->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result['count'] == 0) {
    $defaultAdminUsername = 'admin';
    $defaultAdminEmail = 'admin@gmail.com';
    $defaultAdminPassword = 'admin';

    // Hash the default admin password
    $hashedDefaultAdminPassword = password_hash($defaultAdminPassword, PASSWORD_DEFAULT);

    // Insert the default admin user into the 'users' table
    $query = "INSERT INTO users (admin, username, email, password) VALUES (1, :username, :email, :password)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $defaultAdminUsername);
    $stmt->bindParam(':email', $defaultAdminEmail);
    $stmt->bindParam(':password', $hashedDefaultAdminPassword);
    
    $stmt->execute();
}

?>
