<!DOCTYPE html>
<html>
<head>
    <title>Car Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .review {
            margin-bottom: 20px;
            border-bottom: 1px solid gray;
            padding-bottom: 15px;
        }

        .review p {
            margin: 5px 0;
        }

        .review .rating {
            font-weight: bold;
            color: red;
        }

        .review strong {
            font-weight: bold;
        }

        .car-image {
            width: 300px;
            height: 200px;
            margin-bottom: 10px;
        }
        img {
            margin: 10px;
            border-radius: 8px;
            transition: transform 0.2s ease;
        }

        img:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<?php
// Start the session
session_start();
include('header.php');

// Include the database connection file
include('db_connection.php');

// Retrieve all reviews from the car_reviews table in descending order
$query = "SELECT * FROM car_reviews ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>All Reviews</h2>";

    // Display each review
    while ($row = mysqli_fetch_assoc($result)) {
        $carID = $row['car_id'];
        $customerID = $row['customer_id'];
        $rating = $row['rating'];
        $reviewText = $row['review_text'];

        // Retrieve car details based on carID
        $carQuery = "SELECT car_name, car_model, car_image FROM rent_cars WHERE id = '$carID'";
        $carResult = mysqli_query($conn, $carQuery);
        $carRow = mysqli_fetch_assoc($carResult);
        $carName = $carRow['car_name'];
        $carModel = $carRow['car_model'];
        $carImage = $carRow['car_image'];

        // Retrieve customer details based on customerID
        $customerQuery = "SELECT name FROM customers WHERE customer_id = '$customerID'";
        $customerResult = mysqli_query($conn, $customerQuery);
        $customerRow = mysqli_fetch_assoc($customerResult);
        $customerName = $customerRow['name'];

        // Display the review
        echo "<div class='review'>";
        echo "<img src='$carImage' alt='$carName' class='car-image'>";
        echo "<p class='rating'>Rating: $rating Stars</p>";
        echo "<p><strong>Car:</strong> $carName</p>";
        echo "<p><strong>Model:</strong> $carModel</p>";
        echo "<p><strong>Customer:</strong> $customerName</p>";
        echo "<p><strong>Review:</strong> $reviewText</p>";
        echo "</div>";
    }
} else {
    echo "<h2>No Reviews Found</h2>";
}

// Close the database connection
mysqli_close($conn);
?>
</body>
</html>
