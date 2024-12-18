<?php

include "../../dbconnect.php";


$t_id = $_GET['t_id'];

$sql = "SELECT *
FROM tb_tips
LEFT JOIN tb_videos ON tb_tips.t_video_id = tb_videos.v_id WHERE t_id = ?";

try{
    $stmt = mysqli_stmt_init($conn);
    

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_bind_param($stmt, "s", $t_id);

        mysqli_stmt_execute($stmt); 
        $result = $stmt->get_result();
        $finalData = array();

        while($row = $result->fetch_assoc()){    
            $data = array(
                "status" => "success",
                "t_id" => $row["t_id"],
                "t_imgPath" => $row["t_imgPath"],
                "t_title" => $row["t_title"],
                "t_audience" => $row["t_audience"],
                "t_video_id" => $row["t_video_id"],
                "t_rDate" => $row["t_rDate"],
                "t_author" => $row["t_author"],
                "t_desc" => $row["t_desc"],
                "t_filePath" => $row["t_filePath"],
                "t_type" => $row["t_type"]
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