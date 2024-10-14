<?php      
if(!session_id())
    {
        session_start();
  if($_SESSION["userType"]!='1')
  {
    header ('location: ../login_and_register/login.php');
  }    }
 
  include("../commonPHP/adminNavBar.php");  
  ?>

  <main id="main">
 
    
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Create a Video</h2>

        <br>

        <div class="row gy-4">

          <a href="manage-video.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">
            
          <form id="insertMagForm" action="insert-video-backend.php" method="POST" enctype='multipart/form-data'>
            <div class="form-group">
                <label for="v_id"><b>Video ID (Auto Generated)</b></label>
                <input type="text" class="form-control-plaintext" id="v_id" name="v_id" aria-describedby="emailHelp" value="" readonly>
            </div>
            <br>
            <div class="form-group">
                <label for="v_audience"><b>Video Audience</b></label>
                <select class="form-select" aria-label="Default select example" required id="v_audience" name="v_audience">
                  <option value="">Select Video Audience</option>
                  <option  value="Teacher">Teacher</option>
                  <option  value="Student">Student</option>
                  <option  value="Parent">Parent</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="v_type"><b>Video Type</b></label>
                <select class="form-select" required id="v_type" name="v_type">
                  <option value="">Select Video Type</option>
                  <option  value="Study Smart">Study Smart</option>
                  <option  value="Citizenship">Citizenship</option>
                  <option  value="Tutoring">Tutoring</option>
                  <option  value="Parenting Skills">Parenting Skills</option>
                  <option  value="Counselling">Counselling</option>
                  <option  value="Curriculum & Co-Curriculum">Curriculum & Co-Curriculum</option>

                </select>            
            </div>
            <br>
            <div class="form-group">
                <label for="v_title">Title</label>
                <input type="text" class="form-control" id="v_title" name="v_title" placeholder="How to tie your shoelaces" required>
            </div>
            <!-- <br>
            <div class="form-group">
                <label for="m_edition">Edition</label>
                <input type="text" class="form-control" id="m_edition" name="m_edition" placeholder="Hero" required>
            </div> -->
            <br>
            <div class="form-group">
                <label for="v_rDate">Release Date</label>
                <input type="datetime-local" class="form-control" id="v_rDate" name="v_rDate" required>
            </div>
            <br>
            <!-- <div class="form-group">
                <label for="t_author">Author</label>
                <input type="text" class="form-control" id="t_author" name="t_author" placeholder="MindLoops" required>
            </div>
            <br> -->
            <div class="form-group">
                <label for="v_desc">Description (less than 1000 characters.)</label>
                <textarea class="form-control" id="v_desc" name="v_desc" placeholder="This is the video description..." maxlength="1000" required></textarea>
            </div>
            <br>
            <div class="form-group">
                <label for="v_path">Video</label>
                <input type="file" class="form-control" id="v_path" name="v_path" placeholder="https://www.youtube.com/" required>
            </div>
            <!-- <br>
            <div class="form-group">
                <label for="v_imgPath">Image *(.png / .jpg / .jpeg)</label>
                <input type="file" class="form-control-file" id="v_imgPath" name="v_imgPath" accept="image/png, image/jpeg, image/jpg" required>
            </div> -->
            <!-- <br>
            <div class="form-group">
                <label for="m_filePath">Magazine File *(.pdf)</label>
                <input type="file" class="form-control-file" id="m_filePath" name="m_filePath" accept="application/pdf" required>
            </div> -->
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-warning">Create Video</button>
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

  <?php  include("../commonPHP/jsFiles.php"); ?>


  <script>

    document.getElementById("v_id").value = (Math.floor(Math.random()*90000) + 10000);

  </script>


</body>

</html>
