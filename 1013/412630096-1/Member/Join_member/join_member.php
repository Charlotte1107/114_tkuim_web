<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取表單資料
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    
    // 確認資料
    echo "<h1>確認您的資料</h1>";
    echo "<p><strong>姓名：</strong> $name</p>";
    echo "<p><strong>電子郵件：</strong> $email</p>";
    echo "<p><strong>密碼：</strong> (已隱藏)</p>";
    echo "<form method='post' action='register.php'>";
    echo "<input type='hidden' name='name' value='$name'>";
    echo "<input type='hidden' name='email' value='$email'>";
    echo "<input type='hidden' name='password' value='$password'>";
    
    echo "</form>";
    echo "<form method='get' action='join_member.php'>";
    echo "<input type='submit' value='返回重新填寫' style='background-color: #5a4636; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;'>";
    echo "</form>";
} else {
    // 顯示註冊表單
    ?>
    <!DOCTYPE html>
    <html lang="zh-Hant">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>加入會員</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f1e8;
                color: #5a4636;
                margin: 0;
                padding: 20px;
            }
            h1 {
                text-align: center;
                color: #8b5e3c;
            }
            form {
                max-width: 400px;
                margin: 0 auto;
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            label {
                display: block;
                margin-bottom: 5px;
            }
            input[type="text"],
            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }
            input[type="submit"] {
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <h1>加入會員</h1>
        <form method="post" action="">
            <label for="name">姓名：</label>
            <input type="text" name="name" required>

            <label for="email">電子郵件：</label>
            <input type="email" name="email" required>

            <label for="password">密碼：</label>
            <input type="password" name="password" required>

            <input type="submit" value="提交" style="background-color: #c24e3a; color: white;">
        </form>
    </body>
    </html>
    <?php
}
?>
