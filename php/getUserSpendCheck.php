<?php

require_once("dbconfig.php");

$_POST = JSON_DECODE(file_get_contents("php://input"), true);


$sql1 = mysqli_query($db, "SELECT Age from user where id = '".$_SESSION["ses_username"]."' ");
// 해당 user의 세부 카테고리별 price sum 저장 변수
$row = mysqli_fetch_array($sql1);
$age = $row[0];

$sql2 = mysqli_query($db, "SELECT Category_Detail, sum(price) from spend where id = '".$_SESSION["ses_username"]."' and Category_Detail = '식비'");
// 해당 user의 세부 카테고리별 price sum 저장 변수
$row = mysqli_fetch_array($sql2);
$eat = $row[1];//식비

$sql3 =  mysqli_query($db, "SELECT Category_name, sum(price) from spend where id = '".$_SESSION["ses_username"]."' and Category_name = '교통비' GROUP by Category_name");
// 해당 user의 세부 카테고리별 price sum 저장 변수
$row = mysqli_fetch_array($sql3);
$trans = $row[1];

$sql4=  mysqli_query($db, "SELECT Category_Detail, sum(price) from spend where id = '".$_SESSION["ses_username"]."' and Category_Detail = '유흥'");
// 해당 user의 세부 카테고리별 price sum 저장 변수
$row = mysqli_fetch_array($sql4);
$play = $row[1];

/**
데이터 비교값 

          20대        30대
식비      25만원      45만원 
교통비    10만원      30만원
유흥비    12만원      20만원


**/


if($age == '20대'){
 

 $eat_cal = (int)(((250000-$eat)/250000)*100);
 $eat_result = '20대 평균 식비에서 '.$eat_cal.'% 절약';
 
 if($eat_cal < 0 ){
   $eat_result = '20대 평균 식비에서 '.abs($eat_cal).'% 더씀';
 }



 $trans_cal = (int)(((100000-$trans)/100000)*100);
 $trans_result = '20대 평균 교통비에서 '.$trans_cal.'% 절약';
 
 if($trans_cal < 0 ){
   $trans_result = '20대 평균 교통비에서 '.abs($trans_cal).'% 더씀';
 }



$play_cal = (int)(((120000-$play)/120000)*100);
$play_result = '20대 평균 유흥비에서 '.$play_cal.'% 절약';
 
 if($play_cal < 0 ){
   $play_result = '20대 평균 유흥비에서 '.abs($play_cal).'% 더씀';
 }

}
else{

 $eat_cal = (int)(((450000-$eat)/450000)*100);
 $eat_result = '30대 평균 식비에서 '.$eat_cal.'% 절약';
 
 if($eat_cal < 0 ){
   $eat_result = '30대 평균 식비에서 '.abs($eat_cal).'% 더씀';
 }



 $trans_cal = (int)(((300000-$trans)/300000)*100);
 $trans_result = '30대 평균 교통비에서 '.$trans_cal.'% 절약';
 
 if($trans_cal < 0 ){
   $trans_result = '30대 평균 교통비에서 '.abs($trans_cal).'% 더씀';
 }



$play_cal = (int)(((200000-$play)/200000)*100);
$play_result = '30대 평균 유흥비에서 '.$play_cal.'% 절약';
 
 if($play_cal < 0 ){
   $play_result = '30대 평균 유흥비에서 '.abs($play_cal).'% 더씀';
 }

}


 $result = array(); 
array_push($result, $eat_result);
array_push($result, $trans_result);
array_push($result, $play_result);

echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
 ?>