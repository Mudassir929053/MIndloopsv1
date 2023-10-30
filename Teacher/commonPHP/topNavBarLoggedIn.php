<?php
if (!session_id()) {
  session_start();
}
require_once('../../dbconnect.php');
?>
<style>
  #navToggle {
    color: black;
  }

  #navToggle:hover {
    color: gray;
  }
</style>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="sticky-top">
    <div id="welcome" class="py-4">
    
      <a href="../../index/index.php"><img src="../../assets/img/MindLOOPS_Resouces/Asset_10.png" class="img-fluid" alt="MindLoops" height="80px" width="380px"></a>
    </div>
    <div class="container-fluid d-flex justify-content-center" id="navDiv">
      <div class="row">
        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul>
            <!-- <li><a href="#"><span>Home</span></i></a> -->
              <!-- <ul>
              <li><a href="../index/index.php#gallery">Magazine</a></li>
            </ul> -->
              <?php
              if ($_SESSION["userType"] == '4') {
                echo "<li><a href=../../creativity-submission/creativity-submission.php>Contribute</a></li>";
              }
              if ($_SESSION['userType'] == '2') {
                // echo "<li><a href=>Teaching Support</a></li>";
              ?>
                <!-- <li><a href="../creativity-submission/creativity-submission.php">Contribute</a></li> -->
            <li><a href="../magazine/index.php">Magazine</a></li>
            <li><a href="../ready_to_go_lessons/manage-ready-to-go-lesson.php">Ready To Go Lessons</a></li>
            <li><a href="../loops/view-loops.php">Loops</a></li>
            <li><a href="../tips/view-tips.php">Tips</a></li>
            <li><a href="../videos/videos.php">Videos</a></li>
            <li><a href="../discount/discount.php">Discounts</a></li>
            <li><a href="../subscription/user-profile.php">Profile</a></li>
            <li class="dropdown"><a href="#"><span>Contribution </span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="../Community/community.php">Community</a></li>
                <li><a href="../ToMindloops/to-mindloops.php">To Mindloops</a></li>
                <li><a href="../Forum/forum.php">Forum</a></li>
                <li><a href="../creative_corner/viewforum.php">Kidz Creative Corner</a></li>
              </ul>
            </li>
          <?php } ?>
          <?php
          if ($_SESSION['userType'] == '3') {
            $sj = "SELECT * FROM tb_subjects";
            $sj_result = mysqli_query($conn, $sj);
          ?>

            <li><a href="../magazine/index.php">Magazine</a></li>
            <li><a href="../../mindbooster/mindbooster.php"><span>Mind Booster</a> </li>
            <li><a href="../tips/view-tips.php">Tips</a></li>
            <li><a href="../loops/view-loops.php">Loops</a></li>
            <li><a href="../videos/videos.php">Videos</a></li>

            <li><a href="../creativity-submission/creativity-submission.php">Creativity Submission</a></li>
            <li><a href="../games/index.php">Games</a></li>
          <?php } ?>
          <?php
          if ($_SESSION['userType'] == '4') {
           
          ?>

            <!-- <li><a href="../magazine/index.php">Magazine</a></li> -->
            <!-- <li class="dropdown"><a href="../mindbooster/mindbooster.php"><span>Mind Booster</a> </li> -->
            <li><a href="../../parent/loops/view-loops.php">Loops</a></li>
            <li><a href="../../parent/tips/view-tips.php">Tips</a></li>
            <li><a href="../../parent/videos/videos.php">Videos</a></li>
            <li><a href="../../parent/creativity-submission/creativity-submission.php">Creativity Submission</a></li>

            <!-- <li><a href="../games/index.php">Games</a></li> -->
          <?php } ?>
          </ul>
          <div class="header-social-links d-flex">
            <a id="loginLink" style="text-transform: capitalize;" href="../../login_and_register/logout.php">Logout <i class="bi bi-box-arrow-in-left"></i></a>
           
          </div>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
      </div>
    </div>
  </header><!-- End Header -->
 