<?php
include_once '../../connect/Database.php'; 

// Kết nối cơ sở dữ liệu
$conn = Database::Connect();

// Lấy giá trị id từ yêu cầu Ajax
$addressId = $_POST['addressId'];

// Thực hiện truy vấn SQL để lấy airfield dựa trên id
$queryAirfield = "SELECT airfield FROM Address WHERE id = :addressId";
$stmtAirfield = $conn->prepare($queryAirfield);
$stmtAirfield->bindParam(':addressId', $addressId, PDO::PARAM_INT);
$stmtAirfield->execute();

$airfieldInfo = $stmtAirfield->fetch(PDO::FETCH_ASSOC);

// Sử dụng echo để trả về dữ liệu trong response, không sử dụng return
echo $airfieldInfo ? $airfieldInfo['airfield'] : '';
?>
