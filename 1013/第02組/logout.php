<?php
session_start();        // 啟用 session
session_destroy();      // 清除所有 session 資料（例如登入狀態）
header("Location: index.php");  // 登出後導回首頁
exit();                 // 確保後面不會執行
?>
