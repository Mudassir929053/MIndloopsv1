<?php

include ("../dbconnect.php");
$p_name = $_POST['package_name'];
$p_duration = $_POST['package_duration'];
$p_price = $_POST['package_price'];
$p_userNum = $_POST['package_userNum'];
$p_id = $_POST['packageID'];
$old_img="";
$stmt = mysqli_stmt_init($conn);

if ( isset( $_FILES['p_img'] ) ) {
    $sql1 = "SELECT * FROM tb_spackages WHERE p_id = ?";

    if (!mysqli_stmt_prepare($stmt, $sql1)){
        echo json_encode("SQL ERROR");
    }else{
        
        mysqli_stmt_bind_param($stmt, "s",$p_id);
        if (mysqli_stmt_execute($stmt)){
      //$i=0;
      //successfully added
      $result = $stmt->get_result();
      while($row = $result->fetch_assoc()){
        $old_img = $row['p_img'];
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
	if (($_FILES['p_img']['type'] == "image/png") ||  ($_FILES['p_img']['type'] == "image/jpg") || ($_FILES['p_img']['type'] == "image/jpeg")) {
		$date = new DateTime();
        $date = $date->format('d-m-Y_H-i-s');
        $source_file = $_FILES['p_img']['tmp_name'];
		$dest_file = "../assets/img/package/".$date."_".$_FILES['p_img']['name'];
        
		if (file_exists($dest_file)) {
            unlink($dest_file);
			$p_imgPath = $dest_file;
		}else{
		    $p_imgPath = $dest_file;
		}

	}else{
		echo ("<script LANGUAGE='JavaScript'> window.alert('Image is not in the required format.');</script>");
	}
}

$descriptionList=array();

$i=0;
foreach($_POST as $key => $value) {
    if (strpos($key, 'desc') === 0) {
        // value starts desc
        $descriptionList[$i]=$value;
        $i++;
    }
}
$descriptionList= array_filter($descriptionList);
$descStringList = implode(",",$descriptionList);
$sql = "UPDATE tb_spackages SET p_name = ?,p_desc = ?,p_duration = ?,p_price = ?,p_userNum = ?,p_img=? WHERE p_id = ?";

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{
    
    mysqli_stmt_bind_param($stmt, "sssdiss",$p_name,$descStringList,$p_duration,$p_price,$p_userNum,$p_imgPath,$p_id);

    if (mysqli_stmt_execute($stmt)){
  //$i=0;
  //successfully added
  //$result = $stmt->get_result();

  move_uploaded_file( $source_file, $dest_file )
  or die ("Error!!");
  //rename($dest_file,"../assets/img/package/".$date."_".$_FILES['p_img']['name']);
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