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
$uname = isset($_GET['username']) ? $_GET['username'] : ""; 
$i=1;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>الصفحة الرئيسية</title>
        <link rel="stylesheet" href="users.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200;400&display=swap" rel="stylesheet">
         <style>
            body{
                font-family: 'Amiri', serif;
                font-family: 'Cairo', sans-serif;
            }
            .circle-container {
                position: relative;
                margin-top: 100px;
                margin-left: 50px;
            }

            .circle {
                width: 80px;
                height: 80px;
                background-color: #ff3344;
                border-radius: 50px;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
            }
           a{
            font-weight: bold;
            font-size: 30px !important;
           }
           .logout-div {
            position: fixed;
            bottom: 0;
            left: 0;
            padding: 10px;
            background-color: #333;
        }
        .logout-div a {
            font-size: 14px !important;
            color: #fff;
            font-weight: 200;
        }
    </style>
    </head>
    <body>
        <div class="circle-container">
            <?php
            if($sec==5){
                $sql = "SELECT * FROM questions WHERE section=5";
                $result = mysqli_query($conn, $sql);
                
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $questionId = $row['questionId'];
                        ?>
                        <div class="circle" style="left: <?php echo ($i * 150); ?>px; top: <?php echo ($i % 2 === 0 ? 350 : 150); ?>px;">
                        <a href="levels.php?questionId=<?php echo $questionId; ?>&username=<?php echo urlencode($uname); ?>" style="font-size: 16px;">
                        <?php
                        echo $i; 
                        $i++;?></a>
                    </div>

                        </ul>
                    </form>
                </div>
                        <?php
                    }
                } else {
                    echo "Error executing the query: " . mysqli_error($con);
                }
            
            }elseif($sec==6){
                $sql = "SELECT * FROM questions WHERE section=6";
                $result = mysqli_query($conn, $sql);
                
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $questionId = $row['questionId'];
                        ?>
                        <div class="circle" style="left: <?php echo ($i * 150); ?>px; top: <?php echo ($i % 2 === 0 ? 350 : 150); ?>px;">
                        <a href="levels.php?questionId=<?php echo $questionId; ?>&username=<?php echo urlencode($uname); ?>" style="font-size: 16px;">
                        <?php
                        echo $i; 
                        $i++;?></a>
                    </div>

                        </ul>
                    </form>
                </div>
                        <?php
                    }
                } else {
                    echo "Error executing the query: " . mysqli_error($con);
                }
            }elseif($sec==7){
                $sql = "SELECT * FROM questions WHERE section=7";
                $result = mysqli_query($conn, $sql);
                
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $questionId = $row['questionId'];
                        ?>
                        <div class="circle" style="left: <?php echo ($i * 150); ?>px; top: <?php echo ($i % 2 === 0 ? 350 : 150); ?>px;">
                        <a href="levels.php?questionId=<?php echo $questionId; ?>&username=<?php echo urlencode($uname); ?>">
                        <?php
                        echo $i; 
                        $i++;?></a>
                    </div>

                        </ul>
                    </form>
                </div>
                        <?php
                    }
                } else {
                    echo "Error executing the query: " . mysqli_error($con);
                }
            }elseif($sec==8){
                $sql = "SELECT * FROM questions WHERE section=8";
                $result = mysqli_query($conn, $sql);
                
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $questionId = $row['questionId'];
                        ?>
                        <div class="circle" style="left: <?php echo ($i * 150); ?>px; top: <?php echo ($i % 2 === 0 ? 350 : 150); ?>px;">
                        <a href="levels.php?questionId=<?php echo $questionId; ?>&username=<?php echo urlencode($uname); ?>" style="font-size: 16px;">
                        <?php
                        echo $i; 
                        $i++;?></a>
                    </div>

                        </ul>
                    </form>
                </div>
                        <?php
                    }
                } else {
                    echo "Error executing the query: " . mysqli_error($con);
                }
            }else{

            }
            
            ?>
        </div>
        <div class="logout-div">        
            <a href="../auth/logout.php?username=<?php echo $uname; ?>" >تسجيل الخروج</a>
        </div>
    </body>
</html>