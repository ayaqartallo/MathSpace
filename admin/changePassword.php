<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mathspace';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Retrieve user input from the form
    $oldpassword = mysqli_real_escape_string($con, $_POST['oldpassword']);
    $newpassword = mysqli_real_escape_string($con, $_POST['newpassword']);
    
    $sql = "UPDATE users SET password = '$newpassword' WHERE username = 'admin' AND password='$oldpassword'";
    $result = mysqli_query($con,$sql); 
    
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>تغيير كلمة المرور</title>
        <link rel="stylesheet" href="admin.css">
        <style>
        

        .signup-main {
            text-align: center;
            margin-top: 50px;
        }

        .signup-form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f7f7f7;
            border-radius: 5px;
        }

        .signup-form label {
            display: block;
            margin-bottom: 10px;
            text-align: right;
        }

        .signup-form input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }


        .signup-form input[type="submit"] {
            background-color: #ff3344;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 20px;

        }

        .signup-form input[type="submit"]:hover {
            background-color: #e52438;
        }
        @media only screen and (max-width: 1000px) {
                body {
                    font-size: 20px;
                }
                ul li a{
                    margin: 20px 0;
                }
                header{
                    height: 100px;
                }
                label{
                    font-size: 26px;
                }
                .signup-form {
                    width: 500px;
                }
                .signup-form input[type="submit"]{
                    font-size: 26px;

                }
        }
    </style>
    </head>
    <body dir="rtl">
        <header>
            <ul>
                <li><a href=""></a></li>
                <li><a href="./index.php" target="_self">الصفحة الرئيسية</a></li>
                <li><a href="./signup_users.php" target="_self">انشاء حساب مستخدم</a></li>
                <li><a href="./control_users.php" target="_self">التحكم بالمستخدمين</a></li>
                <li><a href="./add_questions.php" target="_self">اضافة اسئلة</a></li>
                <li><a href="./viewUsersInfo.php" target="_self">معلومات الطلاب</a></li>
                <li><a href="./changePassword.php" target="_self">تغيير كلمة المرور</a></li>
                <li><a href="../auth/login.php" target="_self">تسجيل الخروج</a></li>
            </ul>
        </header>
       
        <div class="signup-main">
        
            <form action="" method="post" class="signup-form">
                <label for="oldpassword">كلمة المرور القديمة: <input type="password" id="oldpassword" name="oldpassword" ></label>
                <label for="newpassword">كلمة المرور الجديدة:  <input type="password" id="newpassword" name="newpassword" ></label>
                <input type="submit" name="submit" id="submit" value="تغيير كلمة المرور" >
            </form>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            </div>
       
    </body>
</html>