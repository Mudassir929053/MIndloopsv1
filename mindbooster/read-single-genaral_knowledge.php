<?php

include "../dbconnect.php";


$l_id = $_GET['l_id'];

$sql = "SELECT *
FROM tb_lessons
 WHERE l_id = ?";

try{
    $stmt = mysqli_stmt_init($conn);
    

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_bind_param($stmt, "s", $l_id);

        mysqli_stmt_execute($stmt); 
        $result = $stmt->get_result();
        $finalData = array();

        while($row = $result->fetch_assoc()){    
            $data = array(
                "status" => "success",
                "l_id" => $row["l_id"],
                "l_image" => $row["l_image"],
                "l_name" => $row["l_name"],
                "l_created_date" => $row["l_created_date"],
                "l_lesson_desc" => $row["l_lesson_desc"]
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