<?php

include ("../dbconnect.php");
$c_id = $_POST['c_id'];
$partChosen = $_POST['c_part']; // for db table
if(!empty($_POST['subject'])){
$subject = $_POST['subject'];} //for mind booster tbl subject
if(!empty($_POST['tip_part'])){
  $tipsPart = $_POST['tip_part']; 
}
if(!empty($_POST['tipCategory'])){
$tipsCategory = $_POST['tipCategory']; 
}
if(!empty($_POST['date'])){
$chosenDate = getDate(strtotime(str_replace('/', '-', $_POST['date'])));
$dt = new DateTime(sprintf( "%04d-%02d-%02d", $chosenDate['year'], $chosenDate['mon'], 
$chosenDate['mday']));
$dt = $dt->format('Y-m-d');
}else{
  $chosenDate = getDate(strtotime(str_replace('/', '-', $_POST['date2'])));
  $dt = new DateTime(sprintf( "%04d-%02d-%02d", $chosenDate['year'], $chosenDate['mon'], 
$chosenDate['mday']));
$dt = $dt->format('Y-m-d');
}
$sql1 = "SELECT * FROM tb_contributes LEFT JOIN tb_contenttypes ON c_type=cn_id WHERE c_id=? LIMIT 1";
try {
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql1)){
  echo json_encode("SQL ERROR");
  }else{
  mysqli_stmt_bind_param($stmt, "i", $c_id);

  if (mysqli_stmt_execute($stmt)){
  $i=0;
  $result = $stmt->get_result(); 
  while($row = $result->fetch_assoc()){
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
  }
}
  else{
  $output=array(
    "status"=>"error"
  );
  echo json_encode($output);
  exit();
  }
  //echo json_encode($output);
}
} catch (PDOException $e) {
  $data = array(
      "status" => "fail"
  );
  echo json_encode($e);
}

if($partChosen=="mindbooster"){
  $table ="tb_mindbooster";
  $partChosen="Mind Booster";

  $sql = "INSERT INTO ".$table." (mb_title,mb_filePath,mb_desc,mb_subject,mb_rDate) VALUES (?,?,?,?,?)";

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{
  //$chosenDate = date("Y-m-d",strtotime($chosenDate));
    mysqli_stmt_bind_param($stmt, "sssss",$cTitle,$cFile,$desc,$subject,$dt);

    if (mysqli_stmt_execute($stmt)){
      $last_id = mysqli_insert_id($conn);

  // UPDATE CONTRIBUTION TBL
$sql2 = "UPDATE tb_contributes SET c_part=?, c_partID=? WHERE c_id = ?";

if (!mysqli_stmt_prepare($stmt, $sql2)){
    echo json_encode("SQL ERROR");
}else{
    
    mysqli_stmt_bind_param($stmt, "sis",$partChosen,$last_id,$c_id);

    if (mysqli_stmt_execute($stmt)){
  $data=array(
    "status"=>"success",
    "date"=>$dt
  );
  echo json_encode($data);
}else{
    $data=array(
        "status"=>"fail"
      );
      echo json_encode($data);
}

}
}else{
    $data=array(
        "status"=>"fail"
      );
      echo json_encode($data);
}

}
}else if($partChosen=="tips"){
  
  $partChosen="Tips";
  $table ="tb_tips";
  $sql = "INSERT INTO ".$table." (t_title,t_rDate,t_author,t_filePath,t_desc,t_audience,t_type) VALUES (?,?,?,?,?,?,?)";

  if (!mysqli_stmt_prepare($stmt, $sql)){
      echo json_encode("SQL ERROR");
  }else{
    //$chosenDate = date("Y-m-d",strtotime($chosenDate));
      mysqli_stmt_bind_param($stmt, "sssssss",$cTitle,$dt,$author,$cFile,$desc,$tipsPart,$tipsCategory);
  
      if (mysqli_stmt_execute($stmt)){
        $last_id = mysqli_insert_id($conn);
  
    // UPDATE CONTRIBUTION TBL
  $sql2 = "UPDATE tb_contributes SET c_part=?, c_partID=? WHERE c_id = ?";
  
  if (!mysqli_stmt_prepare($stmt, $sql2)){
      echo json_encode("SQL ERROR");
  }else{
      
      mysqli_stmt_bind_param($stmt, "sis",$partChosen,$last_id,$c_id);
  
      if (mysqli_stmt_execute($stmt)){
    $data=array(
      "status"=>"success",
      "date"=>$dt
    );
    echo json_encode($data);
  }else{
      $data=array(
          "status"=>"fail"
        );
        echo json_encode($data);
  }
  
  }
  }else{
      $data=array(
          "status"=>"fail"
        );
        echo json_encode($data);
  }
  
  }


}


?>