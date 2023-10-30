<?php 

include '../dbconnect.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
// var_dump($_POST);
// exit;
    extract($_POST);
    if($conn){
    $sql = "INSERT INTO forum_topic(forum_id,ft_name,ft_description) VALUES (?, ?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "iss",$forum_id,$c_name,$c_desc);
    if (mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("Location: ForumTopics.php?forum_id=$forum_id");       
    }else{
        echo ("SQL ERROR:".mysqli_error($conn));
        echo ("Fail");
    }  
}
?>