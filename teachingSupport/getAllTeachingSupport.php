<?php

include "../dbconnect.php";

if(!empty($_GET['ts_type'])){
    
    $category = $_GET['ts_type'];
    if($category != "all"){
    if($category == "Pedagogy"){
        $category='TS1';
    }else if($category == "Curriculum"){
        $category ='TS2';
    }else if($category == "Assessment"){
        $category='TS3';
    }
$sql = "SELECT * FROM tb_teachsupport WHERE ts_type=?";

try{
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{
        mysqli_stmt_bind_param($stmt, "s", $category);

		if (mysqli_stmt_execute($stmt)){
        $result = $stmt->get_result();
        $finalData = array();

        while($row = $result->fetch_assoc()){    
            $data = array(
                "status" => "success",
                "ts_id" => $row["ts_id"],
                "ts_imgPath" => $row["ts_imgPath"],
                "ts_title" => $row["ts_title"],
                "ts_date" => $row["ts_date"],
                "ts_author" => $row["ts_author"],
                "ts_desc" => $row["ts_desc"],
                "ts_filePath" => $row["ts_filePath"],
                "allType" =>$_GET['ts_type']
            );
            
            array_push($finalData, $data);
        }

        echo json_encode($finalData);
    }
}}
catch(PDOException $e){
    $data = array(
        "status" => "fail"
    );
    echo json_encode($data);
}}else{
    $sql = "SELECT * FROM tb_teachsupport";

try{
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_execute($stmt); 
        $result = $stmt->get_result();
        $finalData = array();

        while($row = $result->fetch_assoc()){    
            $data = array(
                "status" => "success",
                "ts_id" => $row["ts_id"],
                "ts_imgPath" => $row["ts_imgPath"],
                "ts_title" => $row["ts_title"],
                "ts_date" => $row["ts_date"],
                "ts_author" => $row["ts_author"],
                "ts_desc" => $row["ts_desc"],
                "ts_type" => $row["ts_type"],
                "ts_filePath" => $row["ts_filePath"],
                "allType" =>"all"
            );
            
            array_push($finalData, $data);
        }

        echo json_encode($finalData);
    }
}
catch(PDOException $e){
    $data = array(
        "status" => "fail"
    );
    echo json_encode($data);
}
}
}else{
    $sql = "SELECT * FROM tb_teachsupport";

try{
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_execute($stmt); 
        $result = $stmt->get_result();
        $finalData = array();

        while($row = $result->fetch_assoc()){    
            $data = array(
                "status" => "success",
                "ts_id" => $row["ts_id"],
                "ts_imgPath" => $row["ts_imgPath"],
                "ts_title" => $row["ts_title"],
                "ts_date" => $row["ts_date"],
                "ts_author" => $row["ts_author"],
                "ts_desc" => $row["ts_desc"],
                "ts_type" => $row["ts_type"],
                "ts_filePath" => $row["ts_filePath"],
                "allType" =>"all"
            );
            
            array_push($finalData, $data);
        }

        echo json_encode($finalData);
    }
}
catch(PDOException $e){
    $data = array(
        "status" => "fail"
    );
    echo json_encode($data);
}
}


?>