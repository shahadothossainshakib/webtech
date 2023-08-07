<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
</head>

<body>
    <center>
       
        <h2>Welcome to the Driver Dashboard</h2>

        <h3>Add Car For rent</h3>
        <form method="post" action="add_car.php" enctype="multipart/form-data">
            <label for="car_name">Car Name:</label>
            <input type="text" name="car_name" id="car_name" required><br><br>

            <label for="car_model">Car Model:</label>
            <input type="text" name="car_model" id="car_model" required><br><br>

            <label for="rent_price">Rent Price:</label>
            <input type="number" name="rent_price" id="rent_price" required><br><br>

            <label for="car_image">Car Image:</label>
            <input type="file" name="car_image" id="car_image" required><br><br>

            <input type="submit" value="Add Car">
        </form>


        <h2><a href="view_cars.php">View Cars</a></h2>
        <h2><a href="logout.php">Logout</a></h2>
    </center>

</body>

</html>