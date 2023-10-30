<?php 
session_start();
include '../dbconnect.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
    extract($_POST);
    $user= $_SESSION['u_id']; 
    // var_dump($_POST);
    // exit;

    $dest_file1='';
    if (isset($_FILES['m_filePath']) && $_FILES['m_filePath']['name'] !='') {
       
        if (($_FILES['m_filePath']['type'] == "image/png") ||  ($_FILES['m_filePath']['type'] == "image/jpg") || ($_FILES['m_filePath']['type'] == "image/jpeg") || ($_FILES['m_filePath']['type'] == "application/pdf")) {
            if (!is_dir("../assets/tomindloops/tomindloops_attachment/")) {
                mkdir("../assets/tomindloops/tomindloops_attachment/");
            }
            $source_file1 = $_FILES['m_filePath']['tmp_name'];
            $dest_file1 = "../assets/tomindloops/tomindloops_attachment/".time(). $_FILES['m_filePath']['name'];
            if (file_exists($dest_file1)) {
                unlink($dest_file1);
                $m_filePath = $dest_file1;
            } else {
                $m_filePath = $dest_file1;
            }
            move_uploaded_file( $source_file1, $dest_file1 );
        } 
        // $sql = "update community_article set ca_title='$ca_name',ca_content='$ca_desc',published='$status',attachment='$dest_file1' where article_id='$ca_id' and cc_id='$cc_id'";
    }
    if($conn){
    $admin = $user;
    $sql = "INSERT INTO kidzpost(topic_id,title,content,created_by,attachment) VALUES (?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
   
    mysqli_stmt_bind_param($stmt, "issss",$topic_id,$ca_name,$ca_desc,$admin,$dest_file1);
    if (mysqli_stmt_execute($stmt)){


        mysqli_stmt_close($stmt);

        header("Location: kidzcornerArticles.php?topic_id=".$topic_id);
        
    }else{
        echo ("SQL ERROR:".mysqli_error($conn));
        echo ("Fail");
    }  
}
?>