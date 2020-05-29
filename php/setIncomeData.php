<?php

require_once("dbconfig.php");


$_POST = JSON_DECODE(file_get_contents("php://input"), true);
//vue와 ajax통신을 위해필요한 코드 json값을 디코딩함 

$year = $_POST["thisYear"];
$month = $_POST["thisMonth"];
$today = $_POST["today"];
$time =$_POST["time"];

$zero = (string)0;
$bar = "-";

if($month < 10){
	$month= $zero.$month;
}

if($today < 10){
	$today= $zero.$today;
}

$date = $year.$bar.$month.$bar.$today;


mysqli_query($db,"INSERT INTO `work_income`(`ID`, `Category_Detail`, `Content`, `Date_d`, `Time`, `Division`, `Category_name`) 
	VALUES('".$_SESSION["ses_username"]."', '일급', '시급', '".$date."', '".$time."', '+', '수입' )");


$result = array(); // 전체값을 담을 배열 

$sql = mysqli_query($db, "SELECT MAX(Date_d) Date_d, sum(price) as price, MAX(Division) Division 
	from 
	(select SUBSTRING(Date_d, 9, 2) as Date_d, sum((user.Change_income*work_income.Time)) as price, max(Division) Division 
	from work_income,user 
	where work_income.ID = '{$_SESSION["ses_username"]}' and user.ID = '{$_SESSION["ses_username"]}' and month(Date_d) = '$month' 
	GROUP BY Date_d 

	UNION ALL 

	select SUBSTRING(Date_d, 9, 2) as Date_d, sum(price), max(Division) as a 
	from income 
	where ID = '{$_SESSION["ses_username"]}' and month(Date_d) = '$month' 
	GROUP by Date_d) as basetable 

	group by Date_d order by Date_d ASC");
 
$moneyIncome = array();
for ($x = 0; $x <= 30; $x++) {
 $moneyIncome[$x]=null;
}

 while($row = mysqli_fetch_array($sql)) { 
            $moneyIncome[$row[0]-1] = $row[1]; 
            }

$result['dateIncomeMoneyDetailNumArray'] = $moneyIncome;
//수입이 금액으로 입력될때 ! 널  값이 31개인 배열에 날짜별로 금액 삽입 




$sql2 = mysqli_query($db, "SELECT SUBSTRING(`Date_d`, 9, 2), sum(`Time`), max(`Division`) 
						  from work_income 
						  where ID = '{$_SESSION["ses_username"]}' 
						  and month(Date_d) = '$month' and year(Date_d) = '$year' 
						  GROUP by Date_d");
 
$TimeIncome = array();
for ($x = 0; $x <= 30; $x++) {
 $TimeIncome[$x]=null;
}

 while($row = mysqli_fetch_array($sql2)) { 
            $TimeIncome[$row[0]-1] = $row[1]; 
            }

$result['dateIncomeTimeDetailNumArray'] = $TimeIncome;
//수입이 시간으로 입력될떄 ! 널  값이 31개인 배열에 날짜별로 금액 삽입 


$sql3 = mysqli_query($db, "SELECT sum(price) from 
			(select SUBSTRING(Date_d, 9, 2) as Date_d, sum((user.Change_income*work_income.Time)) as price, max(Division) Division 
			from work_income,user 
			where work_income.ID = '{$_SESSION["ses_username"]}' 
			and user.ID = '{$_SESSION["ses_username"]}' 
			and month(Date_d) = '$month' and year(Date_d) = '$year' 
			GROUP BY Date_d 

			UNION ALL 

			select SUBSTRING(Date_d, 9, 2) as Date_d, sum(price), max(Division) as a 
			from income 
			where ID = '{$_SESSION["ses_username"]}' 
			and month(Date_d) = '$month' and year(Date_d) = '$year' 
			GROUP by Date_d) as basetable");

$row = mysqli_fetch_array($sql3);
$result['totalIncome'] = $row[0]; 
//총수입


echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);


mysqli_close($db);
?>