<?php
    // check if value was posted
    if($_POST){
    
        ob_start();
        // include database and object file
        include_once '../admin/flight.php';
    
        // get database connection
        $database = new Database();
        $db = $database->Connect();
    
        // prepare product object
        $flight = new Flight($db);
        
        // set product id to be deleted
        $flight->id = $_POST['flight_id'];
        
        echo "Flight ID received: " . $flight->id;

        // Call the delete method and store the returned value
        $result = $flight->delete($flight->id);

        if ($result === true) {
            ob_end_clean();
            echo "Đã xóa chuyến bay.";
            exit();
        } elseif ($result === false) {
            ob_end_clean();
            echo "Không thể xóa chuyến bay.";
            exit();
        } else {
            ob_end_clean();
            echo "Đã xảy ra lỗi: " . $result;
            exit();
        }
    }
?>