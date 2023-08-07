<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
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
            display: block;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 250px;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid green;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 9px 20px;
            background-color: green;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: gray;
        }

        a {
            text-decoration: none;
            background-color: green;
            color: black;
            padding: 9px 20px;
            border-radius: 4px;
            margin-top: 10px;
            margin-left: 80px;
            font-size: 15px;
            font-weight: bold;
            
            
        }

        a:hover {
            background-color: gray;
        }

        img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
  
        <img src="./img/R.png" alt="user img" width="100px" height="100px">
        <h2>Login</h2>

        <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email"><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password"><br><br>

            <input type="submit" value="Login">
            
        <a href="customerreg.php">Regestration</a>
        </form>


  
</body>

</html>

<?php
        // Establish database connection
        require_once('db_connection.php');

        // Process customer login
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Validate email and password
            if (empty($email) || empty($password)) {
                echo "Please enter both email and password.";
            } else {
                // SQL query to check customer credentials
                $sql = "SELECT * FROM customers WHERE email = '$email' AND password = '$password'";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    // Valid login credentials
                    session_start();
                    $_SESSION["email"] = $email;
                    setcookie('email', $email, time() + 3000);
                    echo "Login successful!";
                    // Redirect to customer dashboard or other page
                    header("Location: customerdashboard.php");
                    exit();
                } else {
                    echo "Invalid email or password.";
                }
            }
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
