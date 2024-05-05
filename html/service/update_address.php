<?php
// update_address.php
include("../../model/entity/Address.php");

if (isset($_POST['update_submit'])) {
    // Nhận dữ liệu từ Ajax
    $address_id = $_POST["address_id"];
    $airfield = $_POST["airfield"];
    $city = $_POST["city"];
    $country = $_POST["country"];

        // TODO: Thực hiện cập nhật dữ liệu trong cơ sở dữ liệu
        $database = new Database();
        $db = $database->Connect();

        $address = new Address($db);
        $address->id = $address_id;
        $address->airfield = $airfield;
        $address->city = $city;
        $address->country = $country;

        // Thực hiện cập nhật
        if ($address->update()) {
            echo $airfield;
            echo json_encode(array("message" => "Cập nhật thành công"));
            exit(); // Thêm exit để ngăn chặn mã tiếp tục chạy
        } else {
            echo json_encode(array("message" => "Không thể cập nhật địa chỉ"));
        }
} else {
    // Xử lý khi form không được submit
    echo json_encode(array("message" => "Invalid request!"));
}
?>

