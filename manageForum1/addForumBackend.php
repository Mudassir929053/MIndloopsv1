<?php 
session_start();
$user = $_SESSION['u_id'];
include '../dbconnect.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
    extract($_POST);
    if($conn){
    $sql = "INSERT INTO forum(forum_name,forum_for,created_by,forum_description) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ssis",$c_name,$forum_for,$user,$c_desc);
    if (mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("Location: manageForum.php");
    }else{
        echo ("SQL ERROR:".mysqli_error($conn));
        echo ("Fail");
    }  
}
?>