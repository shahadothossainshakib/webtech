<?php
include('db_connection.php');

if (isset($_GET["id"])) {
    $carId = $_GET["id"];
    $email = $_COOKIE["email"];

    $selectQuery = "INSERT INTO rented_cars (car_id, customer_email) VALUES ('$carId', '$email')";
    $result = mysqli_query($conn, $selectQuery);

    if ($result) {
        header("Location: customerdashboard.php");
    } else {
        header("Location: view_available_cars.php");
    }
}
?>
