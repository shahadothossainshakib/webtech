<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>


    <h2>
        <a href="dashboard.php">Add more Car</a>
    </h2>
    <?php


    // Establish database connection
    include('db_connection.php');

    // Retrieve car data from the database
    $query = "SELECT * FROM rent_cars ORDER BY id DESC";
    $result = mysqli_query($conn, $query);


    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $carName = $row["car_name"];
            $carModel = $row["car_model"];
            $rentPrice = $row["rent_price"];
            $carImage = $row["car_image"];

            // Display car details
            echo "<div>";
            echo "<img src='$carImage' alt='$carName' style='width: 600px; height:400px;'>";
            echo "<h3>Car: $carName</h3>";
            echo "<p>Model: $carModel</p>";
            echo "<p>Rent Price: $rentPrice$</p>";
            echo "</div>";
        }
    } else {
        echo "No cars available.";
    }

    // Close database connection
    mysqli_close($conn);
    ?>
        <h2><a href="logout.php">Logout</a></h2>

</center>

</body>

</html>