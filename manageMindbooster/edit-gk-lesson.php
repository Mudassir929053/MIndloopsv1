<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
  include("../dbconnect.php");
}
?>
<?php
$l_id = $_GET['l_id'];
$mb_id = $_GET['mb_id'];
// Use the $mb_id value as needed
// echo "Lesson ID: " . $l_id;
?>
<?php 
include("../commonPHP/adminNavBar.php"); 
include("../commonPHP/summernote.php"); 
?>

<body>
  <main>
    <div class="container">
      <h2 style="text-align: center;">Update a Lesson</h2>
      <br>
      <div class="row gy-4">
        <a href="view-gk-mindbooster.php?mb_id=<?php echo $mb_id; ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
        <div class="col-lg-12">
          <?php
          $query = "SELECT * FROM tb_lessons WHERE l_id = $l_id";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          $l_id = $row['l_id'];
          $l_name = $row['l_name'];
          $l_image = $row['l_image'];
          
          $l_lesson_desc = $row['l_lesson_desc'];
         
          $l_released_date = $row['l_released_date'];
          ?>
          <form id="insertMbForm" action="edit-gk-backend.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="l_id" name="l_id" value="<?php echo $l_id; ?>" readonly>
            <input type="hidden" class="form-control" id="l_id" name="mb_id" value="<?php echo $mb_id; ?>" readonly>
            <br>
            <div class="form-group">
              <label for="l_name">Lesson Name</label>
              <input type="text" class="form-control" id="l_name" name="l_name" value="<?php echo $l_name; ?>" required>
            </div>
            <br>
            <div class="form-group">
              <label for="summernote">Lesson Description</label>
              <textarea class="form-control" id="summernote" name="l_lesson_desc" placeholder="Enter the lesson description..." maxlength="1000" required><?php echo $l_lesson_desc; ?></textarea>
            </div>
            <br>
            <div class="form-group">
              <label for="l_image">Lesson Image</label>
              <?php if ($l_image) : ?>
                <div class="current-image">
                  <img src="<?php echo $l_image; ?>" alt="Current Image" style="max-width: 20%; height: auto;">
                </div>
              <?php else : ?>
                <p>No image uploaded</p>
              <?php endif; ?>
              <div class="file-upload">
                <label class="file-upload-label" for="l_image">Choose Image</label>
                <span class="file-upload-value"></span>
                <input type="file" id="l_image" name="l_image" accept="image/*">
              </div>
            </div>
            <br>
            <div class="form-group">
              <label for="l_released_date">Released Date</label>
              <?php
              // Assuming that $l_released_date is in the format 'Y-m-d'
              $releasedDate = date('Y-m-d', strtotime($l_released_date));
              ?>
              <input type="datetime-local" class="form-control" id="l_released_date" name="l_released_date" value="<?php echo $releasedDate; ?>" required>
            </div>
            <br>
            <button type="submit" name="edit_lesson" class="btn btn-warning">Update</button>
            <button type="reset" class="btn btn-secondary">Clear</button>
          </form>
        </div>
      </div>
    </div>
    <script>
      // Display the selected file name in the file upload label
      const fileUploads = document.querySelectorAll('.file-upload input[type="file"]');
      fileUploads.forEach(function(fileUpload) {
        fileUpload.addEventListener('change', function() {
          const fileName = this.value.split('\\').pop();
          const fileUploadValue = this.parentNode.querySelector('.file-upload-value');
          fileUploadValue.textContent = fileName;
        });
      });
    </script>
  </main><!-- End #main -->
  <?php include("../commonPHP/footer_admin.php"); ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php include("../commonPHP/jsFiles.php"); ?>

<script>
  // document.getElementById("t_id").value = (Math.floor(Math.random() * 90000) + 10000);
  $(document).ready(function() {
    $('#summernote').summernote({
      spellCheck: false,
    fontNames: ['Arial', 'Helvetica', 'Times New Roman', 'Courier New', 'Tommysoft'],
    fontSizeUnits: ['px', 'pt'],
    lang: ['en-US', 'es'],
    toolbar: [
      ['style', ['fontname', 'fontsize']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['font', ['bold', 'underline', 'clear']],
  ['table', ['table']],
  ['insert', ['link', 'picture', 'video']],
  ['view', ['fullscreen', 'codeview', 'help']],
      ['lang', ['en-US', 'es']],
    ]
  });
  });
</script>
</body>

</html>