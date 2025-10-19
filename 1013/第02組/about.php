
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>關於我們</title>
<style>
body {
  font-family: "Noto Sans TC", sans-serif;
  background-color: #ffffff;
  color: #333;/*字深灰色*/
  padding: 0;/*去掉內邊距*/
  margin: 0;/*去掉外邊距，避免瀏覽器預設的空白*/
}
/*.類別名稱 {
    屬性: 值;
}
*/
.about-section {
  padding: 2rem;/*兩側留白，不然太擠*/
}

.top {
  display: flex;/*橫向排版*/
  justify-content: space-between;/*左右兩邊推開，中間留空*/
  border-bottom: 1px solid #eee;/*淡灰色的細線*/
  padding: 1rem 2rem;/*上下 左右留白*/
}

.logo {
  font-size: 20px;
  color: #1A3C34;
}

.nav-list {
  list-style: none;/*去掉 <ul> 預設的小黑點*/
  display: flex;/*把清單橫向排列*/
  gap: 1.5rem;
  align-items: center;/*垂直方向置中*/
}
/*超連結的樣式*/
.nav-list a {
  text-decoration: none;/*去掉超連結的底線*/
  color: #333;
}

/*滑鼠移上去的效果*/
.nav-list a:hover {
  color: #db995a;
}

/*下拉選單樣式*/
.nav-list select {
  padding: 4px 8px;
  font-size: 16px;
}

h2 {
  font-size: 24px;
  color: #1A3C34; 
}

h3{
  font-size:20px;
  color:#607466;/*灰綠色*/
  border-left:5px solid #db995a;/* 左邊有一條橘棕色粗線*/
  padding-left:0.5rem;/* 文字與左邊粗線的間距 */
  margin-top:2rem;/* 與上方區塊的間距 */
}

table{
  width:100%;/*表格寬度佔滿*/
  border-collapse:collapse;/*不要雙線*/
  margin-top:1rem;/* 表格上方留一點空間 */
}

th,td {
  border:1px solid #ccc;/* 每格都有灰色邊框 */
  padding:0.8rem;/* 內部留白，文字不會太擠 */
  text-align:left;
}

/*表格標題欄*/
th {
  background-color: #f6f6f6;
  color: #1A3C34;
}

.block {
  border: 1px solid #ccc;/*外框灰色細邊線 */
  padding: 1rem;
  margin-top: 1rem;
  border-left: 5px solid #607466; /* 左邊有一條粗框線*/
}

.sitemap-list {
  list-style: none;/* 移除前面的圓點符號 */
  padding-left: 0;
  font-size: 16px;
  line-height: 1.8;
}

.sitemap-list li {
  margin-left: 0;/* 不縮排 */
}

.sitemap-list li.child {
  margin-left: 1rem;
}

.sitemap-list li.grandchild {
  margin-left: 2rem;
  color: #555;
}

.sitemap-list a {
  text-decoration: none;/* 移除底線 */
  color: #1A3C34;
}

.sitemap-list a:hover {
  color: #db995a;
}
.user-info {
  position: absolute;/*不亂改變位置*/
  right: 24px;
  top: 18px;
  font-size: 16px;
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
  <div class="top">
    <h1 class="logo"><br><br>TEA ESSENCE｜茶感日常</h1>
    <ul class="nav-list">
      <li><br><br><a href="index.php">首頁</a></li>
      <li><br><br><a href="checkout.php">購物車</a></li>
      <li>
        <label for="drink-category"><br><br>飲品總覽</label>
        <select name="drink-category" id="drink-category" onchange="location.href=this.value">
          <option selected disabled>飲品總覽</option>
          <option value="tea.php">單品茶 Classic</option>
          <option value="mix_tea.php">調茶 Mix Tea</option>
          <option value="sweet_cream.php">雲蓋 Sweet Cream Cold Foam</option>
          <option value="milk_tea.php">歐蕾 Milk Tea</option>
        </select>
      </li>
      <li><br><br><a href="member.php">會員專區</a></li>
      <li><br><br><a href="order_status.php">訂單狀態</a></li>
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
  </div>

  <div class="about-section">
    <h2>關於我們</h2>

    <!-- 組員分工-->
    <div class="team">
      <h3>組員與分工</h3>
      <table>
        <tr>
          <th>組員姓名</th>
          <th>負責內容</th>
        </tr>
        <tr>
          <td>利蓁琳 412630096</td>
          <td>主題架構發想、首頁製作優化、關於我們製作優化、訂單狀態、飲品總攬、會員登入及註冊、整合網頁、書面報告</td>
        </tr>
        <tr>
          <td>張靜怡 412630666</td>
          <td>主題架構發想、購物車</td>
        </tr>
        <tr>
          <td>陳冠華 412630427</td>
          <td>主題架構發想、訂單狀態、書面報告</td>
        </tr>
        <tr>
          <td>林佳萱 411000796</td>
          <td>首頁</td>
        </tr>
        <tr>
          <td>廖宇宸 411000333</td>
          <td>主題發想、會員專區</td>
        </tr>
        <tr>
          <td>吳彥霆 412000795</td>
          <td>關於我們、書面報告</td>
        </tr> 
      </table>
    </div>

    <!-- 書面報告區塊 -->
    <div class="reflection">
      <h3>書面報告</h3>
      <div class="block">這次的期中報告我們這組的主題是飲料訂購網站，整體風格文青，簡約為主，色調主要是深綠和橘色做點綴，主色調為白色，我們的網站內容總共分為七大項：<br>
      <p>1.首頁：一開始映入眼簾的是我們飲料店的slogan，以及我們飲料店的飲品照片，吸引顧客的眼球，而在左上角則是我們的飲料店名稱logo，我們的首頁不只是一般的網站介紹而已，我們還加了投票系統讓使用的客人都可以為自己喜愛的飲料投上一票，增加互動性。</p>
      <p>2.關於我們：在關於我們裡面有我們這組的分工表、網站地圖、心得以及書面報告。</p>
      <p>3.飲品總覽：飲品總覽我們總共分為四小項，分別有單品茶、調茶、雲蓋跟歐蕾這四項，可以直接在這些頁面直接把飲品加入購物車裡，也有清空購物車和刪除個別飲品的按鈕，方便顧客修改。結帳的部分可以直接前往購物車分頁或是在飲品分頁中，直接按「顯示購物車內容」，下方就有前往結帳的按鈕。</p>
      <p>4.購物車：可以查看目前加進購物車裡的所有飲品項目，也可以在這裡選擇取貨方式及付款方式。</p>
      <p>5.訂單狀態：從購物車送出訂單後，並顯示目前訂單的內容、當前的會員等級、預計的完成時間並且倒數，如果是外送的話會顯示填入的地址。</p>
      <p>6.會員登入及註冊:顧客登入及註冊會員的地方。
      <p>7.會員專區：在會員專區裡會累積目前總共的消費金額，以及幾月幾號幾點訂購哪些飲品，並分為一般、銀牌、金牌會員，並在下一筆訂單開始會有折扣。</p>
      </div>
    </div>
    <!-- 心得區塊 -->
    <div class="reflection">
      <h3>心得分享</h3>
      <div class="block">利蓁琳:<br>相比大二上所做的所有網頁，這次得作業非常有難度，也可能是因為我們這組想讓我們最後呈現的結果更滿意，我們運用到不少課堂所沒有教的東西，所以因此查了不少資料，並且在自己所沒看過的程式碼旁，加了很多註解，希望自己在查找資料的同時，也學會如何運用課堂所沒教的東西，這次的期中作業，對我來說真的充滿挑戰。<br><br><br>張靜怡:<br>這次網頁設計的作業讓我體驗到了一個網頁從0開始到可以用的過程，我們一起完成了線上點飲料的系統。跟平常做作業不一樣，要實際運用學到的知識和技巧，是很特別的一次經驗。除了要做好自己的部分，還要可以跟組員合作，也是很不一樣的經歷，以往的作業都只要自己完成就好，實際跟同學一起完成才發現過程中會出現很多問題，不是想像中那麼簡單就能完成，有很多地方要互相配合，也有很多地方要替組員著想等，讓我知道合作的重要性。<br><br><br>陳冠華:<br>這次期中報告我們做的是飲料訂購網站，因為是團體報告，所以期中當然不免會有一些意見不同，但是我們用投票的方式，這讓我學到了團隊溝通的重要性，再來是這次的期中報告，因為我們想呈現的東西有些比較困難，所以我們有上網查了一些方法，讓我們可以更順利的完成我們的作品，也從這次報告中學到很多關於程式的不同用法。<br><br><br>林佳萱:<br>這次製作手搖飲品商城的網站，讓我實際操作到了使用PHP的整合應用，從網頁排版、超連結設計到內容插入，每一步都充滿挑戰。透過實作，我不只加深了對程式語言的理解，也提升了解決問題的能力，收穫很多。也從與組員的合作中獲得很多成長，我們在分工、設計風格、功能規劃上多次討論，遇到問題時互相協助解決，讓我體會到團隊溝通的重要性。最終看到網站順利完成，真的非常有成就感！<br><br><br>廖宇宸:<br>這次的程式設計報告讓我收穫很多，尤其是在前端開發的部分，學會了怎麼運用 PHP 和 CSS 去實作網頁功能與設計介面。原本對這些語言不是很熟悉，但在實作的過程中慢慢變得更有信心。這次也是一次很不錯的團隊合作經驗，大家都願意溝通、互相幫忙，把各自負責的部分完成得很好。從中我體會到，好的分工與合作真的能讓整個專案變得更順利，也讓過程更有成就感。<br><br><br>吳彥霆:<br>在這次專案中，我們深入學習了PHP與
      HTML的整合應用，並在實踐中提升了團隊合作能力。透過共同努力，我們成功開發出一個功能完善的飲料訂購網站，涵蓋首頁、關於我們、購物車、飲品總覽、會員專區及訂單狀態等多個模組。在開發過程中，我們遇到了如前後端資料傳遞等挑戰，但透過團隊成員間的溝通與協作，最終順利解決這次經驗讓我們深刻體會到技術整合與團隊合作的重要性，並為未來的專案開發奠定了堅實的基礎。</div>
    </div>

    <!-- 網站地圖區塊 -->
    <div class="sitemap">
      <h3>網站地圖</h3>
      <div class="block">
        <ul class="sitemap-list">
          <li><a href="index.php"> 首頁</a></li>
          <li class="child"><a href="about.php"> 關於我們</a></li>
          <li class="child"><a href="checkout.php"> 購物車</a></li>
          <li class="child"><a href="tea.php"> 飲品總覽</a></li>
          <li class="grandchild"><a href="tea.php">・單品茶</a></li>
          <li class="grandchild"><a href="mix_tea.php">・調茶</a></li>
          <li class="grandchild"><a href="sweet_cream.php">・雲蓋</a></li>
          <li class="grandchild"><a href="milk_tea.php">・歐蕾</a></li>
          <li class="child"><a href="member.php"> 會員專區</a></li>
          <li class="child"><a href="order_status.php"> 訂單狀態</a></li>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>
