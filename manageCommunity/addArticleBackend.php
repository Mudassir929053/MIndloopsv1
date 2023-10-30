<?php 

include '../dbconnect.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
    extract($_POST);
    // exit;
    // var_dump($_FILES);
    // exit;
    $dest_file1='';
    if (isset($_FILES['m_filePath']) && $_FILES['m_filePath']['name'] != '') {
        if (($_FILES['m_filePath']['type'] == "image/png") ||  ($_FILES['m_filePath']['type'] == "image/jpg") || ($_FILES['m_filePath']['type'] == "image/jpeg") || ($_FILES['m_filePath']['type'] == "application/pdf")) {
            if (!is_dir("../assets/community/thumbnails/")) {
                mkdir("../assets/community/thumbnails/");
            }
            $source_file1 = $_FILES['m_filePath']['tmp_name'];
            $filename = time(). $_FILES['m_filePath']['name'];
            $dest_file1 = $filename;
            $full_path = "../assets/community/thumbnails/".$filename;
            if (file_exists($full_path)) {
                unlink($full_path);
                $m_filePath = $dest_file1;
            } else {
                $m_filePath = $dest_file1;
            }
            move_uploaded_file($source_file1, $full_path);
        } 
        // $sql = "update community_article set ca_title='$ca_name',ca_content='$ca_desc',published='$status',attachment='$dest_file1' where article_id='$ca_id' and cc_id='$cc_id'";
    }
    if($conn){
    $admin = '1';
    $sql = "INSERT INTO community_article(cc_id,ca_title,ca_content,created_by,article_thumbnail,liked_by,disliked_by) VALUES (?,?,?,?,?,0,0)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
   
    mysqli_stmt_bind_param($stmt, "issss",$cc_id,$ca_name,$ca_desc,$admin,$dest_file1);
    if (mysqli_stmt_execute($stmt)){


        mysqli_stmt_close($stmt);

        header("Location: communityArticles.php?cc_id=".$cc_id."&community_id=".$community_id);
        
    }else{
        echo ("SQL ERROR:".mysqli_error($conn));
        echo ("Fail");
    }  
}
