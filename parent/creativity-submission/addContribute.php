<?php

include ("../dbconnect.php");
$c_title = $_POST['c_title'];
$c_desc = $_POST['c_desc'];
$c_type = $_POST['c_type'];
$c_author = $_POST['c_author'];
$date = date('Y-m-d H:i:s');

if ( isset( $_FILES['c_file'] ) ) {

	if (($_FILES['c_file']['type'] == "image/png") ||  ($_FILES['c_file']['type'] == "image/jpg") || ($_FILES['c_file']['type'] == "image/jpeg" || $_FILES['c_file']['type'] == "application/pdf")) {
		$source_file = $_FILES['c_file']['tmp_name'];
		$dest_file = "../assets/contribute/".$c_author."_".$_FILES['c_file']['name'];
        
		if (file_exists($dest_file)) {
            unlink($dest_file);
			$c_file = $dest_file;
		}else{
		    $c_file = $dest_file;
		}

	}else{
		echo ("<script LANGUAGE='JavaScript'> window.alert('Attachment is not in the required format.');</script>");
	}
}


$sql = "INSERT INTO tb_contributes (c_author,c_date,c_title,c_desc,c_file,c_type) VALUES (?,?,?,?, ?,?)";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{
    
    mysqli_stmt_bind_param($stmt, "ssssss",$c_author,$date,$c_title,$c_desc,$c_file,$c_type);

    if (mysqli_stmt_execute($stmt)){
  //$i=0;
  //successfully added
  //$result = $stmt->get_result();
  move_uploaded_file( $source_file, $dest_file )
  or die ("Error!!");
  
  $data=array(
    "status"=>"success",
  );
  echo json_encode($data);
  ?>
    <script>
      window.location.href=history.back();
    </script>
  <?php
}else{
    $data=array(
        "status"=>"fail"
      );
      echo json_encode($data);
}

}
?>