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
$sec = $_GET['section'];
$i=0;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>الصفحة الرئيسية</title>
        <link rel="stylesheet" href="users.css">
    </head>
    <body>
        <?php
        if($sec==5){
            $sql = "SELECT * FROM questions WHERE section=5";
            $result = mysqli_query($conn, $sql);
            
            // Check if the query executed successfully
            if ($result) {
                // Loop through the result set and fetch data
                while ($row = mysqli_fetch_assoc($result)) {
                    // Access individual columns like $row['column_name']
                    $question = $row['question'];
                    $options = array($row['option1'], $row['option2'], $row['option3'], $row['option4']);
                    $section = $row['section'];
                    ?>
                    <div class="external-div">
                <p><?php echo $question; ?></p>
                <form action="" method="post">
                    <ul>
                    <?php foreach ($options as $index => $option) { ?>
                            <li>
                                <input type="radio" name="selectedOption" value="<?php echo $index + 1; ?>">
                                <?php echo $option; ?>
                            </li>
                        <?php } ?>

                    </ul>
                </form>
            </div>
                    <?php
                }
            } else {
                echo "Error executing the query: " . mysqli_error($con);
            }
           
        }elseif($sec==6){
            ?>
            
            <?php
        }elseif($sec==7){
            ?>
            
            <?php
        }elseif($sec==8){
            ?>
            
            <?php
        }else{

        }
        
        ?>
    </body>
</html>