<?php
require_once('db_connection.php');
if
($_SERVER["REQUEST_METHOD"]=="POST") {
$carname=$_POST["car_name"];
$carmodel=$_POST["car_model"];
$rentprice=$_POST["rent_price"];
$image=$_FILES["car_image"]['name'];
$flag=true;
if(empty($carname)){
$_SESSION['carName_error']="can not be empty!";
    $flag=false;
}else{
    $_SESSION['carname_error']="";
}
if($carmodel==""){
    $_SESSION['carmodel_error']="can not be empty!";
    $flag=false;
}else{
    $_SESSION['carmodel_error']="";
}
if($rentprice==""){
    $_SESSION['rentprice_error']="can not be empty!";
    $flag=false;
}else{
    $_SESSION['rentprice_error']="";
}
//if(empty($_FILES['name'])){
//     $_SESSION['image_error']="can not be empty!";
//     $flag=false;
// }else{
//     $_SESSION['image_error']="";
//     $_SESSION['image']=$image;
// }
if($flag==true){
    $insertQuery="INSERT INTO rent_cars (car_name,car_model,rent_price) VALUES ('$carname','$carmodel','$rentprice')";
    if(mysqli_query($conn, $insertQuery))
    {
            echo"car added successfully";
        }else
        {
            echo"error".mysqli_error($conn);
    }
    mysqli_close($conn);
    }
    else{
    header("location:admin_panel.php");
}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
   
</head>
<body>
    
    <a href="admin_panel.php">Admin</a>
    

</body>
</html>
