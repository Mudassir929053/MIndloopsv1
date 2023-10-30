<?php 
  
  //session_start();
  if(!isset($_SESSION['userType']))
  {
    include("../commonPHP/topNavBar.php");
  }
  else{
    include("../commonPHP/topNavBarLoggedIn.php");
  }


?>