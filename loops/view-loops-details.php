<?php
if (!session_id()) {
  include("../dbconnect.php");
  include("../commonPHP/head.php");

  // include("../commonPHP/adminNavBar.php"); 
  // session_start();

  if ($_SESSION["userType"] != '3') {
    header('location: ../login_and_register/login.php');
  }

  if (isset($_GET['lp_id'])) {
    $lp_id = $_GET['lp_id'];
  }

  $loops = "SELECT * FROM tb_loops where lp_id = ?";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $loops);

  mysqli_stmt_bind_param($stmt, "s", $lp_id);

  mysqli_stmt_execute($stmt);
  $loops_result = $stmt->get_result();
}

?>

<?php include("../commonPHP/topNavBarCheck.php"); ?>

<head>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link href="../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
  <link href="../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
  <link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/student.css">
</head>
<main id="main">

  <section id="portfolio-details" class="portfolio-details">
  <div class="container">
  <h2 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">View Loops</h2>
  <br>
  <div class="row gy-4">
    <?php
    while ($row = $loops_result->fetch_assoc()) {
      // var_dump($row);
    ?>
      <a href="view-loops.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
      <div class="col-md-12">
        <div class="forum-item">
          <h5><i class="fa fa-newspaper-o"></i><?php echo $row['lp_title'] ?></h5>
          <p><?php echo $row['lp_desc'] ?></p>
          <?php
          $file_name = $row['lp_filepath'];
          $extension = pathinfo($file_name, PATHINFO_EXTENSION);

          if (!empty($file_name)) {
          ?>
            <div class="responsive-iframe-container">
              <div class="button-container">
                <button onclick="openPDF('<?php echo $row['lp_filepath'] ?>')" class="btn btn-primary view-button">View PDF</button>
                <a href="<?php echo $row['lp_filepath'] ?>" download class="btn btn-primary download-button">Download PDF</a>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    <?php
    } ?>
  </div>
</div>

  </section>
  <script>
  function openPDF(url) {
    window.open(url, '_blank');
  }
</script>

</main><!-- End #main -->

<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>


</body>

</html>