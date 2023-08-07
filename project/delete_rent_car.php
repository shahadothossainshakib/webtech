<?php
require_once('db_connection.php');
if(isset($_GET["id"]))
{
$carid=$_GET["id"];
$deleteQuery="DELETE FROM rent_cars WHERE id=$carid";
if(mysqli_query($conn, $deleteQuery))
{
echo "rent car deleted successful";
        header("Location: view_rent_cars.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
