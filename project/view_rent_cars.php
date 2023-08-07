<?php
require_once('db_connection.php');
if
($_SERVER["REQUEST_METHOD"]=="POST")
{
$carname=$_POST["car_name"];
$carmodel=$_POST["car_model"];
$rentprice=$_POST["rent_price"];
$rentimage=$_FILES["car_image"]["name"];
//upload file location
$targetDir="uploads/";
$targetFile=$targetDir.basename($_FILES["car_image"]["name"]);
if
(move_uploaded_file($_FILES["car_image"]["tmp_name"], $targetFile))
{
$rentimage=$targetFile;
}
else
{
echo"error upload the file";
}
$insertQuery="INSERT INTO rent_cars (car_name,car_model,rent_price,car_image)VALUES('$carname','$carmodel','$rentprice','$rentimage')";
if(mysqli_query($conn, $insertQuery))
{
echo"car added successfully";
}else
{
echo"Error:".mysqli_error($conn);
}
mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
<h2>View Rent Cars</h2>
<?php
require_once('db_connection.php');
// Fetch rent cars
$query="SELECT * FROM rent_cars ORDER BY id DESC";
$result=mysqli_query($conn,$query);
if
(mysqli_num_rows($result)>0) {
while($row=mysqli_fetch_assoc($result))
{
$car_image=$row["car_image"];
$car_name=$row["car_name"];
echo"<img src='$car_image'alt='$car_name'><br>";
echo "Car Name:" . $row["car_name"]."<br>";
echo "Car Model: " . $row["car_model"]."<br>";
echo "Rent Price: " . $row["rent_price"]."<br><br>";
echo "<a href='edit_rent_car.php?id=".$row["id"]."'>Edit</a>";
echo "<a href='delete_rent_car.php?id=".$row["id"]."'>Delete</a>";
echo"<br><br>";
}
}
else{
        echo"no rent cars available";
        }

mysqli_close($conn);
        ?>
<h2><a href="admin_panel.php">Go Back</a></h2>
</body>
</html>
