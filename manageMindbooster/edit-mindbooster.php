<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
?>
<?php
if (isset($_GET['mb_id'])) {
  $mb_id = $_GET['mb_id'];
}
?>
<?php include("../commonPHP/adminNavBar.php"); ?>
<body>
  <main>
    <div class="container">
      <h2 style="text-align: center;">Update a Mind Booster</h2>
      <br>
      <div class="row gy-4">
        <a href="manage-mindbooster.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
        <div class="col-lg-12">
          <?php
          $query = "SELECT * FROM tb_mindbooster where mb_id=$mb_id ";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          // $mb_sub_code = $row['mb_sub_code'];
          $mb_id = $row['mb_id'];
          $mb_sub_name = $row['mb_sub_name'];
          $mb_sub_desc = $row['mb_sub_desc'];
          $mb_sub_image = $row['mb_sub_image'];
          $mb_sub_released_date = $row['mb_sub_released_date'];
          ?>
          <form id="editMbForm" action="edit-mindbooster-backend.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="mb_id">Mind Booster ID</label>
              <input type="text" class="form-control" id="mb_id" name="mbx_id" value="<?php echo $mb_id; ?>" disabled>
              <input type="hidden" class="form-control" id="mb_id" name="mb_id" value="<?php echo $mb_id; ?>" >
            </div>
            <br>
        
            <div class="form-group">
              <label for="mb_sub_name">Subject Name</label>
              <input type="text" class="form-control" id="mb_sub_name" name="mb_sub_name" value="<?php echo $mb_sub_name; ?>" required>
            </div>
            <br>
            <div class="form-group">
              <label for="mb_sub_desc">Subject Description</label>
              <textarea class="form-control" id="mb_sub_desc" name="mb_sub_desc" placeholder="This is the mindbooster description..." maxlength="1000" required><?php echo $mb_sub_desc; ?></textarea>
            </div>
            <br>
            <div class="form-group">
              <label for="mb_sub_released_date">Released Date</label>
              <input type="datetime-local" class="form-control" id="mb_sub_released_date" name="mb_sub_released_date" value="<?php echo $mb_sub_released_date; ?>" required>
            </div>
            <br>
            <div class="form-group">
              <label for="mb_sub_image">MindBooster File *(.png / .jpg / .jpeg)</label>
              <input type="file" class="form-control-file" id="mb_sub_image" name="mb_sub_image" accept="image/png, image/jpeg, image/jpg">
            </div>
            <br>
            <div class="form-group">
              <?php if ($mb_sub_image) : ?>
                <label>Current Image:</label>
                <br>
                <img src="<?php echo $mb_sub_image; ?>" alt="Current Image" style="max-width: 200px;">
                <br><br>
              <?php endif; ?>
              <button type="submit" name="edit_mindbooster" class="btn btn-warning">Update</button>
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