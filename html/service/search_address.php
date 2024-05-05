<?php
// core.php holds pagination variables
include_once '../config/core.php';
include_once("../../model/entity/Address.php");
  
// instantiate database and product object
$database = new Database();
$db = $database->Connect();
  
$address = new Address($db);
  
// get search term
$search_id = isset($_GET['search_id']) ? $_GET['search_id'] : '';
  
$page_title = "You searched for address ID {$search_id}";
  
// query products
$stmt = $address->searchById($search_id);
  
// specify the page where paging is used
$page_url = "search_address.php?id={$search_id}&";
// count total rows - used for pagination
$total_rows = $address->countAll_BySearch($search_id);

include_once "/../../admin/read_address.php";
?>