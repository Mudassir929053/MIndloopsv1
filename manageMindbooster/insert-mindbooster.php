<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
include("../commonPHP/adminNavBar.php");
// include("../dbconnect.php");
$sql = "SELECT * FROM tb_subjects";
$result = mysqli_query($conn, $sql);
$parano = 2;
?>
<body>
  <main>
    <div class="container">
      <h2 style="text-align: center;">Create a Mind Booster</h2>
      <br>
      <div class="row gy-4">
        <a href="manage-mindbooster.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
        <div class="col-lg-12">
          <form id="insertMbForm" action="insert-mindbooster-backend.php" method="POST" enctype='multipart/form-data'>
            <div class="form-group">
              <label for="mb_sub_name">Subject Name</label>
              <input type="text" class="form-control" id="mb_sub_name" name="mb_sub_name" placeholder="Enter Subject Name" required>
            </div>
            <br>
            <div class="form-group">
              <label for="mb_sub_desc">Subject Description</label>
              <textarea class="form-control" id="mb_sub_desc" name="mb_sub_desc" placeholder="Enter Subject Description" required></textarea>
            </div>
            <br>
            <div class="form-group">
              <label for="mb_sub_image">Subject Image *(.png / .jpg / .jpeg)</label>
              <input type="file" class="form-control-file" id="mb_sub_image" name="mb_sub_image" accept="image/png, image/jpeg, image/jpg" required>
            </div>
            <br>
            <div class="form-group">
              <label for="mb_sub_released_date">Released Date</label>
              <input type="datetime-local" class="form-control" id="mb_sub_released_date" name="mb_sub_released_date" required>
            </div>
            <br>
            <div class="form-group">
              <button type="submit" class="btn btn-warning">Create MindBooster</button>
              <button type="reset" class="btn btn-secondary">Clear</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main><!-- End #main -->
  <?php include("../commonPHP/footer_admin.php"); ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php include("../commonPHP/jsFiles.php"); ?>
</body>
</html>