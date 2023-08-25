<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mathspace';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$username = $_SESSION['login_user']; // Assuming 'login_user' is the session key storing the username

$sql = "UPDATE users SET accept = 0 WHERE username='$username'";
$result = mysqli_query($con, $sql);

$sql1 = "DELETE FROM waiting_users WHERE username='$username'";
$result = mysqli_query($con, $sql1);

// Clear all session variables
session_unset();
session_destroy();

header("Location: login.php");
?>
