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

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>الصفحة الرئيسية</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200;400&display=swap" rel="stylesheet">
        <style>
            body{
                font-family: 'Amiri', serif;
                font-family: 'Cairo', sans-serif;
                overflow-x: hidden;
            }
            fieldset {
                border: none;
            }
            button {
                padding: 10px 50px;
                color: #fff;
                background-color: #ff3344;
                border: none;
                border-radius: 20px;
                cursor: pointer;
                font-weight: bold;
                font-size: 16px;
            }
            div {
                text-align: center;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                margin: 50px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }
            th {
                background-color: #f2f2f2;
            }
            a{
                text-decoration: none;
            }
            label{
                font-weight: bold;
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
        <div>
           <fieldset>
                <form action="" method="post" >
                    <label for="section">الصف
                        <input type="text" name="username" id="username" >
                    </label>
                    <button type="submit">بحث</button>
                </form>
            </fieldset>
            <fieldset>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'];

                $sql = "SELECT * FROM users WHERE username LIKE'%$username%'";

                $result = mysqli_query($con, $sql);

                if ($result) {
                    echo '<table>';
                    echo '<tr><th>الصف:</th><th>العمر:</th><th>عدد النقاط:</th></tr>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['section'] . '</td>';
                        echo '<td>' . $row['age'] . '</td>';
                        echo '<td>' . $row['score'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    mysqli_free_result($result);
                } else {
                    echo 'Error executing query: ' . mysqli_error($con);
                }
            }
            ?>
            </fieldset>
          
            <fieldset>
            <h4>الأسئلة التي أجاب عليها:</h4>
                <?php
                    $sql = "SELECT * FROM user_answers WHERE username LIKE'%$username%'";

                    $result = mysqli_query($con, $sql);
    
                    if ($result) {
                        echo '<table>';
                        echo '<tr><th>السؤال</th><th>الاجابة:</th></tr>';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            $selectedOption = $row['selected_option'];
                            $qId = $row['questionId'];
                            $sql1 = "SELECT question FROM questions WHERE questionId = '$qId'";
                            $result1 = mysqli_query($con, $sql1);
                            while ($row = mysqli_fetch_assoc($result1)) {
                            echo '<td>' . $row['question'] . '</td>';
                            }
                            echo '<td>' . $selectedOption . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                        mysqli_free_result($result);
                    } else {
                        echo 'Error executing query: ' . mysqli_error($con);
                    }
                ?>
            </fieldset>
        </div>
    </body>
</html>