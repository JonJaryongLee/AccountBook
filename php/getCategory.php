<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("dbconfig.php");

$_POST = JSON_DECODE(file_get_contents("php://input"), true);

$mode = $_POST["mode"];
$category = $_POST["category"]; 



$iconNames = array(); // iconNames 배열         
$categoryDetailData = array();

if($mode == "수입" and $category == "upper"){
    $sql = mysqli_query($db, "SELECT * FROM `category` WHERE Category_name = '수입'");

            while($row = mysqli_fetch_array($sql)) { 
            array_push($categoryDetailData, array($row[0],$row[2],$row[1])); 
            }

            $iconNames['iconNames'] = $categoryDetailData;
}

else if($mode == "지출" and $category == "upper"){
    $sql = mysqli_query($db, "SELECT * FROM `category` WHERE Category_name != '수입'");

            while($row = mysqli_fetch_array($sql)) { 
            array_push($categoryDetailData, array($row[0],$row[2],$row[1])); 
            }

            $iconNames['iconNames'] = $categoryDetailData;
}

       
else if($category !== "upper"){
    $sql = mysqli_query($db, "SELECT * FROM under_category WHERE Category_name = '".$category."' ");

            while($row = mysqli_fetch_array($sql)) { 
            array_push($categoryDetailData, array($row[0],$row[3],$row[2])); 
            }

            $iconNames['iconNames'] = $categoryDetailData;
} 

else{
    echo "post 값 에러~ !!";
}


        echo json_encode($iconNames,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);

mysqli_close($db);
 
?>