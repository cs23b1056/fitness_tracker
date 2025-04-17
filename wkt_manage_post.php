<?php
header("Content-Type: application/json");
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


$conn->close();
?>