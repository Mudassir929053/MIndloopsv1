<?php
include "../dbconnect.php";
$email=$_GET['email'];
$p_id=$_GET['p_id'];
$status=$_GET['status_id'];
//print($status);
$billcode=$_GET['billcode'];
//print($billcode);
$message=$_GET['msg'];
//print($message);
$transactionID=$_GET['transaction_id'];
$duration =1;
//print($transactionID);
if($status==1){
    echo "Successfully paid. Enjoy using MindLoops! Thank you!";
    //include "dbconnect.php";
    $count = count($email);
    $newDate = date('Y-m-d');

    $checkPDurationSQL = "SELECT * FROM tb_spackages WHERE p_id= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $checkPDurationSQL)){
		echo json_encode("SQL ERROR");
	}else{
		mysqli_stmt_bind_param($stmt, "s",$p_id);

		if (mysqli_stmt_execute($stmt)){
            $result = $stmt->get_result(); 
            while($row = $result->fetch_assoc()){
                $duration = $row['p_duration'];
                $durationType = substr($duration, strpos($duration, " ") + 1); 
                
                if($durationType=="day"){
                    $duration = intval(strtok($duration," "));
                    $newDate = date_add(date_create(date("Y-m-d")),date_interval_create_from_date_string($duration." day"));
                    $newDate = date_format($newDate,"Y-m-d");
                }else if($durationType=="month"){
                    $duration = intval(strtok($duration," "));
                    $newDate = date_add(date_create(date("Y-m-d")),date_interval_create_from_date_string($duration." month"));
                    $newDate = date_format($newDate,"Y-m-d");
                }else if($durationType=="year"){
                    $duration = intval(strtok($duration," "));
                    $newDate = date_add(date_create(date("Y-m-d")),date_interval_create_from_date_string($duration." year"));
                    
                    $newDate = date_format($newDate,"Y-m-d");

                }
            }
        }
    }
	

 $sql = "INSERT INTO tb_scodes(sc_package, sc_count, sc_sDate, sc_eDate,sc_paymentID,sc_billCode) VALUES(?, ?, ?, ?, ?, ?);";
	if (!mysqli_stmt_prepare($stmt, $sql)){
		echo json_encode("SQL ERROR");
	}else{

        mysqli_stmt_bind_param($stmt, "sissss",$p_id, $count,date("Y-m-d") , $newDate,$transactionID,$billcode);

		if (mysqli_stmt_execute($stmt)){
            echo "Successfully added to scodes";
            $sql = 'SELECT * from tb_scodes WHERE sc_paymentID=?';
            if (!mysqli_stmt_prepare($stmt, $sql)){
                echo json_encode("SQL ERROR");
            }else{
        
                mysqli_stmt_bind_param($stmt, "s",$transactionID);
        
                if (mysqli_stmt_execute($stmt)){
                    $result = $stmt->get_result(); 
  while($row = $result->fetch_assoc()){
    if (mysqli_affected_rows($conn) > 0) {
        // echo $row[0];
             
         $scode_id=$row['sc_id'];
         for($i=0; $i < $count; $i++)
     {
         //try{
         /* $sql2 = 'INSERT INTO tb_subscriptions(s_user, s_code) VALUES
         ("'.$email[$i].'", "'.$scode_id.'")'; */
           $sql2 = "INSERT INTO tb_subscriptions(s_user, s_code) VALUES(?, ?)";
           //$stmt = mysqli_stmt_init($conn);
           if (!mysqli_stmt_prepare($stmt, $sql2)){
             echo json_encode("SQL ERROR");
         }else{
     
             mysqli_stmt_bind_param($stmt, "si",$email[$i], $scode_id);
             if (mysqli_stmt_execute($stmt)){
                 // output data of each row
                 echo "Successfully added to subscription ".$email[$i];
             
             } 
         }        
                
         //execute sql commands that will return result set
         //$result = mysqli_query($conn, $sql2);
         /* }catch (mysqli_sql_exception $e) {
             echo ("<script LANGUAGE='JavaScript'>
                 window.alert('Some user emails you have inserted are not ');
                 window.location.href='../index.php';
                 </script>");
         } */
         //check records fetched available
         /* if (mysqli_affected_rows($conn) > 0) {
             // output data of each row
             echo "Successfully added to subscription ".$email[$i];
             
         
         } 
         else {
             echo "No results";
         } */
     }
     echo ("<script LANGUAGE='JavaScript'>
                 window.alert('Succesfully Subscribed.');
                 window.location.href='../login_and_register/login.php';
                 </script>");
     }
     
     else {
         echo "No results";
     }
  }
                }}
        /* $result2 = mysqli_query($conn, $sql);
        while($row =mysqli_fetch_assoc($result2)) {
        //check records fetched available
        
    } */
			
        }else{

			echo json_encode("SQL ERROR:" + mysqli_error($conn));
		}
    }
}else if($status==2){
    //echo "Pending payment. Please remember to pay before you registered. The transaction id is ".$transactionID;
    /* echo '<script type="text/javascript">
    window.alert("The system is processing your transaction.");
   window.location.href="https://dev.toyyibpay.com/'.$billcode.'"; 
 </script>'; */

    $count = count($email);
    $newDate = date('Y-m-d');

    //to check selected package duration
    $checkPDurationSQL = "SELECT * FROM tb_spackages WHERE p_id= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $checkPDurationSQL)){
        echo json_encode("SQL ERROR");
    }else{
        mysqli_stmt_bind_param($stmt, "s",$p_id);

        if (mysqli_stmt_execute($stmt)){
            $result = $stmt->get_result(); 
            while($row = $result->fetch_assoc()){
                $duration = $row['p_duration'];
                $durationType = substr($duration, strpos($duration, " ") + 1); 
                
                if($durationType=="day"){
                    $duration = intval(strtok($duration," "));
                    $newDate = date_add(date_create(date("Y-m-d")),date_interval_create_from_date_string($duration." day"));
                    $newDate = date_format($newDate,"Y-m-d");
                }else if($durationType=="month"){
                    $duration = intval(strtok($duration," "));
                    $newDate = date_add(date_create(date("Y-m-d")),date_interval_create_from_date_string($duration." month"));
                    $newDate = date_format($newDate,"Y-m-d");
                }else if($durationType=="year"){
                    $duration = intval(strtok($duration," "));
                    $newDate = date_add(date_create(date("Y-m-d")),date_interval_create_from_date_string($duration." year"));
                    
                    $newDate = date_format($newDate,"Y-m-d");

                }
            }
        }
    }
    
    // add into scodes table db
    $sql = "INSERT INTO tb_scodes(sc_package, sc_count, sc_sDate, sc_eDate,sc_paymentID,sc_billCode) VALUES(?, ?, ?, ?, ?, ?);";
    if (!mysqli_stmt_prepare($stmt, $sql)){
        echo json_encode("SQL ERROR");
    }else{

        mysqli_stmt_bind_param($stmt, "sissss",$p_id, $count,date("Y-m-d") , $newDate,$transactionID,$billcode);

        if (mysqli_stmt_execute($stmt)){
            echo "Successfully added to scodes";
            $sql = 'SELECT * from tb_scodes WHERE sc_paymentID=?';
            if (!mysqli_stmt_prepare($stmt, $sql)){
                echo json_encode("SQL ERROR");
            }else{
        
                mysqli_stmt_bind_param($stmt, "s",$transactionID);
        
                if (mysqli_stmt_execute($stmt)){
                    $result = $stmt->get_result(); 
    while($row = $result->fetch_assoc()){
    if (mysqli_affected_rows($conn) > 0) {
        // echo $row[0];
            
        $scode_id=$row['sc_id'];
        for($i=0; $i < $count; $i++)
    {
        // add into subscription table
            $sql2 = "INSERT INTO tb_subscriptions(s_user, s_code) VALUES(?, ?)";
            //$stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql2)){
            echo json_encode("SQL ERROR");
        }else{
    
            mysqli_stmt_bind_param($stmt, "si",$email[$i], $scode_id);
            if (mysqli_stmt_execute($stmt)){
                // output data of each row
                echo "Successfully added to subscription ".$email[$i];
            
            } 
        }        
    }
    echo ("<script LANGUAGE='JavaScript'>
                window.alert('Your subscription/transaction is pending. Please be patient, thank you.');
                window.location.href='../login_and_register/login.php';
                </script>");
    }
  
    else {
        echo "No results";
    }
    }
             }
            }
         
     }else{

         echo json_encode("SQL ERROR:" + mysqli_error($conn));
     }
 }

}else if ($status ==3){
    
 //inactivate bill for failed payment
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
  echo $result;

  echo '<script type="text/javascript">
    window.alert("Payment Failed. Please try again.");
    window.location.href="../login_and_register/login.php";
 </script>'; 
//window.location.href="https://dev.toyyibpay.com/'.$billcode.'"; 
}
?>

