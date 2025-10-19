<?php
//$_SESSION 是伺服器幫你記住某個使用者的資料，即使他跳轉到別頁也還記得
session_start();//開啟session功能,這樣才能用$_SESSION['user']記住誰登入

//檢查是不是用POST方法送出的表單
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $confirm=$_POST['confirm'];
  $name=$_POST['name'];
  $gmail=$_POST['gmail'];
  $phone=$_POST['phone'];

//檢查是否已經有users.json這個檔案，有的話就讀取並解碼成$users陣列，沒有的話就設成空的陣列
  $users=file_exists("users.json") ? json_decode(file_get_contents("users.json"), true) : [];

  if(isset($users[$username])) {
    $error = "帳號已經被註冊過了！";
  }elseif($password !== $confirm) {
    $error="兩次輸入的密碼不一致！";
  }elseif(!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {//檢查是不是合法email格式
    $error="Gmail 格式不正確！";
  }else{
    $users[$username] = [
      "password"=>$password,
      "name"=>$name,
      "gmail"=>$gmail,
      "phone"=>$phone,
      "total_spent"=>0
    ];
    //把$users陣列轉回JSON字串，再存回users.json檔案，這樣資料就保存下來了，JSON_UNESCAPED_UNICODE 是讓中文也能正常顯示
    file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $_SESSION['user']=$username;//註冊完自動登入，記住使用者帳號
    header("Location:index.php"); //導回首頁，並終止程式，不讓它繼續執行
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>會員註冊</title>
  <style>
    body{
      font-family: "Noto Sans TC", sans-serif;
      background-color: #ffffff;
      color: #333;
      margin: 0;
      padding: 0;
    }
    nav{
      background-color: #ffffff;
      padding: 16px;
      border-bottom: 1px solid #eee;
      position: relative;
    }
    nav h1{
      font-size: 20px;
      font-weight: bold;
      margin: 0 0 8px;
      color: #1A3C34;
    }
    nav ul{
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      gap: 16px;
      font-size: 16px;
    }
    nav a, nav button{
      background: none;
      border: none;
      color: #333;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
      position: relative;
    }
    nav a:hover, nav button:hover{
      color: #db995a;
    }
    .hero{
      background-color: #1A3C34;
      text-align: center;
      padding: 40px 16px;
    }
    .hero h2{
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
      padding-left: 0.5rem;
      text-align: center;
    }
    .form-wrapper{
      max-width: 400px;
      margin: 2rem auto;
      background-color: #fdfdfd;
      border: 1px solid #ccc;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    input[type="text"],
    input[type="password"],
    input[type="email"]{
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      font-size: 1rem;
    }
    input[type="submit"]{
      background-color: #1A3C34;
      color: #fff;
      padding: 0.5rem 1.5rem;
      border: none;
      font-size: 1rem;
      cursor: pointer;
      width: 100%;
    }
    input[type="submit"]:hover {
      background-color: #15432c;
    }
    .error{
      color: red;
      margin-bottom: 1rem;
      text-align: center;
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
      <li><a href="order_status">訂單狀態<br><br></a></li>
    </ul>
  </nav>
    <section class="hero">
    <h2>日常的一杯，值得被溫柔對待</h2>
    <p>Find your moment of calm in every cup.</p>
  </section>
  <h2>會員註冊</h2>
  <div class="form-wrapper">
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
      帳號：<input type="text" name="username" required>
      密碼：<input type="password" name="password" required>
      確認密碼：<input type="password" name="confirm" required>
      姓名：<input type="text" name="name">
      Gmail：<input type="email" name="gmail" required>
      手機號碼：<input type="text" name="phone">
      <input type="submit" value="註冊">
    </form>
  </div>
</body>
</html>
