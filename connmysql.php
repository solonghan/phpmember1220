<?php
    $servername = "localhost";
    $username = "root";
    $password = "1qaz@wsx";
    $database = "phpmember";

    //create connection
    $conn = mysqli_connect($servername,$username,$password,$database);

    //check
    if(mysqli_connect_error()){
        print "Failed to connect to MaySql:" . mysqli_connect_error();
    }else{
        //print "Successful connection" . "<br>";
        mysqli_query($conn,"SET NAMES utf8");   //中文編碼的問題
    }

    //資料過濾
    function GetSQLValueString($theValue, $theType) {
        switch ($theType) {
          case "string":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_ADD_SLASHES) : "";
            break;
          case "int":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_NUMBER_INT) : "";
            break;
          case "email":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_EMAIL) : "";
            break;
          case "url":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_URL) : "";
            break;      
        }
        return $theValue;
      }
?>
