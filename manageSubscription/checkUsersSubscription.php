<?php
//to check if user num reach package supportable number of users
include('../dbconnect.php');

$num=$_POST['numUser'];
$scode=$_POST['scode'];
$stmt = mysqli_stmt_init($conn);
$sql = "SELECT * FROM tb_scodes WHERE sc_id=? LIMIT 1";
// find scodes
if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{
  mysqli_stmt_bind_param($stmt, "s",$scode);
  
      if (mysqli_stmt_execute($stmt)){
        $result = $stmt->get_result(); 
        $scodeResult = $result->fetch_assoc();
        //find package type and duration
            $sql1 = "SELECT * FROM tb_spackages WHERE p_id=? LIMIT 1";
            if (!mysqli_stmt_prepare($stmt, $sql1)){
                echo json_encode("SQL ERROR");
            }else{
            mysqli_stmt_bind_param($stmt, "s",$scodeResult['sc_package']);
            
                if (mysqli_stmt_execute($stmt)){
                    $result1 = $stmt->get_result(); 
                    $packageResult = $result1->fetch_assoc();
                    if(mysqli_num_rows($result1)!=0){
                        //reach max user
                        if($num>=$packageResult['p_userNum']){
                            echo ("<script LANGUAGE='JavaScript'>
                            window.alert('The maximum number of users supportable under the package has been reached.');
                            
                            </script>");
                            exit();
                        }else{
                            //still can add user
                            $data=array(
                                "status"=>"success"
                              );
                              echo json_encode($data);
                              exit();
                        }
                    }else{
                        $data=array(
                            "status"=>"fail"
                          );
                          echo json_encode($data);
                          exit();
                    }

                }else{
                    $data=array(
                        "status"=>"fail"
                      );
                      echo json_encode($data);
                      exit();
                }
            }
        
        
    }else{
        $data=array(
            "status"=>"fail"
          );
          echo json_encode($data);
          exit();
    }

}


?>