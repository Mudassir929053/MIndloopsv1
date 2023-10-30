
<?php

include ("../dbconnect.php");
$p_name = $_POST['package_name'];
$p_duration = $_POST['package_duration'];
$duration_type = $_POST['duration_type'];
if($duration_type=="day"){
    $p_duration .=" day";
}else if($duration_type=="month"){

    $p_duration .=" month";
}else if($duration_type=="year"){
    
    $p_duration .=" year";
}
$p_price = $_POST['package_price'];
$p_userNum = $_POST['package_userNum'];
if ( isset( $_FILES['p_img'] ) ) {

	if (($_FILES['p_img']['type'] == "image/png") ||  ($_FILES['p_img']['type'] == "image/jpg") || ($_FILES['p_img']['type'] == "image/jpeg")) {
		$source_file = $_FILES['p_img']['tmp_name'];
		$dest_file = "../assets/img/package/".$_FILES['p_img']['name'];
        
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


$p_type = $_POST['package_type'];
if($p_type=='1'){
    //single
    $sql1 = "SELECT p_id FROM tb_spackages WHERE p_id LIKE ? ORDER BY p_id DESC LIMIT 1";
    $name = "1%";

    $stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql1)){
		echo json_encode("SQL ERROR");
	}else{
		mysqli_stmt_bind_param($stmt, "s", $name);
		if (mysqli_stmt_execute($stmt)){
            
            $result = $stmt->get_result(); 
            if($result!=null){
                while($row = $result->fetch_assoc() ){
                $p_id = $row['p_id'];
                $p_id++;
                }
                
            }else{
                $p_id = '1A';
            }
        }else{
            $data=array(
                "status"=>"fail"
              );
              echo json_encode($data);
              exit();
        }
    }
}else if($p_type=='2'){
    //family
    $sql2 = "SELECT p_id FROM tb_spackages WHERE p_id LIKE ? ORDER BY p_id DESC LIMIT 1";
    $name = "2%";

    $stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql2)){
		echo json_encode("SQL ERROR");
	}else{
		mysqli_stmt_bind_param($stmt, "s", $name);
		if (mysqli_stmt_execute($stmt)){
            
            $result = $stmt->get_result(); 
            if($result!=null){
                while($row = $result->fetch_assoc() ){
                    $p_id = $row['p_id'];
                    $p_id++;
                    }
            }else{
                $p_id = '2A';
            }
        }else{
            $data=array(
                "status"=>"fail"
              );
              echo json_encode($data);
              exit();
        }
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
$sql = "INSERT INTO tb_spackages (p_id,p_name,p_desc,p_duration,p_price,p_userNum,p_img) VALUES (?,?,?,?,?, ?,?)";

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{
    
    mysqli_stmt_bind_param($stmt, "ssssdis",$p_id,$p_name,$descStringList,$p_duration,$p_price,$p_userNum,$p_imgPath);

    if (mysqli_stmt_execute($stmt)){
  //$i=0;
  //successfully added
  //$result = $stmt->get_result();
  move_uploaded_file( $source_file, $dest_file )
  or die ("Error!!");
  $some_data = array(
    'catname' => $p_name, //CATEGORY NAME
    'catdescription' => $descStringList, //PROVIDE YOUR CATEGORY DESCRIPTION
    'userSecretKey' => '1p319zij-i6m8-4g18-rilj-7qvmegdp3vb8' //PROVIDE USER SECRET KEY HERE
  );  

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createCategory');  //PROVIDE API LINK HERE
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

  $resultToyyib = curl_exec($curl);

  $info = curl_getinfo($curl);  
  curl_close($curl);

  $obj = json_decode($resultToyyib);
  //echo $result;
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