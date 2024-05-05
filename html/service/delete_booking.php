<?php
    // check if value was posted
    if($_POST){
        ob_start();
    
        // include database and object file
        include_once '../admin/booking.php';
    
        // get database connection
        $database = new Database();
        $db = $database->Connect();
    
        // prepare product object
        $booking = new Booking($db);
        
        // set product id to be deleted
        $booking->id = $_POST['booking_id'];
        
        echo "Booking ID received: " . $booking->id;

        if ($booking->delete($booking->id)) {
            ob_end_clean();
            echo "Đã xóa vé đặt.";
            exit();
        } else {
            ob_end_clean();
            echo "Không thể xóa vé đặt.";
            exit();
        }
    }
?>