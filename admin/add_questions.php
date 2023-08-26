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
$count = 0;
if (isset($_POST['submit'])) {
    $question = mysqli_real_escape_string($con, $_POST['question']);
    $option1 = mysqli_real_escape_string($con, $_POST['option1']);
    $option2 = mysqli_real_escape_string($con, $_POST['option2']);
    $option3 = mysqli_real_escape_string($con, $_POST['option3']);
    $option4 = mysqli_real_escape_string($con, $_POST['option4']);
    if (isset($_POST['allowAttach'])) {
        $allowAttach = mysqli_real_escape_string($con, $_POST['allowAttach']);
        $attach = "yes";
    } else {
        $allowAttach = "";
        $attach = "no";
    }
    
    if (isset($_POST['coroption'])) {
        $coroption = mysqli_real_escape_string($con, $_POST['coroption']);
    } else {
        $coroption = ""; // Set a default value if 'section' is not set
    }
    if (isset($_POST['forsec'])) {
        $section = mysqli_real_escape_string($con, $_POST['forsec']);
    } else {
        $section = ""; // Set a default value if 'section' is not set
    }
    if(isset($_FILES['image'])){
        $image = $_FILES['image']['name'];
        $imagePath ='uploads/'.$image;
        $tmp_name = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp_name,$imagePath);
    }else{
        $image = "";
    }

    if (isset($_POST['allowAttach'])) {
        $attach = "yes";
    }else{
        $attach= "no";
    }

    if($count<40){
        $query = "INSERT INTO questions (question, option1, option2, option3, option4, coroption, section, image, allowAttach) VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$coroption', '$section','".$image."','$attach')";
        mysqli_query($con, $query);
        $count=$count+1;
    }else{

    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>اضافة اسئلة</title>
        <link rel="stylesheet" href="admin.css">
        <style>
            #addQuestionForm {
                background-color: #eee;
                width: 50%;
                margin: 20px auto;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            label {
                display: block;
                margin-bottom: 10px;
            }

            input[type="text"],
            select {
                width: 100%;
                padding: 8px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            select {
                cursor: pointer;
            }

            button[type="submit"], button[type="button"] {
                background-color: #333;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                font-weight: bold;
            }

            button[type="submit"]:hover {
                background-color: #555;
            }

            .image{
                width: 100%;
                padding: 8px;
                margin-bottom: 10px;
                border-radius: 3px;
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
                #addQuestionForm {
                    width: 60%;
                }
                label{
                    font-size: 28px;
                }
                input[type="text"]{
                    padding: 15px;
                    width: 90%
                }
                select{
                    font-size: 24px;
                }
                input[type="file"]{
                    padding: 15px;
                    font-size: 24px;
                }
                button[type="submit"], button[type="button"] {
                    font-size: 26px;
                    margin-top: 15px;
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
        <div>
        <form id="addQuestionForm" action="" method="post" enctype="multipart/form-data" >
        <label for="question">السؤال: <input type="text" name="question" id="question" required></label>
        <label for="option1">الخيار الاول: <input type="text" name="option1" id="option1" required></label>
        <label for="option2"> الخيار الثاني: <input type="text" name="option2" id="option2" required></label>
        <label for="option3">الخيار الثالث: <input type="text" name="option3" id="option3" required></label>
        <label for="option4">الخيار الرابع: <input type="text" name="option4" id="option4" required></label>
        <label for="coroption">الاجابة الصحيحة: 
        <select name="coroption" id="coroption" required>
            <option value="1">الخيار الاول</option>
            <option value="2">الخيار الثاني</option>
            <option value="3">الخيار الثالث</option>
            <option value="4">الخيار الرابع</option>
        </select>
        </label>
        <label for="forsec">الصف:  
        <select name="forsec" id="forsec" required>
            <option value="5">الخامس</option>
            <option value="6">السادس</option>
            <option value="7">السابع</option>
            <option value="8">الثامن</option>
        </select>
        </label>
        <label for="image">ارفاق صورة: <input type="file" name="image" accept="image/*" /></label>
        <div style="display: flex; flex-direction: row; padding: 2px;">
            <input type="checkbox" id="allowAttach" name="allowAttach" value="allow attach file">
            <label for="allowAttach">السماح للمستخدم بارفاق صور/ملفات</label>
        </div>
        <button type="submit" name="submit">اضافة السؤال</button>
        <button type="button" onclick="deleteData()">حذف جميع الاسئلة</button>
        <script>        
            function deleteData() {
                if (confirm("Are you sure you want to delete all data?")) {
                    <?php $count = 0; ?>
                    window.location.href = "delete_data.php";
                }
            }
        </script>
    </form>
        </div>
    </body>
</html>