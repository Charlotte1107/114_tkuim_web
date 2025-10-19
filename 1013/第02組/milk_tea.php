<?php
  session_start(); 
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>歐蕾</title>
  <style>
    body {
      background-color: #ffffff;
      color: #333;
      font-family: "Noto Sans TC", sans-serif;
      padding: 2rem;
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #ffffff;
      border-bottom: 1px solid #eee;
      padding: 1rem;
    }
    .logo {
      font-size: 20px;
      font-weight: bold;
      color: #1A3C34;
      margin: 0;
    }
    .nav-list {
      list-style: none;
      display: flex;
      gap: 1.5rem;
      margin: 0;
      padding: 0;
      align-items: center;
    }
    .nav-list a {
      text-decoration: none;
      color: #333;
    }
    .nav-list a:hover {
      color: #db995a;
    }
    .nav-list select {
      padding: 4px 8px;
      font-size: 16px;
    }
    h2 {
      font-size: 2rem;
      letter-spacing: 1px;
      border-left: 5px solid #E95C3A;
      padding-left: 0.5rem;
      color: #1A3C34;
    }
    .tea-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 40px;
      margin-top: 2rem;
    }
    .tea-item {
      text-align: left;
    }
    .tea-item img {
      width: 100%;
      height: auto;
      border-radius: 0;
    }
    .tea-item p {
      font-size: 1rem;
      margin: 0.5rem 0;
    }
    input[type="number"] {
      width: 60px;
      padding: 0.3rem;
      border: 1px solid #ccc;
    }
    select {
      padding: 0.4rem;
      border: 1px solid #ccc;
      margin-left: 0.5rem;
    }
    input[type="submit"] {
      padding: 0.5rem 1rem;
      margin-right: 1rem;
      margin-top: 1rem;
      background-color: #1A3C34;
      color: #fff;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover {
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
  <nav class="navbar">
    <h1 class="logo">TEA ESSENCE｜茶感日常</h1>
    <ul class="nav-list">
      <li><a href="index.php">首頁</a></li>
      <li><a href="about.php">關於我們</a></li>
      <li><a href="checkout.php">購物車</a></li>
      <li>
        <label for="drink-category">飲品總覽</label>
        <select name="drink-category" id="drink-category" onchange="location.href=this.value">
          <option selected disabled>飲品總覽</option>
          <option value="tea.php">單品茶 Classic</option>
          <option value="mix_tea.php">調茶 Mix Tea</option>
          <option value="sweet_cream.php">雲蓋 Sweet Cream Cold Foam</option>
          <option value="milk_tea.php">歐蕾 Milk Tea</option>
        </select>
      </li>
      <li><a href="member.php">會員專區</a></li>
      <li><a href="order_status.php">訂單狀態</a></li>
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
  <h2>歐蕾</h2>
  <form action="" method="post">
    <div class="tea-grid">
      <div class="tea-item">
        <img src="珍珠歐蕾.jpg" width="150"><br>
        珍珠歐蕾 - NT$85<br>
        數量：<input type="number" name="qty[珍珠歐蕾]" value="0" min="0"><br>
      </div>
      <div class="tea-item">
        <img src="紅玉歐蕾.jpg" width="150"><br>
        紅玉歐蕾 - NT$65<br>
        數量：<input type="number" name="qty[紅玉歐蕾]" value="0" min="0"><br>
      </div>
      <div class="tea-item">
        <img src="莓果歐蕾.jpg" width="150"><br>
        莓果歐蕾 - NT$80<br>
        數量：<input type="number" name="qty[莓果歐蕾]" value="0" min="0"><br>
      </div>
      <div class="tea-item">
        <img src="黑密歐蕾.jpg" width="150"><br>
        黑密歐蕾 - NT$70<br>
        數量：<input type="number" name="qty[黑密歐蕾]" value="0" min="0"><br>
      </div>
      <div class="tea-item">
        <img src="青茶歐蕾.jpg" width="150"><br>
        青茶歐蕾 - NT$65<br>
        數量：<input type="number" name="qty[青茶歐蕾]" value="0" min="0"><br>
      </div>
      <div class="tea-item">
        <img src="金蜜歐蕾.jpg" width="150"><br>
        金蜜歐蕾 - NT$70<br>
        數量：<input type="number" name="qty[金蜜歐蕾]" value="0" min="0"><br>
      </div>
    </div>
    <br>
    冰度：
    <input type="radio" name="iceLevel" value="去冰">去冰
    <input type="radio" name="iceLevel" value="微冰">微冰
    <input type="radio" name="iceLevel" value="少冰">少冰
    <input type="radio" name="iceLevel" value="正常冰">正常冰
    <input type="radio" name="iceLevel" value="溫">溫
    <input type="radio" name="iceLevel" value="熱">熱
    <br><br>

    甜度：
    <input type="radio" name="sugar" value="無糖">無糖
    <input type="radio" name="sugar" value="微糖">微糖
    <input type="radio" name="sugar" value="半糖">半糖
    <input type="radio" name="sugar" value="少糖">少糖
    <input type="radio" name="sugar" value="正常糖">正常糖
    <br><br>

    加料：
    <select name="add[]" multiple>
      <option value="無">無</option>
      <option value="珍珠">珍珠 +$10</option>
      <option value="椰果">椰果 +$5</option>
      <option value="仙草">仙草 +$5</option>
    </select>
    <br><br>

    <input type="submit" name="submit" value="加入購物車">
    <input type="submit" name="clear" value="清空購物車">
    <input type="submit" name="show" value="顯示購物車內容">
  </form>

<?php
  session_start(); 
  error_reporting(0);

  // 初始化購物車
  function initializeCart() {
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
    }
  }

  // 計算加料價格
  function calculateAddPrice($addItems) {
    $addPrice = 0;
    foreach ($addItems as $a) {
      if ($a === '珍珠') $addPrice += 10;
      elseif ($a === '椰果' || $a === '仙草') $addPrice += 5;
    }
    return $addPrice;
  }

  // 處理加入購物車
  function handleAddToCart($post, $prices) {
    if ($post['submit']) {
      $qty = $post['qty'];
      $ice = isset($post['iceLevel']) ? $post['iceLevel'] : '去冰';
      $sugar = isset($post['sugar']) ? $post['sugar'] : '無糖';
      $add = isset($post['add']) ? $post['add'] : ['無'];

      if (!is_array($add)) {
        $add = [$add];
      }

      foreach ($qty as $name => $amount) {
        if ($amount > 0) {
          $addKey = implode(',', $add);
          $key = $name . '|' . $ice . '|' . $sugar . '|' . $addKey;
          if (!isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key] = [
              'name' => $name,
              'qty' => 0,
              'ice' => $ice,
              'sugar' => $sugar,
              'add' => $add
            ];
          }
          $_SESSION['cart'][$key]['qty'] += $amount;
        }
      }
    }
  }

  // 處理減少數量
  function handleReduceItem($post) {
    if (isset($post['reduce_key']) && isset($post['reduce_qty'])) {
      $key = $post['reduce_key'];
      $qtyToReduce = intval($post['reduce_qty']);
      if (isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key]['qty'] -= $qtyToReduce;
        if ($_SESSION['cart'][$key]['qty'] <= 0) {
          unset($_SESSION['cart'][$key]);
        }
      }
    }
  }

  // 清空購物車
  function handleClearCart() {
    $_SESSION['cart'] = [];
    echo "<h3>購物車已清空</h3>";
  }

  // 顯示購物車內容
  function displayCart($prices) {
    if (!empty($_SESSION['cart'])) {
      echo "<h3>購物車內容</h3>";
      $total = 0;
      foreach ($_SESSION['cart'] as $key => $item) {
        $addText = is_array($item['add']) ? implode('、', $item['add']) : $item['add'];
        $addItems = is_array($item['add']) ? $item['add'] : [$item['add']];
        $addPrice = calculateAddPrice($addItems);
        $pricePerCup = $prices[$item['name']] + $addPrice;
        $subtotal = $pricePerCup * $item['qty'];
        $total += $subtotal;

        echo "<form method='post' style='display:inline; margin-left: 10px;'>
          <input type='hidden' name='reduce_key' value='" . htmlspecialchars($key) . "'>
          減少數量：<input type='number' name='reduce_qty' min='1' max='{$item['qty']}' value='1' style='width:50px;'>
          <button type='submit' style='background:none; border:1px solid #E95C3A; color:#E95C3A; padding:2px 6px; cursor:pointer;'>刪除</button>
          </form>
          {$item['name']} × {$item['qty']} 杯（{$item['ice']} /{$item['sugar']}/ 加料：{$addText}） - NT$$subtotal<br>";
      }
      echo "<strong>總金額：NT$$total</strong><br>";
      echo "<br><br><a href='checkout.php'>
              <button style='background-color:#1A3C34; color:white; padding:8px 16px; border:none; cursor:pointer;'>
                前往結帳
              </button>
            </a>";
    }
  }

  // 商品價格設定
  $prices = [
    '暮色紅玉' => 60,
    '焙影烏龍' => 65,
    '蜜香琥珀' => 55,
    '穀雨春芽' => 70,
    '霧嵐青茶' => 50,
    '白毫雪露' => 60,
    '夏暮青柚' => 65,
    '桑檸熟紅' => 55,
    '胭脂多多' => 50,
    '莓果綠茶' => 70,
    '蜜橙熟紅' => 55,
    '金蜜檸果' => 60,
    '雲蓋可可' => 80,
    '雲蓋青茶' => 75,
    '雲蓋紅玉' => 75,
    '雲蓋莓果' => 85,
    '雲蓋歐蕾' => 85,
    '雲蓋烏龍' => 70,
    '珍珠歐蕾' => 85,
    '紅玉歐蕾' => 65,
    '莓果歐蕾' => 80,
    '黑密歐蕾' => 70,
    '青茶歐蕾' => 65,
    '金蜜歐蕾' => 70
  ];

  // 執行流程
  initializeCart();
  handleReduceItem($_POST);
  handleAddToCart($_POST, $prices);
  if ($_POST['clear']) handleClearCart();
  if ($_POST['show']) displayCart($prices);
?>

</body>
</html>
