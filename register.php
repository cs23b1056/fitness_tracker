<?php
// Database connection setup
$host = 'localhost';
$db = 'fitness_tracker';
$user = 'root';
$pass = '54321';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password']; // Not hashed — stored as-is (not secure)

// Escape input to prevent SQL injection
$username = $conn->real_escape_string($username);
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

// Check if username or email already exists
$checkQuery = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$checkResult = $conn->query($checkQuery);

if ($checkResult->num_rows > 0) {
    echo "Username or email already exists.";
} else {
    // Insert user
    $sql = "INSERT INTO users (username, email, password_hash) VALUES ('$username', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location: login.html");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
