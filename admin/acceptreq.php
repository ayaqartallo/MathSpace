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
$name = $_GET['name'];
$sql = "SELECT * FROM waiting_users WHERE username='".$name."'";
$result = mysqli_query($conn,$sql);
$count  = mysqli_num_rows($result);

if($count==1){
    while ($row = $result->fetch_assoc()) {

            $update = "UPDATE `users` SET `accept`=1 WHERE `username`='".$name."'";
            $query = mysqli_query($conn,$update);
            if ($query) {
                $delete = "UPDATE `waiting_users` SET `accept`=1 WHERE `username`='".$name."'";
                $query1 = mysqli_query($conn,$delete);
                if($query1){
                    header('Location: control_users.php');
                }
            }

    }
}