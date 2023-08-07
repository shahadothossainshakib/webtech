<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
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

        form {
            display: inline-block;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 250px;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid green;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: black;
            color: whitesmoke;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: green;
            color: black;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        a {
            text-decoration: none;
        }

        .customer img {
            width: 150px;
            height: 200px;
        }
    </style>
</head>
<body>
    <div class="customer">
        <img src="./img/C.png" alt="customer">
    </div>
    <h2>Customer Registration</h2>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" ><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"><br>
        
        <label for="mobile">Mobile Number:</label>
        <input type="text" name="mobile" id="mobile"><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" ><br>
        
        <input type="submit" value="Register">
    </form>
  
    <?php
    // Establish database connection
    include('db_connection.php');

    // Process customer registration
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $password = $_POST["password"];

        // Validate form fields
        $errors = [];
        if (empty($name)) {
            $errors[] = "Name is required.";
        }

        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        } else {
            // Check if email already exists
            $checkEmailQuery = "SELECT * FROM customers WHERE email = '$email'";
            $checkEmailResult = mysqli_query($conn, $checkEmailQuery);
            if (mysqli_num_rows($checkEmailResult) > 0) {
                $errors[] = "Email already exists";
            }
        }

        if (empty($mobile)) {
            $errors[] = "Mobile number is required.";
        }

        if (empty($password)) {
            $errors[] = "Password is required.";
        }

        // If there are validation errors, display them
        if (!empty($errors)) {
            echo "<div class='error-message'>";
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo "</div>";
        } else {
            // SQL query to insert customer into the database
            $sql = "INSERT INTO customers (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password')";

            if (mysqli_query($conn, $sql)) {
                echo "<p class='success-message'>Registration successful!</p>";
                echo '<a href="customer.php">Login Here</a>';
            } else {
                echo "<p class='error-message'>Error: " . mysqli_error($conn) . "</p>";
            }
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
