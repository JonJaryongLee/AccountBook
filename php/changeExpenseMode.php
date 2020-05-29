<?php

class loginObject{
	public $thisYear;
	public $thisMonth;
	public $spendContent;
}


require_once("dbconfig.php"); // 접속에 필요한 코드를 불러옴 
$_POST = JSON_DECODE(file_get_contents("php://input"), true);
//vue와 ajax통신을 위해필요한 코드 json값을 디코딩함 
$mode = $_POST["mode"];


            $monthData1 = new loginObject;
           	$year = date("Y");
           	$month = date("n"); 
           	//변수선언 이번년도,이번달

            $monthData1 -> thisYear = (int)$year;
            $monthData1 -> thisMonth = (int)$month;



$res = mysqli_query($db, "
  SELECT SUBSTRING(Date_d, 9, 2) as Date_d, sum(price) as price, max(Division) as Division, max(Category_name) as Category_name 
  from spend 
  where ID = '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()) and Category_name='".$mode."' 
  GROUP by Date_d");


$zero = 0;
$plus = '+';

$spendContent = array();

            while($row = mysqli_fetch_array($res)) { 
            $spendContent[(int)$row[0]] = array($zero, $plus, (int)$row[1], $row[2]);
            }


            $monthData1 -> spendContent = (object)$spendContent; 
            //배열 형태로 보내줄 chartData 
            $monthData = array();
            $monthData["monthData"] = $monthData1;
   
            echo json_encode($monthData);
 mysqli_close($db);

?>