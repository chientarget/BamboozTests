<?php
session_start();
require_once '../../connect/Database.php';

// Lấy username từ session
$username = $_SESSION['user'];

// Kết nối đến cơ sở dữ liệu
$db = Database::Connect();

// Truy vấn để lấy thông tin người dùng
$stmt = $db->prepare("SELECT * FROM Customer WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h2>Thông tin người dùng</h2>
    <p>Họ tên: <?php echo $user['fullName']; ?></p>
    <p>Địa chỉ: <?php echo $user['address']; ?></p>
    <p>Số điện thoại: <?php echo $user['phone']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
</div>
<script>
    $(document).ready(function () {
        $('#pay').click(function (e) {
            e.preventDefault();
            loadContent("#content", "Dat-Ve-Thanh-Cong");
        });
    });
</script>

