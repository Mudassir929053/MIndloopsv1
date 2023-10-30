<?php
include("../global_modal.php");
include("../commonPHP/head.php");
include("../commonPHP/topNavBarCheck.php");
include("../dbconnect.php");
?>

<style>
  body {
    background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
    background-size: 110%;
    background-position: top center;
    background-repeat: no-repeat;
  }

  .textAll {
    padding-top: 2%;
  }
</style>

<main id="main">

  <div id="portfolio-details" data-toggle="modal" data-target="#globalModal">
    <div class="container-fluid">
      <div class="row">
        <!-- <h1>Image for go to lessons</h1> -->
        <!-- <img src="../assets/creativity-submission/CS-Banner 2.png" alt="" style="padding:0;" width="100%"> -->
      </div>
    </div>
  </div>

  <div class="container">
    <br>
    <div class="row">
      <?php
      $query = "SELECT * FROM `tb_mindbooster`";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($result)) {
        $s_id = $row['mb_id'];
        $subjectName = $row['mb_sub_name'];
        $filename = $row['mb_sub_image'];
        $mb_sub_desc = $row['mb_sub_desc'];
        $mb_sub_released_date = $row['mb_sub_released_date'];
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card"  data-toggle="modal" data-target="#globalModal">
                            <div style="height: 200px; overflow: hidden;" class="">
                                <img src="<?php echo $filename; ?>" class="card-img-top" alt="Subject Image" style="object-fit: cover; height: 100%; width: 100%;">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-black"><?php echo $subjectName; ?></h4>
                                <div class="card-title text-black "><?php echo $mb_sub_desc; ?></div>
                                <div class="card-title text-secondary"><?php echo date('y-F-d', strtotime($mb_sub_released_date)); ?></div>
                                
                                <div class="form-select bg-info mt-auto" onclick="return false">
                                    <option value="">Select Grade</option>
                                    <!-- <option value="1">Level 1</option>
                                    <option value="2">Level 2</option>
                                    <option value="3">Level 3</option>
                                    <option value="4">Level 4</option>
                                    <option value="5">Level 5</option>
                                    <option value="6">Level 6</option> -->
      </div>
                               
                            </div>
                        </div>
         </div>
      <?php
      }
      ?>
    </div>
  </div>

</main><!-- End #main -->

<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
