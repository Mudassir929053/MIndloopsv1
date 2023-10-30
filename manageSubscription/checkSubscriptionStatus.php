<?php

include ("../dbconnect.php");
//include ("checkLoggedIn.php");
session_start(); 
if( !isset($_SESSION["userType"]) ){
  $login=false;
}else{
  $login=true;
}
$numUser=0;
    if($login==true){
    $email = $_SESSION["email"]; 
}
    else{
        $email="";
    }
    $sql = "SELECT * FROM tb_subscriptions WHERE s_code = ( select s_code from tb_subscriptions where s_user = ? )";
    //$result= mysqli_query($conn,$sql); 
    $stmt = mysqli_stmt_init($conn);
    $scode='';
    if (!mysqli_stmt_prepare($stmt, $sql)){
		echo json_encode("SQL ERROR");
	}else{
		mysqli_stmt_bind_param($stmt, "s",$email);
        $i=0;
        
		if (mysqli_stmt_execute($stmt)){
            $result = $stmt->get_result(); 
            $output ='
            
        <div id="subscriptionDetails" class="container">
        <h3>Subscription Details: </h3>
        </div>
            <div class="container">
<div class="row">
<div class="col-lg-12">
<h4>The users under your subscription:</h4>
    
    <table id="tbList" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
    <thead>
    <th>No.</th>
        <th>Email</th>
        <th>Name</th>
    </thead>';
            //$user = $result->fetch_assoc(); 
            if(mysqli_num_rows($result)!=0){
                $numUser=mysqli_num_rows($result);
            while($row = $result->fetch_assoc() ){
            if($i==0){
                if(mysqli_num_rows($result)==1){
                    $output .= '<tbody>
                            <tr>
                            <td colspan="3">You do not have any emails other than yours under this subscription. </td>
                            </tbody>';
                }
                        }else{
                            //get user details
                            $sql3="SELECT * FROM tb_users WHERE u_email=? LIMIT 1";
                            $stmt2 = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt2, $sql3)){
                                echo json_encode("SQL ERROR");
                            }else{
                                mysqli_stmt_bind_param($stmt2, "s",$row['s_user']);
                                if (mysqli_stmt_execute($stmt2)){
                                    $result3 = $stmt2->get_result(); 
                                    $user = $result3->fetch_assoc(); 
                            $output .= '<tbody>
                            <tr>
                            <td>'.$i.'</td>
                            <td>'. $row['s_user'].'</td>
                            <td>'.$user['u_name'].'</td>
                            </tbody>';
                            }}
                        }
                $scode = $row['s_code'];
                //echo $row['s_code'];
             $i++; 
            }
            $output.='</table>
                     </div>
                 </div>
             </div> 
             ';    }else{
                $data = array(
                    "subscribedStatus"=>false,
                    "login"=>$login
                );
                echo json_encode($data);
                exit();
             }    
                //check subscription ending date
                $sql2 = "SELECT * FROM tb_scodes WHERE sc_id = ? LIMIT 1";
                if (!mysqli_stmt_prepare($stmt, $sql2)){
                    echo json_encode("SQL ERROR");
                }else{

                    mysqli_stmt_bind_param($stmt, "i",$scode);
            
                    if (mysqli_stmt_execute($stmt)){
                        //check subscription date status
                        $result2 = $stmt->get_result(); 
                        $subscriptionCode = $result2->fetch_assoc(); 
                        //echo $scode;
                        $date_now = date("Y-m-d");
                        $date2    = date($subscriptionCode['sc_eDate']);
                        if($date2 < $date_now ){
                            $data = array(
                                "subscribedStatus"=>false,
                                "login"=>$login
                            );
                            echo json_encode($data);
                            exit();
                        }else{
                            // START check bill status from toyyibpay
                            $some_data = array(
                                'billCode' => $subscriptionCode['sc_billCode'],
                                //to check for pending put 2
                                //'billpaymentStatus' => '2'
                            );  
                            $curl = curl_init();
                            
                            curl_setopt($curl, CURLOPT_POST, 1);
                            curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/getBillTransactions');  
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);
                            
                            $bill = curl_exec($curl);
                            $info = curl_getinfo($curl);  
                            curl_close($curl);
                            $obj = json_decode($bill,true);
                            $billstate=$obj[0]['billpaymentStatus'];
                            //echo $billstate;
                            //echo $billStatus;
                            // END check bill status from toyyibpay
                            
                            //START get package details, show subscription details output
                            $sql4 = "SELECT * FROM tb_spackages WHERE p_id = ? LIMIT 1";
                            if (!mysqli_stmt_prepare($stmt, $sql4)){
                                echo json_encode("SQL ERROR");
                            }else{
            
                                mysqli_stmt_bind_param($stmt, "s",$subscriptionCode['sc_package']);
                                
                                if (mysqli_stmt_execute($stmt)){ 
                                    $result4 = $stmt->get_result(); 
                        $subsPackageDetails = $result4->fetch_assoc(); 
                        $sDate = date("d/m/Y", strtotime($subscriptionCode['sc_sDate']));
                            $subscriptionDetails = "
                            Package Name: ".$subsPackageDetails['p_name']."<br>
                            Starting date: ".$sDate ."<br>
                            Expiry date: ".date("d/m/Y", strtotime($date2));

                            //pending payment check
                            if($billstate == "1")
                            {
                                //package type check
                                if($subscriptionCode['sc_package'][0]=="1"){
                                    $subscriptionDetails .= "<br>
                            Transaction ID: ".$subscriptionCode['sc_paymentID']."<br><br>
                            ";
                                }else{
                                    $subscriptionDetails .= "<br>
                                Number of users: ".$numUser."<br>
                                Transaction ID: ".$subscriptionCode['sc_paymentID']."<br><br>
                                ";
                                }
                            }else if($billstate=="4"){
                                //payment pending == true, customer yet to do transaction
                                $paymentLink = "https://dev.toyyibpay.com/".$subscriptionCode['sc_billCode'];
                                $deactivateBillLink = "deactivateBill.php?billCode=".$subscriptionCode['sc_billCode']."&s=".$scode;
                                $subscriptionDetails .= "<br><br>
                                <a class='btn btn-success' style='margin-bottom:10px;background-color: yellow;
                                border: none;
                                padding: 10px;
                                border-radius: 8px;
                                color: black;'
                                href='".$paymentLink."' >
                                Click to pay to activate your account</a>
                                <a class='btn btn-success' style='margin-bottom:10px;background-color: yellow;
                                border: none; margin-left:10px;
                                padding: 10px;
                                border-radius: 8px;
                                color: black;'
                                href='".$deactivateBillLink."' >
                                Click to change package</a>
                                <br><br>
                                ";
                            }
                            else if($billstate=="2"){
                                //payment pending == true, bank yet to process transaction
                                //$paymentLink = "https://dev.toyyibpay.com/".$subscriptionCode['sc_billCode'];
                                //package type check
                                if($subscriptionCode['sc_package'][0]=="1"){
                                    $subscriptionDetails .= "<br>
                            Transaction ID: ".$subscriptionCode['sc_paymentID']."
                            Payment Status: Your transaction is still on the process.
                            <br><br>
                            ";
                                }else{
                                    $subscriptionDetails .= "<br>
                                Number of users: ".$numUser."<br>
                                Transaction ID: ".$subscriptionCode['sc_paymentID']."<br>
                                Payment Status: Your transaction is still on the process.
                                <br><br>
                                ";
                                }
                            }
                            else{
                                $data = array(
                                    "subscribedStatus"=>false,
                                    "login"=>$login
                                );
                                echo json_encode($data);
                                exit();
                            }
                            
             $data = array(
                "subscribedStatus"=>true,
                "table"=>$output,
                "scid"=>$scode,
                "num"=>$i,
                "login"=>$login,
                "subscriptionDetails"=>$subscriptionDetails,
                "subscriptionPackageType" => $subscriptionCode['sc_package'][0],
                "bill"=>$billstate
            );
            echo json_encode($data);
            exit();
        }
                        }}
                    }
                } 
                }
    }
/*       
    $sql2 = "SELECT * FROM tb_usertypes WHERE ut_id != 1";
    $result2= mysqli_query($conn,$sql2);  */

?>