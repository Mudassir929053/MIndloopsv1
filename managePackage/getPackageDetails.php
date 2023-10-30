<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
include "../dbconnect.php";
$id = $_GET['p_id'];   
    $sql = "SELECT * FROM tb_spackages WHERE p_id=?";

    try {
        $stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)){
		echo json_encode("SQL ERROR");
	}else{

		mysqli_stmt_bind_param($stmt, "s", $id);

		if (mysqli_stmt_execute($stmt)){
      $i=0;
      $result = $stmt->get_result(); 
  while($row = $result->fetch_assoc()){
    $pid = $row['p_id'];
    $imagePath = $row['p_img'];
    $imageHTML = "<img src='".$imagePath."' style='width:300px;height:220px;'></img>";
    $descList = $row['p_desc'];  
    $descriptionList=array();
    $descriptionList = explode(",",$descList);
    $descriptionList= array_filter($descriptionList);
    $output=array(
        "name"=>$row['p_name'],
        "price"=>$row['p_price'],
        "duration"=>$row['p_duration'],
        "numUser"=>$row['p_userNum'],
        "type"=>$pid[0],
        "descList"=>$descriptionList,
        "numDescription" => count($descriptionList),
        "image"=>$imageHTML,

    );
  }}
else{
    $output=array(
        "name"=>"error",
        "price"=>"error"
    );
}
echo json_encode($output);
}

        /* $packageStatement = $conn->prepare($sql);
        $packageStatement->execute();
        while($row = $packageStatement->fetch(PDO::FETCH_ASSOC)){
            $output=array(
                "name"=>$row['p_name'],
                "price"=>$row['p_price']
            );
        }
	    echo json_encode($output); */
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($e);
    }
    
        
    ?>
    