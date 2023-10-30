<?php

include ("../dbconnect.php");
$ts_id = $_POST['ts_id'];
$ts_title = $_POST['ts_title'];
$ts_date = $_POST['ts_date'];
$chosenDate = getDate(strtotime(str_replace('/', '-', $ts_date)));
$dt = new DateTime(sprintf( "%04d-%02d-%02d", $chosenDate['year'], $chosenDate['mon'], 
$chosenDate['mday']));
$datetime = new DateTime();
        $datetime = $datetime->format('d-m-Y_H-i-s');
$dt = $dt->format('Y-m-d');
$old_file="";
$old_img="";
$ts_type = $_POST['ts_type'];
if($ts_type=="pedagogy"){
    $ts_type="TS1";
}else if($ts_type=="curriculum"){
    $ts_type="TS2";
}else if($ts_type=="assessment"){
    $ts_type="TS3";
}else{
    echo ("<script LANGUAGE='JavaScript'> window.alert('Teaching support type not supportable.');</script>");

}
$ts_author = $_POST['ts_author'];
$ts_desc = $_POST['ts_desc'];
$stmt = mysqli_stmt_init($conn);
if ( isset( $_FILES['ts_img'] ) ) {
    $sql1 = "SELECT * FROM tb_teachsupport WHERE ts_id = ?";

    if (!mysqli_stmt_prepare($stmt, $sql1)){
        echo json_encode("SQL ERROR");
    }else{
        
        mysqli_stmt_bind_param($stmt, "i",$ts_id);
        if (mysqli_stmt_execute($stmt)){
      //$i=0;
      //successfully added
      $result = $stmt->get_result();
      while($row = $result->fetch_assoc()){
        $old_img = $row['ts_imgPath'];
        $old_file = $row['ts_filePath'];
      }
      if (file_exists($old_img)) {
      unlink($old_img);
      }
      
      
    }else{
        $data=array(
            "status"=>"fail"
          );
          echo json_encode($data);
    }
    
    }
	if (($_FILES['ts_img']['type'] == "image/png") ||  ($_FILES['ts_img']['type'] == "image/jpg") || ($_FILES['ts_img']['type'] == "image/jpeg")) {
		
        $sourceimg_file = $_FILES['ts_img']['tmp_name'];
		$destimg_file = "../assets/teachingSupport/image/".$datetime."_".$_FILES['ts_img']['name'];
        
		if (file_exists($destimg_file)) {
            unlink($destimg_file);
			$ts_imgPath = $destimg_file;
		}else{
		    $ts_imgPath = $destimg_file;
		}

	}else{
		echo ("<script LANGUAGE='JavaScript'> window.alert('Image is not in the required format.');</script>");
	}
}
if ( isset( $_FILES['ts_file'] ) ) {
    if(file_exists($old_file)){
        unlink($old_file);
      }
	if (($_FILES['ts_file']['type'] == "application/pdf") ) {
		$source_file = $_FILES['ts_file']['tmp_name'];
		$dest_file = "../assets/teachingSupport/pdf/".$datetime."_".$_FILES['ts_file']['name'];
        
		if (file_exists($dest_file)) {
            unlink($dest_file);
			$ts_filePath = $dest_file;
		}else{
		    $ts_filePath = $dest_file;
		}

	}else{
		echo ("<script LANGUAGE='JavaScript'> window.alert('Attachment is not in the required format.');</script>");
	}
}
$sql = "UPDATE tb_teachsupport SET ts_title=? ,ts_desc=? ,ts_date=? ,ts_imgPath=? ,ts_type=? ,ts_author=? ,ts_filePath=? WHERE ts_id = ?";

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{
    
    mysqli_stmt_bind_param($stmt, "ssssssss",$ts_title,$ts_desc,$dt,$ts_imgPath,$ts_type,$ts_author,$ts_filePath,$ts_id);

    if (mysqli_stmt_execute($stmt)){
  //$i=0;
  //successfully added
  //$result = $stmt->get_result();
  move_uploaded_file( $sourceimg_file, $destimg_file )
  or die ("Error!!");

  move_uploaded_file( $source_file, $dest_file )
  or die ("Error!!");
  $data=array(
    "status"=>"success",
  );
  echo json_encode($data);
}else{
    $data=array(
        "status"=>"fail"
      );
      echo json_encode($data);
}

}
?>