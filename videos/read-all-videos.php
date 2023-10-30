<?php

include "../dbconnect.php";


$sql = "SELECT * FROM tb_videos";

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
                "v_id" => $row["v_id"],
                "v_imgPath" => $row["v_path"],
                "v_title" => $row["v_title"],
                "v_rDate" => $row["v_rDate"],
                "v_desc" => $row["v_desc"],
                "v_path" => $row["v_path"],
                "v_audience" => $row["v_audience"],
                "v_type" => $row["v_type"]
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


?>