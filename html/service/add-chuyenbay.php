<?php
require_once(__DIR__ . '/../../connect/Database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the departure and arrival cities from POST data
    $departureCity = $_POST['diemdi'];
    $arrivalCity = $_POST['diemden'];

    // Create a mapping of city names to their corresponding IDs
    $cityToIdMapping = [
        'Hà Nội' => '1',
        'TP.Hồ Chí Minh' => '2',
        'Đà Nẵng' => '3',
        'Hải Phòng' => '4',
        'Nha Trang' => '5',
        'Vũng Tàu' => '6',
        'Quy Nhơn' => '7',
        'Cần Thơ' => '8',
        'Huế' => '9',
        'Bắc Giang' => '10',
        // Add the rest of the cities here...
    ];

    // Assign departureAddressID and arrivalAddressID based on the city names
    $departureAddressID = $cityToIdMapping[$departureCity];
    $arrivalAddressID = $cityToIdMapping[$arrivalCity];

    // Assign seatClassId based on seat_class_id
    $seat_class_id = $_POST['ticketType'];// Loại ghế
    if ($seat_class_id == 'Business') {
        $seatClassId = '1';// Loại ghế Business
    } elseif ($seat_class_id == 'SkyBoss') {
        $seatClassId = '2';// Loại ghế SkyBoss
    } elseif ($seat_class_id == 'Veluxe') {
        $seatClassId = '3';// Loại ghế Veluxe
    } else {
        $seatClassId = '4';// Loại ghế Economy
    }

    $flightId = $_POST['flightId'];// Mã chuyến bay
    $fullName = $_POST['fullName'];// Họ tên
    $phoneNumber = $_POST['phoneNumber'];// Số điện thoại
    $email = $_POST['email'];// Email
    $bookingDate = $_POST['bookingDate'];// Ngày đặt
    $totalPrice = $_POST['totalPrice'];// Tổng tiền
    $Time_bay = $_POST['Time_bay'];
    $ngaydi = $_POST['ngaydi'];// Ngày đi
    $ngayve = $_POST['ngayve'];// Ngày về
    $soluong = $_POST['soluong'];// Số lượng
    $hanhtrinh = $_POST['hanhtrinh'];// Hành trình
    $soGhe = $_POST['soGhe'];// Số ghế
    $availableSeats = '45';// Số ghế trống
    $totalSeats = '50';// Tổng số ghế
    list($startTime, $endTime) = explode('-', $_POST['Time_bay']);

    $startTimeObj = DateTime::createFromFormat('H:i', $startTime);
    $endTimeObj = DateTime::createFromFormat('H:i', $endTime);
    $flightDuration = $startTimeObj->diff($endTimeObj);
    $flightTime = $flightDuration->format('%h hours %i minutes');

    $departureTime = $_POST['ngaydi'] . ' ' . $startTime;
    $arrivalTime = $_POST['ngaydi'] . ' ' . $endTime;

    $db = Database::Connect();
    // Thực hiện truy vấn SQL INSERT để thêm dữ liệu vào bảng flight
    $sql = "INSERT INTO Flight (id, arrivalAddressID, flightTime, departureTime, arrivalTime, availableSeats, totalSeats, departureAddressID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$flightId, $arrivalAddressID, $flightTime, $departureTime, $arrivalTime, $availableSeats, $totalSeats, $departureAddressID]);

    // Insert into customer table
    $sql = "INSERT INTO Customer (fullName, phone, email) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$fullName, $phoneNumber, $email]);

    $customerId = $db->lastInsertId();

    // Insert into booking table
    $sql = "INSERT INTO Booking (customer_id, flight_id, bookingDate, seatNumber, roundTrip, seatClassId) VALUES (?, ?, ?, ?, ?,?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$customerId, $flightId, $bookingDate, $soGhe, $hanhtrinh, $seatClassId]);

    $bookingId = $db->lastInsertId();

    // Insert into invoice table
    $sql = "INSERT INTO Invoice (booking_id, totalAmount, departureTime, arrivalTime, paymentStatus) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$bookingId, $totalPrice, $ngaydi, $ngayve, 'Đã thanh toán']);

    header('Location: ../user/index.php?message=Đặt vé thành công');
    exit();
}
?>