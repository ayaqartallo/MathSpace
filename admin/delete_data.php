<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mathspace';

// Establish the database connection
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Run the DELETE query
$query = "DELETE FROM questions";
mysqli_query($con, $query);

// Close the database connection
mysqli_close($con);

// Redirect back to the page where you want to trigger this action
header("Location: add_questions.php");
exit();
?>
