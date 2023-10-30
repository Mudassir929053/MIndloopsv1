<?php

include "../../dbconnect.php";


$m_id = $_GET['m_id'];

$sql = "SELECT * FROM tb_magazines WHERE m_id = ?";

try{
    $stmt = mysqli_stmt_init($conn);
    

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_bind_param($stmt, "s", $m_id);

        mysqli_stmt_execute($stmt); 
        $result = $stmt->get_result();
        $finalData = array();

        while($row = $result->fetch_assoc()){    
            $data = array(
                "status" => "success",
                "m_id" => $row["m_id"],
                "m_imgPath" => $row["m_imgPath"],
                "m_title" => $row["m_title"],
                "m_edition" => $row["m_edition"],
                "m_rDate" => $row["m_rDate"],
                "m_author" => $row["m_author"],
                "m_desc" => $row["m_desc"],
                "m_filePath" => $row["m_filePath"],
                "m_pageLimit" => $row["m_pageLimit"]
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