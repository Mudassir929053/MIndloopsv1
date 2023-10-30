<?php
session_start();
require_once '../assets/securimage/securimage.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../assets/PHPMailer-master/src/Exception.php';
require '../assets/PHPMailer-master/src/PHPMailer.php';
require '../assets/PHPMailer-master/src/SMTP.php';


// Check if the form has been submitted
if (isset($_POST['register'])) {
  // Retrieve the form data using $_POST
  $userType = $_POST['userType'];
  $referralCode = $_POST['p_refferalcode'];
  $referrerID = null;
  // Check if referral code is entered
  if (!empty($referralCode)) {
    // Referral code is entered, check if it exists in the table
    $checkQuery = "SELECT * FROM tb_users WHERE u_referral_code = '$referralCode'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $count = mysqli_num_rows($checkResult);

    if ($count === 0) {
      // Referral code does not exist, display an error message
      echo ("<script LANGUAGE='JavaScript'>
            window.alert('Invalid Referral Code');
            window.location.href='login.php';
            </script>");
      exit();
    }
    $referrerData = mysqli_fetch_assoc($checkResult);
    $referrerID = $referrerData['u_id'];
  }

  // Generate a unique referral code
  $generatedReferralCode = generateReferralCode($_POST['teacheremail'], $conn);
  $securimage = new Securimage();

  // Depending on the user type, retrieve additional form data
  if ($userType == '2') {


    if ($securimage->check($_POST['teacher_captcha_code']) == false) {
      // Captcha code is incorrect, display an error message
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('Invalid Captcha Code for teacher');
      window.location.href='login.php';
      </script>");
      exit();
    }
    // Retrieve the remaining form data
    $password = $_POST['teacherpassword'];
    $confirmPassword = $_POST['teacherconfirmPassword'];
    $subjects = isset($_POST['teachersubjects']) ? implode(",", $_POST['teachersubjects']) : ''; // convert array to comma-separated string
    $other = $_POST['other'];
    $u_name = $_POST['teachername'];
    $email = $_POST['teacheremail'];
    $mobile = $_POST['teachermobile'];
    $emailType = "Teacher";
    $mail_subject = 'Teacher Registration Confirmation';

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // You can add more fields here as needed
    // $sql = "INSERT INTO tb_users (u_type, u_email, u_name, u_contact, u_subject, u_other_sub, u_pwd, u_referral_code,u_referral_by) VALUES ('2', '$email','$u_name', '$mobile', '$subjects', '$other', '$hashed_password','$generatedReferralCode','$referrerID')";

    // Prepare the statement
    $stmt = $conn->prepare("INSERT INTO tb_users (u_type, u_email, u_name, u_contact, u_subject, u_other_sub, u_pwd, u_referral_code, u_referral_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param("isssssssi", $userType, $email, $u_name, $mobile, $subjects, $other, $hashed_password, $generatedReferralCode, $referrerID);
  } elseif ($userType == '4') {

    // $securimage = new Securimage();

    if ($securimage->check($_POST['parent_captcha_code']) == false) {
      // Captcha code is incorrect, display an error message
      echo ("<script LANGUAGE='JavaScript'>
        window.alert('Invalid Captcha Code for parent');
        window.location.href='login.php';
        </script>");
      exit();
    }
    // Retrieve the remaining form data
    $numberOfChildren = $_POST['numberOfChildren'];
    $u_name = $_POST['parentname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $emailType = "Parent";
    $mail_subject = 'Parent Registration Confirmation';


    $confirmPassword = $_POST['confirmPassword'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // You can add more fields here as needed
    // $sql = "INSERT INTO tb_users (u_type, u_name, u_email, u_contact, u_numberofchildren, u_pwd, u_referral_code,u_referral_by) VALUES ('4', '$u_name', '$email', '$mobile', '$numberOfChildren', '$hashed_password','$generatedReferralCode','$referrerID')";

    $stmt = $conn->prepare("INSERT INTO tb_users (u_type, u_name, u_email, u_contact, u_numberofchildren, u_pwd, u_referral_code, u_referral_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param("isssissi", $userType, $u_name, $email, $mobile, $numberOfChildren, $hashed_password, $generatedReferralCode, $referrerID);
  }

  $stmt->execute();
  $inserted_u_id = $stmt->insert_id;

  // exit;
  // Check if the insertion was successful
  if ($stmt->affected_rows > 0) {
    // Insertion successful
    $p_id = 'T1';
    $transaction = 'TRAIL';
    $s_amount = 0;
    $status = 'unpaid';
    $stmt1 = $conn->prepare("INSERT INTO subscription (s_name, s_email, s_packege_code, transaction_id, s_amount, s_status, s_start_date, s_end_date, subscriber_id) VALUES (?, ?, ?, ?, ?, ?, NOW(), DATE_ADD(NOW(), INTERVAL  3 YEAR), ?)");
    $stmt1->bind_param("ssssssi", $u_name, $email, $p_id, $transaction, $s_amount, $status, $inserted_u_id);
    $stmt1->execute();
    $inserted_s_id = $stmt1->insert_id;
    if ($stmt->affected_rows > 0) {
      $_SESSION['session_name'] = session_id(); // set session id
      $_SESSION['email'] = $email;
      $_SESSION['userType'] = $userType;
      $_SESSION['subscribed'] = true;
      $_SESSION['u_id'] = $inserted_u_id;
      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
      $mail->SMTPAuth   = true;
      $mail->Username   = 'mindloopsintencode@gmail.com'; // Replace with your email address
      $mail->Password   = 'ebehltxjfliwqxyc'; // Replace with your email password
      $mail->SMTPSecure = 'ssl';
      $mail->Port       = 465;
      $mail->setFrom('sana.intelcode@gmail.com', 'Mindloops'); // Replace with your name and email address
      $mail->addAddress($email, $u_name); // Replace with the teacher's email and name
      $mail->Subject = $mail_subject;

      // server setting 
      // $_SESSION['session_name'] = session_id();// set session id
      // $_SESSION['email'] = $email;
      // $_SESSION['userType'] = $userType;
      // $_SESSION['subscribed'] = true;
      // $_SESSION['u_id']=$inserted_u_id;
      // $mail = new PHPMailer(true);
      // $mail->isSMTP();
      // $mail->Host       = 'mail.mindloops.org'; // cPanel mail server
      // $mail->SMTPAuth   = true;
      // $mail->Username   = 'info@mindloops.org'; // Replace with your email address
      // $mail->Password   = 'S(r#eZQg9wT='; // Replace with your email password
      // $mail->SMTPSecure = 'ssl';
      // $mail->Port       = 465;
      // $mail->setFrom('info@mindloops.org', 'Mindloops'); // Replace with your name and email address
      // $mail->addAddress($email, $u_name); // Replace with the teacher's email and name
      // $mail->Subject = $mail_subject;


      $mail->Body    = '<!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
          <style>
            /* Inline CSS specific to the email content */
            body {
              font-family: Arial, sans-serif;
              background-color: BLUE;
              color: #333333;
            }
            .email-container {
              max-width: 600px;
              margin: 0 auto;
              padding: 20px;
              background-color: #ffffff;
              box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            }
            .email-heading {
              font-size: 24px;
              font-weight: bold;
              margin-bottom: 20px;
              color: #333333;
            }
            .email-message {
              margin-bottom: 20px;
              color: #333333;
            }
            .email-footer {
              margin-top: 40px;
              font-size: 12px;
              color: #333333;
            }
          </style>
        </head>
        <body>
          <div class="email-container bg-gray-200 shadow-md">
            <h1 class="email-heading">Dear ' . $u_name . ',</h1>
            <p class="email-message">Thank you for registering as a ' . $emailType . '. Your registration is confirmed.</p>
            <div class="flex items-center justify-center mb-4">
            </div>          
            <p class="email-footer">If you have any questions or need further assistance, please feel free to contact us.</p>
            <div class="flex justify-center mt-8">
              <a href="#" class="mr-4">
                <img src="facebook.png" alt="Facebook" class="w-8 h-8">
              </a>
              <a href="#" class="mr-4">
                <img src="twitter.png" alt="Twitter" class="w-8 h-8">
              </a>
              <a href="#" class="mr-4">
                <img src="instagram.png" alt="Instagram" class="w-8 h-8">
              </a>
            </div>
          </div>
        </body>
        </html>';
      if ($referrerID) {
        // Get the referrer's email address
        $referrerQuery = "SELECT u_email FROM tb_users WHERE u_id = '$referrerID'";
        $referrerResult = mysqli_query($conn, $referrerQuery);
        $referrerData = mysqli_fetch_assoc($referrerResult);
        $referrerEmail = $referrerData['u_email'];
        $mail->addCC($referrerEmail); // Send a copy of the email to the referrer
      }
      $mail->IsHTML(true);
      if (!$mail->send()) {
        echo ("<script LANGUAGE='JavaScript'>
      window.alert('Error sending email: " . $mail->ErrorInfo . "');
      
      </script>");
      } else {
        echo "<script LANGUAGE='JavaScript'>
        window.alert('Registration Successful');
        
        </script>";
      }
    } else {
      echo "Subscription error";
      exit;
    }
  } else {
    // Insertion failed
  }

  // Execute the SQL query to insert the data into the database
  // $result = mysqli_query($conn, $sql);
  // Check if the query was successful

}

// Function to generate a unique referral code
function generateReferralCode($email, $conn)
{
  $pre = 'ML';
  // $startingEmail = substr($pre, 0, 4);
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $codeLength = 8;

  do {
    $referralCode = $pre;

    for ($i = strlen($pre); $i < $codeLength; $i++) {
      $referralCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Check if the generated referral code already exists in the database
    $checkQuery = "SELECT * FROM tb_users WHERE u_referral_code = '$referralCode'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $count = mysqli_num_rows($checkResult);
  } while ($count > 0); // Regenerate the code if it already exists

  return $referralCode;
}
