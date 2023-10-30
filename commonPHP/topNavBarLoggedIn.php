<?php
if (!session_id()) {
  session_start();
}
if (!isset($_SESSION['userType'])) {
  header("location: ../public/index.php");
  exit;
}
require_once('../dbconnect.php');
?>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="sticky-top">
    <div id="welcome" class="py-4">
      <!-- <h3>Welcome To</h3> -->
      <a href="../index/index.php"><img src="../assets/img/MindLOOPS_Resouces/Asset_10.png" class="img-fluid" alt="MindLoops" height="80px" width="380px"></a>
    </div>
    <div class="container-fluid d-flex justify-content-center" id="navDiv">
      <div class="row">
        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul>
            <li><a href="../index.php"><span>Home</span></i></a>
              <!-- <ul>
              <li><a href="../index/index.php#gallery">Magazine</a></li>
            </ul> -->
              <?php
              if ($_SESSION["userType"] == '2' || $_SESSION["userType"] == '4') {
                echo "<li><a href=../parent/creativity-submission/creativity-submission.php>Contribute</a></li>";
              }
              if ($_SESSION['userType'] == '2') {
                echo "<li><a href=../Teacher/teachingSupport/mainTeachingSupport.php>Teaching Support</a></li>";
              ?>
            <li><a href="../Teacher/loops/view-loops.php">Loops</a></li>
            <li><a href="../Teacher/tips/view-tips.php">Tips</a></li>
            <li><a href="../Teacher/videos/videos.php">Videos</a></li>
          <?php } ?>
          <?php
          if ($_SESSION['userType'] == '3') {
            $sj = "SELECT * FROM tb_subjects";
            $sj_result = mysqli_query($conn, $sj);
          ?>
            <li><a href="../magazine/index.php">Magazine</a></li>
            <li><a href="../mindbooster/mindbooster.php"><span>Mind Booster</a> </li>
            <li><a href="../tips/view-tips.php">Tips</a></li>
            <li><a href="../loops/view-loops.php">Loops</a></li>
            <li><a href="../videos/videos.php">Videos</a></li>
            <li><a href="../discount/discount.php">Discount</a></li>


            <li class="dropdown"><a href="../creative_corner/viewforum.php">Creativity Submission </span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="../creative_corner/viewforum.php">Creative Corner</a></li>
                <li><a href="../kidzforum/viewforum.php">Kidz Forum</a></li>
              </ul>
            </li>
            <li><a href="../games/index.php">Games</a></li>
          <?php } ?>
          <?php
          if ($_SESSION['userType'] == '4') {
            $sj = "SELECT * FROM tb_subjects";
            $sj_result = mysqli_query($conn, $sj);
          ?>

            <li><a href="../parent/loops/view-loops.php">Loops</a></li>
            <li><a href="../parent/tips/view-tips.php">Tips</a></li>
            <li><a href="../parent/videos/videos.php">Videos</a></li>
            <li><a href="../parent/creativity-submission/creativity-submission.php">Creativity Submission</a></li>
            <li><a href="../subscription/subscription-details.php">My Subscription</a></li>
            <!-- <li><a href="../games/index.php">Games</a></li> -->
          <?php } ?>
          </ul>
          <div class="header-social-links d-flex">
            <a id="loginLink" style="text-transform: capitalize;" href="../login_and_register/logout.php">Logout <i class="bi bi-box-arrow-in-left"></i></a>
            <!-- <a href="#" id="navToggle"><i class="bi bi-list"></i></a> -->
          </div>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
      </div>
    </div>
  </header><!-- End Header -->