<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>藤本角色遊戲區</title>
	<style>
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
		.container {
			max-width: 800px;
			margin: 20px auto;
			padding: 20px;
			background: rgba(255, 255, 255, 0.9);
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
		h2 {
			color: #2E8B57;
			font-size: 24px;
			margin-bottom: 15px;
		}
		p {
			line-height: 1.6;
		}
		input, select, button {
			margin: 10px 0;
			padding: 8px;
			font-size: 16px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}
		button {
			background-color: #4682B4;
			color: white;
			cursor: pointer;
			border: none;
		}
		button:hover {
			background-color: #2E8B57;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 20px;
			text-align: center;
		}
		table, th, td {
			border: 1px solid #ccc;
			padding: 10px;
			font-size: 16px;
		}
		th {
			background-color: #4682B4;
			color: white;
		}
		td {
			width: 11%;
		}
	</style>
</head>
<body>
	<nav>
		<a href="index.php">首頁</a>
		<a href="5.php">關於</a>
		<a href="1.html">註冊會員</a>
		<a href="2.html">宗介介紹</a>
		<a href="4.php">波妞介紹</a>
	</nav>

	<div class="container">
		<h2>藤本角色介紹</h2>
		<p>波妞的父親。以前是人類，現在是住在海裡的魔法師。
		在海中駕駛自製的「姥鯊號」，有操縱水魚等魔物的力量及張開結界的能力。平時住在海底的珊瑚塔。
		過去曾為海底兩萬里中鸚鵡螺號的成員，因迷戀珂藍曼瑪蓮而自願捨棄人類的身份投入海中生活。
		最後與宗介握手言和，並表示以後把波妞交給他照顧。</p>

		<form action="https://www.google.com/search" method="get" target="_blank">
			<h2>更多藤本相關介紹</h2>
			<p>想更了解藤本這個角色嗎?</p>
			<input type="text" name="q" placeholder="輸入想搜尋的內容" value="波妞的爸爸藤本">
			<input type="submit" value="搜尋">
		</form>

		<form action="" method="get" >
			<h2>遊戲區</h2>
			<ul>
				<li>
					<b>請選擇運算符號並作答</b><br>
					10
					<select name="num1">
						<option value="1">+</option>
						<option value="2">-</option>
						<option value="3">x</option>
						<option value="4">/</option>
					</select>
					2 = <input type="text" name="ans1">
				</li>

				<li>
					<b>請輸入兩個整數A、B，並計算A到B的整數和</b><br>
					A:<input type="number" name="A" min="0" max="15">
					B:<input type="number" name="B" min="0" max="15"><br>
					A到B的整數和為:<input type="text" name="ans2">
				</li>

				<li>
					<b>反覆投擲骰子直到出現數字5，如果投擲次數小於等於2即可獲得九九乘法表提示</b><br>
					<button type="submit" name="game" value="dice_game">開始擲骰子</button>
				</li>
			</ul>
			<p>
				<input type="submit" name="sub" value="提交答案">
				<input type="reset" value="重置">
			</p>
		</form>
	</div>

<?php
	error_reporting(0);
	if (isset($_GET['game'])) {
		echo "<div class='container'>";
		echo "<h2>投擲骰子執行結果</h2>";
		$x = 0;
		$cnt = 0;
		while ($x != 5) {
			$x = rand(1, 6);
			$cnt++;
			echo "你擲出: $x<br>";
		}
		echo "共擲了 $cnt 次";
		if ($cnt <= 2) {
			echo "<h3>恭喜獲得提示!!!</h3>";
			echo "<table>";
			for ($i = 1; $i <= 9; $i++) {
				echo "<tr>";
				for ($j = 1; $j <= 9; $j++) {
					$k = $i * $j;
					echo "<td>$i × $j = $k</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		} else {
			echo "<h3>Sorry 無法獲得提示</h3>";
		}
		echo "</div>";
	}
	if (isset($_GET['sub'])) {
		echo "<div class='container'>";
		echo "<h2>作答結果</h2>";
		$num1 = $_GET['num1'];
		$ans1 = $_GET['ans1'];
		$correct_ans1 = 0;

		$A = $_GET['A'];
		$B = $_GET['B'];
		$ans2 = $_GET['ans2'];
		$sum = 0;

		for ($i = $A; $i <= $B; $i++) {
			$sum += $i;
		}

		switch ($num1) {
			case 1:
				$correct_ans1 = 12;
				break;
			case 2:
				$correct_ans1 = 8;
				break;
			case 3:
				$correct_ans1 = 20;
				break;
			case 4:
				$correct_ans1 = 5;
				break;
		}
		if ($ans1 == $correct_ans1) {
			echo "第一題答對啦~ 答案是: $correct_ans1<br>";
		} else {
			echo "第一題答錯啦... 正確答案是: $correct_ans1<br>";
		}

		if ($A > $B) {
			echo "第二題輸入的值A要小於B喔!";
		} else {
			if ($ans2 == $sum) {
				echo "第二題答對啦~ 答案是: $sum<br>";
			} else {
				echo "第二題答錯啦... 正確答案是: $sum<br>";
			}
		}
		echo "</div>";
	}
?>
</body>
</html>
