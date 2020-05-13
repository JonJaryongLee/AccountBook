<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("dbconfig.php");

$_POST = JSON_DECODE(file_get_contents("php://input"), true);

$memberId = $_POST["id"];
    
 
        $sql = "SELECT * FROM `user` WHERE ID = '".$memberId."'"; 
        $result = mysqli_query($db,$sql);
        $row = mysqli_num_rows($result);
        //멤버 테이블에서 같은 아이디조회 후 추출해서 배열에 담음
        if($row>0)
        {
            $b = false;
         echo json_encode($b,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
        }else{
            $a = true;
         echo json_encode($a,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
        }


mysqli_close($db);
 
?>


