<?php

include ("../dbconnect.php");
$newEmail = $_POST['email'];
$scode=$_POST['scode'];


$stmt = mysqli_stmt_init($conn);
$sql = "SELECT * FROM tb_subscriptions WHERE s_user=?";

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{
  mysqli_stmt_bind_param($stmt, "s",$newEmail);
  
      if (mysqli_stmt_execute($stmt)){
        $result = $stmt->get_result(); 
        if(mysqli_num_rows($result)!=0){
          //there exists a subscription for this user
            while($userSubscription = $result->fetch_assoc())
            {    
              //check subscription ending date
                $sql2 = "SELECT * FROM tb_scodes WHERE sc_id = ? LIMIT 1";
                if (!mysqli_stmt_prepare($stmt, $sql2)){
                    echo json_encode("SQL ERROR");
                }else{    
                mysqli_stmt_bind_param($stmt, "i",$userSubscription['s_code']);

                if (mysqli_stmt_execute($stmt)){
                    //check subscription date status
                    $result2 = $stmt->get_result(); 
                    
                    while($subscriptionCode = $result2->fetch_assoc())
                    {  //echo $scode;
                      $date_now = date("Y-m-d");
                      $date2    = date($subscriptionCode['sc_eDate']);
                      if($date2 < $date_now ){
                        //expired, can add
                        
                            $sql1 = "INSERT INTO tb_subscriptions (s_user,s_code) VALUES (?, ?)";

                          if (!mysqli_stmt_prepare($stmt, $sql1)){
                              echo json_encode("SQL ERROR");
                          }else{
                              mysqli_stmt_bind_param($stmt, "si",$newEmail,$scode);

                              if (mysqli_stmt_execute($stmt)){
                                  $data=array(
                                    "status"=>"success"
                                  );
                                  echo json_encode($data);
                                  exit();
                              }else{
                                    $data=array(
                                        "status"=>"fail"
                                      );
                                      echo json_encode($data);
                                      exit();
                              }
                          }
                      }else{
                          //not expired, cannot add this email
                          echo ("<script LANGUAGE='JavaScript'>
                          window.alert('The email entered is under an active subscription.');
                          window.location.href='../login_and_register/login.php';
                          </script>");
                          exit();
                      }
                    }
                  
              }
             else{
                      $data=array(
                          "status"=>"fail"
                        );
                        echo json_encode($data);
                  }
                }
              }

            }else{
                  $sql1 = "INSERT INTO tb_subscriptions (s_user,s_code) VALUES (?, ?)";

                  if (!mysqli_stmt_prepare($stmt, $sql1)){
                      echo json_encode("SQL ERROR");
                  }else{
                      mysqli_stmt_bind_param($stmt, "si",$newEmail,$scode);

                      if (mysqli_stmt_execute($stmt)){
                    $data=array(
                      "status"=>"success"
                    );
                    echo json_encode($data);
                  }else{
                      $data=array(
                          "status"=>"fail"
                        );
                        echo json_encode($data);
                  }
            }
          }
      }else{
        $data=array(
            "status"=>"fail"
          );
          echo json_encode($data);
    }


}
?>