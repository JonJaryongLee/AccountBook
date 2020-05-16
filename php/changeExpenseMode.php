  <?php

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
$_POST = JSON_DECODE(file_get_contents("php://input"), true);
//vue와 ajax통신을 위해필요한 코드 json값을 디코딩함 
$mode = $_POST["mode"];


            $monthData1 = new loginObject;
           	$year = date("Y");
           	$month = date("n"); 
           	//변수선언 이번년도,이번달

            $monthData1 -> thisYear = (int)$year;
            $monthData1 -> thisMonth = (int)$month;


            $spendContent = array();
          


$res5 = mysqli_query($db, "SELECT  Date_d, ifnull(f.i_price, 0), ifnull(f.i_Division, '+'), ifnull(f.s_price, 0), ifnull(f.s_Division, '-'), f.Category_name from
(SELECT IFNULL(A.Date_d, B.Date_d) as Date_d, A.price as i_price, A.Division as i_Division, B.price as s_price, B.Division as s_Division, IFNULL(A.Category_name, B.Category_name) as Category_name
  From
(SELECT MAX(Date_d) Date_d, sum(price) as price, MAX(Division) Division, MAX(Category_name) Category_name from (select SUBSTRING(Date_d, 9, 2) as Date_d, sum((user.Change_income*work_income.Time)) as price, max(Division) Division, MAX(Category_name) Category_name from work_income,user where work_income.ID = '{$_SESSION["ses_username"]}' and user.ID = '{$_SESSION["ses_username"]}' and month(Date_d) = Month(now()) GROUP BY Date_d UNION ALL select SUBSTRING(Date_d, 9, 2) as Date_d, sum(price), max(Division), max(Category_name) as a from income where ID = '{$_SESSION["ses_username"]}' and month(Date_d) = Month(now()) GROUP by Date_d) as basetable group by Date_d) as A 
    
    LEFT OUTER JOIN 
 
 (SELECT SUBSTRING(Date_d, 9, 2) as Date_d, sum(price) as price, max(Division) as Division, max(Category_name) as Category_name from spend where ID = '{$_SESSION["ses_username"]}' and month(Date_d) = Month(now()) GROUP by Date_d) as B 
    ON A.Date_d = B.Date_d
    
UNION    

SELECT IFNULL(A.Date_d, B.Date_d), A.price, A.Division, B.price, B.Division, IFNULL(A.Category_name, B.Category_name) as Category_name
  From
(SELECT SUBSTRING(Date_d, 9, 2) as Date_d, sum(price) as price, max(Division) as Division, max(Category_name) as Category_name from spend where ID = '{$_SESSION["ses_username"]}' and month(Date_d) = Month(now()) GROUP by Date_d) as B  
    
    LEFT OUTER JOIN 
 
 (SELECT MAX(Date_d) Date_d, sum(price) as price, MAX(Division) Division, MAX(Category_name) Category_name from (select SUBSTRING(Date_d, 9, 2) as Date_d, sum((user.Change_income*work_income.Time)) as price, max(Division) Division, max(Category_name) Category_name from work_income,user where work_income.ID = '{$_SESSION["ses_username"]}' and user.ID = '{$_SESSION["ses_username"]}' and month(Date_d) = Month(now()) GROUP BY Date_d UNION ALL select SUBSTRING(Date_d, 9, 2) as Date_d, sum(price), max(Division), max(Category_name) as a from income where ID = '{$_SESSION["ses_username"]}' and month(Date_d) = Month(now()) GROUP by Date_d) as basetable group by Date_d) as A  
    ON A.Date_d = B.Date_d) as f where Category_name='".$mode."' order by Date_d asc;");
           //이번달에 속하는 일, 금액, 구분    
/*
sql 설명 

*/
            while($row = mysqli_fetch_array($res5)) { 
            $spendContent[(int)$row[0]] = array((int)$row[1], $row[2], $row[3], $row[4]);
            }


            $monthData1 -> spendContent = (object)$spendContent; 
            //배열 형태로 보내줄 chartData 
            $monthData = array();
            $monthData["monthData"] = $monthData1;


            
            echo json_encode($monthData);

            
        

 mysqli_close($db);

?>