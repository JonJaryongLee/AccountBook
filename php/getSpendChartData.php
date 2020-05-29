<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("dbconfig.php");

$_POST = JSON_DECODE(file_get_contents("php://input"), true);
//vue와 ajax통신을 위해필요한 코드 json값을 디코딩

$month = $_POST["month"];
$category_name = $_POST["tag"];


$sql = mysqli_query($db, "SELECT Category_Detail,sum(price) from spend where Category_name = '".$category_name."' and ID = '".$_SESSION["ses_username"]."' and month(Date_d) = $month GROUP by Category_Detail");

//카테고리에 해당하는 세부 카테고리명 별로 금액의 합 계산


$moneyDetailTagIcon = array();
//json형식으로 내보내기 위해 배열 생성

while($row = mysqli_fetch_array($sql)) {
         array_push($moneyDetailTagIcon, array("label" => $row[0], "value" => $row[1]));
        }

    $data = $moneyDetailTagIcon;

echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
mysqli_close($db);

?>