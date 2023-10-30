<?php include("../commonPHP/head.php"); ?>
<?php include("../commonPHP/topNavBarCheck.php"); ?>
<link rel="stylesheet" href="../../assets/css/parent.css">
<body class="imagebackground">
<main>
  <div class="container">
    <!-- <a href="manage-mindbooster.php" class="btn btn-warning col-lg-2 my-5">Go To Back</a> -->
    <br>
    <?php
    $l_id = $_GET['l_id']; // Get the l_id from the URL parameter
    $mb_id = $_GET['mb_id']; // Get the l_id from the URL parameter
    $level = $_GET['grade']; // Get the l_id from the URL parameter


    // Fetch the lessons based on mb_id and level

    // Fetch the lesson description based on l_id
    $query = "SELECT * FROM `tb_lessons` WHERE `l_id` = $l_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      // $l_id = $row['l_id'];
      $l_name = $row['l_name'];
      // $lessonPlan = $row['l_lesson_plan'];
      $lessonDesc = $row['l_lesson_desc'];
      $worksheet = $row['l_worksheet'];
      // $exercise = $row['l_exercise'];
      $supplementaryNote = $row['l_supplementary_note'];
      $quiz = $row['l_quiz'];
      // $createdDate = $row['l_created_date'];
      $releasedDate = $row['l_released_date'];
    ?>
      <a href="lesson.php?mb_id=<?php echo $mb_id; ?>&grade=<?php echo $level; ?>" class="btn btn-warning" id="back-button" style="margin-left: 15px;"><i class="bi bi-arrow-left"></i>Go To Back</a>
      <div class="d-flex justify-content-center p-5">
        <div class="col-lg-9 d-flex justify-content-center">
          <div class="card col-md-12 p-5 shadow" style=" background-color: cornsilk;">
            <div class="card-body">
              <a href="bala.php" class="d-flex align-items-center justify-content-center">
                <h5 class="text-black text-center"><?php echo $l_name; ?></h5>
              </a>
              <div class="card-title text-black"><?php echo ucfirst(strtolower($lessonDesc)); ?></div>
              <div class="text-secondary"><?php echo date('Y-F-d', strtotime($releasedDate)); ?></div>
              <br>
              <?php if (!empty($worksheet)) { ?>
                <div class="btn-group p-1" role="group">
                  <a href="../<?php echo $worksheet; ?>" class="btn btn-success " target="_blank">Worksheet</a>
                </div>
              <?php } ?>

              <?php if (!empty($supplementaryNote)) { ?>
                <div class="btn-group  p-1" role="group">
                  <a href="../<?php echo $supplementaryNote; ?>" class="btn btn-danger" download>Supplementary Note</a>
                </div>
              <?php } ?>

              <?php if (!empty($quiz)) { ?>
                <div class="btn-group  p-1" role="group">
                  <a href="../<?php echo $quiz; ?>" class="btn btn-primary" target="_blank">Quiz</a>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>


  </div>
<?php } else { ?>
  <a href="manage-mindbooster.php" class="btn btn-warning col-lg-2 my-5">Go To Back</a>
  <div class="container p-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
          </div>
          <div class="card-body">
            <p class="card-text text-danger text-center font-weight-bold">No lessons found for the selected level.</p>
          </div>
          <div class="card-footer text-center">
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

</div>

</main>

<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/teachsupport.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.15.349/build/pdf.min.js"></script>
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
<script src="../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
<script src="../assets/vendor/aos-portfolio/aos.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>