<?php
include('../dbconnect.php');
$billcode = $_GET['billCode'];
$scode = $_GET['s'];

$some_data = array(
    'secretKey' => '1p319zij-i6m8-4g18-rilj-7qvmegdp3vb8', //PROVIDE USER SECRET KEY HERE
    'billCode' => $billcode //PROVIDE BILL CODE HERE
  );  

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/inactiveBill'); 
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

  $result = curl_exec($curl);

  $info = curl_getinfo($curl);  
  curl_close($curl);

  $obj = json_decode($result);
  //echo $result;
  //delete data from db
 //1. dlt subscription users
$sql1 = "DELETE FROM tb_subscriptions WHERE s_code=?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql1)){
    echo json_encode("SQL ERROR");
}else{
    mysqli_stmt_bind_param($stmt, "s", $scode);
    if (mysqli_stmt_execute($stmt)){
        $sql2 = "DELETE FROM tb_scodes WHERE sc_billCode=?";
        if (!mysqli_stmt_prepare($stmt, $sql2)){
            echo json_encode("SQL ERROR");
        }else{
            mysqli_stmt_bind_param($stmt, "s", $billcode);
            if (mysqli_stmt_execute($stmt)){
            echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Successfully deactivate bill.');
                        window.location.href='../login_and_register/login.php';
                        </script>");
            }else{
                $data=array(
                    "status"=>'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Subscription does not exist in DB. Therefore, can\'t delete.</div>'
                  );
                  echo json_encode($data);
                  exit();
            }
        }
    }else{
        $data=array(
            "status"=>'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Subscription code does not exist in DB. Therefore, can\'t delete.</div>'
          );
          echo json_encode($data);
          exit();
    }
}






?>