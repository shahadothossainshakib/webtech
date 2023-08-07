<?php
$id = "localhost";
$name = "root";
$Passsword = "";
$dbName = "car_rental";

// Establish database connection
$conn = mysqli_connect($id, $name, $Passsword, $dbName);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>