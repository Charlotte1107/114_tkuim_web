<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username=$_POST['username'];
  $password=$_POST['password'];
//.json檔用來儲存結構化資料，這樣才可以比對密碼對不對再讓使用者進入
  $users = file_exists("users.json")?json_decode(file_get_contents("users.json"), true):[];

  if (isset($users[$username])&&$users[$username]['password'] === $password) {
    $_SESSION['user']=$username;
    header("Location: index.php");
    exit();
  }else{
    $error="帳號或密碼錯誤！";
  }
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>會員登入</title>
  <style>
    body{
      font-family:"Noto Sans TC", sans-serif;
      background-color:#ffffff;
      color:#333;
      margin:0;
      padding:0;
    }
    nav{
      background-color:#ffffff;
      padding:16px;
      border-bottom:1px solid #eee;
      position:relative;
    }
    nav h1{
      font-size:20px;
      font-weight:bold;
      margin:0 0 8px;
      color:#1A3C34;
    }
    nav ul{
      list-style:none;
      padding:0;
      margin:0;
      display:flex;
      gap:16px;
      font-size:16px;
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
    .hero p{
      font-size: 15px;
      color: #ffffff;
    }
    h2{
      font-size: 2rem;
      color: #1A3C34;
      text-align: center;
      margin-top: 2rem;
    }
    .form-wrapper{
      max-width: 400px;
      margin:2rem auto;
      background-color: #fdfdfd;
      border:1px solid #ccc;
      padding:1.5rem;
      border-radius: 8px;
      box-shadow:0 2px 8px rgba(0, 0, 0, 0.05);
    }
  
    input[type="text"],
    input[type="password"] {
      width:100%;
      padding:0.6rem;
      margin-bottom:1.2rem;
      border:1px solid #ccc;
      border-radius:4px;
      font-size:1rem;
    }
    input[type="submit"]{
      background-color:#1A3C34;
      color:#fff;
      padding:0.5rem 1.5rem;
      border:none;
      font-size:1rem;
      cursor:pointer;
      width:100%;
    }
    input[type="submit"]:hover{
      background-color: #15432c;
    }
    .error{
      color:red;
      margin-bottom:1rem;
      text-align:center;
    }
    .register-link{
      text-align:center;
      margin-top:1rem;
      display:block;
      color:#1A3C34;
    }
    .register-link:hover{
      color:#E95C3A;
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
          <option value="sweet_cream.php">雲蓋 Sweet Cream Cold Foam</option>
          <option value="milk_tea.php">歐蕾 Milk Tea</option>
        </select>
      </li>
      <li><a href="register.php">會員專區</a></li>
      <li><a href="order_status">訂單狀態</a></li>
    </ul>
  </nav>

  <section class="hero">
    <h2>日常的一杯，值得被溫柔對待</h2>
    <p>Find your moment of calm in every cup.</p>
  </section>

  <h2>會員登入</h2>
  <div class="form-wrapper">
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
      <label>帳號：</label>
      <input type="text" name="username" required>
      <label>密碼：</label>
      <input type="password" name="password" required>
      <input type="submit" value="登入">
    </form>
    <a class="register-link" href="register.php">還沒有帳號？點我註冊</a>
  </div>
</body>
</html>
