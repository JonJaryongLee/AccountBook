<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


require_once("dbconfig.php");


$_POST = JSON_DECODE(file_get_contents("php://input"), true);


$sql = mysqli_query($db, "SELECT Material, Text from spend_material");

$money_material = array();

while($row = mysqli_fetch_array($sql)){
  array_push($money_material, array("type" => $row[0], "describe" => $row[1]))
}

$data = $money_material;

echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
mysqli_close($db);

 ?>
