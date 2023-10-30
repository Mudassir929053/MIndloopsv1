<?php include("../commonPHP/head.php");
include '../commonPHP/topNavBarLoggedIn.php';
?>
<?php
if (!session_id()) {
  session_start();
}
if ($_SESSION["userType"] != '4') {
  echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
  // header("../login_and_register/login.php");
}
include("../../dbconnect.php");
$sql = "SELECT * FROM tb_loopstype";
$result = mysqli_query($conn, $sql);
if (isset($_GET['topic_id'])) {
  extract($_GET);
} else {
  header('Location: manageCommunity.php');
}
$user_id = $_SESSION['u_id'];

?>
<link rel="stylesheet" href="../../assets/css/style.css">
<link href="../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../../assets/css/parent.css">
<body class="imagebackground">



  <main id="main">

    <!-- <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Kidz Create Article (<?= $ca_name ?>)</h2>

        <br>

        <div class="row gy-4">

          <a href="javascript:history.back()" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

            <form id="insertLpForm" action="addArticleBackend.php" method="POST" enctype='multipart/form-data'>
              <div class="form-group">
                
                <label for="c_name">Article Title</label>
                <input type="text" class="form-control" id="ca_name" name="ca_name" placeholder="Enter Title" required>
                <input type="hidden" class="form-control" id="topic_id" name="topic_id" value="<?= $topic_id ?>">
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $user_id ?>">

              </div>
              <br>
              <div class="form-group">
                <label for="c_desc">Article Description</label>
                <textarea class="form-control" id="summernote" name="ca_desc" placeholder="Enter Article description..." maxlength="1000" required></textarea>
              </div>

              <div class="form-group">
                <label for="m_filePath">Upload Article Thumbnail *(png, jpeg)</label>
                <input type="file" class="form-control-file" id="m_filePath" name="m_filePath" accept="image/png, image/jpeg">
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-warning">Add Article </button>
                <button type="reset" class="btn btn-secondary bg-secondary text-white rounded">Clear</button>
              </div>

            </form>


          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include("../commonPHP/jsFiles.php"); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script>
    // document.getElementById("t_id").value = (Math.floor(Math.random() * 90000) + 10000);
    $(document).ready(function() {
      $('#summernote').summernote({
        minHeight: 200
      });
    });
  </script>
</body>

</html>