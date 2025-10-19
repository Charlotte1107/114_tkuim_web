<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>網站地圖</title>
    <style>
        body {
            background-color: #87CEEB; /* 波妞的水藍色 */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #2E8B57; /* 深綠色 */
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        a {
            color: #4682B4; /* 深藍色 */
            text-decoration: none;
            font-size: 18px;
        }
        a:hover {
            text-decoration: underline;
        }
        .info {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    echo "<div class='info'>班級: 資管二C<br>";
    echo "學號: 412630096<br>";
    echo "姓名: 利蓁琳<br>";
    echo "心得與建議:上課內容有趣<br></div>";
    echo "<h2>網站地圖</h2>";
    echo "<ul>";
    echo "<li><a href='index.php'>首頁</a></li>";
    echo "<li><a href='5.php'>關於</a></li>";
    echo "<li><a href='1.html'>註冊會員</a></li>";
    echo "<li><a href='2.html'>宗介介紹</a></li>";
    echo "<li><a href='3.php'>藤本介紹</a></li>";
    echo "<li><a href='4.php'>波妞介紹</a></li>";
    echo "</ul>";
    ?>
</div>

</body>
</html>
