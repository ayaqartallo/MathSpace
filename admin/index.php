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
                overflow: hidden;
                font-family: 'Amiri', serif;
                font-family: 'Cairo', sans-serif;
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
                <li><a href="./signup_users.php" target="_self">انشاء حساب للمستخدم</a></li>
                <li><a href="./control_users.php" target="_self">التحكم بالمستخدمين</a></li>
                <li><a href="./add_questions.php" target="_self">اضافة اسئلة</a></li>
                <li><a href="../auth/login.php" target="_self">تسجيل الخروج</a></li>
            </ul>
        </header>
        <div>
           <fieldset>
                <form action="" method="post" >
                    <label for="section">الصف
                        <select name="section" id="section">
                            <option value="5">الخامس</option>
                            <option value="6">السادس</option>
                            <option value="7">السابع</option>
                            <option value="8">الثامن</option>
                        </select>
                    </label>
                    <button type="submit">بحث</button>
                </form>
            </fieldset>
            <fieldset>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $selected_section = $_POST['section'];

                $sql = "SELECT * FROM questions WHERE section = $selected_section";

                $result = mysqli_query($con, $sql);

                if ($result) {
                    echo '<table>';
                    echo '<tr><th>رقم السؤال</th><th>السؤال</th></tr>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['questionId'] . '</td>';
                        echo '<td><a href="viewUsersSol.php?questionId=' . $row['questionId'] . '">' . $row['question'] . '</a></td>'; 
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
        </div>
    </body>
</html>