<?php 
  
  if(!isset($_COOKIE['userType']) && (isset($no_redirect))){
    $no_redirect = true;
    header('Location: ../public/index.php');
    exit;
  }
  else{
    $user_type =isset($_COOKIE['userType'])?$_COOKIE['userType']:'';
  }
?>


<style>

  #navToggle{
    color:black;
  }

  #navToggle:hover{
    color: gray;
  }
  .navbar {
    justify-content: flex-center;
  }
</style>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="sticky-top">
    <div id="welcome" class="py-4">
     
      <a href="./index.php"><img src="../assets/img/MindLOOPS_Resouces/Asset_10.png" alt="MindLoops" height="80px" width="380px"></a>
    </div>

    <div class="container-fluid">   
    <div class="row"> 
      <nav id="navbar" class="navbar">
        <ul>    
          <?php if($user_type=='Student'){ ?>    
          <li><a href="#">Home</a></li>
          <li><a href="../public/magazine_index.php">Magazine</a></li>
            <li ><a href="../public/mindbooster.php"><span>Mind Booster</a> </li>
            <li><a href="../public/view-tips.php">Tips</a></li>
            <li><a href="../public/view-loops.php">Loops</a></li>
            <li><a href="../public/videos.php">Videos</a></li>
            <!-- <li><a href="../public/creativity-submission.php">Creative Submission</a></li> -->
            <li class="dropdown"><a href="../public/creativity-submission.php">Creativity Submission </span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="viewforum_student.php">Creative Corner</a></li>
                <li><a href="kidzforum_student.php">Kidz Forum</a></li>
              </ul>
            </li>
            <li><a href="./index.php?role_change=yes">Change Role</a></li>
          <li class="ms-auto"> <a style="text-transform: capitalize;" id="loginLink" href="../login_and_register/login.php">Login 
          <i style="font-size: 18px;" class="bi bi-box-arrow-in-right"></i>
        </a></li>
        <?php }
          else if($user_type=='Teacher'){
?>
            <!-- <li><a href="#">Home</a></li> -->
            <li><a href="../public/magazine_index.php">Magazine</a></li>
            <li><a href="../public/ready-to-go-lesson.php">READY TO GO LESSONS</a></li>
            <li><a href="../public/view-loops.php">Loops</a></li>
            <li><a href="../public/view-tips.php">Tips</a></li>
            <li><a href="../public/videos.php">Videos</a></li>
            <!-- <li><a href=../public/creativity-submission.php>CREATIVITY SUBMISSION</a></li> -->
            <li class="dropdown"><a href="#"><span>Contribution 
            </span> <i class="bi bi-chevron-down"></i></a> 
            <ul> <li><a href="../public/community.php">Community</a></li>
            <!-- <li><a href="../Tomindloops/to-mindloops.php">To Mindloops</a></li> -->
            <li><a href="../public/forum.php">Forum</a></li> 
            <!-- <li><a href="../kidz_creative_corner/viewforum.php">Kidz Creative Corner</a></li>  -->
            </ul> 
            </li>
            <li><a href="./index.php?role_change=yes">Change Role</a></li>
            <li class="ms-auto"> <a style="text-transform: capitalize;" id="loginLink" href="../login_and_register/login.php">Login 
            <i style="font-size: 18px;" class="bi bi-box-arrow-in-right"></i>
        </a></li>
        <?php
          }
          else if($user_type=='Parent'){
            ?>
                 <!-- <li><a href=../index/index.php#gallery>Magazine</a></li> -->
                 <!-- <li><a href="#">Home</a></li> -->
                 <li><a href="../public/magazine_index.php">Magazine</a></li>
                 <!-- <li><a href="../public/mindbooster.php">Mind Booster</a></li> -->
                 
                 <li><a href="../public/view-loops.php">Loops</a></li>
                 <li><a href="../public/view-tips.php">Tips</a></li>
                 <li><a href="../public/videos.php">Videos</a></li>
                 <!-- <li><a href=../public/creativity-submission.php>CREATIVITY SUBMISSION</a></li> -->
                 <li class="dropdown"><a href="#"><span>Contribution 
                </span> <i class="bi bi-chevron-down"></i></a> 
                <ul> <li><a href="../public/community.php">Community</a></li>
                <!-- <li><a href="../Tomindloops/to-mindloops.php">To Mindloops</a></li> -->
                <li><a href="../public/forum.php">Forum</a></li> 
                <!-- <li><a href="../kidz_creative_corner/viewforum.php">Kidz Creative Corner</a></li>  -->
                </ul> 
                </li>
                 <li><a href="./index.php?role_change=yes">Change Role</a></li>
                 <li class="ms-auto"> <a style="text-transform: capitalize;" id="loginLink" href="../login_and_register/login.php">Login 
                 <i style="font-size: 18px;" class="bi bi-box-arrow-in-right"></i></a></li>
            <?php
          }
        ?>
          </ul>     
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->      
      </div>
    </div>
  </header><!-- End Header -->


  