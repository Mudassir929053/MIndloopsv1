<?php 

include '../dbconnect.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
    extract($_POST);
    if($conn){
    $sql = "INSERT INTO kidzcreativecorner(topic_name,description) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss",$c_name,$c_desc);
    if (mysqli_stmt_execute($stmt)){


        mysqli_stmt_close($stmt);

        header("Location: manageKidzcorner.php");
        
    }else{
        echo ("SQL ERROR:".mysqli_error($conn));
        echo ("Fail");
    }  
}
?>