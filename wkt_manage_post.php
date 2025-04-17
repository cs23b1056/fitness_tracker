<?php
/*header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);
//echo "workout name:" .$input["workout_name"]. "workout description:" .$input["workout_desc"];
$servername = "localhost";
$username = "root";
$password = "54321";
$dbname="fitness_tracker";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully"; 

// Create database
$sql = "insert into workouts(workout_name,notes,start_time,category,weight,sets,reps) values('$input[workout_name]','$input[workout_desc]',current_timestamp(),'$input[workout_catg]','$input[workout_weight]','$input[workout_sets]','$input[workout_reps]')";

//echo $sql;
$result = $conn->query($sql);

if ($result) {
  // output data of each row
  echo "Successfully added";
} else {
  echo "0 results";
}


$conn->close();*/

header("Content-Type: application/json");
session_start(); // Required to access session variables

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

$servername = "localhost";
$username = "root";
$password = "54321";
$dbname = "fitness_tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if workout table is set in session
if (!isset($_SESSION['workout_table'])) {
    echo json_encode(["error" => "Workout table not defined in session."]);
    exit();
}

$table_name = $_SESSION['workout_table'];

// Escape values to prevent SQL injection
$workout_name   = $conn->real_escape_string($input['workout_name']);
$notes          = $conn->real_escape_string($input['workout_desc']);
$category       = $conn->real_escape_string($input['workout_catg']);
$weight         = $conn->real_escape_string($input['workout_weight']);
$sets           = $conn->real_escape_string($input['workout_sets']);
$reps           = $conn->real_escape_string($input['workout_reps']);
$user_id        = $_SESSION['user_id'] ?? 'NULL';

// Insert into dynamic user table
$sql = "INSERT INTO `$table_name` 
        (user_id, workout_name, notes, start_time, category, weight, sets, reps) 
        VALUES 
        ('$user_id', '$workout_name', '$notes', current_timestamp(), '$category', '$weight', '$sets', '$reps')";

$result = $conn->query($sql);

if ($result) {
    echo json_encode(["message" => "Workout successfully added."]);
} else {
    echo json_encode(["error" => "Insert failed: " . $conn->error]);
}

$conn->close();


?>