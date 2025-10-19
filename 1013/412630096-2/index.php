<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>首頁</title>
    <style>
        body {
            background-color: #87CEEB; /* 波妞的水藍色 */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        nav {
            background-color: #4682B4; /* 深藍色 */
            padding: 10px 20px;
            text-align: center;
        }
        nav a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #2E8B57; /* 深綠色 */
        }
        img {
            display: block;
            margin: 20px auto;
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        p {
            text-align: justify;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<nav>
    <a href="5.php">關於</a>
    <a href="1.html">注冊會員</a>
    <a href="2.html">宗介介紹</a>
    <a href="3.php">藤本介紹</a>
    <a href="4.php">波妞介紹</a>
</nav>

<div class="container">
    <?php
    echo '<img src="首頁.jpg" alt="首頁圖片">';
    echo '<h1>崖上的波妞故事簡介</h1>';
    echo '<p>電影《崖上的波妞》敘述了一個美麗感人的故事。其主人公宗介是一個五歲的小男孩，
    與他所救的小金魚波妞展開了一場奇妙的冒險。電影中的畫面洋溢著溫馨與夢幻，傳遞出對自然與生命的熱愛。</p>';
    echo '<p>波妞的形象充滿童趣，配以鮮豔的紅色小裙子和靈動的眼神，使得她成為最受歡迎的角色之一。
    這部電影通過孩子的純真視角，勾勒出人類與自然之間的微妙聯繫，並啟發觀眾對愛與責任的思考。</p>';
    echo '<img src="首頁2.jpg" alt="波妞圖片">';
    ?>
</div>

</body>
</html>
