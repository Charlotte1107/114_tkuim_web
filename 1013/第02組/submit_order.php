<?php
session_start();

// 儲存 checkout 表單的資料
$_SESSION['pickup_method'] = $_POST['pickup_method'] ?? '';
$_SESSION['address'] = $_POST['address'] ?? '';
$_SESSION['phone'] = $_POST['phone'] ?? '';
$_SESSION['payment_method'] = $_POST['payment_method'] ?? '';
$_SESSION['online_method'] = $_POST['online_method'] ?? '';
$_SESSION['need_invoice'] = $_POST['need_invoice'] ?? '';
$_SESSION['invoice_number'] = $_POST['invoice_number'] ?? '';

// 例如：如果是外送，但地址沒填，就回到 checkout.php
if ($_SESSION['pickup_method'] === '外送' && empty($_SESSION['address'])) {
  header("Location: checkout.php?error=missing_address");
  exit();
}