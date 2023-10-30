<?php

include "../dbconnect.php";

if(isset($_GET['sj_id'])){
    
    $sj_id = $_GET['sj_id'];

}else{
    exit(); 

} 


if(isset($_GET['year'])){
    
    if(is_null($_GET['year'])){
        $year = date("Y"); 
    }else {
        $year = $_GET['year'];
    }

}else{
    exit(); 

} 

$sql = "SELECT * FROM tb_mindbooster where mb_subject = ? and mb_year= ?";

try{
    $stmt = mysqli_stmt_init($conn);
    

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_bind_param($stmt, "ss", $sj_id, $year);

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