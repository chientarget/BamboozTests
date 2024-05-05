<?php
// Import các class và kết nối database
require_once "../../connect/Database.php";
require_once "../../model/entity/Booking.php";

// Kiểm tra nếu dữ liệu được gửi từ biểu mẫu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $customerId = $_POST["customerId"];
    $flightId = $_POST["flightId"];
    $bookingDate = $_POST["bookingDate"];
    $seatNumber = $_POST["seatNumber"];
    $roundTrip = $_POST["roundTrip"];
    $seatClassId = $_POST["seatClassId"];
    $database = new Database();
    $db = $database->Connect();
    // Tạo một đối tượng Booking và gọi phương thức create()
    $booking = new Booking($db);
    $booking->customerId = $customerId;
    $booking->flightId = $flightId;
    $booking->bookingDate = $bookingDate;
    $booking->seatNumber = $seatNumber;
    $booking->roundTrip = $roundTrip;
    $booking->seatClassId = $seatClassId;

    // Gọi phương thức create() để tạo một bản ghi mới
    if ($booking->create()) {
        echo "Tạo bản ghi mới thành công!";
        header("Location: ../admin/booking.php");
    } else {
        echo "Có lỗi xảy ra khi tạo bản ghi mới.";
    }
}
?>