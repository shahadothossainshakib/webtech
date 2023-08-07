<?php
// Start the session

session_start();

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // User is logged in, retrieve the email from the session
    $email = $_SESSION['email'];
    include('header.php');
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Customer Dashboard</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                text-align: center;
            }

            h2 {
                color: red;
            }

            h3 {
                margin-top: 20px;
            }

            img {
                width: 600px;
                height: 400px;
                margin-bottom: 10px;
            }

            .RR a{
                text-decoration: none;
                background-color: green;
                color: black;
                padding: 10px 20px;
                border-radius: 4px;
                margin-top: 10px;
            }

            .RR a:hover {
                background-color: gray;
            }
            .cimg img{
                width: 200px;
                height: 200px;
}
        </style>
    </head>

    <body>
        <div class="cimg">
        <img src="./img/01.png" alt="pro">
        </div>
      
            <h2>Welcome, <?php echo $email; ?></h2>
            <!-- Add your dashboard content here -->
            <h3>View Available Cars</h3>
            <div class="RR">
            <a href="view_available_cars.php">Click here to view available cars</a>
            </div>
            <h1>Rented Cars</h1>
            <?php
            // Establish database connection
            include('db_connection.php');

            // Retrieve car data from the database
            $query = "SELECT * FROM rent_cars WHERE id IN (SELECT car_id FROM rented_cars WHERE customer_email='$email')";
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
                        <img src="<?php echo $carImage ?>" alt="<?php echo $carName ?>">
                        <h3>Car: <?php echo $carName ?></h3>
                        <p>Model: <?php echo $carModel ?></p>
                        <p>Rent Price: <?php echo $rentPrice ?>$</p>
<div class="RR">

<a href="customer_delete_rent_car.php?id=<?php echo $carId ?>">Remove This Car</a>
                        <a href="review.php">Review</a>
</div>
                    </div><br>
            <?php
                }
            } else {
                echo "No cars available.";
            }

            // Close database connection
            mysqli_close($conn);
            ?>
            <h2><a href="index.html">Logout</a></h2>
      

    </body>

    </html>

<?php
} else {
    // User is not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}
?>
