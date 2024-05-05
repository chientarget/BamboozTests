<?php
include("../../model/entity/Customer.php");

if ($_POST) {

    // Lấy dữ liệu từ form
    $customer_fullName = $_POST['fullName'];
    $customer_birth_date = $_POST['birth_date'];
    $customer_password = $_POST['password'];
    $customer_username = $_POST['username'];
    $customer_phone = $_POST['phone'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];
    $customer_CMND = $_POST['CMND'];
    $customer_visaCreated = ($_POST['visaCreated'] === 'true');

    $database = new Database();
    $db = $database->Connect();

    // Tạo đối tượng Customer
    $customer = new Customer($db);

    // Gán giá trị cho các thuộc tính của Customer
    $customer->fullName = $customer_fullName;
    $customer->username = $customer_username;
    $customer->password = $customer_password;
    $customer->birthDate = $customer_birth_date;
    $customer->phone = $customer_phone;
    $customer->email = $customer_email;
    $customer->address = $customer_address;
    $customer->CMND = $customer_CMND;
    $customer->visaCreated = $customer_visaCreated;

    // Kiểm tra xem dữ liệu đã tồn tại chưa
    if ($customer->checkUsernameExistence()) {
        echo "Username đã tồn tại. Vui lòng sửa lại thông tin.";
    }elseif(!$customer->isValidFullName()) {
        echo "Full name không được chứa số hoăc ký tự đặc biệt";
    }elseif(!$customer->isValidPassword()) {
        echo "Password cần chứa ít nhất 1 ký tự viết hoa  và một ký tự đặc biệt";
    }
    elseif(!$customer->isValidInput($customer->username, 'username') || !$customer->isValidInput($customer->fullName, 'fullName')) {
        echo "Full name và Username không được chứa ký tự đặc biệt";
    }elseif(!$customer->isValidPhone() && !$customer->isValidID()) {
        echo "Số điện thoại và  CMND chỉ được chứa số";
    }
    elseif(!$customer->isValidPhone()) {
        echo "Số điện thoại chỉ được chứa số";
    }elseif(!$customer->isValidID()) {
        echo "CMND chỉ được chứa số";
    }
     elseif ($customer->checkPhoneExistence()) {
        echo "Số điện thoại đã tồn tại. Vui lòng sửa lại thông tin.";
    } elseif ($customer->checkEmailExistence()) {
        echo "Email đã tồn tại. Vui lòng sửa lại thông tin.";
    } elseif ($customer->checkCMNDExistence()) {
        echo "CMND đã tồn tại. Vui lòng sửa lại thông tin.";
    } else {
        // Thêm khách hàng mới
        if ($customer->addCustomer()) {
            echo "Khách hàng đã được tạo.";
        } else {
            echo "Không thể tạo khách hàng.";
        }
    }
}
?>