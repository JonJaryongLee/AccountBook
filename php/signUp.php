<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("dbconfig.php");

$_POST = JSON_DECODE(file_get_contents("php://input"), true);

    $memberId = $_POST["id"];
    $memberPw = $_POST["pw"];
    $_SESSION["ses_username"] = $memberId;
    
    $memberName = $_POST["name"];
    $memberAge = $_POST["age"];
    $memberSex = $_POST["sex"];
    
    $memberTotalProperty = $_POST["userTotalProperty"];
    $memberincomeMonthly = $_POST["incomeMonthly"];
    
    $memberspendFixedList = $_POST["spendFixedList"];
    
    $memberspendFixibleList = $_POST["spendFlexibleList"];
    
    $userGoals = $_POST["userGoals"];
    
//post받는데이터



 if(!empty($memberId) && !empty($memberPw))
     {
        $sql = "SELECT * FROM user WHERE ID = '$memberId'"; 
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result);
        //멤버 테이블에서 같은 아이디조회 후 추출해서 배열에 담음
        if($row['ID'] === $memberId)
        {
            $b = false;
         echo json_encode($b,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
        }
        else
        {
            mysqli_query($db,"INSERT INTO user(ID,PW,Name,Sex,Age,Cash,Fix_Income) VALUES('".$memberId."', '".$memberPw."', '".$memberName."', '".$memberSex."', '".$memberAge."', '$memberTotalProperty', '$memberincomeMonthly' )");
 

            for($i = 0; $i < (count($memberspendFixedList[0])); $i++) {
             mysqli_query($db,"INSERT INTO fix_spend(ID,Category_Detail,price) VALUES('".$memberId."', '".$memberspendFixedList['0'][$i]."','".$memberspendFixedList['1'][$i]."')");
            }//고정지출을 삽입하는 sql 

            for($i = 0; $i < (count($memberspendFixibleList[0])); $i++) {
             mysqli_query($db,"INSERT INTO month_spend(ID,Category_name,price) VALUES('".$memberId."', '".$memberspendFixibleList['0'][$i]."','".$memberspendFixibleList['1'][$i]."')");
            }//고정지출을 삽입하는 sql 

            for($i = 0; $i < (count($userGoals)); $i++) {
             mysqli_query($db,"INSERT INTO user_target(ID,content) VALUES('".$memberId."', '".$userGoals[$i]."')");
            }//고정지출을 삽입하는 sql

            $a = true;
         echo json_encode($a,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);

        }
     }

mysqli_close($db);
 
?>