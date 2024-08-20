<?php
session_start();
if (!isset($_SESSION['userType'])) {
  header("location: ../public/index.php");
  exit;
}
require_once("../commonPHP/head.php");
include("../commonPHP/topNavBarCheck.php");
include("_discover.php");
?>

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
<!-- if there have article need to use this css -->
<style>
  span {
    background-image: none !important;
    position: static !important;
  }
</style>

<main id="main">

  <?php include("../magazine/magazine-slider.php"); ?>


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
            <a href="#<?= $row['t_filePath']; ?>"> <small class="text-danger text-right">Read More</small></a>
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
      <div class="col-md-6 d-flex justify-content-center align-items-center" style="padding: 0;">
        <div class="box">
          <!-- <iframe src="<?= $row['v_path'] ?>" title="YouTube video" allowfullscreen></iframe> -->
          <video autoplay loop width="100%" controls>
            <!-- <source src="http://www.mysite.braaasil.com/video/mel.webm" type="video/webm"> -->
            <source src="<?= $row['v_path'] ?>" type="video/mp4">
          </video>
        </div>
      </div>
      <div class="col-md-6" style="background-color: #FFCC33;">
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
<div class="container-fluid" style="background: url(../assets/img/game_bg.png); background-size: 100% 100%;">
  <div class="container-fluid">
    <div class="row" style="padding: 100px 0">
      <div class="col-md-8">
        <div class="row">
          <h3 class="block_heading">What's Fun</h3>
          <div class="col-lg-3 offset-lg-2 col-md-4">
            <div class="box text-center p-2">
              <!-- Box content goes here -->
              <a href="#"><img src="../assets/img/MindLOOPS_Resouces/_Puzzles.png" class="img-fluid" /></a>
              <!-- <h4 class="game_name">Game Name</h4> -->
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="box text-center p-2">
              <!-- Box content goes here -->
              <a href="#"><img src="../assets/img/MindLOOPS_Resouces/_A&C.png" class="img-fluid" /></a>
              <!-- <h4 class="game_name">Game Name</h4> -->
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="box text-center p-2">
              <!-- Box content goes here -->
              <a href="#"><img src="../assets/img/MindLOOPS_Resouces/_Quizzes.png" class="img-fluid" /></a>
              <!-- <h4 class="game_name">Game Name</h4> -->
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
      <div class="row" style="padding: 100px 0">
        <div class="col-sm-12">
          <div class="box text-center">
            <p id="discover_text" class="p-2">Discover more fun ways to learn and explore with the tip of the finger.</p>
            <!-- Box content goes here -->
            <img src="../assets/img/MindLOOPS_Resouces/Aliff_1_green.png" class="img-fluid" style="max-height: 300px;" />
            <a href="#"><img src="../assets/img/MindLOOPS_Resouces/subscribe.png" class="img-fluid" height="220" style="margin-top: -180px;" /></a>
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
