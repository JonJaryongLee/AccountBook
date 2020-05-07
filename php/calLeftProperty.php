<?php

require_once("dbconfig.php");


$_POST = JSON_DECODE(file_get_contents("php://input"), true);
//vue와 ajax통신을 위해필요한 코드 json값을 디코딩함 

$userTotalProperty = $_POST["userTotalProperty"];
$incomeMonthly = $_POST["incomeMonthly"];
$spendList = $_POST["spendList"];



$sum_spendList = array_sum($spendList[1]);

$leftMoney = $userTotalProperty + $incomeMonthly - $sum_spendList;
//리턴해줘야하는 금액 = 남은자산 = 현재총자산 + 고정수입 - 고정지출의합 



mysqli_query($db, "UPDATE user SET Cash = '$leftMoney'  WHERE ID = '".$_SESSION["ses_username"]."' ");


echo json_encode($leftMoney,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);

mysqli_close($db);
?>