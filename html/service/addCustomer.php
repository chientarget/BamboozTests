<?php

require_once(__DIR__ . '/../../connect/Database.php');
if (class_exists('Database')) {
    echo '<br>Import lớp Database thành công!';
} else {
    echo '<br>Import lớp Database không thành công!  ';
}

require_once(__DIR__ . '/../../model/entity/Customer.php');
if (class_exists('Customer')) {
    echo '<br>Import lớp Customer thành công!';
} else {
    echo '<br>Import lớp Customer không thành công!';
}


// Kiểm tra xem dữ liệu từ form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Kiểm tra kết nối đến cơ sở dữ liệu
    if (!Database::testConnection()) {
        echo "Không thể kết nối đến cơ sở dữ liệu";
        exit();
    }
    // Kiểm tra và lấy giá trị từ form
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
    $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
    $CMND = isset($_POST["CMND"]) ? $_POST["CMND"] : "";
    $address = isset($_POST["address"]) ? $_POST["address"] : "";

    // Kiểm tra xem có bất kỳ giá trị bị thiếu không

    try {
        $db = Database::Connect();

        $customer = new Customer($db);
        $customer->setFullName($lastName . ' ' . $firstName);
        $customer->setAddress($address);
        $customer->setPhone($phone);
        $customer->setCMND($CMND);
        $customer->setVisaCreated("");  // Thiết lập giá trị mặc định hoặc xử lý tùy thuộc vào yêu cầu của bạn
        $customer->setUsername($username);
        $customer->setPassword($password);
        $customer->setBirthDate("00/00/0000");  // Không có thông tin về ngày sinh trong yêu cầu của bạn
        $customer->setEmail($email);

        // Thực hiện thêm khách hàng vào cơ sở dữ liệu
        // (Giả sử trong lớp Customer có một phương thức addCustomer())
        if ($customer->addCustomer()) {
            session_start();
            $_SESSION['timeout'] = time() + 15 * 60;
            $_SESSION['user'] = $username;
            session_start();

            $_SESSION['just_registered'] = true;
            header("Location: ../user/index.php");
            exit();
        } else {
            echo "Lỗi khi thêm khách hàng.";
        }
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }

} else {
    // Redirect hoặc xử lý khác nếu không phải là phương thức POST
    echo "Invalid Request";
}
?>
