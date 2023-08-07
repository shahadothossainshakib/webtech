<?php
require_once('db_connection.php');
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
$carid=$_POST["car_id"];
$carname=$_POST["car_name"];
$carmodel=$_POST["car_model"];
$rentprice=$_POST["rent_price"];
$rentimage=$_FILES["rent_image"]["name"];
    if ($_FILES["rent_image"]["name"])
{
$targetDir="uploads/";
$targetFile=$targetDir . basename($_FILES["rent_image"]["name"]);
if (move_uploaded_file($_FILES["rent_image"]["tmp_name"], $targetFile))
{
 $rentimage=$targetDir . basename($_FILES["rent_image"]["name"]);
        }else
{
            echo "error upload the file";
        }
    }else
{
        echo "please select a file. <br>";
    }

    $updateQuery="UPDATE rent_cars SET car_name ='$carname',car_model ='$carmodel',rent_price = '$rentprice', car_image = '$rentimage' WHERE id = $carid";

    if (mysqli_query($conn, $updateQuery)) {
        echo "rent car updated successfully!";
    } else
{
        echo "Error: " . mysqli_error($conn);
}

}


if (isset($_GET["id"]))
{
    $carid=$_GET["id"];

    $selectQuery="SELECT * FROM rent_cars WHERE id=$carid";
    $result = mysqli_query($conn, $selectQuery);

    if (mysqli_num_rows($result) == 1)
{
$row=mysqli_fetch_assoc($result);
$carimage = $row["car_image"];
$carname = $row["car_name"];
$carmodel = $row["car_model"];
$rentprice = $row["rent_price"];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Rent Car</title>
    
</head>

<body>
  
        <h2>Edit Rent Car</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $carid ?>"
            enctype="multipart/form-data">
            <input type="hidden" name="car_id" value="<?php echo $carid; ?>">
            <label for="car_name">Car Name:</label>
            <input type="text" name="car_name" id="car_name" value="" required><br><br>
            <label for="car_model">Car Model:</label>
            <input type="text" name="car_model" id="car_model" value="" required><br><br>
            <label for="rent_price">Rent Price:</label>
            <input type="number" name="rent_price" id="rent_price" value="" required><br><br>
            <input type="file" name="rent_image" id="rent_image"><br><br>
           
          
          <input type="submit" value="Update Rent Car">
            <h2><a href="view_rent_cars.php">Go Back</a></h2>
                    </form>
        <br>
   
</body>

</html>
