<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
include "../dbconnect.php";
$id = $_GET['c_id']; 
$fileSize ="";
    $sql = "SELECT * FROM tb_contributes LEFT JOIN tb_contenttypes ON c_type=cn_id WHERE c_id=? LIMIT 1";

    try {
        $stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)){
		echo json_encode("SQL ERROR");
	}else{

		mysqli_stmt_bind_param($stmt, "s", $id);

		if (mysqli_stmt_execute($stmt)){
      $i=0;
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $cid = $row['c_title'];
      $desc = $row['c_desc'];
      $author = $row['c_author'];
      $date = $row['c_date'];
      $cTitle = $row['c_title'];
      $contentType = $row['c_type'];
      $cPart = $row['c_part'];
      $cPartID = $row['c_partID'];
      $contentID = $row['cn_id'];
      $contentDesc = $row['cn_desc'];
      $cFile = $row['c_file'];
      $reversedFile = strrev($cFile);
      $fileExtension = strtok($reversedFile, '.');
      if(strrev($fileExtension)=="jpg" || strrev($fileExtension)=="jpeg"
      || strrev($fileExtension)=="png"
      ){
        $fileSize = "img";
      }else if(strrev($fileExtension)=="pdf"){
        $fileSize = "pdf";
      }

    $output=array(
        "title"=>$cid,
        "desc"=>$desc,
        "author"=>$author,
        "date"=>date('d F Y, h:i:s A',strtotime($date)),
        "contentType"=>$contentDesc,
        "file"=>$cFile,
        "fileSize"=>$fileSize,
    );
}
else{
    $output=array(
        "name"=>"error",
        "price"=>"error"
    );
}
echo json_encode($output);
}

    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($e);
    }
    
        
    ?>
    