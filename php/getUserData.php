<?

class loginObject{
	public $thisYear;
	public $thisMonth;
	public $spendContent;
}

class uData{
  public $month;
  public $income;
  public $balance;
  public $expense;
  public $expenseTypeCash;
  public $expenseTypeCard;
}
class spend{}
// 사용할 객체와 객체의 속성들! 

require_once("dbconfig.php"); // 접속에 필요한 코드를 불러옴 


       
            $userData = new uData;//객체생성 
            
            $udMonth = date("n");// date("n") = 현재 월을 숫자로 반환함 
            $userData -> month = (int)$udMonth;// int형으로 형변환 시킨후 속성에 추가
            
            $res1 = mysqli_query($db, "SELECT sum(price) as price from (select SUBSTRING(Date_d, 9, 2) as Date_d, price, Division, Content from income where ID = '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()) UNION all select SUBSTRING(Date_d, 9, 2) as Date_d, (user.Change_income*work_income.Time) as price, Division, Content from work_income, user where work_income.ID = '".$_SESSION["ses_username"]."' and user.ID = '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()))ic");
            

            $row = mysqli_fetch_array($res1);//res1을 배열로 변환시켜 row에 담는다 
            $monthTotalIncome = $row[0];// row에 담긴 정보를 다시 변수 ic에 담는다 

            $userData -> income = (int)$monthTotalIncome; //int로 변환시켜 income에 넣는다.
            //34~ 49line 은 income 부분 



            $res2 = mysqli_query($db, "SELECT sum(price) from spend where ID= '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now())");//해당월 지출

            $row = mysqli_fetch_array($res2);
            $monthExpense = $row[0];
            $userData -> expense = (int)$monthExpense;
            //54~58 expense 부분


            $monthBalance =  ($monthTotalIncome - $monthExpense);//월총수입 = 월지출 = 월잔액 
            $userData -> balance = (int)$monthBalance;
            // 62~63 balance 부분


            $res3 = mysqli_query($db, "SELECT sum(price) from spend where ID= '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()) and Use_division='현금'");
            $row = mysqli_fetch_array($res3);
            $monthCash = $row[0];
            $userData -> expenseTypeCash = (int)$monthCash;
            //해당월 현금 지출

            $res4 = mysqli_query($db, "SELECT sum(price) from spend where ID= '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()) and Use_division='카드'");
            $row = mysqli_fetch_array($res4);
            $monthCard = $row[0];
            $userData -> expenseTypeCard = (int)$monthCard;
            //해당월 카드지출 

            echo json_encode($userData,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
            // userData객체를 json으로 변환해서 전송
              


//여기 아래부터는 monthDate 객체부분에 들어갈 코드

            $monthDate = new loginObject;
           	$year = date("Y");
           	$month = date("n"); 
           	//변수선언 이번년도,이번달

            $monthDate -> thisYear = (int)$year;
            $monthDate -> thisMonth = (int)$month;


            $spendContent = array();
           
           	$res5 = mysqli_query($db, "SELECT SUBSTRING(Date_d, 9, 2) as Date_d, price, Division, num from income where ID = '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()) UNION all select SUBSTRING(Date_d, 9, 2) as Date_d, (user.Change_income*work_income.Time) as price, Division, num from work_income,user where work_income.ID = '".$_SESSION["ses_username"]."' and user.ID = '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()) UNION all select SUBSTRING(Date_d, 9, 2), price, Division, num from spend where ID = '".$_SESSION["ses_username"]."' and month(Date_d) = Month(now()) order by Date_d");
           //이번달에 속하는 일, 금액, 구분  
/*
sql 설명 
기타수입에서 이번달의 날짜,금액,구분,num(키값) 뽑아내서 아래 sql과 union
노동수입에서 이번달의 날짜,금액,구분,num(키값) 뽑아내서 아래sql과 union
지출에서 날짜, 금액 ,구분,num(키값) 
*/
            while($row = mysqli_fetch_array($res5)) { 
            $spendContent[(int)$row[0]][] = array((int)$row[1], $row[2]);
            }


            $monthDate -> spendContent = (object)$spendContent; 
            //배열 형태로 보내줄 chartData 
            echo json_encode($monthDate,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
            //monthDate객체를 json으로 전송 


 mysqli_close($db);

?>