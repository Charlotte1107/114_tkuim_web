<?php
session_start();

// 所有飲品名稱陣列
$all_drinks = [
  "暮色紅玉", "焙影烏龍", "蜜香琥珀", "穀雨春芽", "霧嵐青茶", "白毫雪露",
  "夏暮青柚", "桑檸熟紅", "胭脂多多", "莓果綠茶", "蜜橙熟紅", "金蜜檸果",
  "雲蓋可可", "雲蓋青茶", "雲蓋紅玉", "雲蓋莓果", "雲蓋歐雷", "雲蓋烏龍",
  "珍珠歐蕾", "紅玉歐蕾", "莓果歐蕾", "黑密歐蕾", "青茶歐蕾", "金蜜歐蕾"
];

// 初始化票數
if (!isset($_SESSION['votes'])) {
  $_SESSION['votes'] = [];
  foreach ($all_drinks as $drink) {
    $_SESSION['votes'][$drink] = 0;
  }
}

// 處理投票
if (isset($_POST['vote'])) {
  $vote = $_POST['vote'];
  if (isset($_SESSION['votes'][$vote])) {
    $_SESSION['votes'][$vote]++;
  }
}

// 取前三名飲品
$votes = $_SESSION['votes'];
arsort($votes);
$top3 = array_slice($votes, 0, 3, true);
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8" />
  <title>茶感日常｜TEA ESSENCE</title>
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
    .image-row {
      display: flex;
      justify-content: center;
      gap: 16px;
      padding: 24px;
    }
    .image-row img {
      width: 300px;  
      object-fit: cover;
    }
    .ranking-table {
      margin: 2rem auto;
      padding: 1rem;
      max-width: 1000px;
      text-align: center;
    }
    .ranking-table h2 {
      color: #1A3C34;
      margin-bottom: 1rem;
    }
    .ranking-table table {
      width: 100%;
      border-collapse: collapse;
      margin: 0 auto;
    }
    .ranking-table th,
    .ranking-table td {
      border-bottom: 1px solid #ccc;
      padding: 0.8rem;
      font-size: 1rem;
    }
    .ranking-table img {
      width: 200px;
      height: auto;
      border-radius: 8px;
    }
    .ranking-table form {
      margin-bottom: 2rem;
    }
    .ranking-table select, .ranking-table button {
      padding: 8px 12px;
      font-size: 16px;
      margin: 0 4px;
    }
    .ranking-table button {
      background-color: #1A3C34;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .ranking-table button:hover {
      background-color: #15432c;
    }
    .user-info {
  position: absolute;
  right: 24px;
  top: 18px;
  font-size: 18px;
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
      <li><a href="order_status">訂單狀態</a></li>
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

  <section class="image-row">
    <img src="圖片1.png" alt="圖片1">
    <img src="圖片2.png" alt="圖片2">
    <img src="圖片3.png" alt="圖片3">
    <img src="圖片4.png" alt="圖片4">
  </section>

  <section class="ranking-table">
    <h2>人氣飲品排行榜 TOP 3</h2>

    <!-- 下拉投票區 -->
    <form method="post">
      <select name="vote" required>
        <option disabled selected>請選擇想投票的飲品</option>
        <?php foreach ($all_drinks as $drink): ?>
          <option value="<?php echo $drink; ?>"><?php echo $drink; ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit">投票</button>
    </form>

    <!-- 前三名排行表格 -->
    <table>
      <tr>
        <th>NO.1</th>
        <th>NO.2</th>
        <th>NO.3</th>
      </tr>
      <tr>
        <?php foreach ($top3 as $name => $count): ?>
        <td>
          <img src="<?php echo $name; ?>.jpg" alt="<?php echo $name; ?>"><br>
          <?php echo $name; ?>（<?php echo $count; ?> 票）
        </td>
        <?php endforeach; ?>
      </tr>
    </table>
  </section>
</body>
</html>