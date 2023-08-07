<?php
include('db_connection.php');

if (isset($_GET["id"])) {
    $carId = $_GET["id"];
    $email = $_COOKIE["email"];

    $selectQuery = "DELETE FROM rented_cars WHERE car_id='$carId' AND customer_email='$email'";
    $result = mysqli_query($conn, $selectQuery);

    if ($result) {
        header("Location: customerdashboard.php");
    } else {
        header("Location: view_available_cars.php");
    }
}
?>