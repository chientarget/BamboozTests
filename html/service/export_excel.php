<?php
require '../../../../vendor/autoload.php'; // Đường dẫn tới file autoload.php của Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include_once './../../model/entity/Customer.php';
include_once './../../model/entity/Flight.php';
include_once './../../model/entity/Booking.php';
include_once './../../model/entity/Invoice.php';

$database = new Database();
$db = $database->Connect();

$customer = new Customer($db);
$totalCustomers = $customer->countAllCustomers();

$flight = new Flight($db);
$totalFlights = $flight->countAllFlights();

$booking = new Booking($db);
$totalBookings = $booking->countAllBookings();

$invoice = new Invoice($db);
$totalRevenue = $invoice->calculateTotalRevenue();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Total Customers');
$sheet->setCellValue('B1', $totalCustomers);

$sheet->setCellValue('A2', 'Total Flights');
$sheet->setCellValue('B2', $totalFlights);

$sheet->setCellValue('A3', 'Total Bookings');
$sheet->setCellValue('B3', $totalBookings);

$sheet->setCellValue('A4', 'Total Revenue');
$sheet->setCellValue('B4', $totalRevenue);

$writer = new Xlsx($spreadsheet);
$writer->save('report.xlsx'); // Tên file Excel xuất ra
?>