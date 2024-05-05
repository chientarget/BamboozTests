<?php
require_once(__DIR__ . '/../../connect/Database.php');
require_once(__DIR__ . '/../../model/entity/Address.php');

$database = new Database();
$db = $database->Connect();

$address = new Address($db);

$stmt = $address->getAll();
$cities = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $cities[] = $city;
}

header('Content-Type: application/json');
echo json_encode($cities);
?>