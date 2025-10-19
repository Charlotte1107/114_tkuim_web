<?php
error_reporting(0);
echo "<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f0f8ff;
        color: #333;
    }
    nav {
        background-color: #4682B4;
        padding: 10px 0;
        text-align: center;
        margin-bottom: 20px;
    }
    nav a {
        color: white;
        margin: 0 15px;
        text-decoration: none;
        font-size: 16px;
    }
    nav a:hover {
        text-decoration: underline;
    }
    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }
    th {
        background-color: #4682B4;
        color: white;
    }
    img {
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }
</style>";

echo "<nav>";
echo "<a href='index.php'>首頁</a>";
echo "<a href='5.php'>關於</a>";
echo "<a href='2.html'>宗介介紹</a>";
echo "<a href='3.php'>藤本介紹</a>";
echo "<a href='4.php'>波妞介紹</a>";
echo "</nav>";

if (isset($_GET['sub'])) {
    $name = $_GET['name'];
    $num = $_GET['num'];
    $pic = array($_GET['love1'], $_GET['love2'], $_GET['love3'], $_GET['love4']);
    $background = $_GET['background'];
    $me = $_GET['me'];

    // 初始化圖片路徑陣列
    $imagePaths = array();

    for ($i = 0; $i < count($pic); $i++) {
        if ($pic[$i] == "1") {
            $imagePaths[$i] = "波妞.jpg";
        } elseif ($pic[$i] == "2") {
            $imagePaths[$i] = "宗介.jpg";
        } elseif ($pic[$i] == "3") {
            $imagePaths[$i] = "曼瑪璉.jpg";
        } else {
            $imagePaths[$i] = "理莎.jpg";
        }
    }

    echo "<table>";
    echo "<tr><th colspan='4'>基本資訊</th></tr>";

    echo "<tr><td>姓名</td><td>$name</td><td rowspan='2'><img src='$me' width='100' height='100'></td></tr>";
    echo "<tr><td>電話</td><td>$num</td></tr>";

    echo "<tr><th colspan='4'>喜愛角色程度分級</th></tr>";

    echo "<tr><td>第一名</td><td colspan='3'><img src='" . $imagePaths[0] . "' width='100' height='100'></td></tr>";
    echo "<tr><td>第二名</td><td colspan='3'><img src='" . $imagePaths[1] . "' width='100' height='100'></td></tr>";
    echo "<tr><td>第三名</td><td colspan='3'><img src='" . $imagePaths[2] . "' width='100' height='100'></td></tr>";
    echo "<tr><td>第四名</td><td colspan='3'><img src='" . $imagePaths[3] . "' width='100' height='100'></td></tr>";
    
    echo "<tr><th colspan='4'>查看更多桌布</th></tr>";
    echo "<tr><td colspan='4'><a href='$background' target='_blank'>桌布</a></td></tr>";
    echo "</table>";
}
?>
