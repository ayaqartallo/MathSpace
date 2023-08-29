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
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    if (isset($_POST['section'])) {
        $section = mysqli_real_escape_string($con, $_POST['section']);
    } else {
        $section = ""; // Set a default value if 'section' is not set
    }

    $sql = "SELECT username FROM users WHERE username ='$username'";
    $result = mysqli_query($con,$sql); 
    if($result){
        $error = "اسم المستخدم موجود مسبقاً";
    }else{
          // SQL query to insert user data into the database
    $query = "INSERT INTO users (username, password, age, section) VALUES ('$username', '$password', '$age', '$section')";
    
    mysqli_query($con, $query);
    }
      
    
    
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>انشاء حساب للمستخدم</title>
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

        .signup-form input[type="text"],
        .signup-form input[type="password"],
        .signup-form input[type="number"],
        .signup-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .signup-form select {
            height: 34px;
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
                    font-size: 30px;
                }
                .signup-form {
                    width: 500px;
                }
                .signup-form input[type="text"],
                .signup-form input[type="password"],
                .signup-form input[type="number"],
                .signup-form select{
                    font-size: 28px;          
                }
                .signup-form select {
                    height: 54px;
                }
                .signup-form input[type="submit"] {
                    margin-top: 20px;
                    font-size: 30px;
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
                <label for="username">اسم المستخدم: <input type="text" id="username" name="username" ></label>
                <label for="password">كلمة المرور:  <input type="password" id="password" name="password" ></label>
                <label for="age">العمر:  <input type="number" id="age" name="age" ></label>
                <label for="section">الصف:  
                    <select id="section" name="section" required>
                        <option value="5">الخامس</option>
                        <option value="6">السادس</option>
                        <option value="7">السابع</option>
                        <option value="8">الثامن</option>

                    </select>
                </label>
                <input type="submit" name="submit" id="submit" value="انشاء حساب" >
            </form>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            </div>
       
    </body>
</html>