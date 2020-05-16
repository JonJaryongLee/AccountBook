<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("dbconfig.php");

$_POST = JSON_DECODE(file_get_contents("php://input"), true);

$mode = $_POST["mode"];
 
$iconNames = array(); // iconNames 배열          
$categoryName = array(); //categoryName 배열 

       
        if($mode== "upper"){

            $sql = mysqli_query($db, "SELECT * FROM category");

            while($row = mysqli_fetch_array($sql)) { 
            array_push($categoryName, array($row[0],$row[2],$row[1])); 
            }

            $iconNames['iconNames'] = $categoryName;

        }else{
           
            $sql = mysqli_query($db, "SELECT * FROM under_category WHERE Category_name = '".$mode."' ");

            while($row = mysqli_fetch_array($sql)) { 
            array_push($categoryName, array($row[0],$row[3],$row[2])); 
            }

            $iconNames['iconNames'] = $categoryName;
       
        }


        echo json_encode($iconNames,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);

mysqli_close($db);
 
?>