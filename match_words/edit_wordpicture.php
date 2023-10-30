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
   
    <!-- <div class="mt-2">&nbsp</div> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">Edit Word-Picture</h2>
        <br>
        <div class="row gy-4">
          <a href="admin.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <div class="col-lg-12">
            <?php
            // Retrieve the record to update
            $id = $_GET['id']; // Assuming you have the ID of the record in the URL parameter
            $sql = $conn->query("SELECT * FROM tb_wordmatch WHERE id  = '$id'");
            $row = $sql->fetch_assoc();
            // Populate the form fields with the retrieved values
            $game_level = $row['game_level'];
            $category = $row['category'];
            $word_name = $row['word_name'];
            $image_url = $row['image_url'];
            // Render the form
            ?>
            <form id="insertMbForm" method="POST" enctype='multipart/form-data'>
              <div class="form-group">
                <label for="word_name">Word Name</label>
                <input type="text" class="form-control" id="word_name" name="word_name" placeholder="Enter Word Name" value="<?php echo $word_name; ?>" required>
              </div>
              <br>
              <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category" placeholder="Enter Word Category" value="<?php echo $category; ?>" required>
              </div>
              <br>
              <div class="form-group">
                <label for="category_image">Category Image File *(.png / .jpg / .jpeg)</label>
                <br>
                <?php if ($row['img_category']) { ?>
                  <img src="<?php echo $row['img_category']; ?>" width="200">
                  <br><br>
                <?php } ?>
                <input type="file" class="form-control-file" id="category_image" name="category_image" accept="image/png, image/jpeg, image/jpg">
              </div>
              <br>
              <div class="form-group">
                <label for="level">Level</label>
                <select class="form-select" name="game_level" id="level" required>
                  <option value="Easy" <?php if ($game_level == 'Easy') echo 'selected'; ?>>Easy</option>
                  <option value="Medium" <?php if ($game_level == 'Medium') echo 'selected'; ?>>Medium</option>
                  <option value="Hard" <?php if ($game_level == 'Hard') echo 'selected'; ?>>Hard</option>
                </select>
              </div>
              <br>
              <div class="form-group">
                <label for="image">Word-Image File *(.png / .jpg / .jpeg)</label>
                <br>
                <?php if ($row['image_url']) { ?>
                  <img src="<?php echo $row['image_url']; ?>" width="200">
                  <br><br>
                <?php } ?>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/png, image/jpeg, image/jpg">
              </div>
              <br>
              <div class="form-group">
                <button type="submit" name="edit_word_picture" id="edit_word_picture" class="btn btn-warning">Edit Word-Picture</button>
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