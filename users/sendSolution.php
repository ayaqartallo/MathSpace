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

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $questionId = $_POST['questionId'];
    $selectedOption = $_POST['selectedOption'];
    if(isset($_FILES['image'])){
        $image = $_FILES['image']['name'];
        $imagePath ='uploads/'.$image;
        $tmp_name = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp_name,$imagePath);
    }else{
        $image = "";
    }

    $insertSql = "INSERT INTO user_answers (question_id, selected_option, username, attach) VALUES ('$questionId', '$selectedOption', '$username', '$image')";
    $insertResult = mysqli_query($conn, $insertSql);

    if ($insertResult) {
        echo "Answer submitted successfully.";
    } else {
        echo "Error submitting answer: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
header("Location: levels.php?questionId=$questionId&username=$username");
exit();
?>
