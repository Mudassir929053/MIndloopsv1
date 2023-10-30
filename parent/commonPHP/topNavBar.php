<?php 
//   include("../commonPHP/head.php"); 
  // require_once("../commonPHP/head.php"); 
?>


<style>

  #navToggle{
    color:black;
  }

  #navToggle:hover{
    color: gray;
  }

</style>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="sticky-top">
    <div id="welcome">
      <h3>Welcome To</h3>
      <a href="../index/index.php"><img src="../assets/img/MindLOOPS_Resouces/Asset_10.png" alt="MindLoops" height="80px" width="380px"></a>
    </div>
    
    <div class="container d-flex " id="navDiv">   
    <div class="row" style="width: 100%;"> 
      <nav id="navbar" class="navbar order-last order-lg-0 mx-auto">
        <ul>        
          <li><a href=../index/index.php#gallery>Magazine</a></li>
          <!-- <li><a href=../index/index.php#Subscribe>Subscribe</a></li> -->
          <li><a href="../subscription/allSubscriptions.php">Subscription</a></li>
          <li><a href=../creativity-submission/creativity-submission.php>CREATIVITY SUBMISSION</a></li>
          <li class="ms-auto"> <a style="text-transform: capitalize;" id="loginLink" href="../login_and_register/login.php">Login 
          <i style="font-size: 18px;" class="bi bi-box-arrow-in-right"></i>
        </a></li>
          </ul>     
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->      
      </div>
    </div>
  </header><!-- End Header -->


  <script>

    var navShowing = true;

    document.getElementById("navToggle").addEventListener("click",function(event){
      event.preventDefault();

      if(navShowing){
        document.getElementById("welcome").style.display = "none";
        navShowing = false;
      }
      else{
        document.getElementById("welcome").style.display = "flex";
        navShowing = true;
      }

    });

</script>