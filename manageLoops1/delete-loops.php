<?php

include "../dbconnect.php";

$lp_id = $_GET['lp_id'];

function deleteAll($dir) {
    foreach(glob($dir . '/*') as $file) {
    if(is_dir($file))
    deleteAll($file);
    else
    unlink($file);
    }
    rmdir($dir);
    }


$sql = "DELETE FROM tb_loops WHERE lp_id =?";


try{
    $stmt = mysqli_stmt_init($conn);
    

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_bind_param($stmt, "s", $lp_id);

        $sql2 = "SELECT  lp_imgpath, lp_filepath FROM tb_loops WHERE lp_id = ?";

        $stmt2 = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt2,$sql2);
        mysqli_stmt_bind_param($stmt2,"i",$lp_id );
        mysqli_stmt_execute($stmt2);
    
        $resultData = mysqli_stmt_get_result($stmt2);
        if($row = mysqli_fetch_assoc($resultData)){

            if(file_exists($row['lp_imgpath'])){
                unlink($row['lp_imgpath']);
            }

            $file_name = $row['lp_filepath'];  
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            if($extension != 'pdf')  { 

                if(is_dir($row['lp_filepath'])){
                    $dirname = $row['lp_filepath'];
                    
                // delete all files and sub-folders from a folder
                deleteAll($dirname);

                }



            }else{
                if(file_exists($row['lp_filepath'])){
                    unlink($row['lp_filepath']);
                }

            }
                   
        }else{
            // mysqli_stmt_close($stmt);
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