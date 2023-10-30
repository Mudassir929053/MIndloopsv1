<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
?>
<?php
include("../commonPHP/adminNavBar.php");
include("../commonPHP/summernote.php");
?>
<main id="main">
  <section id="portfolio-details" class="portfolio-details">
    <div class="container-fluid">
      <h2 class="fw-bolder" style="text-align: center;">Update a Tip</h2>
      <br>
      <div class="row gy-4">
        <a href="manage-tip.php" class="btn btn-warning col-lg-1 fw-bolder offset-2"><i class="bi bi-arrow-left"></i> Back</a>
        <div class="col-lg-12">
          <form id="editMagForm" action="edit-tip-backend.php" method="POST" enctype='multipart/form-data'>
            <div class="form-group">
              <label for="t_id"><b>Tip ID</b></label>
              <input type="text" class="form-control-plaintext" id="t_id" name="t_id" aria-describedby="emailHelp" value="" readonly>
            </div>
            <br>
            <div class="form-group">
              <label for="t_audience"><b>Tip Audience</b></label>
              <select class="form-control" aria-label="Default select example" id="t_audience" name="t_audience" onchange="updateTipTypes(this.value)">
                <!-- <option selected>Open this select menu</option> -->
                <option value="Teacher">Teacher</option>
                <option value="Student">Student</option>
                <option value="Parent">Parent</option>
              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="t_type"><b>Tip Type</b></label>
              <select class="form-control" aria-label="Default select example" id="t_type" name="t_type">
              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="t_title">Title</label>
              <input type="text" class="form-control" id="t_title" name="t_title" placeholder="How to Tie Your Shoelaces" required>
            </div>
            <div class="form-group">
              <label for="t_audience"><b>Tip Video</b></label>
              <?php
              $query = mysqli_query($conn, "SELECT `v_id`, `v_title`, `v_desc`, `v_path`, `v_rDate`, `v_type`, `v_audience` FROM `tb_videos` WHERE 1");
              if ($query) {
              ?>
                <select class="form-control" name="video" id="t_video">
                  <option value="">Select Video</option>
                  <?php
                  while ($video = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    $selected = ($video["v_id"] === $jsonData[0]["t_video"]) ? "selected" : "";
                    echo '<option value="' . $video["v_id"] . '" ' . $selected . '>' . $video["v_title"] . '</option>';
                  }
                  ?>
                </select>
              <?php
              } else {
                echo "Error: " . mysqli_error($conn);
              }
              ?>
            </div>
            <!-- <br>
            <div class="form-group">
                <label for="m_edition">Edition</label>
                <input type="text" class="form-control" id="m_edition" name="m_edition"  placeholder="Hero" required>
            </div> -->
            <br>
            <div class="form-group">
              <label for="t_rDate">Release Date</label>
              <input type="datetime-local" class="form-control" id="t_rDate" name="t_rDate" required>
            </div>
            <br>
            <div class="form-group">
              <label for="t_author">Author</label>
              <input type="text" class="form-control" id="t_author" name="t_author" placeholder="MindLoops" required>
            </div>
            <br>
            <div class="form-group">
              <label for="summernote">Description (less than 1000 characters.)</label>
              <textarea class="form-control" id="summernote" name="t_desc" required></textarea>
            </div>
            <br>
            <div class="form-group">
              <label for="m_id"><b>Current Tip File *(.png / .jpg / .jpeg)</b></label>
              <input type="text" class="form-control-plaintext" id="currFilePath" name="currFilePath" aria-describedby="emailHelp" value="" style="font-size: 13px;" readonly>
            </div>
            <div class="form-group">
              <label for="m_filePath"><b></b></label><!--New Magazine File *(.pdf)-->
              <input type="file" class="form-control-file" id="m_filePathNew" name="m_filePathNew" accept="image/png, image/jpeg, image/jpg">
            </div>
            <br>
            <div class="form-group">
              <button type="submit" class="btn btn-warning fw-bolder">Update Tip</button>
              <button type="reset" class="btn btn-secondary fw-bolder">Clear</button>
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
<script>
  document.getElementById("t_id").value = (Math.floor(Math.random() * 90000) + 10000);
  $(document).ready(function() {
    $('#summernote').summernote({
      placeholder: 'Enter your tip here...',
    });
  });
</script>
<script>
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const t_id = urlParams.get('t_id');
  var xhr = new XMLHttpRequest();
  xhr.open("get", "./read-single-tip.php?t_id=" + t_id);
  xhr.send();
  xhr.onload = async function() {
    var jsonData = JSON.parse(xhr.responseText);
    // console.log(jsonData);
    if (jsonData.length > 0) {
      document.getElementById("t_id").value = jsonData[0].t_id;
      document.getElementById("t_title").value = jsonData[0].t_title;
      document.getElementById("t_video").value = jsonData[0].t_video;
      document.getElementById("summernote").value = jsonData[0].t_desc;
      $('#summernote').summernote({});
      document.getElementById("t_author").value = jsonData[0].t_author;
      document.getElementById('t_audience').value = jsonData[0].t_audience;
      await updateTipTypes(jsonData[0].t_audience);
      document.getElementById("t_type").value = jsonData[0].t_type;
      document.getElementById("t_rDate").value = jsonData[0].t_rDate;
      document.getElementById("currFilePath").value = jsonData[0].t_filePath;
    } else {
      alert('Details not found!! Please check again');
      window.location.href = 'manage-tip.php';
    }
  }

  function updateTipTypes(selectedAudience) {
    const typeSelect = document.getElementById("t_type");
    typeSelect.innerHTML = '<option selected>Select Tip Type</option>';
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
  }
</script>
</body>

</html>