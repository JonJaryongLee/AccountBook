<?php
//DB접속의 기본이 되는 라이브러리 파일이다 각 파일의 제일 첫번째에 위치시킬것 
	session_start();
//세션변수 사용을 위함 
error_reporting(E_ALL);
ini_set("display_errors", 1);

header("Content-Type:application/json"); 
// json type 사용시 필요한 헤더

	$host = 'localhost'; 
    $user = 'root';
    $pw = '**uplus1214';
    $dbName = 'accountbook';
    $db = new mysqli($host, $user, $pw, $dbName);
// DB 접속

    mysqli_set_charset($db,"utf8");
// 기본 클라이언트 문자 집합 설정하기  

    
?>