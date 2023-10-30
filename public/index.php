<!DOCTYPE html>
<html>

<head>
  <title>Mindloops</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/MindLOOPS_Resouces/ML Icon4.png" rel="icon">
  <link href="../assets/img/MindLOOPS_Resouces/ML Icon4.png" rel="apple-touch-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
  <?php
  // $past = time() - 3600;
  // foreach ( $_COOKIE as $key => $value )
  // {
  //     setcookie( $key, $value, $past, '/' );
  // }
  // var_dump($_COOKIE);
  // exit;

  if (!isset($_COOKIE['userType']) || isset($_GET['role_change'])) { ?>

    <script type="text/javascript">
      $(document).ready(function() {

        $('#myModal').modal('show');
        // $('#myModal .close').off('click.dismiss.bs.modal');
        // console.log('here');
      });
    </script>

  <?php
  }



  ?>
  <?php include '../global_modal.php'; ?>


  <style>
    .modal.fade .modal-dialog.modal-dialog-zoom {
      -webkit-transform: translate(0, 0)scale(.5);
      transform: translate(0, 0)scale(.5);
    }

    .modal.show .modal-dialog.modal-dialog-zoom {
      -webkit-transform: translate(0, 0)scale(1);
      transform: translate(0, 0)scale(1);
    }

    .img-fluid {
      width: 100%;
    }

    .modal-dialog .modal-fade {
      width: 1800px;
      height: 500px;
    }
  </style>
</head>
<?php
require_once("../commonPHP/head.php");
include("../commonPHP/topNavBarCheck.php");
include("../index/_discover.php");
include '../dbconnect.php';

?>

<body>
  <!-- Modal -->
  <div class="container">
    <div class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg">
        <div class="modal-content text-center">
          <div class="modal-body m-1 p-1">
            <div class="row ml-5 py-5" style="background-image: url(images/Maskgroup.png);background-repeat: no-repeat;background-position: top right">
              <div class="col-md-12">
                <p class="modal-title" style="font-size: 22px;">Before We Start,</p>
                <p class="modal-title" style="font-size: 32px;padding:0 20% 0 20%;">Which of the following best suits your category?</p>
              </div>
            </div>
            <!-- Modal body -->
            <div class="row px-5">
              <div class="col-md-4 ">
                <button type="button" class="btn py-2  user-type-name" data-type='Teacher'>
                  <img src="images/Group265.png" alt="Teacher" class="img-fluid">
                </button>
                <p>I'm a teacher</p>
              </div>
              <div class="col-md-4">
                <button type="button" class="btn py-2 user-type-name" data-type='Parent'>
                  <img src="images/Group266.png" alt="Parent" class="img-fluid">
                </button>
                <p>I'm a parent</p>
              </div>
              <div class="col-md-4">
                <button type="button" class="btn py-2 user-type-name" data-type='Student'>
                  <img src="images/Group267.png" alt="Student" class="img-fluid">
                </button>
                <p>I'm a Student</p>
              </div>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="py-3">
            <button type="button" class="btn" onclick="noneSelected()"><u>None of the above</u></button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Javascript code for button onclick functions -->
  <script>
    let roles = document.getElementsByClassName('user-type-name');
    // console.log(roles.length)
    for (let i = 0; i < roles.length; i++) {
      // console.log(roles[i]);
      let role = roles[i];

      //    console.log(userType);
      role.addEventListener('click', function() {
        let userType = role.getAttribute('data-type');
        let url = 'setcookies.php?userType=' + userType;
        // console.log(url);
        fetch(url).then(data => data.text()).then(data => {
          // console.log(data);
          window.location.href = '../';

        });
      })

    }
  </script>


  <div class="container-fluid" style="background: url(../assets/img/bg1.png); background-size: 100%; background-repeat: repeat-y;">
    <div class="container">
      <div class="row" style="padding: 100px 0">
        <div class="col-sm-4 p-2">
          <div class="box text-center">
            <!-- Box content goes here -->
            <a href="#"><img src="../assets/img/MindLOOPS_Resouces/_Puzzles.png" class="img-fluid" /></a>
          </div>
        </div>
        <div class="col-sm-4 p-2">
          <div class="box text-center">
            <!-- Box content goes here -->
            <a href="#"><img src="../assets/img/MindLOOPS_Resouces/_A&C.png" class="img-fluid" /></a>
          </div>
        </div>
        <div class="col-sm-4 p-2">
          <div class="box text-center">
            <!-- Box content goes here -->
            <a href="#"><img src="../assets/img/MindLOOPS_Resouces/_Quizzes.png" class="img-fluid" /></a>
          </div>
        </div>
      </div>
    </div>
  </div>



  <main id="main" data-toggle="modal" data-target="#globalModal">

    <?php include("../magazine/magazine-public-slider.php"); ?>


  </main><!-- End #main -->

  <?php
  $sqlt = "SELECT * FROM `tb_tips` ORDER by t_id DESC LIMIT 1";
  $result = $conn->query($sqlt);
  while ($row = $result->fetch_assoc()) {



  ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 d-flex justify-content-center align-items-center" style="background-color: #EC2C48; padding:0">
          <div class="box ">
            <!-- <h4 class="text-light">article <br> thumbnail</h4> -->
            <img src="<?= $row['t_filePath']; ?>" style="max-height: 350px; width: 100%;" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="box px-5 py-4">
            <small class="text-danger">Living Skills</small>
            <h4 class="article_heading"><?= $row['t_title']; ?></h4>
            <small class="text-secondary"><?= date_format(date_create($row['t_rDate']), "j F Y"); ?></small>
            <p class="article_text"><?= $row['t_desc']; ?></p>
            <div class="text-end">
              <a data-toggle="modal" data-target="#globalModal"> <small class="text-danger text-right">Read More</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php }

  $sqlv = "SELECT * FROM `tb_videos` order by v_id DESC limit 1";
  $result1 = $conn->query($sqlv);
  while ($row = $result1->fetch_assoc()) {

  ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 d-flex justify-content-center align-items-center" style="padding: 0;">
          <div class="box">
            <!-- <iframe src="<?= $row['v_path'] ?>" title="YouTube video" allowfullscreen></iframe> -->
            <video loop width="100%" controls>
              <!-- <source src="http://www.mysite.braaasil.com/video/mel.webm" type="video/webm"> -->
              <source src="<?= $row['v_path'] ?>" type="video/mp4">
            </video>
          </div>
        </div>
        <div class="col-lg-6" style="background-color: #FFCC33;">
          <div class="box px-5 py-4">
            <div class="row py-4">
              <div class="col-sm-2"><img src="../assets/img/MindLOOPS_Resouces/icon_diy.png" /></div>
              <div class="col-sm-10">
                <h4 class="video_text_heading">DIY</h4>
                <span class="text-light mt-0">Learn everything by do it by yourself.</span>
              </div>
            </div>
            <div class="row py-4">
              <div class="col-sm-2"><img src="../assets/img/MindLOOPS_Resouces/icon_book.png" /></div>
              <div class="col-sm-10">
                <h4 class="video_text_heading">Lessons</h4>
                <span class="text-light mt-0">Learn more and become brilliant</span>
              </div>
            </div>
            <div class="row py-4">
              <div class="col-sm-2"><img src="../assets/img/MindLOOPS_Resouces/icon_explore.png" /></div>
              <div class="col-sm-10">
                <h4 class="video_text_heading">Explore</h4>
                <span class="text-light mt-0">Hello there our little explorer.</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="container-fluid" style="background: url(../assets/img/game_bg.png); background-size: 100% 100%; ">
    <div class="container-fluid">
      <div class="row" style="padding: 100px 0">
        <div class="col-md-8">
          <div class="row">
            <h3 class="block_heading">What's Fun</h3>
            <div class="col-lg-3 col-md-4 offset-lg-2">
              <div class="box text-center p-2">
                <!-- Box content goes here -->
                <a href="#"><img src="../assets/img/MindLOOPS_Resouces/_Puzzles.png" class="img-fluid" /></a>
                <h4 class="game_name">Game Name</h4>
              </div>
            </div>
            <div class="col-lg-3 col-md-4">
              <div class="box text-center p-2">
                <!-- Box content goes here -->
                <a href="#"><img src="../assets/img/MindLOOPS_Resouces/_A&C.png" class="img-fluid" /></a>
                <h4 class="game_name">Game Name</h4>
              </div>
            </div>
            <div class="col-lg-3 col-md-4">
              <div class="box text-center p-2">
                <!-- Box content goes here -->
                <a href="#"><img src="../assets/img/MindLOOPS_Resouces/_Quizzes.png" class="img-fluid" /></a>
                <h4 class="game_name">Game Name</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">&nbsp;</div>
      </div>
    </div>

  </div>

  <?php if (!isset($_SESSION['userType'])) { ?>

    <div class="container-fluid" style="background: url(../assets/img/bg1.png); background-size: 100%; background-repeat: no-repeat;">
      <div class="container">
        <div class="row" style="padding: 50px 0;">
          <div class="col-sm-12 col-md-12 px-5">

            <div class="box text-center">
              <div class="row">
                <p id="discover_text" class="p-2">Discover more fun ways to learn and explore with the tip of the finger.</p>
                <div class="col-lg-3 offset-lg-3">
                  <img src="../assets/img/MindLOOPS_Resouces/Aliff_1_green.png" class="img-fluid" style="max-height: 450px;" />

                </div>
                <div class="col-lg-3">
                  <a href="#"><img src="../assets/img/MindLOOPS_Resouces/subscribe.png" class="img-fluid" /></a>
                </div>
              </div>
              <!-- Box content goes here -->
              <!-- Box content goes here -->


            </div>
          </div>


        </div>
      </div>

    </div>


  <?php } ?>

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include("../commonPHP/jsFiles.php"); ?>

</body>

</html>