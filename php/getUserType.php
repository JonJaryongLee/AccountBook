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
// [0] -> 욜로형, [1] -> 절약형, [2] -> 표준형


$sumsql = mysqli_query($db, "SELECT sum(price) FROM spend WHERE ID = '".$_SESSION["ses_username"]."' and Category_name = '생활비'");


$userTotalProperty = mysqli_query($db, "SELECT sum(price) as price from (select SUBSTRING(Date_d, 9, 2) as Date_d, price, Division, Content from income where ID = '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()) UNION all select SUBSTRING(Date_d, 9, 2) as Date_d, (user.Change_income*work_income.Time) as price, Division, Content from work_income, user where work_income.ID = '".$_SESSION["ses_username"]."' and user.ID = '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()))ic")

$result = array();

// (user의 생활비 총 합 / user의 전체 수입) *
if(($sumsql / $userTotalProperty) > 80 ){
  $result = $money_material[2];
}

if(90> ($sumsql / $userTotalProperty) > 70){
  $result = $money_material[1];
}

if(($sumsql / $userTotalProperty) > 100){
  $result = $money_material[0];
}


$data = $result;

echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
mysqli_close($db);

 ?>
