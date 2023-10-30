<?php

include "../dbconnect.php";

$m_id = $_GET['m_id'];


$sql = "DELETE FROM tb_magazines WHERE m_id = ?";


try{
    $stmt = mysqli_stmt_init($conn);
    

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_bind_param($stmt, "s", $m_id);

        $sql2 = "SELECT m_imgPath,m_filePath FROM tb_magazines WHERE m_id = ?";

        $stmt2 = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt2,$sql2);
        mysqli_stmt_bind_param($stmt2,"s",$m_id );
        mysqli_stmt_execute($stmt2);
    
        $resultData = mysqli_stmt_get_result($stmt2);
        if($row = mysqli_fetch_assoc($resultData)){

            unlink($row['m_imgPath']);
            unlink($row['m_filePath']);

            $imgPath = $row['m_imgPath'];
            $imgPathFolder = substr($imgPath, 0, 50);
            rmdir($imgPathFolder);

            $filePath = $row['m_filePath'];
            $filePathFolder = substr($filePath, 0, 52);
            rmdir($filePathFolder);

            //return $row;
        }else{
            mysqli_stmt_close($stmt);
        }
        
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