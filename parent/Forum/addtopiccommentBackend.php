<?php 

 
date_default_timezone_set("Asia/Kuala_Lumpur");
var_dump($_POST);
// exit;
    extract($_POST);
    if($conn){
    $sql = "INSERT INTO forum_postcomment(subforumtopic_id,content,created_by) VALUES (?, ?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "iss",$forumtopic_id,$c_name5,$c_desc6);
    if (mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("Location: forumtopic-comments.php?forumtopic_id=$forumtopic_id");       
    }else{
        echo ("SQL ERROR:".mysqli_error($conn));
        echo ("Fail");
    }  
}
?>