<?php
class mDetailT{
  public $moneyDetailsNum;
  public $moneyDetailTagData;
  public $moneyDetailTagIcon;
  public $iconColor;
  public $moneyDetailContentData;
  public $moneyDetailMoneyData;
}

require_once("dbconfig.php");
$_POST = JSON_DECODE(file_get_contents("php://input"), true);
//vue와 ajax통신을 위해필요한 코드 json값을 디코딩함 


$year = (string)$_POST["thisYear"];
$month = (string)$_POST["thisMonth"];
$day = (string)$_POST["today"];
$indexNum = (int)$_POST["index"];


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



$moneyDetailT  = new mDetailT;//객체생성 
            
$res1 = mysqli_query($db, "SELECT COUNT(Content) FROM (SELECT ID, Category_Detail, price, Date_d, Division, Content FROM spend WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date') UNION all SELECT user.ID, Category_Detail, (user.Change_income*work_income.Time) as price, Date_d, Division, Content FROM work_income, user where work_income.ID = '".$_SESSION["ses_username"]."' and user.ID = '".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10)) = '$date'UNION all SELECT ID, Category_Detail, price, Date_d, Division, Content FROM income WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date'))a INNER JOIN under_category ON a.Category_Detail= under_category.Category_Detail"); //정보의 개수 셀렉하는 sql

	$row = mysqli_fetch_array($res1);

	$countNum = $row[0];
	$moneyDetailT -> moneyDetailsNum = (int)$countNum;


$res2 = mysqli_query($db, "SELECT * FROM (SELECT ID, Category_Detail, price, Date_d, Division, Content FROM spend WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date') UNION all SELECT user.ID, Category_Detail, (user.Change_income*work_income.Time) as price, Date_d, Division, Content FROM work_income, user where work_income.ID = '".$_SESSION["ses_username"]."' and user.ID = '".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10)) = '$date'UNION all SELECT ID, Category_Detail, price, Date_d, Division, Content FROM income WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date'))a INNER JOIN under_category ON a.Category_Detail= under_category.Category_Detail");


$moneyDetailTagData = array();

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailTagData, $row[1]);
        }

            $moneyDetailT -> moneyDetailTagData = $moneyDetailTagData;
// 태그 정보 

$moneyDetailTagIcon = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailTagIcon, $row[9]);
        }

            $moneyDetailT -> moneyDetailTagIcon = $moneyDetailTagIcon;


$iconColor = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($iconColor, $row[8]);
        }

            $moneyDetailT -> iconColor = $iconColor;


$moneyDetailContentData = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailContentData, $row[5]);
        }

            $moneyDetailT -> moneyDetailContentData = $moneyDetailContentData;


$moneyDetailMoneyData = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailMoneyData,array($row[2], $row[4]));
        }

            $moneyDetailT -> moneyDetailMoneyData = $moneyDetailMoneyData;


$moneyDetailContentDataOfIndex = $moneyDetailT -> moneyDetailContentData[$indexNum];
$moneyDetailTagDataOfIndex = $moneyDetailT -> moneyDetailTagData[$indexNum];
$moneyDetailMoneyDataOfIndexPrice = $moneyDetailT -> moneyDetailMoneyData[$indexNum][0];
$moneyDetailMoneyDataOfIndexDevision = $moneyDetailT -> moneyDetailMoneyData[$indexNum][1]; // 인덱스번호에 해당하는 정보들중에서 삭제할때 특정 필드를 식별하기 위한 조건들



$resT = mysqli_query($db, "SELECT Change_income FROM user WHERE id='".$_SESSION["ses_username"]."'"); 

$row = mysqli_fetch_array($resT);

$incomeOfTime = (int)$row[0];

//아래 조건문에서 기타수입을 삭제하는 sql 문 사용시 사용자 시급 x 시간 = 금액 이기때문에 시급을 구하는 변수 설정


if($moneyDetailMoneyDataOfIndexDevision == "-"){//지출
  mysqli_query($db, "DELETE FROM spend where Content = '$moneyDetailContentDataOfIndex' and Category_Detail = '$moneyDetailTagDataOfIndex' and price = $moneyDetailMoneyDataOfIndexPrice and (SUBSTRING(Date_d, 1, 10)) = '$date' and ID = '".$_SESSION["ses_username"]."'");
}

else if($moneyDetailMoneyDataOfIndexDevision == "+" and ($moneyDetailTagDataOfIndex == "일급" or $moneyDetailTagDataOfIndex == "주급"){//노동
    mysqli_query($db, "DELETE FROM work_income where Content = '$moneyDetailContentDataOfIndex' and Category_Detail = '$moneyDetailTagDataOfIndex' and (work_income.Time * $incomeOfTime) = $moneyDetailMoneyDataOfIndexPrice and (SUBSTRING(Date_d, 1, 10)) = '$date' and ID = '".$_SESSION["ses_username"]."'");  }
else if($moneyDetailMoneyDataOfIndexDevision == "+" and $moneyDetailTagDataOfIndex !== "일급" and $moneyDetailTagDataOfIndex !== "주급") {//기타수입
   mysqli_query($db, "DELETE FROM income where Content = '$moneyDetailContentDataOfIndex' and Category_Detail = '$moneyDetailTagDataOfIndex' and price = $moneyDetailMoneyDataOfIndexPrice and (SUBSTRING(Date_d, 1, 10)) = '$date' and ID = '".$_SESSION["ses_username"]."'");
  }
else{
    echo "error";
  }
// 여기 까지가 delete 


// 여기 부터는 업데이트된 정보 리턴
class mDetail{
  public $moneyDetailsNum;
  public $moneyDetailTagData;
  public $moneyDetailTagIcon;
  public $iconColor;
  public $moneyDetailContentData;
  public $moneyDetailMoneyData;
}


$moneyDetail = new mDetail;//객체생성 
            
$res1 = mysqli_query($db, "SELECT COUNT(Content) FROM (SELECT ID, Category_Detail, price, Date_d, Division, Content FROM spend WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date') UNION all SELECT user.ID, Category_Detail, (user.Change_income*work_income.Time) as price, Date_d, Division, Content FROM work_income, user where work_income.ID = '".$_SESSION["ses_username"]."' and user.ID = '".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10)) = '$date'UNION all SELECT ID, Category_Detail, price, Date_d, Division, Content FROM income WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date'))a INNER JOIN under_category ON a.Category_Detail= under_category.Category_Detail");

  $row = mysqli_fetch_array($res1);

  $countNum = $row[0];
  $moneyDetail -> moneyDetailsNum = (int)$countNum;


$res2 = mysqli_query($db, "SELECT * FROM (SELECT ID, Category_Detail, price, Date_d, Division, Content FROM spend WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date') UNION all SELECT user.ID, Category_Detail, (user.Change_income*work_income.Time) as price, Date_d, Division, Content FROM work_income, user where work_income.ID = '".$_SESSION["ses_username"]."' and user.ID = '".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10)) = '$date'UNION all SELECT ID, Category_Detail, price, Date_d, Division, Content FROM income WHERE ID='".$_SESSION["ses_username"]."' and (SUBSTRING(Date_d, 1, 10) = '$date'))a INNER JOIN under_category ON a.Category_Detail= under_category.Category_Detail");


$moneyDetailTagData = array();

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailTagData, $row[1]);
        }

            $moneyDetail -> moneyDetailTagData = $moneyDetailTagData;
// 태그 정보 

$moneyDetailTagIcon = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailTagIcon, $row[9]);
        }

            $moneyDetail -> moneyDetailTagIcon = $moneyDetailTagIcon;


$iconColor = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($iconColor, $row[8]);
        }

            $moneyDetail -> iconColor = $iconColor;


$moneyDetailContentData = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailContentData, $row[5]);
        }

            $moneyDetail -> moneyDetailContentData = $moneyDetailContentData;


$moneyDetailMoneyData = array();
mysqli_data_seek($res2, 0);

 while($row = mysqli_fetch_array($res2)) { 
            array_push($moneyDetailMoneyData,array($row[2], $row[4]));
        }

            $moneyDetail -> moneyDetailMoneyData = $moneyDetailMoneyData;


echo json_encode($moneyDetail,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
mysqli_close($db);

?>