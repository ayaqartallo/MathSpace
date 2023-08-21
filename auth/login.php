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
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
   // username and password sent from form 
   
   $myusername = mysqli_real_escape_string($conn,$_POST['username']);
   $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
   
   $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   
   $count = mysqli_num_rows($result);
   
   $acceptanceQuery = "SELECT accept FROM users WHERE username = '$myusername'";
   $acceptanceResult = mysqli_query($conn, $acceptanceQuery);
   $acceptanceRow = mysqli_fetch_array($acceptanceResult, MYSQLI_ASSOC);
   $acceptanceStatus = $acceptanceRow['accept'];

   $sql1 = "SELECT section FROM users WHERE username = '$myusername'";
   $secResult = mysqli_query($conn, $sql1);
   $secRow = mysqli_fetch_array($secResult, MYSQLI_ASSOC);
   $sec = $secRow['section'];

   // If result matched $myusername and $mypassword, table row must be 1 row
     
   if($count == 1) {
      $_SESSION['login_user'] = $myusername;
      if($myusername=="admin"){
        header("location: ../admin/index.html");
      } else {
        if($acceptanceStatus==1){
            header("Location: ../users/home.php?section=" . urlencode($sec));
            exit;
        } else {
            $query = "INSERT INTO waiting_users (username) VALUES ('$myusername')";
            if(mysqli_query($conn, $query)) {
                $error = "يرجى انتظار قبول الدخول";
            }
        }
      }
   } else {
      $error = "اسم المستخدم او كلمة المرور غير صالح";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>MathSpace</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="card">
            <div class="login-div">
                <h3>تسجيل الدخول</h3>
                <form action="" method="post">
                    <input type="text" name="username" placeholder="اسم المستخدم" required>
                    <input type="password" name="password" placeholder="كلمة المرور" required>
                    <input type="submit" name='submit' value="تسجيل الدخول">
                </form>
                <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            </div>
            <div class="title-div">
                <h1>مرحباً بكم <br> في <br> مساحة الرياضيات</h1>
                <br>
                <p>موقع للالغاز الرياضية</p>
            </div>
        </div>
    </body>
</html>