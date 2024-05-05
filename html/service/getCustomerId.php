<?php
require_once(__DIR__ . '/../connect/Database.php');
require_once(__DIR__ . '/../model/entity/Customer.php');

session_start();

// Lấy username từ session
$username = $_SESSION['user'];

// Kết nối đến cơ sở dữ liệu
$db = Database::Connect();
$customer = new Customer($db);
$customer->setUsername($username);

// Lấy customer_id
$customer_id = $customer->getIdFromUsername();

// Trả về customer_id
echo $customer_id;
?>