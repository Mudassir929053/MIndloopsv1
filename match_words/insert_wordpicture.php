<?php
if (!session_id()) {
  session_start();

  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}

// include("../dbconnect.php");
?>
<?php include("../commonPHP/adminNavBar.php");
include 'function.php';
?>
<body>

  <main id="main">

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">Add Word-Picture</h2>

        <br>

        <div class="row gy-4">
          <a href="admin.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <div class="col-lg-12">
            <form id="insertMbForm" method="POST" enctype='multipart/form-data'>
              <div class="form-group">
                <label for="word_name">Word Name</label>
                <input type="text" class="form-control" id="word_name" name="word_name" placeholder="Enter Word Name" required>
              </div>
              <br>
              <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category" placeholder="Enter Word Category" required>
              </div>
              <br>
              <div class="form-group">
                <label for="category_image">Category Image File *(.png / .jpg / .jpeg)</label>
                <input type="file" class="form-control-file" id="category_image" name="category_image" accept="image/png, image/jpeg, image/jpg" required>
              </div>
              <br>
              <div class="form-group">
                <label for="level">Level</label>
                <select class="form-select" name="level" id="level" required>
                  <option selected disabled>Select Level</option>
                  <option value="Easy">Easy</option>
                  <option value="Medium">Medium</option>
                  <option value="Hard">Hard</option>
                </select>
              </div>
              <br>
              <div class="form-group">
                <label for="image">Word-Image File *(.png / .jpg / .jpeg)</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/png, image/jpeg, image/jpg" required>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" name="addword" id="addword" class="btn btn-warning">Add Word-Picture</button>
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

</body>

</html>