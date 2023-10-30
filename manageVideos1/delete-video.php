<?php

include "../dbconnect.php";

$v_id = $_GET['v_id'];


$sql = "DELETE FROM tb_videos WHERE v_id = ?";


try{
    $stmt = mysqli_stmt_init($conn);
    

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_bind_param($stmt, "s", $v_id);

        // $sql2 = "SELECT t_filePath FROM tb_tips WHERE t_id = ?";

        // $stmt2 = mysqli_stmt_init($conn);
        // mysqli_stmt_prepare($stmt2,$sql2);
        // mysqli_stmt_bind_param($stmt2,"s",$t_id );
        // mysqli_stmt_execute($stmt2);
    
        // $resultData = mysqli_stmt_get_result($stmt2);
        // if($row = mysqli_fetch_assoc($resultData)){
        //     // unlink($row['m_imgPath']);
        //     unlink($row['t_filePath']);

        //     //return $row;
        // }else{
        //     mysqli_stmt_close($stmt);
        // }
        
        mysqli_stmt_execute($stmt); 
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()){    
            $data = array(
                "status" => "success"
            );
            
        }

        echo json_encode($data);
    }
}
catch(PDOException $e){
    $data = array(
        "status" => "fail"
    );
    echo json_encode($data);
}


?>