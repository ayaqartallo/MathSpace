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
        body {
            font-family: 'Amiri', serif;
            font-family: 'Cairo', sans-serif;
            background-image: url("background.gif");
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center; 
            justify-content: center; 
            min-height: 100vh; 
        }

        a {
            font-weight: bold;
            font-size: 30px !important;
            text-decoration: none;
            color: white;
        }

        .logout-div {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px;
            background-color: #333;
            text-align: center;
        }

        .circle-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; 
            align-items: center;
         
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        .circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            margin: 20px;
        }

        .table-container {
            width: 100%;
        max-width: 800px;
        overflow: auto;
        margin: 0 auto; 
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center; 
        }
        @media only screen and (max-width: 1000px) {

            table {
                display: block; 
            }

            td {
                width: 50%;
                box-sizing: border-box; 
                float: left;
            }
            .circle {
                width: 150px;
                height: 150px;
            }
            .table-container{
                padding-left: 15%;
            }
            a{
                font-size: 36px !important;
            }
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
                    echo '<div class="table-container">';
                    echo '<table>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $questionId = $row['questionId'];
                        
                        if ($i % 5 === 0) {
                            echo '<tr>';
                        }
                        ?>
                        <td>
                            <div class="circle" style="background-color: <?php echo ($i % 2 === 0 ? '#ff3344' : '#00cc66'); ?>;">
                                <a href="levels.php?questionId=<?php echo $questionId; ?>&username=<?php echo urlencode($uname); ?>" style="font-size: 16px;">
                                <?php
                                echo $i; 
                                $i++;?>
                                </a>
                            </div>
                        </td>
                        <?php
                        
                        if ($i % 5 === 0) {
                            echo '</tr>';
                        }
                    }
                    if ($i % 5 !== 0) {
                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '</div>';
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
                        <div class="circle" style="left: <?php if($i!==9){
                             echo ($i * 150); ?>px; top: <?php echo ($i % 2 === 0 ? 300 : 150);
                        }else{
                            echo ($i * 50); ?>px; top: <?php echo ($i % 2 === 0 ? 500 : 500);
                        } ?>px;">
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
                        <div class="circle" style="left: <?php if($i!==9){
                             echo ($i * 150); ?>px; top: <?php echo ($i % 2 === 0 ? 300 : 150);
                        }else{
                            echo ($i * 50); ?>px; top: <?php echo ($i % 2 === 0 ? 500 : 500);
                        } ?>px;">
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
                        <div class="circle" style="left: <?php if($i!==9){
                             echo ($i * 150); ?>px; top: <?php echo ($i % 2 === 0 ? 300 : 150);
                        }else{
                            echo ($i * 50); ?>px; top: <?php echo ($i % 2 === 0 ? 500 : 500);
                        } ?>px;">
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