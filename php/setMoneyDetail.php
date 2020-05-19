<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("dbconfig.php");

$_POST = JSON_DECODE(file_get_contents("php://input"), true);


$year = $_POST["thisYear"];
$month = $_POST["thisMonth"];
$day = $_POST["today"];
//날짜 post
$mode = $_POST["mode"];
$money = $_POST["money"];
$content = $_POST["content"];
$cashOrCard = $_POST["cashOrCard"];
$category = $_POST["category"];




$res = mysqli_query($db, "SELECT Category_name from under_category where Category_Detail = '".$category."' ");

$row = mysqli_fetch_array($res);
$Category_name = $row[0]; // 상위카테고리 



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



if($mode == "지출"){//모드가 수입이면 수입테이블에 삽입
  mysqli_query($db,"INSERT INTO spend(ID, Category_name, Category_Detail, Content, Use_division, Date_d, price, Division) VALUES('".$_SESSION["ses_username"]."', '".$Category_name."', '".$category."', '".$content."', '".$cashOrCard."', '".$date."', '$money', '-' )");
}
else if($mode == "수입" and ($category == "일급" or $category == "주급" or $category == "월급")){
  mysqli_query($db,"INSERT INTO `work_income`(`ID`, `Category_Detail`, `Content`, `Date_d`, `Time`, `Division`, `Category_name`) VALUES('".$_SESSION["ses_username"]."', '".$category."', '".$content."', '".$date."', '$money', '+', '".$Category_name."' )");
}//노동수입 테이블  
else if($mode == "수입" and $category !== "일급" and $category !== "주급" and $category !== "월급"){
  mysqli_query($db,"INSERT INTO income(ID, Category_Detail, Content, price, Date_d, Division, Category_name) VALUES('".$_SESSION["ses_username"]."', '".$category."', '".$content."', '$money', '".$date."', '+', '".$Category_name."' )");
}//수입테이블
else{
    echo "error";
  }

$flag = (boolean)false;  // flag값 정의 

$res_Sum = mysqli_query($db, "SELECT sum(price) from spend where id = '".$_SESSION["ses_username"]."' and Category_name = '생활비'");
$row = mysqli_fetch_array($res_Sum);
$SumOfliving = $row[0]; // 사용자의 생활비 총액 



$res_Sum = mysqli_query($db, "SELECT Sex, Age FROM user where id='".$_SESSION["ses_username"]."'");
$row = mysqli_fetch_array($res_Sum);
$Sex = $row[0]; 
$Age = $row[1]; 
$SexAndAge = $Sex.$Age;// 저장되는값과 비교값 ,  남자20대(60만원), 남자30대(100만원), 여자20대(70만원), 여자30대(110만원) 


if($SexAndAge === "남자20대" and $SumOfliving >= 600000){
  $flag = true;
}
else if($SexAndAge === "남자30대" and $SumOfliving >= 1000000){
  $flag = true;
}
else if($SexAndAge === "여자20대" and $SumOfliving >= 700000){
  $flag = true;
}
else if($SexAndAge === "여자30대" and $SumOfliving >= 1100000){
  $flag = true;
}
else{
  $flag = false;
}


// 여기 부터는 업데이트된 정보 리턴
class mDetail{
  public $moneyDetailsNum;
  public $moneyDetailTagData;
  public $moneyDetailTagIcon;
  public $iconColor;
  public $moneyDetailContentData;
  public $moneyDetailMoneyData;
  public $danger;
}


$moneyDetail1 = new mDetail;//객체생성 

$moneyDetail1 -> danger = (boolean)$flag;

            
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