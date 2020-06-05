<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


require_once("dbconfig.php");

$_POST = JSON_DECODE(file_get_contents("php://input"), true);



$sql1 = mysqli_query($db, "SELECT sum(price) as price FROM spend WHERE ID = '".$_SESSION["ses_username"]."' and Category_name = '생활비'");

$row = mysqli_fetch_array($sql1);
$living = $row[0];
//생활비

$sql2 = mysqli_query($db, "SELECT sum(price) as price from (select SUBSTRING(Date_d, 9, 2) as Date_d, price, Division, Content from income where ID = '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()) UNION all select SUBSTRING(Date_d, 9, 2) as Date_d, (user.Change_income*work_income.Time) as price, Division, Content from work_income, user where work_income.ID = '".$_SESSION["ses_username"]."' and user.ID = '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()))ic");
//전체수입 
$row = mysqli_fetch_array($sql2);
$income = $row[0];
//생활비





$cal = ($living / $income)*100;
//수식 = (생활비 / 전체수입 )*100


if ($cal < 100 and $cal >80) {
 $name = "표준형";
} 

else if ($cal > 70 and $cal <81) {
	$name = "절약형";
}

else if ($cal > 100){
	$name = "욜로형";
}
else {
	$name = "소비권장형";
}


$sql3 = mysqli_query($db, "SELECT * from spend_material where Material = '".$name."' ");
// 해당 user의 세부 카테고리별 price sum 저장 변수
$row = mysqli_fetch_array($sql3);
$Material = $row[0];
$Image = $row[1];
$Text = $row[2];






$result = array();

$result['type'] = $Material;
$result['describe'] = $Text;
$result['image'] = $Image;


echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
mysqli_close($db);

 ?>