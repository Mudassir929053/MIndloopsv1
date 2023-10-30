<?php

if (!session_id()) {
  session_start();
}
if ($_SESSION["userType"] != '1') {
  echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
  // header("../login_and_register/login.php");
}
// include('help.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Mindloops</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
  <link href="../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->




  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/gallery/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/gallery/swiper-bundle.min.css" rel="stylesheet">
  <!-- <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet"> -->
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">


  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/package.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Company - v4.7.0
  * Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <!-- Bootbox JS -->
  <script src="../assets/vendor/bootbox/bootbox.min.js"></script>

  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<style>
  #hideNav {
    color: black;
  }

  #hideNav:hover {
    color: gray;
  }

  /* from insert-tips.php */
  #insertMagForm {
    width: 60%;
    margin-left: auto;
    margin-right: auto;
    padding: 15px;
    background-color: azure;
    border: solid 1px rgba(255, 255, 0, 0);
    border-radius: 30px;
  }

  /* from insert-tips.php */
  #m_id {
    background-color: transparent;
    border: 0px;
    outline: none;
  }

  /* from insert-tips.php */
  #m_id:focus {
    background-color: transparent;
    border: 0px;
    outline: none;
  }

  /* from edit-tips.php */
  #editMagForm {
    width: 60%;
    margin-left: auto;
    margin-right: auto;
    padding: 15px;
    background-color: azure;
    border: solid 1px rgba(255, 255, 0, 0);
    border-radius: 30px;
  }

  .dataTables_filter {
    text-align: right;
  }
</style>


<body>
  <!-- ======= Header ======= -->
  <header id="header" class="sticky-top">
    <div id="welcome" class="py-4">

      <a href="../login_and_register/admin.php"><img src="../assets/img/MindLOOPS_Resouces/Asset_10.png" alt="MindLoops" height="80px" width="380px"></a>
    </div>
    <div class="container-fluid d-flex align-items-center" id="navDiv">

      <!-- <h1 class="logo me-auto"><a href="./index.php"><span>Mind</span>loops</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="./assets/img/MindLOOPS_Resouces/mindloops_title-01_cropped.png" alt="" class="img-fluid" height="50px" width="150px" ></a> -->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>

          <li class="dropdown"><a href="../login_and_register/admin.php">Home <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="../manageDiscovers/manage.php">Discover</a></li>
              <li><a href="../admin-magazine/manage-magazine.php">Magazine</a></li>
              <li><a href="../managePackage/managePackage.html">Subscription Package</a></li>
            </ul>
          <!-- <li><a href="../manageTeachingSupport/manageTeachSupport.php">Teaching Support</a></li> -->
          <!-- <li><a href="../manageContribute/manageContribute.php">Contribution</a></li> -->
          <li><a href="../manageTips/manage-tip.php">Tips</a></li>
          <li><a href="../manageMindbooster/manage-mindbooster.php">Mind Booster</a></li>
          <li><a href="../manageVideos/manage-video.php">Video</a></li>
          <li><a href="../manageLoops/manage-loops.php">Loops</a></li>
          <li><a href="../manageDiscount/index.php">Discount</a></li>
          <li><a href="../manageCoupons/index.php">Coupons</a></li>


          <li class="dropdown"><a href="#"><span>Contribution
              </span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="../manageCommunity/manageCommunity.php">Community</a></li>
              <li><a href="../manageTomindloops/manageTopics.php">To Mindloops</a></li>
              <li><a href="../manageKidzcorner/manageKidzcorner.php">Kidz Corner</a></li>
              <li><a href="../manageForum/manageForum.php">Forum</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Games
              </span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <!-- <li><a href="#">Puzzels</a></li> -->
              <li><a href="../admin-manage-games/game-crossword.php">crossword</a></li>
              <li><a href="../admin-manage-games/addjigsawcategory-images.php">jigsaw</a></li>
              <!-- <li><a href="../quizes/Admin_quiz1/allquestions.php">riddle</a></li> -->
              <li><a href="../wordsearch_admin/manage-wordsearch.php">search word</a></li>
              <li><a href="../match_words/admin.php">match word</a></li>
              <li><a href="../Admin_quiz1/manage_category.php">quizzes</a></li>

            </ul>
            <!-- <li><a href="./pricing.html">Contribute</a></li> -->
            <!-- <li><a href="./blog.html">Blog</a></li>
          <li><a href="./contact.html">Contact</a></li> -->
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <div class="header-social-links d-flex">
        <a id="loginLink" href="../login_and_register/logout.php">Logout <i class="bi bi-box-arrow-in-left"></i></a>
        <a id="hideNav" href="#" style="visibility: hidden;" class="facebook"></a>
        <!-- <a href="#" class="instagram"><i class="bu bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bu bi-linkedin"></i></i></a> -->
      </div>

    </div>
  </header><!-- End Header -->

  <script>
    var showing = true;

    document.getElementById("hideNav").addEventListener('click', function(event) {
      event.preventDefault();

      if (showing === true) {
        toggleOff();
        showing = false;
      } else {
        toggleOn();
        showing = true;
      }

    });


    function toggleOff() {
      document.getElementById("welcome").style.display = "none";
    }


    function toggleOn() {
      document.getElementById("welcome").style.display = "flex";
    }
  </script>