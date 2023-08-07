<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: red;
        }

        img {
            width: 600px;
            height: 400px;
            margin-bottom: 10px;
        }

        h3 {
            margin-top: 10px;
        }

        p {
            margin-bottom: 5px;
        }

        a {
            display: inline-block;
            text-decoration: none;
            background-color: green;
            color: black;
            padding: 5px 10px;
            border-radius: 4px;
            margin-top: 10px;
        }

        a:hover {
            background-color: gray;
        }

        a.back {
            display: block;
            margin-top: 30px;
        }

        h2.logout {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>View Available Cars</h1><br>
    <?php
    // Establish database connection
    include('db_connection.php');

    // Retrieve car data from the database
    $query = "SELECT * FROM rent_cars ORDER BY id DESC";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $carId = $row["id"];
            $carName = $row["car_name"];
            $carModel = $row["car_model"];
            $rentPrice = $row["rent_price"];
            $carImage = $row["car_image"];

            // Display car details
    ?>
            <div>
                <img src="<?php echo $carImage ?>" alt="<?php echo $carName ?>"><br>
                <h3>Car: <?php echo $carName ?></h3>
                <p>Model: <?php echo $carModel ?></p>
                <p>Rent Price: <?php echo $rentPrice ?>$</p>
                <h3><a href="customer_rent_car.php?id=<?php echo $carId ?>">Rent This Car</a></h3>
            </div>
    <?php
        }
    } else {
        echo "No cars available.";
    }

    // Close database connection
    mysqli_close($conn);
    ?>
    <a href="customerdashboard.php" class="back">Back to Dashboard</a>
    <h2 class="logout"><a href="logout.php">Logout</a></h2>
</body>

</html>
