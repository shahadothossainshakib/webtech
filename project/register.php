<?php
// Establish database connection
include('db_connection.php');

// Define variables and initialize with empty values
$name = $email = $password = "";
$nameErr = $emailErr = $passwordErr = "";

// Process user registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = $_POST["name"];
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = $_POST["email"];
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    }

    // Check if there are no validation errors
    if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
        // Check if the email is already registered
        $checkQuery = "SELECT * FROM users WHERE email = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $emailErr = "Email already registered";
        } else {
            // Insert the user into the database
            $insertQuery = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

            if (mysqli_query($conn, $insertQuery)) {
                // Redirect to the login page
                header("Location: login.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }

    // Close database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Registration</title>
</head>
<body>
    <center>
        <img src="main.png" alt="main" width="100px" height="100px">
        <h2>Registration</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>">
            <span class="error"><?php echo $nameErr; ?></span><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <span class="error"><?php echo $passwordErr; ?></span><br><br>

            <input type="submit" value="Register"> ||
            <a href="login.php">Login</a>
        </form>
    </center>
</body>
</html>
