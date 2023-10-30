<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
include("../dbconnect.php");
$sql = "SELECT * FROM tb_subjects";
$result = mysqli_query($conn, $sql);
$parano = 2;
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
      <h2 style="text-align: center;">Create a Lesson</h2>
      <br>
      <div class="row gy-4">
        <div class="col-lg-12">
          <a href="view-mindbooster.php?mb_id=<?php echo $mb_id; ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
        </div>
        <div class="col-lg-12">
          <form id="insertMbForm" action="insert-lesson-backend.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="l_name">Lesson Name</label>
              <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter Lesson Name" required>
            </div>
            <div class="form-group">
              <label for="l_level">Level</label>
              <select class="form-select" id="l_level" name="l_level" required>
                <option value="">Select Level</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="l_lesson_desc">Lesson Description</label>
              <textarea class="form-control" id="l_lesson_desc" name="l_lesson_desc" placeholder="Enter Lesson Description" required></textarea>
            </div>
            <br>
            <div class="form-group">
              <label for="l_lesson_plan">Lesson Plan (.docx)</label>
              <input type="file" class="form-control-file" id="l_lesson_plan" name="l_lesson_plan" accept=".doc, .docx">
              <input type="hidden" id="mb_id" name="mb_id" value="<?php echo $mb_id; ?>">
            </div>
            <br>
            <div class="form-group">
              <label for="l_classroom_activity">Performance-based (Classroom Activity)</label>
              <input type="file" class="form-control-file" id="l_classroom_activity" name="l_classroom_activity">
            </div>
            <br>
            <div class="form-group">
              <label for="l_worksheet">Worksheet (PDF)</label>
              <input type="file" class="form-control-file" id="l_worksheet" name="l_worksheet" accept="application/pdf">
            </div>
            <br>
            <!-- <div class="form-group">
              <label for="l_exercise">Exercise (PDF)</label>
              <input type="file" class="form-control-file" id="l_exercise" name="l_exercise" accept="application/pdf">
            </div> -->
            <br>
            <div class="form-group">
              <label for="l_supplementary_note">Supplementary Notes (Presentation Files)</label>
              <input type="file" class="form-control-file" id="l_supplementary_note" name="l_supplementary_note" accept=".pptx, .ppt, .odp, .key, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-powerpoint, application/vnd.oasis.opendocument.presentation, application/x-iwork-keynote-sffkey">
            </div>
            <br>
            <div class="form-group">
              <label for="l_quiz">Quiz (PDF)</label>
              <input type="file" class="form-control-file" id="l_quiz" name="l_quiz" accept="application/pdf">
            </div>
            <br>
            <!-- <div class="form-group">
              <label for="l_image">Lesson Image</label>
              <input type="file" class="form-control-file" id="l_image" name="l_image" accept="image/jpeg, image/png, image/gif, image/svg+xml">
            </div> -->
            <br>
            <div class="form-group">
              <label for="l_released_date">Released Date</label>
              <input type="datetime-local" class="form-control" id="l_released_date" name="l_released_date">
            </div>
            <br>
            <div class="form-group">
              <button type="submit" class="btn btn-warning">Create Lesson</button>
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