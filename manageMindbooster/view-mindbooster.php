<?php
if (!session_id()) {
  include("../commonPHP/adminNavBar.php");
  // session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
?>
<?php
include("../commonPHP/jsFiles.php");
?>
<?php
if (isset($_GET['mb_id'])) {
  $mb_id = $_GET['mb_id'];
}
?>
<main>
  <div class="container">
    <h2 style="text-align: center;">Manage Lessons</h2>
    <br>
    <div class="row gy-4">
      <div class="d-flex justify-content-between">
        <a href="insert-lesson.php?mb_id=<?php echo $mb_id; ?>" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add a New Lesson</a>
        <a href="manage-mindbooster.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
      </div>
      <div class="col-lg-12">
        <table id="magTbl" class="table datatable table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">SNo.</th>
              <th scope="col">Name</th>
              <th scope="col">Level</th>
              <th scope="col">Lesson Plan</th>
              <th scope="col">Lesson Desc</th>
              <th scope="col">Performance</th>
              <th scope="col">Worksheet</th>
              <th scope="col">Exercise</th>
              <th scope="col">Supplementary Notes</th>
              <th scope="col">Quiz</th>
              <th scope="col">Created Date</th>
              <th scope="col">Released Date</th>
              <th scope="col" width="150px" style="text-align: center;">Actions</th>
            </tr>
          </thead>
          <tbody id="tbody">
            <?php
            // Retrieve lesson data from the database
            $query = "SELECT * FROM tb_lessons WHERE l_mb_id='$mb_id' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
              $counter = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                $l_id = $row['l_id'];
                $l_name = $row['l_name'];
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
                // Assign a class based on the level value
                $rowClass = '';
                switch ($l_level) {
                  case '1':
                    $rowClass = 'level-one';
                    break;
                  case '2':
                    $rowClass = 'level-two';
                    break;
                  case '3':
                    $rowClass = 'level-three';
                    break;
                  case '4':
                    $rowClass = 'level-four';
                    break;
                  case '5':
                    $rowClass = 'level-five';
                    break;
                  case '6':
                    $rowClass = 'level-six';
                    break;
                }
            ?>
                <tr class="<?php echo $rowClass; ?>">
                  <td><?php echo $counter; ?></td>
                  <td><?php echo $l_name; ?></td>
                  <td><?php echo $l_level; ?></td>
                  <td>
                    <?php if (!empty($l_lesson_plan)) { ?>
                      <a href="<?php echo $l_lesson_plan; ?>" target="_blank" class="btn btn-link">
                        <i class="bi bi-file-pdf" style="font-size: 24px;"></i>
                      </a>
                    <?php } ?>
                  </td>
                  <td>
                    <?= (strip_tags(substr($l_lesson_desc, 0, 20))) ?>...
                    <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $l_lesson_desc; ?>">
                      <span style="color: skyblue;">Read More</span>
                    </button>
                  </td>
                  <td>
                    <?php if (!empty($l_classroom_activity)) { ?>
                      <button onclick="window.open('<?php echo $l_classroom_activity; ?>', '_blank')" class="btn btn-link">
                        <i class="bi bi-file-pdf" style="font-size: 24px;"></i>
                      </button>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if (!empty($l_worksheet)) { ?>
                      <button onclick="window.open('<?php echo $l_worksheet; ?>', '_blank')" class="btn btn-link">
                        <i class="bi bi-file-pdf" style="font-size: 24px;"></i>
                      </button>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if (!empty($l_exercise)) { ?>
                      <button onclick="window.open('<?php echo $l_exercise; ?>', '_blank')" class="btn btn-link">
                        <i class="bi bi-file-pdf" style="font-size: 24px;"></i>
                      </button>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if (!empty($l_supplementary_note)) { ?>
                      <button onclick="window.open('<?php echo $l_supplementary_note; ?>', '_blank')" class="btn btn-link">
                        <i class="bi bi-file-ppt" style="font-size: 24px;"></i>
                      </button>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if (!empty($l_quiz)) { ?>
                      <button onclick="window.open('<?php echo $l_quiz; ?>', '_blank')" class="btn btn-link">
                        <i class="bi bi-file-pdf" style="font-size: 24px;"></i> </button>
                    <?php } ?>
                  </td>
                  <td><?php echo $l_created_date; ?></td>
                  <td><?php echo $l_released_date; ?></td>
                  <td style="text-align: center;">
                    <!-- <a href="view-lesson.php?l_id=<?php echo $l_id; ?>" class="btn btn-sm btn-link text-danger mx-1 rounded-circle"><i class="bi bi-eye-fill"></i></a> -->
                    <a href="edit-lesson.php?l_id=<?php echo $l_id; ?>&mb_id=<?php echo $mb_id; ?>" class="btn btn-sm btn-link text-danger mx-1 rounded-circle"><i class="bi bi-pencil-fill"></i></a>
                    <a href="delete-lesson.php?l_id=<?php echo $l_id; ?>" class="btn btn-sm btn-link text-danger mx-1 rounded-circle" onclick="return confirm('Are you sure you want to delete this lesson?')"><i class="bi bi-trash-fill"></i></a>
                  </td>
                </tr>
            <?php
                $counter++;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main><!-- End #main -->
<?php include("../commonPHP/footer_admin.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<script>
  $(document).ready(function() {
    // Initialize DataTable with pagination and search
    $('#magTbl').DataTable();
  });
</script>
</body>

</html>