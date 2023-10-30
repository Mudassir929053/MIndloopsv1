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

<body>

  <?php include("../commonPHP/adminNavBar.php"); ?>

  <main>

    <div class="container">
      <h2 style="text-align: center;">Update a Lesson</h2>
      <br>
      <div class="row gy-4">
        <a href="view-mindbooster.php?mb_id=<?php echo $mb_id; ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
        <div class="col-lg-12">
          <?php
          $query = "SELECT * FROM tb_lessons WHERE l_id = $l_id";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          $l_id = $row['l_id'];
          $l_name = $row['l_name'];
          $l_image = $row['l_image'];
          $l_level = $row['l_level'];
          $l_lesson_plan = $row['l_lesson_plan'];
          $l_classroom_activity = $row['l_classroom_activity'];
          $l_lesson_desc = $row['l_lesson_desc'];
          $l_worksheet = $row['l_worksheet'];
          $l_exercise = $row['l_exercise'];
          $l_supplementary_note = $row['l_supplementary_note'];
          $l_quiz = $row['l_quiz'];
          $l_created_date = $row['l_created_date'];
          $l_released_date = $row['l_released_date'];
          ?>
          <form id="insertMbForm" action="edit-lesson-backend.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="l_id" name="l_id" value="<?php echo $l_id; ?>" readonly>
            <br>
            <div class="form-group">
              <label for="l_name">Lesson Name</label>
              <input type="text" class="form-control" id="l_name" name="l_name" value="<?php echo $l_name; ?>" required>
            </div>
            <div class="form-group">
              <label for="l_level">Level</label>
              <select class="form-control" id="l_level" name="l_level" required>
                <?php
                $levels = array(1, 2, 3, 4, 5, 6);
                foreach ($levels as $level) {
                  $selected = ($level == $l_level) ? 'selected' : '';
                  echo "<option value='$level' $selected>$level</option>";
                }
                ?>
              </select>
            </div>

            <br>
            <div class="form-group">
              <label for="l_lesson_desc">Lesson Description</label>
              <textarea class="form-control" id="l_lesson_desc" name="l_lesson_desc" placeholder="Enter the lesson description..." maxlength="1000" required><?php echo $l_lesson_desc; ?></textarea>
            </div>
            <br>
            <div class="form-group">
              <label for="l_lesson_plan">Lesson Plan (PDF)</label>
              <?php if ($l_lesson_plan) : ?>
                <p>Current File: <a href="<?php echo $l_lesson_plan; ?>" target="_blank"><?php echo $l_lesson_plan; ?></a></p>
              <?php else : ?>
                <p>No file uploaded</p>
              <?php endif; ?>
              <div class="file-upload">
                <label class="file-upload-label" for="l_lesson_plan">Choose File</label>
                <span class="file-upload-value"></span>
                <input type="file" id="l_lesson_plan" name="l_lesson_plan" accept="application/pdf">
              </div>
            </div>
            <div class="form-group">
              <label for="l_classroom_activity">Performace based(classroom activity)</label>
              <?php if ($l_classroom_activity) : ?>
                <p>Current File: <a href="<?php echo $l_classroom_activity; ?>" target="_blank"><?php echo $l_classroom_activity; ?></a></p>
              <?php else : ?>
                <p>No file uploaded</p>
              <?php endif; ?>
              <div class="file-upload">
                <label class="file-upload-label" for="l_classroom_activity">Choose File</label>
                <span class="file-upload-value"></span>
                <input type="file" id="l_classroom_activity" name="l_classroom_activity" accept="application/pdf">
              </div>
            </div>
            <div class="form-group">
              <label for="l_worksheet">Worksheet (PDF)</label>
              <?php if ($l_worksheet) : ?>
                <p>Current File: <a href="<?php echo $l_worksheet; ?>" target="_blank"><?php echo $l_worksheet; ?></a></p>
              <?php else : ?>
                <p>No file uploaded</p>
              <?php endif; ?>
              <div class="file-upload">
                <label class="file-upload-label" for="l_worksheet">Choose File</label>
                <span class="file-upload-value"></span>
                <input type="file" id="l_worksheet" name="l_worksheet" accept="application/pdf">
              </div>
            </div>

            <div class="form-group">
              <label for="l_exercise">Exercise (PDF)</label>
              <?php if ($l_exercise) : ?>
                <p>Current File: <a href="<?php echo $l_exercise; ?>" target="_blank"><?php echo $l_exercise; ?></a></p>
              <?php else : ?>
                <p>No file uploaded</p>
              <?php endif; ?>
              <div class="file-upload">
                <label class="file-upload-label" for="l_exercise">Choose File</label>
                <span class="file-upload-value"></span>
                <input type="file" id="l_exercise" name="l_exercise" accept="application/pdf">
              </div>
            </div>

            <div class="form-group">
              <label for="l_supplementary_note">Supplementary Notes (PPTX)</label>
              <?php if ($l_supplementary_note) : ?>
                <p>Current File: <a href="<?php echo $l_supplementary_note; ?>" target="_blank"><?php echo $l_supplementary_note; ?></a></p>
              <?php else : ?>
                <p>No file uploaded</p>
              <?php endif; ?>
              <div class="file-upload">
                <label class="file-upload-label" for="l_supplementary_note">Choose File</label>
                <span class="file-upload-value"></span>
                <input type="file" id="l_supplementary_note" name="l_supplementary_note" accept=".pptx, .ppt, .odp, .key, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-powerpoint, application/vnd.oasis.opendocument.presentation, application/x-iwork-keynote-sffkey">
              </div>
            </div>


            <div class="form-group">
              <label for="l_quiz">Quiz (PDF)</label>
              <?php if ($l_quiz) : ?>
                <p>Current File: <a href="<?php echo $l_quiz; ?>" target="_blank"><?php echo $l_quiz; ?></a></p>
              <?php else : ?>
                <p>No file uploaded</p>
              <?php endif; ?>
              <div class="file-upload">
                <label class="file-upload-label" for="l_quiz">Choose File</label>
                <span class="file-upload-value"></span>
                <input type="file" id="l_quiz" name="l_quiz" accept="application/pdf">
              </div>
            </div>
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

            <div class="form-group">
              <label for="l_released_date">Released Date</label>
              <?php
              // Assuming that $l_released_date is in the format 'Y-m-d'
              $releasedDate = date('Y-m-d', strtotime($l_released_date));
              ?>
              <input type="date" class="form-control" id="l_released_date" name="l_released_date" value="<?php echo $releasedDate; ?>" required>
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


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




</body>

</html>