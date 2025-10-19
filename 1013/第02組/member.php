

<?php
session_start();
date_default_timezone_set("Asia/Taipei");
$users = file_exists("users.json") ? json_decode(file_get_contents("users.json"), true) : [];
$username = $_SESSION['user'] ?? null;

$history = $username && isset($users[$username]['history']) ? $users[$username]['history'] : [];
$total_spent = $users[$username]['total_spent'] ?? 0;

if ($total_spent >= 10000) {
  $level = "金牌會員";
} elseif ($total_spent >= 5000) {
  $level = "銀牌會員";
} else {
  $level = "一般會員";
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>會員專區</title>
  <style>
    body {
      background-color: #ffffff;
      color: #333;
      font-family: sans-serif;
      margin: 0;
      padding: 0;
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
    }
    .info {
      max-width: 600px;
      margin: 2rem auto;
      padding: 1.5rem;
      background: #f9f9f9;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .info p {
      font-size: 16px;
      line-height: 1.6;
    }
    .record {
      border-top: 1px solid #ddd;
      padding-top: 1rem;
      margin-top: 1rem;
    }
    .record ul {
      margin: 0.5rem 0;
      padding-left: 1.5rem;
    }
    .membership-info {
  max-width: 600px;
  margin: 2rem auto;
  background-color: #f8f8f8;
  padding: 1.5rem;
  border-left: 6px solid #1A3C34;
  border-radius: 6px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.membership-info h3 {
  margin-bottom: 1rem;
  color: #1A3C34;
  border-bottom: 1px solid #ccc;
  padding-bottom: 0.5rem;
}

.membership-info ul {
  padding-left: 1.5rem;
  line-height: 1.8;
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
      <li><a href="about.php">關於我們</a></li>
      <li><a href="index.php">首頁</a></li>
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
      <li><a href="order_status">訂單狀態</a></li>
    </ul>
    <div class="user-info">
  <?php
  if (isset($_SESSION['user'])) {
    echo "歡迎，" . htmlspecialchars($_SESSION['user']) . "｜<a href='logout.php'>登出</a>";
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
  <h2>會員專區</h2>
  <div class="membership-info">
  <h3>會員等級說明</h3>
  <ul>
    <li><strong>金牌會員</strong>（累積消費滿 NT$10,000）：每次消費享 <span style="color: #e95c3a;">NT$20</span> 折扣</li>
    <li><strong>銀牌會員</strong>（累積消費滿 NT$5,000）：每次消費享 <span style="color: #e95c3a;">NT$10</span> 折扣</li>
    <li><strong>一般會員</strong>：享基本服務（無折扣）</li>
  </ul>
</div>

  <div class="info">
    <?php if ($username): ?>
      <p><strong>歡迎回來，<?= $users[$username]['name']; ?>！</strong></p>
      <p>會員等級：<?= $level; ?></p>
      <p>累積消費金額：NT$<?= $total_spent; ?></p>

      <?php if (!empty($history)): ?>
        <div class="record">
          <h3>歷史訂單：</h3>
          <?php foreach (array_reverse($history) as $record): ?>
            <p><strong><?= $record['time']; ?></strong></p>
            <ul>
              <?php foreach ($record['items'] as $item): ?>
                <?php
                  $adds = is_array($item['add']) ? implode('、', $item['add']) : $item['add'];
                  echo "<li>{$item['name']} × {$item['qty']} 杯（{$item['ice']} / {$item['sugar']} / 加料：{$adds}）</li>";
                ?>
              <?php endforeach; ?>
            </ul>
            <p>此筆總金額：NT$<?= $record['total']; ?></p>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p>目前尚無歷史訂單紀錄。</p>
      <?php endif; ?>
    <?php else: ?>
      <p>請先登入以查看您的會員資料。</p>
    <?php endif; ?>
  </div>
</body>
</html>
