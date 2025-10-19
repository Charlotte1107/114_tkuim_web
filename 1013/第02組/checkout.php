<?php
session_start();
date_default_timezone_set("Asia/Taipei");//時區是台北的
// 讀取會員資料
$users = [];//初始化空陣列
if (file_exists("users.json")) {
  $json = file_get_contents("users.json");
  $users = json_decode($json, true);
}

$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;

$prices = [
  //單品茶
      "暮色紅玉" => 60,
      "焙影烏龍" => 65,
      "蜜香琥珀" => 55,
      "穀雨春芽" => 70,
      "霧嵐青茶" => 50,
      "白毫雪露" => 60,

      //調茶
      "夏暮青柚" => 65,
      "桑檸熟紅" => 55,
      "胭脂多多" => 50,
      "莓果綠茶" => 70,
      "蜜橙熟紅" => 55,
      "金蜜檸果" => 60,

      //雲蓋
      "雲蓋可可" => 80,
      "雲蓋青茶" => 75,
      "雲蓋紅玉" => 75,
      "雲蓋莓果" => 85,
      "雲蓋歐蕾" => 85,
      "雲蓋烏龍" => 70,

      //歐雷
      "珍珠歐蕾" => 85,
      "紅玉歐蕾" => 65,
      "莓果歐蕾" => 80,
      "黑密歐蕾" => 70,
      "青茶歐蕾" => 65,
      "金蜜歐蕾" => 70
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['cart'])) {
  $name = $_POST['name'] ?? '';
  $phone = $_POST['phone'] ?? '';
  $method = $_POST['method'] ?? '';
  $address = $_POST['address'] ?? '';
  $payment = $_POST['payment'] ?? '';

  $total = 0;
  foreach ($_SESSION['cart'] as $item) {
    $addPrice = 0;
    $adds = is_array($item['add']) ? $item['add'] : [$item['add']];
    foreach ($adds as $a) {
      if ($a === '珍珠') $addPrice += 10;
      elseif ($a === '椰果' || $a === '仙草') $addPrice += 5;
    }
    $subtotal = ($prices[$item['name']] + $addPrice) * $item['qty'];
    $total += $subtotal;
  }

  $discount = 0;
  if ($username && isset($users[$username])) {
    $spent = $users[$username]['total_spent'];
    if ($spent >= 10000) {
      $discount = 20;
      $level = "金牌會員";
    } elseif ($spent >= 5000) {
      $discount = 10;
      $level = "銀牌會員";
    } else {
      $level = "一般會員";
    }
    $users[$username]['total_spent'] += ($total - $discount);
    // 新增歷史訂單紀錄
  if (!isset($users[$username]['history'])) {
    $users[$username]['history'] = [];
  }
  $users[$username]['history'][] = [
    'time' => date("Y-m-d H:i:s"),
    'items' => $_SESSION['cart'],
    'total' => $total
  ];
    file_put_contents("users.json", json_encode($users));
  } else {
    $level = "訪客（無折扣）";
  }

  $finalTotal = $total - $discount;
  $minutesToAdd = rand(10, 15);
  $deliveryTime = time() + ($minutesToAdd * 60);
  $_SESSION['order'] = [
    'items' => $_SESSION['cart'],
    'delivery_time' => $deliveryTime,
    'name' => $name,
    'phone' => $phone,
    'method' => $method,
    'address' => $address,
    'payment' => $payment
  ];

  $_SESSION['cart'] = [];
  $submitted = true;
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>結帳頁面</title>
  <style>
    body {
      font-family: "Noto Sans TC", sans-serif;
      background-color: #fff;
      color: #333;
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
    h2, h3 {
      text-align: center;
      color: #1A3C34;
    }
    .cart-section,
    .contact-section {
      max-width: 600px;
      margin: 2rem auto;
      padding: 1.5rem 2rem;
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .cart-section ul {
      padding-left: 1.5rem;
      line-height: 1.8;
    }
    .contact-section label {
      display: block;
      margin-top: 1rem;
      font-weight: bold;
    }
    .contact-section input,
    .contact-section select {
      width: 100%;
      padding: 0.5rem;
      margin-top: 0.3rem;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .contact-section button {
      margin-top: 2rem;
      background-color: #1A3C34;
      color: white;
      padding: 0.6rem 1.2rem;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      width: 100%;
      cursor: pointer;
    }
    .contact-section button:hover {
      background-color: #15432c;
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
      <li>
        <label for="drink-category">飲品總攬</label>
        <select name="drink-category" id="drink-category" onchange="location.href=this.value">
          <option selected disabled>飲品總攬</option>
          <option value="tea.php">單品茶 Classic</option>
          <option value="mix_tea.php">調茶 Mix Tea</option>
          <option value="sweet_cream.php">雲蓋 Sweet Cream Cold Foam</option>
          <option value="milk_tea.php">歐蕾 Milk Tea</option>
        </select>
      </li>
      <li><a href="member.php">會員專區</a></li>
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

  <h2>結帳頁面</h2>
  <?php if (isset($submitted) && $submitted): ?>
    <div class="cart-section">
      <h3>感謝您的訂購！</h3>
      <p>總金額：NT$<?= $finalTotal; ?>（已折扣 NT$<?= $discount; ?>）</p>
      <p>會員等級：<?= $level; ?></p>
      <p>付款方式：<?= $payment; ?></p>
      <p><a href="order_status.php">查看訂單狀態</a></p>
    </div>
  <?php elseif (!empty($_SESSION['cart'])): ?>
    <div class="cart-section">
      <h3>購物車明細</h3>
      <ul>
        <?php foreach ($_SESSION['cart'] as $item): ?>
          <?php
            $adds = is_array($item['add']) ? implode('、', $item['add']) : $item['add'];
            echo "<li>{$item['name']} × {$item['qty']} 杯（{$item['ice']} / {$item['sugar']} / 加料：{$adds}）</li>";
          ?>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="contact-section">
      <h3>請填寫聯絡資訊</h3>
      <form method="post">
        <label>姓名：</label>
        <input type="text" name="name" required>

        <label>電話：</label>
        <input type="text" name="phone" required>

        <label>取餐方式：</label>
        <input type="radio" name="method" value="自取" checked onclick="document.getElementById('address-field').style.display='none'"> 自取
        <input type="radio" name="method" value="外送" onclick="document.getElementById('address-field').style.display='block'"> 外送

        <div id="address-field" style="display:none;">
          <label>地址：</label>
          <input type="text" name="address">
        </div>

        <label>支付方式：</label>
        <select name="payment" required>
          <option value="現金">現金</option>
          <option value="LINE Pay">LINE Pay</option>
          <option value="信用卡">信用卡</option>
        </select>

        <button type="submit">確認結帳</button>
      </form>
    </div>
  <?php else: ?>
    <p style="text-align:center;">購物車是空的。</p>
  <?php endif; ?>
</body>
</html>