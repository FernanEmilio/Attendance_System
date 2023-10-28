<?php
$host = "localhost";
$username = "root";
$password = "root";
$database = "finalproject";
$port=3306;

// Create connection
$conn = mysqli_connect($host,$username,$password,$database,$port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>



