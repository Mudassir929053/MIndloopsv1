<?php
    session_start();
    // var_dump($_SESSION['userType']);
    // ++!exit(); 
    if(isset($_SESSION['userType'])){
        if($_SESSION['userType']=='3'){  
        header('location: index/index.php');
    } 
    else if($_SESSION['userType']=='2'){
        header('location: ./Teacher/magazine/index.php'); 
    } 
    else if($_SESSION['userType']=='4'){
        header('location: ./parent/magazine/index.php');
    }
    else{
        header("location: public/index.php");
    }
    exit;
    }
    header("location: public/index.php");
?>
