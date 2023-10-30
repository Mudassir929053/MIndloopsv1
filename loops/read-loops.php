<?php

include "../dbconnect.php";

if(isset($_GET['lp_id'])){
    $lp_id = $_GET['lp_id'];
}

$sql = "SELECT * FROM tb_loops where lp_id = ? ";

try{
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_bind_param($stmt, "s", $lp_id);

        mysqli_stmt_execute($stmt); 
        $result = $stmt->get_result();
        $finalData = array();
        
        while($row = $result->fetch_assoc()){    
            $data = array(
                "status" => "success",
                "lp_id" => $row["lp_id"],
                "lp_title" => $row["lp_title"],
                "lp_desc" => $row["lp_desc"],
                "lp_type" => $row["lp_type"],
                "lp_date" => $row["lp_date"],
                "lp_imgpath" => $row["lp_imgpath"],
                "lp_filepath" => $row["lp_filepath"]
                

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