<?php
header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];
//$id = $_GET['workout_id'];
//$input = json_decode(file_get_contents("php://input"), true);

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
//$sql = "insert into workouts values(2,5,'benchpress','2025-06-04 11:00:00','2025-06-04 11:10:00','skakn',30,10,'2025-06-04 10:43:39')";
//echo "received id :". $id. "<br>";
$sql="select * from workouts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $recentworkouts=array();
  // output data of each row
  while($row = $result->fetch_assoc()) {
    //echo "id: "  . $row["workout_id"]. " " . $row["user_id"]. "<br>";
    $out =["wkt_name"=> $row['workout_name'],"wkt_stime"=> $row['start_time'] ,"wkt_desc"=> $row['notes'],"wkt_catg"=> $row['category'],"wkt_weight"=> $row['weight'],"wkt_sets"=> $row['sets'],"wkt_reps"=> $row['reps']];
    $recentworkouts[]=$out;
  }
  echo json_encode(array_values($recentworkouts));
} else {
  echo "0 results";
}


$conn->close();
?>