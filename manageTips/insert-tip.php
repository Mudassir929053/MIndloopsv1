<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
include("../commonPHP/adminNavBar.php");
include("../commonPHP/summernote.php");
?>
<main id="main">
  <section id="portfolio-details" class="portfolio-details">
    <div class="container-fluid">
      <h2 style="text-align: center;">Create a Tip</h2>
      <br>
      <div class="row-5 gy-2">
        <a href="manage-tip.php" class="btn btn-warning mb-3 fw-bolder col-lg-1 offset-2"><i class="bi bi-arrow-left"></i> Back</a>
        <div class="col-lg-12">
          <form id="insertMagForm" action="insert-tip-backend.php" method="POST" enctype='multipart/form-data'>
            <div class="form-group">
              <label for="t_id"><b>Tip ID (Auto Generated)</b></label>
              <input type="text" class="form-control-plaintext" id="t_id" name="t_id" aria-describedby="emailHelp" value="" readonly>
            </div>
            <br>
            <div class="form-group">
              <label for="t_audience"><b>Tip Audience</b></label>
              <select class="form-control" aria-label="Default select example" id="t_audience" name="t_audience" onchange="updateTipTypes(this.value)">
                <option selected>Select Audience</option>
                <option value="Teacher">Teacher</option>
                <option value="Student">Student</option>
                <option value="Parent">Parent</option>
              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="t_type"><b>Tip Type</b></label>
              <select class="form-control" aria-label="Default select example" id="t_type" name="t_type">
                <option selected>Seelct Tip Type</option>
              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="t_title">Tip Title</label>
              <input type="text" class="form-control" id="t_title" name="t_title" placeholder="Kembali Ke Sekolah" required>
            </div>
            <div class="form-group">
              <label for="t_audience"><b>Tip Video</b></label>
              <?php
              $query = mysqli_query($conn, "SELECT `v_id`, `v_title`, `v_desc`, `v_path`, `v_rDate`, `v_type`, `v_audience` FROM `tb_videos` WHERE 1");
              if ($query) {
              ?>
                <select class="form-control" name="video">
                  <option selected>Select Video</option>
                  <?php
                  while ($video = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                  ?>
                    <option value="<?php echo $video["v_id"]; ?>">
                      <?php echo $video["v_title"]; ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
              <?php
              } else {
                echo "Error: " . mysqli_error($conn);
              }
              ?>
            </div>
            <br>
            <div class="form-group">
              <label for="t_rDate">Tip Release Date</label>
              <input type="datetime-local" class="form-control" id="t_rDate" name="t_rDate" required>
            </div>
            <br>
            <div class="form-group">
              <label for="t_author">Tip Author</label>
              <input type="text" class="form-control" id="t_author" name="t_author" placeholder="MindLoops" required>
            </div>
            <br>
            <div class="form-group">
              <label for="summernote">Tip Description</label>
              <textarea class="form-control" id="summernote" name="t_desc" spellcheck="false" required></textarea>
            </div>
            <br>
            <div class="form-group">
              <label for="t_filePath">Image *(.png / .jpg / .jpeg)</label>
              <input type="file" class="form-control-file" id="t_filePath" name="t_filePath" accept="image/png, image/jpeg, image/jpg" required>
            </div>
            <!-- <br>
            <div class="form-group">
                <label for="m_filePath">Magazine File *(.pdf)</label>
                <input type="file" class="form-control-file" id="m_filePath" name="m_filePath" accept="application/pdf" required>
            </div> -->
            <br>
            <div class="form-group">
              <button type="submit" class="btn btn-warning fw-bolder">Create Tip</button>
              <button type="reset" class="btn btn-secondary fw-bolder">Clear</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
<script>
  function updateTipTypes(selectedAudience) {
    // const audienceSelect = document.getElementById("t_audience");
    const typeSelect = document.getElementById("t_type");
    // Clear existing options
    typeSelect.innerHTML = '<option selected>Select Tip Type</option>';
    // Get selected audience
    // const selectedAudience = audienceSelect.value;
    // Set available options based on selected audience
    if (selectedAudience === "Teacher") {
      typeSelect.innerHTML += '<option value="Counselling">Counselling</option>';
      typeSelect.innerHTML += '<option value="Curriculum & Co-Curriculum">Curriculum & Co-Curriculum</option>';
      typeSelect.innerHTML += '<option value="Teaching Resources">Teaching Resources</option>';
      typeSelect.innerHTML += '<option value="Classroom Management">Classroom Management</option>';
    } else if (selectedAudience === "Student") {
      typeSelect.innerHTML += '<option value="Living Skills">Living Skills</option>';
      typeSelect.innerHTML += '<option value="Study Smart">Study Smart</option>';
      typeSelect.innerHTML += '<option value="Citizenship">Citizenship</option>';
    } else if (selectedAudience === "Parent") {
      typeSelect.innerHTML += '<option value="Children">Children</option>';
      typeSelect.innerHTML += '<option value="Teen">Teen</option>';
      typeSelect.innerHTML += '<option value="Tutoring">Tutoring</option>';
      typeSelect.innerHTML += '<option value="Parenting Skills">Parenting Skills</option>';
    }
    // Add other available options for all audiences
    // typeSelect.innerHTML += '<option value="Study Smart">Study - Smart</option>';
    // typeSelect.innerHTML += '<option value="Citizenship">Citizenship</option>';
  }
</script>
<?php include("../commonPHP/footer_admin.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<script>
  document.getElementById("t_id").value = (Math.floor(Math.random() * 90000) + 10000);
  $(document).ready(function() {
    $('#summernote').summernote({
      placeholder: 'Enter your tip here...',
      
    });
  });
</script>
</body>

</html>