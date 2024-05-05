<?php
include("../../model/entity/Flight.php");

if ($_POST) {
    // Lấy dữ liệu từ form
    $flight_arrivalAddressId  = $_POST['arrivalAddressId'];
    $flight_departureAddressId   = $_POST['departureAddressId'];
    $flight_flightTime   = $_POST['flightTime'];
    $flight_departureTime   = $_POST['departureTime'];
    $flight_arrivalTime   = $_POST['arrivalTime'];
    $flight_availableSeats   = $_POST['availableSeats'];
    $flight_totalSeats   = $_POST['totalSeats'];


    // Lấy thêm các trường khác nếu cần

    // Kết nối đến cơ sở dữ liệu
    $database = new Database();
    $db = $database->Connect();

    // Tạo đối tượng Product
    $flight = new Flight($db);

    // Gán giá trị cho các thuộc tính của Product
    $flight->arrivalAddressId = $flight_arrivalAddressId;
    $flight->departureAddressId = $flight_departureAddressId;
    $flight->flightTime = $flight_flightTime;
    $flight->departureTime = $flight_departureTime;
    $flight->arrivalTime = $flight_arrivalTime;
    $flight->availableSeats = $flight_availableSeats;
    $flight->totalSeats = $flight_totalSeats;
    
    // Gán giá trị cho các trường khác nếu cần

    // Thêm sản phẩm
    if ($flight->create()) {
        echo"Đã thêm chuyến bay thành công";
    } else {
        echo "Không thể thêm chuyến bay";
    }
}
?>