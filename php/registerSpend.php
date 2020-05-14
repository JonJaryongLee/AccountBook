<?php

require_once("dbconfig.php");


$_POST = JSON_DECODE(file_get_contents("php://input"), true);
//vue와 ajax통신을 위해필요한 코드 json값을 디코딩함 

$year = $_POST["thisYear"];
$month = $_POST["thisMonth"];
$day = $_POST["today"];
$payType = $_POST["payType"];
$spendContent = $_POST["spendContent"];
$content = $_POST["content"];



$zero = (string)0;
$bar = "-";

if($month < 10){
	$month= $zero.$month;
}

if($day < 10){
	$day= $zero.$day;
}

$date = $year.$bar.$month.$bar.$day;
//년 월 일을 db에 맞게 변환


$res1 = mysqli_query($db, "SELECT * from under_category where Category_Detail = '".$spendContent['1']."'");

	$row = mysqli_fetch_array($res1);
	$Category_name = $row[1];
//카테고리명을 조회하기 위함


mysqli_query($db,"INSERT INTO spend(ID,Category_name,Category_Detail,Content,Use_division,Date_d,price,Division) VALUES('".$_SESSION["ses_username"]."', '".$Category_name."', '".$spendContent['1']."', '".$content."', '".$payType."', '".$date."', '".$spendContent['0']."', '-')");
//지출 삽입 



// 여기 부터는 업데이트된 정보 리턴
class mDetail{
  public $moneyDetailsNum;
  public $moneyDetailTagData;
  public $moneyDetailTagIcon;
  public $iconColor;
  public $moneyDetailContentData;
  public $moneyDetailMoneyData;
}


$moneyDetail1 = new mDetail;//객체생성 
            
$res1 = mysqli_query($db, "SELECT COUNT(Content) FROM (SELECT ID, Category_Detail, price, Date_d, Division, Content FROM spend WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date') UNION all SELECT user.ID, Category_Detail, (user.Change_income*work_income.Time) as price, Date_d, Division, Content FROM work_income, user where work_income.ID = '".$_SESSION["ses_username"]."' and user.ID = '".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10)) = '$date'UNION all SELECT ID, Category_Detail, price, Date_d, Division, Content FROM income WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date'))a INNER JOIN under_category ON a.Category_Detail= under_category.Category_Detail");

  $row = mysqli_fetch_array($res1);

  $countNum = $row[0];
  $moneyDetail1 -> moneyDetailsNum = (int)$countNum;


$res2 = mysqli_query($db, "SELECT * FROM (SELECT ID, Category_Detail, price, Date_d, Division, Content FROM spend WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date') UNION all SELECT user.ID, Category_Detail, (user.Change_income*work_income.Time) as price, Date_d, Division, Content FROM work_income, user where work_income.ID = '".$_SESSION["ses_username"]."' and user.ID = '".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10)) = '$date'UNION all SELECT ID, Category_Detail, price, Date_d, Division, Content FROM income WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date'))a INNER JOIN under_category ON a.Category_Detail= under_category.Category_Detail");


$moneyDetailTagData = array();

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailTagData, $row[1]);
        }

            $moneyDetail1 -> moneyDetailTagData = $moneyDetailTagData;
// 태그 정보 

$moneyDetailTagIcon = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailTagIcon, $row[9]);
        }

            $moneyDetail1 -> moneyDetailTagIcon = $moneyDetailTagIcon;


$iconColor = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($iconColor, $row[8]);
        }

            $moneyDetail1 -> iconColor = $iconColor;


$moneyDetailContentData = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailContentData, $row[5]);
        }

            $moneyDetail1 -> moneyDetailContentData = $moneyDetailContentData;


$moneyDetailMoneyData = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailMoneyData,array($row[2], $row[4]));
        }

            $moneyDetail1 -> moneyDetailMoneyData = $moneyDetailMoneyData;


$moneyDetail = array();
$moneyDetail["moneyDetail"] = $moneyDetail1;

echo json_encode($moneyDetail,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);

mysqli_close($db);
?>