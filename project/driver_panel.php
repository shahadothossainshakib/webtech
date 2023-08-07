<!DOCTYPE html>
<html>
<head>
    <title>Driver Panel</title>
</head>
<body>
    <h2>Welcome to the Driver Panel</h2>
    
    <h3>Add Car for Rent</h3>
    <form method="post" action="add_car_for_rent.php">
        <label for="car_name">Car Name:</label>
        <input type="text" name="car_name" id="car_name" required><br><br>
        
        <label for="car_model">Car Model:</label>
        <input type="text" name="car_model" id="car_model" required><br><br>
        
        <label for="rent_price">Rent Price:</label>
        <input type="number" name="rent_price" id="rent_price" required><br><br>
        
        <input type="submit" value="Add Car for Rent">
    </form>
</body>
</html>
