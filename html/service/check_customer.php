<?php
// Import các class và kết nối database
require_once "../../connect/Database.php";
require_once "../../model/entity/Customer.php";

// Kiểm tra nếu yêu cầu là Ajax và có tham số customerId được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["customerId"])) {
    // Lấy customerId từ yêu cầu Ajax
    $customerId = $_GET["customerId"];

    // Kiểm tra xem mã khách hàng có tồn tại trong cơ sở dữ liệu không
    $customer = Customer::getCustomerById($customerId)->fetch(PDO::FETCH_ASSOC);
    
    // Trả về kết quả dưới dạng JSON
    if ($customer) {
        echo json_encode(array("exists" => true));
    } else {
        echo json_encode(array("exists" => false));
    }
}
?>
