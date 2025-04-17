<?php
$host = 'localhost';
$db = 'fitness_tracker';
$user = 'root';
$pass = '54321';

session_start();

$conn = new mysqli($host, $user, $pass, $db);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];

// Sanitize input
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

// Query to check user credentials
$sql = "SELECT * FROM users WHERE username='$username' AND password_hash='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Save user info to session
    $_SESSION["username"] = $row["username"];
    $_SESSION["user_id"] = $row["user_id"];

    // Create a dynamic table for the user: workouts_<username>
    $safe_username = preg_replace('/[^a-zA-Z0-9_]/', '', $row["username"]); // sanitize table name
    $table_name = "workouts_" . $safe_username;

    $create_table_sql = "
        CREATE TABLE IF NOT EXISTS `$table_name` (
            `workout_id` int NOT NULL AUTO_INCREMENT,
            `user_id` int DEFAULT NULL,
            `workout_name` varchar(100) DEFAULT NULL,
            `start_time` timestamp NOT NULL,
            `end_time` timestamp NULL DEFAULT NULL,
            `notes` text,
            `workout_duration` int DEFAULT NULL,
            `category` varchar(100) DEFAULT NULL,
            `weight` float DEFAULT NULL,
            `sets` int DEFAULT NULL,
            `reps` int DEFAULT NULL,
            PRIMARY KEY (`workout_id`),
            KEY `idx_workouts_user_id` (`user_id`)
        )
    ";
    $_SESSION["workout_table"] = $table_name;

    if ($conn->query($create_table_sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error creating user workout table: " . $conn->error;
    }

} else {
    echo "Invalid username or password.";
}

$conn->close();
?>
