<?php

include "../dbconnect.php";


$sql = "SELECT * FROM tb_mindbooster";

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
                "mb_id" => $row["mb_id"],
                "mb_title" => $row["mb_title"],
                "mb_desc" => $row["mb_desc"],
                "mb_level" => $row["mb_level"],
                "mb_subject" => $row["mb_subject"],
                "mb_rDate" => $row["mb_rDate"],
                "mb_year" => $row["mb_year"],
                "mb_filePath" => $row["mb_filePath"]


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