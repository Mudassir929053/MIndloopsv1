<?php

include "../dbconnect.php";


$sql = "SELECT distinct(mb_year) FROM tb_mindbooster ORDER BY mb_year";

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
                "mb_year" =>  $row["mb_year"]
            );
            // $data = $row["mb_year"];

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
