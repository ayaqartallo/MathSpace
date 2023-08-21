<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mathspace";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM waiting_users";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $uname = $row['username']; 

    $update = "UPDATE `users` SET `accept` = 1 WHERE `username` = '$uname'";
    $query = mysqli_query($conn, $update);

    if ($query) {
       // $delete = "DELETE FROM `waiting_users` WHERE `username` = '$uname'";
        $query1 = mysqli_query($conn, $delete);

        if ($query1) {
=            header('Location: control_users.php');
            exit(); 
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
