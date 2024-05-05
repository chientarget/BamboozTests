<?php
require_once(__DIR__ . '/../../connect/Database.php');
require_once(__DIR__ . '/../../model/entity/Customer.php');
require_once(__DIR__ . '/../../model/entity/Employee.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == null || $password == null) {
        $errorMessage = "Vui lòng nhập đầy đủ thông tin.";
        header("Location: ../user/index.php?message=" . urlencode($errorMessage));
        exit();
    }

    $db = Database::Connect();

    // Check if the user is a customer
    $customer = new Customer($db);
    $customer->setUsername($username);
    $customer->setPassword($password);

    if ($customer->checkLogin()) {
        session_start();
        $_SESSION['user'] = $username;
        echo 'user';
        header("Location: ../user/index.php");
        exit();
    } else {
        // Check if the user is an employee (admin)
        $employee = new Employee($db);
        $employee->setUsername($username);
        $employee->setPassword($password);

        if ($employee->checkLogin()) {
            session_start();
            $_SESSION['user'] = $username;
            header("Location: ../admin/index.php");
            echo 'admin';
            exit();
        } else {
            $errorMessage = "Mật khẩu không chính xác. Vui lòng thử lại.";
            header("Location: ../user/index.php?message=" . urlencode($errorMessage));
            exit();
        }
    }
} else {
    echo "Invalid Request";
}
?>