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

$questionId = isset($_GET['questionId']) ? $_GET['questionId'] : "";
$uname = isset($_GET['username']) ? $_GET['username'] : "";  
$sql = "SELECT * FROM questions WHERE questionId='".$questionId."'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $question = $row['question'];
    $options = array($row['option1'], $row['option2'], $row['option3'], $row['option4']);
    $section = $row['section'];
    $image = $row['image'];
    $attach = $row['allowAttach'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $questionId; ?>السؤال </title>
        <link rel="stylesheet" href="./users.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200;400&display=swap" rel="stylesheet">
        <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: 'Amiri', serif;
            font-family: 'Cairo', sans-serif;
        }

        .external-div {
            width: 500px;
            padding: 20px;
            padding-right: 50px;
            border: 1px solid #ccc;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        button[type="submit"] {
            background-color: #ff3344;
            color: #fff;
            padding: 15px;
            border-radius: 20px;
            border: none; 
            cursor: pointer;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
    </head>
    <body dir="rtl">
         <div class="external-div">
                <h2>السؤال <?php echo $questionId;?></h2>
                <p><?php echo $question; ?></p>
                <img src="../admin/uploads/<?php echo $image;?>" alt="">
                <form action="sendSolution.php" method="post"  enctype="multipart/form-data" >
                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($uname); ?>">
                    <input type="hidden" name="questionId" value="<?php echo $questionId; ?>">
                    <ul>
                    <?php foreach ($options as $index => $option) { ?>
                            <li>
                                <input type="radio" name="selectedOption" value="<?php echo $index + 1; ?>">
                                <?php echo $option; ?>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php
                        if($attach=="yes"){
                            ?>
                            <label for="image">ارفاق صورة: <input type="file" name="image" accept="image/*" /></label>
                        <?php
                        }else{

                        }
                    ?>
                    <br>
                    <button type="submit" name="submit">ارسال الاجابة</button>
                </form>
            </div>
    </body>
</html>
<?php
    // ... display any other information you retrieved from the database
} else {
    echo "No question found.";
    exit;
}

mysqli_close($conn);
?>
