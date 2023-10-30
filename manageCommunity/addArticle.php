<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
include("../dbconnect.php");
$sql = "SELECT * FROM tb_loopstype";
$result = mysqli_query($conn, $sql);
if (isset($_GET['cc_id'])) {
  extract($_GET);
} else {
  header('Location: manageCommunity.php');
}
?>
<?php
include("../commonPHP/adminNavBar.php");
include("../commonPHP/summernote.php");
?>

<body>
  <main id="main">
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">Create Article (<?= $cc_name ?>)</h2>
        <br>
        <div class="row gy-4">
          <a href="communityArticles.php?cc_id=<?= $cc_id ?>&community_id=<?= $community_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <div class="col-lg-12">
            <form id="insertLpForm" action="addArticleBackend.php" method="POST" enctype='multipart/form-data'>
              <div class="form-group">
                <label for="c_name">Article Title</label>
                <input type="text" class="form-control" id="ca_name" name="ca_name" placeholder="Enter Title" required>
                <input type="hidden" class="form-control" id="cc_id" name="cc_id" value="<?= $cc_id ?>">
                <input type="hidden" class="form-control" id="community_id" name="community_id" value="<?= $community_id ?>">
              </div>
              <br>
              <div class="form-group">
                <label for="c_desc">Article Description</label>
                <textarea class="form-control" id="summernote" name="ca_desc" placeholder="Enter Community description..." maxlength="1000" required></textarea>
              </div>
              <div class="form-group">
                <label for="m_filePath">Upload File *(jpg,png,gif,jpeg,pdf)</label>
                <input type="file" class="form-control-file" id="m_filePath" name="m_filePath">
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-warning">Add Article </button>
                <button type="reset" class="btn btn-secondary">Clear</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <?php include("../commonPHP/footer_admin.php"); ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php include("../commonPHP/jsFiles.php"); ?>
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