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

    $searchsql = "SELECT questionId, username FROM user_answers WHERE questionId = '$questionId' AND username LIKE '%$username%'";
    $searchResult = mysqli_query($conn, $searchsql);

    if ($searchResult && mysqli_num_rows($searchResult) > 0) {
        $updateSql = "UPDATE user_answers SET selected_option='$selectedOption', attach='$image' WHERE questionId='$questionId' AND username LIKE '%$username%'";
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            $correctOptionQuery = "SELECT coroption FROM questions WHERE questionId='$questionId'";
            $correctOptionResult = mysqli_query($conn, $correctOptionQuery);
            
            if ($correctOptionResult && mysqli_num_rows($correctOptionResult) > 0) {
                $row = mysqli_fetch_assoc($correctOptionResult);
                $correctOption = $row['coroption'];

                if ($selectedOption == $correctOption) {
                    // Increment the user's score
                    $updateScoreSql = "UPDATE users SET score = score + 1 WHERE username LIKE '%$username%'";
                    $updateScoreResult = mysqli_query($conn, $updateScoreSql);

                    if (!$updateScoreResult) {
                        echo "Error updating user's score: " . mysqli_error($conn);
                    }
                }
            } else {
                echo "Error fetching correct option: " . mysqli_error($conn);
            }
        } else {
            echo "Error editing answer: " . mysqli_error($conn);
        }
    } else {
        $insertSql = "INSERT INTO user_answers (questionId, selected_option, username, attach) VALUES ('$questionId', '$selectedOption', '$username', '$image')";
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
}
?>
