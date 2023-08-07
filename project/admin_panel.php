<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
</head>
<body>
<h1>Welcome to the Admin Panel</h1>
<h3>Manage Rent Cars</h3>
<a href="view_rent_cars.php">View Rent Cars</a><br>
<h3>Add Car</h3>
<form method="post"action="add_car_for_rent.php"enctype="multipart/form-data">
<label for="car_name">Car Name:</label>
<input type="text"name="car_name"id="car_name"><br><br>
<label for="car_model">Car Model:</label>
<input type="text"name="car_model"id="car_model"><br><br>
<label for="rent_price">Rent Price:</label>
<input type="number"name="rent_price"id="rent_price"><br><br>
<label for="car_image">Car Image:</label>
<input type="file" name="car_image"id="car_image"><br><br>
<input type="submit"value="Add Rent Car"><br><br>
</form>
<div class="RR">
<h2><a href="index.html">Home Page</a></h2>
<a href="logout.php">Logout</a>
</div>
</body>
</html>
