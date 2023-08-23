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
$query = "SELECT * from waiting_users";
$result = mysqli_query($conn,$query);
$status = 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>التحكم بالمستخدمين</title>
        <link rel="stylesheet" href="admin.css">
        <script src="https://kit.fontawesome.com/9c69e75105.js" crossorigin="anonymous"></script>
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
        <main>
            <table>
                    <tr class="htitle">
                        <td>الرقم</td>
                        <td>اسم المستخدم</td>
                        <td>السماح بالدخول</td>
                    </tr>
                    <tr> <?php
                        while ($row = mysqli_fetch_assoc($result)){
                        ?>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $name=$row['username'];?></td>
                        <td><a href="acceptreq.php?name=<?php echo $name?>" >
                        <?php $status=$row['accept'];?>
                        <?php if ($status == 0): ?>
                        <i class="fa-solid fa-check" style="color: #ff3344"></i>
                        <?php else: ?>
                        <i class="fa-solid fa-cancel" style="color: #ff3344"></i>
                        <?php endif; ?>
                    </a></td>
                    </tr>
                    <?php
                    }
                    ?>
            </table>
            <a href="acceptall.php" class="acceptall">الموافقة على الجميع</a>
        </main>
    </body>
</html>