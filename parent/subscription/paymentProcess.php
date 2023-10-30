<?php
include "../dbconnect.php";
$nama=$_POST['name'];
$email=$_POST['email1'];
if(isset($_POST['email2'])){
  $email2=$_POST['email2'];
}
if(isset($_POST['email3'])){
  $email3=$_POST['email3'];
}
if(isset($_POST['email4'])){
  $email4=$_POST['email4'];
}
if(isset($_POST['email5'])){
  $email5=$_POST['email5'];
}

$emailList=array();
array_push($emailList,$email,$email2,$email3,$email4,$email5);
$emailList= array_filter($emailList);
$sql = "SELECT * FROM tb_users WHERE u_email=?";
$stmt = mysqli_stmt_init($conn);
$resultMessage="";
if(empty($emailList)) 
  {
    echo("You didn't select any packages.");
  } 
  else 
  {
    $N = count($emailList);

    
      //check if emails are registered
	if (!mysqli_stmt_prepare($stmt, $sql)){
		echo json_encode("SQL ERROR");
	}else{
    for($i=0; $i < $N; $i++)
    {
		mysqli_stmt_bind_param($stmt, "s",$emailList[$i]);

		if (mysqli_stmt_execute($stmt)){
      
      $result = $stmt->get_result(); 
      $user = $result->fetch_assoc(); 
      if($user == null){
        $resultMessage ="error";
      }else{
        $sql2 = "SELECT * FROM tb_subscriptions WHERE s_user=?";
        $stmt2 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt2, $sql2)){
          echo json_encode("SQL ERROR");
        }else{
          mysqli_stmt_bind_param($stmt2, "s",$emailList[$i]);

            if (mysqli_stmt_execute($stmt2)){
              $result2 = $stmt2->get_result(); 
              $user2 = $result2->fetch_assoc(); 
              if($user2 != null){
                $resultMessage ="errorSubscribed";

              }
            }
        }
      }
     }else{
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('Something went wrong.');
      window.location.href='../login_and_register/login.php';
      </script>");
      exit();
        
    } 
    if($resultMessage=="error"){
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('The email you entered was not registered. Please make sure it is registered.');
      window.location.href='../login_and_register/login.php';
      </script>");
      exit();
    }else if($resultMessage=="errorSubscribed"){
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('The email you entered was subscribed. Please try again.');
      window.location.href='../login_and_register/login.php';
      </script>");
      exit();
    }
  }
    }
  }
//print($emailList);
$query = http_build_query(array('email' => $emailList));
//print($query);
$telefon=$_POST['phone'];
$harga=$_POST['price'];
$package= $_POST['packageID'];
$packageName= $_POST['packageName'];
$rmx100=($harga*100);
if($package=='1A'){
$categoryCode = 'y9j3kt6w';
}else if($package=='1B'){
    $categoryCode = 'roanyjt1';
}else if($package=='2A'){
    $categoryCode = 'pz4d37ee';
}else if($package=='2B'){
    $categoryCode = 'b2w0q7hu';
}

$some_data = array(
    'userSecretKey'=> '1p319zij-i6m8-4g18-rilj-7qvmegdp3vb8',
    'categoryCode'=> $categoryCode,
    'billName'=> $packageName,
    'billDescription'=> 'MindLoops Subscription Package RM'.$harga,
    'billPriceSetting'=>1,
    'billPayorInfo'=>1,
    'billAmount'=>$rmx100,
    'billReturnUrl'=>'https://mindloopsweb.000webhostapp.com/subscription/successPayment.php?'.$query.'&p_id='.$package.'',
    'billCallbackUrl'=>'',
    'billExternalReferenceNo'=>'',
    'billTo'=>$nama,
    'billEmail'=>$email,
    'billPhone'=>$telefon,
    'billSplitPayment'=>0,
    'billSplitPaymentArgs'=>'',
    'billPaymentChannel'=>2,
  );  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);
  $result = curl_exec($curl);
  $info = curl_getinfo($curl);  
  curl_close($curl);
  //$obj = json_decode($result,true);
  //echo("<script>console.log('$obj[0]['BillCode']');</script>");
  //$billcode=$obj[0]['BillCode'];

  //$result = curl_exec($curl);
  //$info = curl_getinfo($curl);  
  //curl_close($curl);
  $obj = json_decode($result,true);
  $billcode=$obj[0]['BillCode'];
  //echo $billcode;
?>
<!--SEND USER TO TOYYIBPAY PAYMENT-->
<script type="text/javascript">
    //redirect to payment gateway
    console.log(<?php $billcode?>);
   window.location.href="https://dev.toyyibpay.com/<?php echo $billcode;?>"; 
 </script>
