<?php
if (isset($_POST['user_choice'])) {
    $user_choice = $_POST['user_choice'];

    $computer_choice = rand(1, 3);

    $choices = [
        1 => ['name' => '剪刀', 'img' => 'scissors.png'],
        2 => ['name' => '石頭', 'img' => 'stone.png'],
        3 => ['name' => '布', 'img' => 'paper.png']
    ];

    if ($user_choice == $computer_choice) {
        $result = "平手！";
    } elseif (
        ($user_choice == 1 && $computer_choice == 3) || 
        ($user_choice == 2 && $computer_choice == 1) || 
        ($user_choice == 3 && $computer_choice == 2)
    ) {
        $result = "恭喜，你贏了！";
    } else {
        $result = "很可惜，你輸了！";
    }

    echo "<style>
        body { font-family: 'Arial', sans-serif; background-color: #f0f8ff; padding: 20px; text-align: center; }
        h1 { color: #2E8B57; }
        p { font-size: 16px; }
        img { margin: 10px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); }
        a { color: #4682B4; text-decoration: none; font-size: 16px; }
        a:hover { text-decoration: underline; }
    </style>";

    echo "<h1>猜拳結果</h1>";
    echo "<p>你出的是：" . $choices[$user_choice]['name'] . "</p>";
    echo "<img src='" . $choices[$user_choice]['img'] . "' alt='" . $choices[$user_choice]['name'] . "' width='100'>";
    echo "<p>宗介出的是：" . $choices[$computer_choice]['name'] . "</p>";
    echo "<img src='" . $choices[$computer_choice]['img'] . "' alt='" . $choices[$computer_choice]['name'] . "' width='100'>";
    echo "<h2>$result</h2>";
    echo '<a href="2.html">回到遊戲主頁</a>';

} elseif (isset($_POST['game']) && $_POST['game'] == 'guess_number') {
    $target = isset($_POST['target']) ? (int)$_POST['target'] : rand(1, 10);
    $guess = (int)$_POST['guess'];
    $guesses = isset($_POST['guesses']) ? explode(',', $_POST['guesses']) : [];
    $guesses[] = $guess;

    if ($guess < $target) {
        $message = "太小了！再試一次！";
    } elseif ($guess > $target) {
        $message = "太大了！再試一次！";
    } else {
        echo "<style>
            body { font-family: 'Arial', sans-serif; background-color: #f0f8ff; padding: 20px; text-align: center; }
            h1 { color: #2E8B57; }
            p { font-size: 16px; }
            a { color: #4682B4; text-decoration: none; font-size: 16px; }
            a:hover { text-decoration: underline; }
        </style>";

        echo "<h1>恭喜你猜中了！宗介心中的數字是 $target</h1>";
        echo '<a href="2.html">回到遊戲主頁</a>';
        exit(); 
    }

    echo "<style>
        body { font-family: 'Arial', sans-serif; background-color: #f0f8ff; padding: 20px; text-align: center; }
        h1 { color: #2E8B57; }
        p { font-size: 16px; }
        form { margin-top: 20px; }
        input { padding: 8px; font-size: 16px; }
        button { background-color: #4682B4; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; }
        button:hover { background-color: #2E8B57; }
        a { color: #4682B4; text-decoration: none; font-size: 16px; }
        a:hover { text-decoration: underline; }
    </style>";

    echo "<h1>猜數字遊戲</h1>";
    echo "<p>$message</p>";
    echo "<p>你已猜過的數字：" . implode(', ', $guesses) . "</p>";
    echo '<form action="2.php" method="post">';
    echo '<input type="hidden" name="target" value="' . $target . '">';
    echo '<input type="hidden" name="guesses" value="' . implode(',', $guesses) . '">';
    echo '<input type="number" name="guess" min="1" max="10" required>'; 
    echo '<button type="submit" name="game" value="guess_number">再猜一次</button>';
    echo '</form>';
    echo '<a href="2.html">回到遊戲主頁</a>';

} elseif (isset($_POST['game']) && $_POST['game'] == 'dice_game') {
    if (!isset($_POST['rule'])) {
        echo "<style>
            body { font-family: 'Arial', sans-serif; background-color: #f0f8ff; padding: 20px; text-align: center; }
            h1 { color: #2E8B57; }
            p { font-size: 16px; }
            a { color: #4682B4; text-decoration: none; font-size: 16px; }
            a:hover { text-decoration: underline; }
        </style>";

        echo "<h1>錯誤</h1>";
        echo "<p>請選擇比賽規則（比大或比小）</p>";
        echo '<a href="2.html">回到遊戲主頁</a>';
        exit();
    }

    $rule = $_POST['rule'];
    $player_roll = rand(1, 6);
    $sosuke_roll = rand(1, 6);

    if ($rule == 'high') {
        if ($player_roll > $sosuke_roll) {
            $result = "恭喜！你贏了！";
        } elseif ($player_roll < $sosuke_roll) {
            $result = "很可惜，你輸了！";
        } else {
            $result = "平手！";
        }
    } elseif ($rule == 'low') {
        if ($player_roll < $sosuke_roll) {
            $result = "恭喜！你贏了！";
        } elseif ($player_roll > $sosuke_roll) {
            $result = "很可惜，你輸了！";
        } else {
            $result = "平手！";
        }
    } else {
        $result = "未選擇正確規則，請重新開始遊戲。";
    }

    echo "<style>
        body { font-family: 'Arial', sans-serif; background-color: #f0f8ff; padding: 20px; text-align: center; }
        h1 { color: #2E8B57; }
        p { font-size: 16px; }
        a { color: #4682B4; text-decoration: none; font-size: 16px; }
        a:hover { text-decoration: underline; }
    </style>";

    echo "<h1>擲骰子遊戲結果</h1>";
    echo "<p>$result</p>";
    echo "你擲出了 $player_roll 宗介擲出了 $sosuke_roll<br>";
    echo '<a href="2.html">回到遊戲主頁</a>';
}
?>
