<?php
session_start();
require_once '../assets/securimage/securimage.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../assets/PHPMailer-master/src/Exception.php';
require '../assets/PHPMailer-master/src/PHPMailer.php';
require '../assets/PHPMailer-master/src/SMTP.php';
include("../dbconnect.php");

extract($_REQUEST);

function generateOTP($length = 6)
{
  $characters = '0123456789';
  $otp = '';

  $characterLength = strlen($characters);
  for ($i = 0; $i < $length; $i++) {
    $otp .= $characters[rand(0, $characterLength - 1)];
  }

  return $otp;
}

// Example usage


if (!empty($sendOtp)) {

  $otp = generateOTP();
  $_SESSION['new_OTP'] = $otp;
  // echo $rType;
  try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'mindloopsintencode@gmail.com'; // Replace with your email address
    $mail->Password   = 'ebehltxjfliwqxyc'; // Replace with your email password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->setFrom('mindloopsintencode@gmail.com', 'Mindloops'); // Replace with your name and email address

    // $mail->Host       = 'mail.mindloops.org'; // Replace with your SMTP server
    // $mail->SMTPAuth   = true;
    // $mail->Username   = 'info@mindloops.org'; // Replace with your email address
    // $mail->Password   = 'S(r#eZQg9wT='; // Replace with your email password
    // $mail->SMTPSecure = 'tls';
    // $mail->Port       = 587;
    // $mail->setFrom('info@mindloops.org', 'Mindloops'); // Replace with your name and email address


    $mail->addAddress($email, "Mindloops"); // Replace with the teacher's email and name
    $mail->Subject = 'Mindloops Registration OTP';
    $mail->Body = '
        <!DOCTYPE html>
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
            
            <p class="email-message">Thank you for registering with Mindloops.</p>
            <div class="flex items-center justify-center mb-4">

            </div>
            <p class="email-message">Your One-Time Password (OTP) is: <strong>' . $otp . ' </strong></p>
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
    $mail->IsHTML(true);
    if (!$mail->send()) {
      echo $mail->ErrorInfo;
    } else {
      echo "Sent";
    }
  } catch (Exception $e) {
    echo $e->getMessage(); //Boring error messages from anything else!
  }
}
if (!empty($verifyEmail)) {
  if ($ent_otp == $_SESSION['new_OTP']) {
    echo "true";
  } else {
    echo  "false";
  }
}
if (!empty($checkEmail)) {
  // echo $email;

  $checkQuery = "SELECT * FROM tb_users WHERE u_email = '$email'";
  $checkResult = mysqli_query($conn, $checkQuery);
  $count = mysqli_num_rows($checkResult);
  if ($count > 0) {
    echo "true";
  } else {
    echo "false";
  }
}
