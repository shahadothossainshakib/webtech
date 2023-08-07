<!-- <?php
// Establish database connection
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_name = $_POST["car_name"];
    $car_model = $_POST["car_model"];
    $rent_price = $_POST["rent_price"];

    // Check if a file was uploaded
    if ($_FILES["car_image"]["name"]) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["car_image"]["name"]);

        // Move the uploaded file to the specified location
        if (move_uploaded_file($_FILES["car_image"]["tmp_name"], $targetFile)) {
            // SQL query to insert car details into the database
            $sql = "INSERT INTO rent_cars (car_name, car_model, rent_price, car_image) VALUES ('$car_name', '$car_model', '$rent_price', '$targetFile')";

            if ($conn->query($sql) === TRUE) {
                echo "Car added successfully!";
                header("Location: view_cars.php"); 
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Please select a file.";
    }
}

// Close the database connection
$conn->close();
?> -->
