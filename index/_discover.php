<?php
include('../dbconnect.php');

$sql = "SELECT cd_imgPath FROM tb_discovers ORDER BY RAND() LIMIT 3";
$result = mysqli_query($conn, $sql);
if (!$result)
  echo $conn->error;
?>
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
<link rel="stylesheet" href="css/style.css">
<div class="home-slider owl-carousel border">
  <?php
  $x = 1;
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  ?>
    <div class="container-fluid">
      <div class="row">
        <div class="slider-item bg-image" style="background-image:url(<?php echo $row['cd_imgPath'] ?>); background-size: 100% 100%;">
          <!-- <div class="overlay"></div> -->

          <div class="row no-gutters slider-text align-items-center justify-content-center">

          </div>
        </div>
      </div>
    </div>
  <?php
    $x++;
  }
  ?>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>