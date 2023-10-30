<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
include("../commonPHP/adminNavBar.php"); ?>
<main id="main">
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">
      <h2 style="text-align: center;">Update a Video</h2>
      <br>
      <div class="row gy-4">
        <a href="manage-video.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
        <div class="col-lg-12">
          <form id="editMagForm" action="edit-video-backend.php" method="POST" enctype='multipart/form-data'>
            <div class="form-group">
              <label for="v_id"><b>Video ID</b></label>
              <input type="text" class="form-control-plaintext" id="v_id" name="v_id" aria-describedby="emailHelp" value="" readonly>
            </div>
            <br>
            <div class="form-group">
              <label for="v_audience"><b>Video Audience</b></label>
              <select class="form-select" aria-label="Default select example" id="v_audience" name="v_audience">
                <!-- <option selected>Open this select menu</option> -->
                <option id="teacherAudience" value="Teacher">Teacher</option>
                <option id="studentAudience" value="Student">Student</option>
                <option id="parentAudience" value="Parent">Parent</option>
              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="v_type"><b>Video Type</b></label>
              <select class="form-select" aria-label="Default select example" id="v_type" name="v_type">
                <!-- <option selected>Open this select menu</option> -->
                <option value="">Select Video Type</option>
                <option value="Study Smart">Study Smart</option>
                <option value="Citizenship">Citizenship</option>
                <option value="Tutoring">Tutoring</option>
                <option value="Parenting Skills">Parenting Skills</option>
                <option value="Counselling">Counselling</option>
                <option value="Curriculum & Co-Curriculum">Curriculum & Co-Curriculum</option>
                <!-- <option id="teensType" value="Teens">Parent - Teens</option> -->
              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="v_title">Title</label>
              <input type="text" class="form-control" id="v_title" name="v_title" placeholder="How to Tie Your Shoelaces" required>
            </div>
            <!-- <br>
            <div class="form-group">
                <label for="m_edition">Edition</label>
                <input type="text" class="form-control" id="m_edition" name="m_edition"  placeholder="Hero" required>
            </div> -->
            <br>
            <div class="form-group">
              <label for="v_rDate">Release Date</label>
              <input type="datetime-local" class="form-control" id="v_rDate" name="v_rDate" required>
            </div>
            <br>
            <div class="form-group">
              <label for="v_desc">Description (less than 1000 characters.)</label>
              <textarea class="form-control" id="v_desc" name="v_desc" placeholder="This is the magazine description..." maxlength="1000" required></textarea>
            </div>
            <br>
            <div class="form-group">
              <label for="v_path">Video URL</label>
              <input type="file" class="form-control" id="v_path" name="v_path" placeholder="https://www.youtube.com">
            </div>
            <div class="row p-5">
              <div class="col-lg-4">
                <div class="ratio ratio-16x9 mt-4">
                  <iframe id='video_src' src="<?= $data['v_path'] ?>" title="YouTube video" allowfullscreen></iframe>
                </div>
              </div>
              <div class="col-lg-8">&nbsp;</div>
            </div>
            <br>
            <div class="form-group">
              <button type="submit" class="btn btn-warning">Update Video</button>
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
<script>
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const v_id = urlParams.get('v_id');
  var xhr = new XMLHttpRequest();
  xhr.open("get", "../videos/read-single-video.php?v_id=" + v_id);
  xhr.send();
  xhr.onload = function() {
    var jsonData = JSON.parse(xhr.responseText);
    // console.log(xhr.responseText);
    document.getElementById("v_id").value = jsonData[0].v_id;
    document.getElementById("v_title").value = jsonData[0].v_title;
    document.getElementById("v_desc").innerHTML = jsonData[0].v_desc;
    if (jsonData[0].v_audience === "Teacher") {
      document.getElementById("teacherAudience").setAttribute("selected", true);
    } else if (jsonData[0].v_audience === "Student") {
      document.getElementById("studentAudience").setAttribute("selected", true);
    } else if (jsonData[0].v_audience === "Parent") {
      document.getElementById("parentAudience").setAttribute("selected", true);
    }
    document.getElementById("video_src").src = jsonData[0].v_path;
    if (jsonData[0].v_type === "D.I.Y") {
      document.getElementById("diyType").setAttribute("selected", true);
    } else if (jsonData[0].v_type === "Parenting") {
      document.getElementById("parentingType").setAttribute("selected", true);
    } else if (jsonData[0].v_type === "Professional Development") {
      document.getElementById("professionalDevelopmentType").setAttribute("selected", true);
    }
    // else if(jsonData[0].v_type === "Living Skills"){
    //     document.getElementById("livingSkillsType").setAttribute("selected",true);
    // }
    document.getElementById("v_rDate").value = jsonData[0].v_rDate;
    // document.getElementById("currImgPath").value = jsonData[0].m_imgPath;
    // document.getElementById("currFilePath").value = jsonData[0].t_filePath;
  }
  var frm = $('#editMagForm');
  frm.submit(function(e) {
    e.preventDefault();
    // console.log(this);
    let formData = new FormData(this);
    fetch(frm.attr('action'), {
      method: 'POST',
      body: formData
    }).then(data => data.text()).then(data => {
      alert(data);
      window.location.href = "manage-video.php";
    });
    return false;
  });
</script>
</body>

</html>