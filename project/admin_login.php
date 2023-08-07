<?php
session_start();
$defaultusername="admin";
$defaultpassword="admin";
if($_SERVER["REQUEST_METHOD"]==="POST")
{
$username=$_POST["username"];
$password=$_POST["password"];
//check user&pass
if($username===$defaultusername&&$password===$defaultpassword)
{
$_SESSION["admin"]=true;
echo"success";
header("Location: admin_panel.php");
exit();
}
else
{
$error_message = "Please enter correct username and password!";
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
</head>
<body>
    <h1 align="center">Admin Login</h1>
    <form method="post" action="<?php echo($_SERVER["PHP_SELF"]);?>" align="center">
<label for="username">Username:</label>
<input type="text" name="username" id="username">
<br>
<label for="password">Password:</label>
<input type="password" name="password"id="password">
<br>
<input type="submit" value="Login">
<a href="index.html">Home</a>
</form>
<?php
if (isset($error_message))
{
echo"<p>$error_message</p>";
}
?>
</body>
</html>
