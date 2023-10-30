<?php 
  
  //session_start();
  if(!isset($_SESSION['userType']))
  {
    include("../commonPHP/topNavBar.php");
  }
  else{

    // if($_SESSION['subscribed'] == False){
    //     include("../commonPHP/topNavBar.php");
    // }
    // else{
    //     include("../commonPHP/topNavBar.php");
    // }
    include("../commonPHP/topNavBarLoggedIn.php");

  }


?>