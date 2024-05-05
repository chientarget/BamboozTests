

<?php
    ob_start();

    // check if value was posted
    if($_POST){
    
        // include database and object file
        include_once '../../connect/Database.php';
        include_once '../admin/customer.php';
    
        // get database connection
        $database = new Database();
        $db = $database->Connect();
    
        // prepare customer object
        $customer = new Customer($db);
        
        // set customer id to be deleted
        $customer->id = $_POST['customer_id'];

        // delete the customer
        if ($customer->delete($customer->id) === true) {
            ob_end_clean();
            echo "Đã xóa khách hàng.";
            exit();
        } elseif ($customer->delete($customer->id) === false) {
            ob_end_clean();
            echo "Khách hàng đang có chuyến bay.";
            exit();
        } else {
            ob_end_clean();
            echo "Lỗi khi xóa khách hàng: " . $customer->delete($customer->id);
            exit();
        }
    }
?>