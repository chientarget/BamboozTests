<?php
require_once(__DIR__ . '/../../connect/Database.php');

$flightNumber = $_GET['flightNumber'];

$pdo = Database::Connect();
$stmt = $pdo->prepare('SELECT Flight.*, Booking.*, Customer.*, Address.*, SeatClass.*, seatNumber, amount FROM Flight
LEFT JOIN Booking ON Flight.id = Booking.flight_id
LEFT JOIN Customer ON Booking.customer_id = Customer.id
LEFT JOIN Address ON Flight.arrivalAddressID = Address.id OR Flight.departureAddressID = Address.id
LEFT JOIN SeatClass ON Booking.SeatClassId = SeatClass.id
WHERE Flight.id = ?');
$stmt->execute([$flightNumber]);
$flight = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($flight);
?>