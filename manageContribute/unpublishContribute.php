<?php

include ("../dbconnect.php");
$c_id = $_POST['c_id'];

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

if($cPart=="Mind Booster"){
  $table ="tb_mindbooster";
  $sql = "DELETE FROM ".$table." WHERE mb_id=?";

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{
    mysqli_stmt_bind_param($stmt, "s",$cPartID);

    if (mysqli_stmt_execute($stmt)){

  // UPDATE CONTRIBUTION TBL EMPTY OUT PART
$sql2 = "UPDATE tb_contributes SET c_part=?, c_partID=? WHERE c_id = ?";

if (!mysqli_stmt_prepare($stmt, $sql2)){
    echo json_encode("SQL ERROR");
}else{
    $emptyID ="";
    $emptyPart ="";
    mysqli_stmt_bind_param($stmt, "sis",$emptyPart,$emptyID,$c_id);

    if (mysqli_stmt_execute($stmt)){
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
}else{
    $data=array(
        "status"=>"fail"
      );
      echo json_encode($data);
}

}
}else if($cPart=="Tips"){
  $table ="tb_tips";
  $sql = "DELETE FROM ".$table." WHERE t_id=?";

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{
    mysqli_stmt_bind_param($stmt, "s",$cPartID);

    if (mysqli_stmt_execute($stmt)){

  // UPDATE CONTRIBUTION TBL EMPTY OUT PART
$sql2 = "UPDATE tb_contributes SET c_part=?, c_partID=? WHERE c_id = ?";

if (!mysqli_stmt_prepare($stmt, $sql2)){
    echo json_encode("SQL ERROR");
}else{
    $emptyID ="";
    $emptyPart ="";
    mysqli_stmt_bind_param($stmt, "sis",$emptyPart,$emptyID,$c_id);

    if (mysqli_stmt_execute($stmt)){
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
}else{
    $data=array(
        "status"=>"fail"
      );
      echo json_encode($data);
}

}
}





?>