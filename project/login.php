<?php
// Establish database connection

include('db_connection.php');

// Process user login

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        session_start();
        $_SESSION["email"] = $email;
        setcookie('email', $email, time() + 3000);
        header("Location: dashboard.php"); // Redirect to the user's dashboard
    } else {
        echo "";
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
    <title>Document</title>
</head>

<body>
    <center>
    <img src="main.png" alt="main" width="100px" height="100px">
    <h2>User Login</h2>
    <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <input type="submit" value="Login">
    </form> <br>
 
        <a href="register.html">Register here</a>
     
    </center>
</body>

</html>