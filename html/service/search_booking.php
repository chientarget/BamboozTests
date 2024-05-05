<?php
// core.php holds pagination variables
include_once '../config/core.php';
include_once("../../model/entity/Booking.php");
  
// instantiate database and product object
$database = new Database();
$db = $database->Connect();
  
$booking = new Booking($db);
  
// get search term
$search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
  
$page_title = "You searched for customer name {$search_name}";
  
// query products
$stmt = $booking->searchByName($search_name);
  
// specify the page where paging is used
$page_url = "search_booking.php?name={$search_name}&";
// count total rows - used for pagination
$total_rows = $booking->countAll_BySearchName($search_name);

include_once "../admin/read_booking.php";
?>