<?php
$DB_HOST="localhost";
$DB_USER="root";
$DB_PASSWORD="";
$DB_NAME="project";

$conn = new mysqli($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);

if($conn -> connect_error){
  die("Error connecting to the database" . $conn -> connect_error);
}else {
  //echo "Database connected successfully";
}

// $conn ->close();
?>