<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


require_once("dbconfig.php");
 

$_POST = JSON_DECODE(file_get_contents("php://input"), true);
$month = $_POST["month"];
$category_name = $_POST["tag"];


$sql = mysqli_query($db, "SELECT Category_Detail,sum(price) from spend where Category_name = '".$category_name."' and ID = '".$_SESSION["ses_username"]."' and month(Date_d) = $month GROUP by Category_Detail");


$moneyDetailTagIcon = array();

while($row = mysqli_fetch_array($sql)) { 
         array_push($moneyDetailTagIcon, array("label" => $row[0], "value" => $row[1]));
        }

    $data = $moneyDetailTagIcon;
     

echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
mysqli_close($db);
 
?>