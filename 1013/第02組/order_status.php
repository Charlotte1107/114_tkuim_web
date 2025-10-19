<?php
session_start();
date_default_timezone_set("Asia/Taipei");
$order = isset($_SESSION['order']) ? $_SESSION['order'] : null;
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>訂單狀態</title>
  <style>
    body {
      font-family: "Noto Sans TC", sans-serif;
      background-color: #ffffff;
      color: #333;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 700px;
      margin: 0 auto;
      background-color: #fdfdfd;
      padding: 2rem;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    nav {
      background-color: #ffffff;
      padding: 16px;
      border-bottom: 1px solid #eee;
      position: relative;
    }
    nav h1 {
      font-size: 20px;
      font-weight: bold;
      margin: 0 0 8px;
      color: #1A3C34;
    }
    nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      gap: 16px;
      font-size: 16px;
    }
    nav a, nav button {
      background: none;
      border: none;
      color: #333;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
      position: relative;
    }
    nav a:hover, nav button:hover {
      color: #db995a;
    }
    .hero {
      background-color: #1A3C34;
      text-align: center;
      padding: 40px 16px;
    }
    .hero h2 {
      font-size: 22px;
      margin-bottom: 8px;
      color:#ffffff;
    }
    .hero p {
      font-size: 15px;
      color: #ffffff;
    }
    h2 {
      text-align: center;
      color: #1A3C34;
      margin-bottom: 2rem;
    }
    p, li {
      font-size: 1rem;
      line-height: 1.6;
    }
    ul {
      margin-left: 1.5rem;
      padding-left: 0;
    }
    #countdown {
      margin-top: 1rem;
      font-weight: bold;
      color: #E95C3A;
      font-size: 1.1rem;
    }
    .user-info {
      position: absolute;
      right: 24px;
      top: 18px;
      font-size: 1ˊpx;
      color: #1A3C34;   
    }
    .user-info a {
      text-decoration: none;
      color: #1A3C34;
    }
    .user-info a:hover {
      color: #db995a;
    }
  </style>
</head>
<body>
  <nav>
    <h1>TEA ESSENCE｜茶感日常</h1>
    <ul>
      <li><a href="index.php">首頁</a></li>
      <li><a href="about.php">關於我們</a></li>
      <li><a href="checkout.php">購物車</a></li>
      <li>
        <label for="drink-category">飲品總覽</label>
        <select name="drink-category" id="drink-category" onchange="location.href=this.value">
          <option selected disabled>飲品總覽</option>
          <option value="tea.php">單品茶 Classic</option>
          <option value="mix_tea.php">調茶 Mix Tea</option>
          <option value="sweet_cream.php">雲蓋 Sweet Cream Coid Foam</option>
          <option value="milk_tea.php">歐蕾 Milk Tea</option>
        </select>
      </li>
      <li><a href="member.php">會員專區</a></li>
    </ul>
    <div class="user-info">
  <?php
  if (isset($_SESSION['user'])) {
    echo "歡迎，" . ($_SESSION['user']) . "｜<a href='logout.php'>登出</a>";
  } else {
    echo "<a href='login.php'>登入</a>｜<a href='register.php'>註冊</a>";
  }
  ?>
</div>
  </nav>
  <section class="hero">
    <h2>日常的一杯，值得被溫柔對待</h2>
    <p>Find your moment of calm in every cup.</p>
  </section>
  <br><br>
  <div class="container">
    <h2>訂單狀態</h2>
    <?php if ($order): ?>
      <p><strong>收件人：</strong><?php echo $order['name']; ?>（<?php echo $order['phone']; ?>）</p>
      <p><strong>取餐方式：</strong><?php echo $order['method']; ?><?php if ($order['method'] === '外送') echo "，地址：" . $order['address']; ?></p>
      <p><strong>付款方式：</strong><?php echo $order['payment']; ?></p>
      <p><strong>預計送達時間：</strong><?php echo date('H:i', $order['delivery_time']); ?></p>

      <p><strong>訂購內容：</strong></p>
      <ul>
        <?php
        foreach ($order['items'] as $item) {
          $add = is_array($item['add']) ? implode('、', $item['add']) : $item['add'];
          echo "<li>{$item['name']} × {$item['qty']} 杯（{$item['ice']} / {$item['sugar']} / 加料：{$add}）</li>";
        }
        ?>
      </ul>

      <p id="countdown"></p>
      <script>
        var deliveryTime = <?php echo $order['delivery_time']; ?> * 1000;
        var countdown = document.getElementById("countdown");
        var timer = setInterval(function() {
          var now = new Date().getTime();
          var distance = deliveryTime - now;

          if (distance <= 0) {
            clearInterval(timer);
            countdown.innerHTML = "訂單已完成！";
          } else {
            var minutes = Math.floor(distance / 60000);
            var seconds = Math.floor((distance % 60000) / 1000);
            countdown.innerHTML = "剩下 " + minutes + " 分 " + seconds + " 秒";
          }
        }, 1000);
      </script>
    <?php else: ?>
      <p style="text-align:center;">目前沒有訂單紀錄</p>
    <?php endif; ?>
  </div>
</body>
</html>
