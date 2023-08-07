<!DOCTYPE html>
<html>
<head>
    <title>Car Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        div.car {
            display: inline-block;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 300px;
        }

        div.car img {
            width: 300px;
            height: 200px;
        }

        h3, p {
            margin: 5px 0;
        }

        form {
            margin-top: 10px;
        }

        label {
            font-weight: bold;
        }

        select, textarea {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .go-back-button {
            margin-top: 20px;
            display: block;
        }
    </style>
</head>
<body>
<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // User is logged in, retrieve the email from the session
    $email = $_SESSION['email'];

    // Include the database connection file
    include('db_connection.php');
    include('header.php');

    // Retrieve the customer ID from the database
    $query = "SELECT customer_id FROM customers WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Customer found, retrieve the customer ID
        $row = mysqli_fetch_assoc($result);
        $customerID = $row['customer_id'];

        // Process review submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the submitted review details
            $carID = $_POST['car_id'];
            $rating = $_POST['rating'];
            $reviewText = $_POST['review_text'];

            // Insert the review into the car_reviews table
            $query = "INSERT INTO car_reviews (car_id, customer_id, rating, review_text) VALUES ('$carID', '$customerID', '$rating', '$reviewText')";
            if (mysqli_query($conn, $query)) {
                // Review submission successful
                echo "<h2>Review Submitted Successfully</h2>";
            } else {
                // Error occurred while submitting the review
                echo "<h2>Error: " . mysqli_error($conn) . "</h2>";
            }
        }

        // Retrieve the rented car details based on the logged-in customer's email
        $query = "SELECT * FROM rent_cars WHERE id IN (SELECT car_id FROM rented_cars WHERE customer_email='$email')";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Display the rented car details
            while ($row = mysqli_fetch_assoc($result)) {
                $carId = $row["id"];
                $carName = $row["car_name"];
                $carModel = $row["car_model"];
                $rentPrice = $row["rent_price"];
                $carImage = $row["car_image"];

                echo "<div class='car'>";
                echo "<img src='$carImage' alt='$carName'>";
                echo "<h3>Car: $carName</h3>";
                echo "<p>Model: $carModel</p>";
                echo "<p>Rent Price: $rentPrice$</p>";

                // Display the review form
                echo "<form method='POST' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='car_id' value='$carId'>";
                echo "<label for='rating'>Rating:</label>";
                echo "<select name='rating' id='rating'>
                        <option value='5'>5 Stars</option>
                        <option value='4'>4 Stars</option>
                        <option value='3'>3 Stars</option>
                        <option value='2'>2 Stars</option>
                        <option value='1'>1 Star</option>
                      </select><br>";
                echo "<label for='review_text'>Review:</label>";
                echo "<textarea name='review_text' id='review_text' rows='4' cols='50'></textarea><br>";
                echo "<input type='submit' value='Submit Review'>";
                echo "</form>";

                echo "</div>";
            }
        } else {
            echo "No cars available.";
        }

        // Display the "Go Back" button
        echo "<a href='' class='go-back-button'>Go Back</a>";
    } else {
        echo "Customer not found.";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // User is not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}
?>
</body>
</html>
