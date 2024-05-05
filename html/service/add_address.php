

<?php
// add_address.php
include("../../model/entity/Address.php");

if (isset($_POST['submit'])) {
    // Nhận dữ liệu từ form
    $airfield = $_POST["airfield"];
    $city = $_POST["city"];
    $country = $_POST["country"];

    // TODO: Thêm dữ liệu vào cơ sở dữ liệu (sử dụng PDO hoặc MySQLi)
    $database = new Database();
    $db = $database->Connect();

    // Tạo đối tượng Product
    $address = new Address($db);

    // Gán giá trị cho các thuộc tính của Product
    $address->airfield = $airfield;
    $address->city = $city;
    $address->country = $country;
    
    // Gán giá trị cho các trường khác nếu cần

    // Thêm sản phẩm
    if ($address->create()) {
        echo '<script>alert("Thêm địa chỉ thành công"); window.location.href = "../admin/address.php";</script>';
        exit();
    } else {
        echo '<script>alert("Không thể thêm địa chỉ");</script>';
    }
} else {
    // Xử lý khi form không được submit
    echo "Invalid request!";
}
?>