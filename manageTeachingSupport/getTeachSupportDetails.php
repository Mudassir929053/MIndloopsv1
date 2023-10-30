<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
include "../dbconnect.php";
$id = $_GET['ts_id']; 
$fileSize ="";
    $sql = "SELECT * FROM tb_teachsupport LEFT JOIN tb_teachsupporttype ON ts_type=tst_id WHERE ts_id=? LIMIT 1";

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
      $cid = $row['ts_id'];
      $desc = $row['ts_desc'];
      $author = $row['ts_author'];
      $date = $row['ts_date'];
      $cTitle = $row['ts_title'];
      $contentType = $row['ts_type'];
      $contentID = $row['tst_id'];
      $contentDesc = $row['tst_desc'];
      $cFile = $row['ts_filePath'];
      $cImg = $row['ts_imgPath'];
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
        "title"=>$cTitle,
        "desc"=>$desc,
        "author"=>$author,
        "date"=>date('d F Y, h:i:s A',strtotime($date)),
        "datePublic"=>date('d F Y',strtotime($date)),
        "contentType"=>$contentDesc,
        "file"=>$cFile,
        "fileSize"=>$fileSize,
        "fileImage"=>$cImg,
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
    