<?php
session_start();
if( !isset($_SESSION["userType"]) ){
    echo ("<script LANGUAGE='JavaScript'>
					window.alert('Please log in first.');
					window.location.href='../login_and_register/login.php';
					</script>");
    
  }
?>