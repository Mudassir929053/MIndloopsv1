<?php
if (!session_id()) {
  include("../dbconnect.php");
  include("../commonPHP/adminNavBar.php");
  include("../commonPHP/head.php");
  // session_start();

  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }

  if (isset($_GET['l_id'])) {
    $l_id = $_GET['l_id'];
    // echo $mb_id;
  }

  $single_mb = "SELECT * FROM `tb_lessons`
    where l_id = ?";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $single_mb);

  mysqli_stmt_bind_param($stmt, "s", $l_id);

  mysqli_stmt_execute($stmt);
  $single_mb_result = $stmt->get_result();
}

?>


<main id="main">

  <div id="magazine-hero">
  </div>

  <section id="portfolio-details" class="portfolio-details">
    <div class="container">

      <h2 style="text-align: center;">View Mind Booster</h2>

      <br>

      <div class="row gy-4">
        <?php
        while ($row = $single_mb_result->fetch_assoc()) {
        ?>

          <a href="manage-mindbooster.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <!-- <img id="magazine-img" src=<?php echo $row["mb_filePath"]; ?>  alt="" height="300px" class="col-lg-12"> -->

          <div class="col-lg-12">

            <table id="mbTbl" class="table table-warning table-borderless table-striped table-hover">

              <thead>
                <tr>
                  <th><strong>ID</strong></th>
                  <th><?php echo $row["l_id"]; ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>level</strong></td>
                  <td><?php echo $row['l_level']; ?></td>
                </tr>
                <!-- <tr></tr> -->
                <tr>
                  <td><strong>Lesson Plan</strong></td>
                  <td>
                    <?php
                    $lessonPlanFileName = basename($row["l_lesson_plan"]);
                    echo $lessonPlanFileName;
                    ?>
                    <a href="<?php echo $row["l_lesson_plan"]; ?>" target="_blank" class="btn btn-primary">View</a>
                  </td>
                </tr>
                <tr>
                  <td><strong>Lesson desc</strong></td>
                  <td><?php echo $row["l_lesson_desc"]; ?></td>
                </tr>

                <tr>
                  <td><strong>Lesson Worksheet</strong></td>
                  <td>
                    <?php
                    $worksheetFileName = basename($row["l_worksheet"]);
                    echo $worksheetFileName;
                    ?>
                    <a href="<?php echo $row["l_worksheet"]; ?>" target="_blank" class="btn btn-primary">View</a>
                  </td>
                </tr>
                <tr>
                  <td><strong>Lesson Exercise</strong></td>
                  <td>
                    <?php
                    $exerciseFileName = basename($row["l_exercise"]);
                    echo $exerciseFileName;
                    ?>
                    <a href="<?php echo $row["l_exercise"]; ?>" target="_blank" class="btn btn-primary">View</a>
                  </td>
                </tr>
                <tr>
                  <td><strong>Lesson Supplementary Notes</strong></td>
                  <td>
                    <?php
                    $supplementaryNotesFileName = basename($row["l_supplementary_note"]);
                    echo $supplementaryNotesFileName;
                    ?>
                    <a href="<?php echo $row["l_supplementary_note"]; ?>" target="_blank" class="btn btn-primary">View</a>
                  </td>
                </tr>
                <tr>
                  <td><strong>Lesson Quiz</strong></td>
                  <td>
                    <?php
                    $quizFileName = basename($row["l_quiz"]);
                    echo $quizFileName;
                    ?>
                    <a href="<?php echo $row["l_quiz"]; ?>" target="_blank" class="btn btn-primary">View</a>
                  </td>
                </tr>
                <tr>
                  <td><strong>Release Date</strong></td>
                  <td><?php echo $row["l_released_date"]; ?></td>
                </tr>

              </tbody>
            </table>

          <?php } ?>

          </div>

      </div>



    </div>
  </section>

</main><!-- End #main -->

<?php include("../commonPHP/footer_admin.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>


<script>
  $(document).ready(function() {

    $('#mbtbl').dataTable({
      "columns": [{
          "width": "40%"
        },
        {
          "width": "60%"
        }
      ]
    });

  });
</script>


</body>

</html>