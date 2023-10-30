<?php

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '600' );

include('../dbconnect.php');

$t_id = (int)$_POST['t_id'];
$t_title = $_POST['t_title'];
$t_desc = $_POST['t_desc'];
// $m_imgPath = "pdf/Cover_Pages/" . $_POST['m_imgPath'];
$t_rDate = $_POST['t_rDate'];           
// $m_filePath = "pdf/Magazine_Full/" . $_POST['m_filePath'];
// $m_edition = $_POST['m_edition'];
$t_author = $_POST['t_author'];
$t_video = $_POST['video'];
$t_audience = $_POST['t_audience'];
$t_type = $_POST['t_type'];
$currFilePath = $_POST['currFilePath'];
// $m_pageLimit = (int)$_POST['m_pageLimit'];
$dateTime = (string) date('Y-m-d_H-i-s');


if ( isset( $_FILES['m_filePathNew'] ) ) {

	if (($_FILES['m_filePathNew']['type'] == "image/png") ||  ($_FILES['m_filePathNew']['type'] == "image/jpg") || ($_FILES['m_filePathNew']['type'] == "image/jpeg")) {

		if(!is_dir("../assets/tips/tip_images/".$dateTime."/")) {
			mkdir("../assets/tips/tip_images/".$dateTime."/");
		}	

		$source_file2 = $_FILES['m_filePathNew']['tmp_name'];
		$dest_file2 = "../assets/tips/tip_images/".$dateTime."/".$_FILES['m_filePathNew']['name'];
        
		if (file_exists($dest_file2)) {
			
            unlink($dest_file2);
            $m_filePath = $dest_file2;
		}else{
		    $m_filePath = $dest_file2;
		}

        move_uploaded_file( $source_file2, $dest_file2 )
        or die ("Error!!");

        gc_collect_cycles();
        unlink($currFilePath);

        $filePathFolder = substr($currFilePath, 0, 45);
        rmdir($filePathFolder);

	}else{
		// echo ("<script LANGUAGE='JavaScript'> window.alert('Magazine is not in PDF format.');</script>");
        $m_filePath = $currFilePath;
	}
}
else {
    $m_filePath = $currFilePath;
}

$sql = "UPDATE tb_tips SET t_title = ?, t_rDate = ?, 
t_author = ?, t_desc = ?, t_audience = ?, t_video_id = ?, t_type = ?, t_filePath = ? WHERE t_id = ?;";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{

    mysqli_stmt_bind_param($stmt, "ssssssssi", $t_title, $t_rDate, $t_author, $t_desc, $t_audience,$t_video, $t_type, $m_filePath, $t_id);

    mysqli_stmt_execute($stmt);

    echo "<script> alert('Updated Successfully!'); </script>";

    echo "<script> window.location.replace('manage-tip.php'); </script>";
}
