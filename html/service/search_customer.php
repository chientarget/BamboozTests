<?php
// core.php chứa các biến phân trang
include_once '../config/core.php';
include_once("../../model/entity/Customer.php");
  
// khởi tạo đối tượng cơ sở dữ liệu và đối tượng khách hàng
$database = new Database();
$db = $database->Connect();
  
$customer = new Customer($db);
  
// lấy điều kiện tìm kiếm
$search_term = isset($_GET['s']) ? $_GET['s'] : '';
  
$page_title = "You searched for \"{$search_term}\"";
  
// truy vấn khách hàng
$stmt = $customer->search($search_term, $from_record_num, $records_per_page);
  
// chỉ định trang sử dụng phân trang
$page_url = "search_customer.php?s={$search_term}&";
// đếm tổng số dòng - được sử dụng cho phân trang
$total_rows = $customer->countAll_BySearch($search_term);

include_once "../admin/read_customer.php";
?>