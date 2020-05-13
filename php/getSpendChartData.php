<?php
class Chart{
  public $label;
  public $value;
}

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("dbconfig.php");

$_POST = JSON_DECODE(file_get_contents("php://input"), true);

$month = $_POST["month"];
$category_detail = $_POST["tag"];

$data = new Chart;

$sumSql = mysqli_query($db, "SELECT Category_Detail, sum(price)
                              FROM spend
                              WHERE ID = '".$_SESSION["ses_username"]."'
                              and Category_Detail = '".$category_detail."'
                              and month(Date_d) = '.$month.'");

$result = mysqli_fetch_array($sumSql);

$data -> label = $category_detail;
$data -> value = $sumSql;

echo $_SESSION["ses_username"].'\n';


echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);

 ?>
