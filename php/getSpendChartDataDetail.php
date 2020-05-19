<?php


error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("dbconfig.php");

$_POST = JSON_DECODE(file_get_contents("php://input"), true);

$month = $_POST["month"];
$category_Detail = $_POST["minorTag"];



$sql = mysqli_query($db, "SELECT month(Date_d), day(Date_d), Content, price from spend where id = '{$_SESSION["ses_username"]}' and Category_Detail= '".$category_Detail."' and month(Date_d) = '$month'");

$expenseLists = array();

 while($row = mysqli_fetch_array($sql)) { 
            array_push($expenseLists, array($row[0]."/".$row[1], $row[2], $row[3]));
        }
        $result['expenseLists'] = $expenseLists;

echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK|JSON_UNESCAPED_SLASHES);

 ?>
