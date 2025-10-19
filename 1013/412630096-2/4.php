<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>波妞角色遊戲區</title>
	<style>
		body {
			font-family: 'Arial', sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f0f8ff;
			color: #333;
		}
		nav {
			background-color: #4682B4;
			padding: 10px;
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
			margin-top: 10px;
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
			padding: 10px 20px;
			border-radius: 5px;
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
			width: auto;
		}
	</style>
	<script>
		function limitCheckboxSelection(groupName, maxSelection) {
			const checkboxes = document.querySelectorAll(`input[name='${groupName}[]']`);
			const checkedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
			if (checkedCount > maxSelection) {
				alert(`最多只能選擇 ${maxSelection} 個選項！`);
				event.target.checked = false;
			}
		}
	</script>
</head>
<body>
	<nav>
		<a href="index.php">首頁</a>
		<a href="5.php">關於</a>
		<a href="1.html">註冊會員</a>
		<a href="2.html">宗介角色介紹</a>
		<a href="3.php">藤本角色介紹</a>
	</nav>
	<div class="container">
		<h2>波妞角色介紹</h2>
		<p>本電影主角，藤本和珂蘭曼瑪蓮的女兒。原本名布倫希爾蒂。有著人面魚身的外貌。
		偷偷離開家時不小心讓自己的頭卡在玻璃罐裡，而這時救了她的就是宗介，宗介把她命名為「波妞」。
		有著類似人類的臉而被辰奶奶稱為「人面魚」，因為舔了宗介的血液而成為半人魚。
		對於不喜歡的人物會對著對方用嘴噴水，喜歡的食物是火腿，喜歡的人是宗介，最後為了他而捨棄魔法，變成人類。</p>
		<form action="" method="post" >
			<h2>更多波妞相關介紹</h2>
			<a href="https://www.google.com/search?q=波妞">進一步查詢波妞的資料</a>
			<h2>遊戲區</h2>
			<p>請輸入姓名:<input type="text" name="name" required></p>
			<b>作答區:</b><br>
			<ol>
				<li>
					<b>波妞最喜歡的食物是甚麼?</b><br>
					<input type="radio" name="num1" value="火腿">火腿<br>
					<input type="radio" name="num1" value="草莓蛋糕">草莓蛋糕<br>
					<input type="radio" name="num1" value="義大利麵">義大利麵<br>
				</li>
				<li>
					<b>波妞的爸爸叫甚麼名字?</b><br>
					<input type="radio" name="num2" value="宗介">宗介<br>
					<input type="radio" name="num2" value="藤本">藤本<br>
					<input type="radio" name="num2" value="理莎">理莎<br>
				</li>
				<li>
					<b>波妞幾歲?</b><br>
					<input type="number" name="num3" placeholder="輸入" min="0" max="15"><br>
				</li>
				<li>
					<b>下列選項哪些正確(複選題)?</b><br>
					<input type="checkbox" name="num4[]" value="波妞的母親叫理莎" onclick="limitCheckboxSelection('num4', 2)">波妞的母親叫理莎<br>
					<input type="checkbox" name="num4[]" value="波妞最喜歡的人是宗介" onclick="limitCheckboxSelection('num4', 2)">波妞最喜歡的人是宗介<br>
					<input type="checkbox" name="num4[]" value="波妞偷偷離開家時，不小心讓自己的腳卡在玻璃罐裡" onclick="limitCheckboxSelection('num4', 2)">波妞偷偷離開家時，不小心讓自己的腳卡在玻璃罐裡<br>
					<input type="checkbox" name="num4[]" value="波妞因為舔了宗介的血液而成為半人魚" onclick="limitCheckboxSelection('num4', 2)">波妞因為舔了宗介的血液而成為半人魚<br>
				</li>
				<li>
					<b>下列選項哪些不正確(複選題)?</b><br>
					<input type="checkbox" name="num5[]" value="波妞有著類似人類的臉而被辰奶奶稱為「人面獸」" onclick="limitCheckboxSelection('num5', 2)">波妞有著類似人類的臉而被辰奶奶稱為「人面獸」<br>
					<input type="checkbox" name="num5[]" value="波妞的頭髮是紅色" onclick="limitCheckboxSelection('num5', 2)">波妞的頭髮是紅色<br>
					<input type="checkbox" name="num5[]" value="波妞最後為了宗介而捨棄魔法，變成人類" onclick="limitCheckboxSelection('num5', 2)">波妞最後為了宗介而捨棄魔法，變成人類<br>
					<input type="checkbox" name="num5[]" value="波妞有著人面魚身的外貌" onclick="limitCheckboxSelection('num5', 2)">波妞有著人面魚身的外貌<br>
				</li>
				<li>
					<b>波妞的名字是誰取的?</b><br>
					<input type="text" name="num6"><br>
				</li>
				<li>
					<b>波妞是大海中的一隻_____</b><br>
					<select name="num7">
						<option value="海豚">海豚</option>
						<option value="章魚">章魚</option>
						<option value="金魚">金魚</option>
					</select><br>
				</li>
				<li>
					<b>波妞是_____和_____的女兒</b><br>
					<select name="num8[]" multiple onclick="limitCheckboxSelection('num8', 2)">
						<option value="藤本">藤本</option>
						<option value="芳江婆婆">芳江婆婆</option>
						<option value="曼瑪璉">曼瑪璉</option>
						<option value="理莎">理莎</option>
					</select><br>
				</li>
				<li>
					<b>波妞是乘著____來到外面世界去的?</b><br>
					<input type="text" name="num9"><br>
				</li>
				<li>
					<b>波妞想變成人類嗎?</b><br>
					<input type="radio" name="num10" value="想">想<br>
					<input type="radio" name="num10" value="不想">不想<br>
				</li>
			</ol>
			<p>
				<input type="submit" name="sub" value="提交">
				<input type="reset" value="重置">
			</p>
		</form>
	</div>
<?php
if (isset($_POST['sub'])) {
    $name = $_POST['name'];

    $answers = [
        'num1' => '火腿',
        'num2' => '藤本',
        'num3' => '5',
        'num4' => ['波妞最喜歡的人是宗介', '波妞因為舔了宗介的血液而成為半人魚'],
        'num5' => ['波妞有著類似人類的臉而被辰奶奶稱為「人面獸」', '波妞的頭髮是紅色'],
        'num6' => '宗介',
        'num7' => '金魚',
        'num8' => ['藤本', '曼瑪璉'],
        'num9' => '水母',
        'num10' => '想'
    ];

    $userAnswers = [
        'num1' => $_POST['num1'] ?? '',
        'num2' => $_POST['num2'] ?? '',
        'num3' => $_POST['num3'] ?? '',
        'num4' => $_POST['num4'] ?? [],
        'num5' => $_POST['num5'] ?? [],
        'num6' => $_POST['num6'] ?? '',
        'num7' => $_POST['num7'] ?? '',
        'num8' => $_POST['num8'] ?? [],
        'num9' => $_POST['num9'] ?? '',
        'num10' => $_POST['num10'] ?? ''
    ];

    $score = 0;
    $results = [];
    foreach ($answers as $key => $correctAnswer) {
        if (is_array($correctAnswer)) {
            sort($correctAnswer);
            sort($userAnswers[$key]);
            if ($correctAnswer === $userAnswers[$key]) {
                $score += 10;
                $results[$key] = '✔';
            } else {
                $results[$key] = '✘';
            }
        } else {
            if ($correctAnswer == $userAnswers[$key]) {
                $score += 10;
                $results[$key] = '✔';
            } else {
                $results[$key] = '✘';
            }
        }
    }

    echo "<div class='container'>";
    echo "<h2>$name 的分數是: $score</h2>";
    echo "<table>";
    echo "<tr><th>題號</th><th>你的答案</th><th>正確答案</th><th>結果</th></tr>";
    $i = 1;
    foreach ($answers as $key => $correctAnswer) {
        $userAnswer = is_array($userAnswers[$key]) ? implode(', ', $userAnswers[$key]) : $userAnswers[$key];
        $correct = is_array($correctAnswer) ? implode(', ', $correctAnswer) : $correctAnswer;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$userAnswer</td>";
        echo "<td>$correct</td>";
        echo "<td>{$results[$key]}</td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";

    if ($score == 100) {
        echo "<h3>恭喜!!!太厲害了</h3>";
    } elseif ($score >= 60) {
        echo "<h3>再接再厲</h3>";
    } else {
        echo "<h3>請多加油</h3>";
    }

    echo '<button onclick="history.back()">返回重新作答</button>';
    echo "</div>";
}
?>
</body>
</html>
