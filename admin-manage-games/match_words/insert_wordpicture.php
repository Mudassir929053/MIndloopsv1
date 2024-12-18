<?php
if (!session_id()) {
  session_start();

  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}

include("../../dbconnect.php");
?>
<?php include("../../commonPHP/adminNavBar_quiz.php");
include 'function.php';
?>
<!-- <link rel="stylesheet" href="style.css"> -->


<style>
  body {
    background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
    background-size: 110%;
    background-position: top center;
  }

  #magazine-hero {
    background-image: none;
    height: 150px;
  }

  #imgDiv {
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
  }

  #insertMbForm {
    width: 60%;
    margin-left: auto;
    margin-right: auto;
    padding: 15px;
    background-color: azure;
    border: solid 1px rgba(255, 255, 0, 0);
    border-radius: 30px;
  }

  #m_id {
    background-color: transparent;
    border: 0px;
    outline: none;
  }

  #m_id:focus {
    background-color: transparent;
    border: 0px;
    outline: none;
  }
</style>


<body>

  <main id="main">

    <!-- <div class="mt-2">&nbsp</div> -->


    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">Add Word-Picture</h2>

        <br>

        <div class="row gy-4">
          <a href="admin.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <div class="col-lg-12">
            <form id="insertMbForm" method="POST" enctype='multipart/form-data'>
              <div class="form-group">
                <label for="word_name">Word Name</label>
                <input type="text" class="form-control" id="word_name" name="word_name" placeholder="Enter Word Name" required>
              </div>
              <br>
              <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category" placeholder="Enter Word Category" required>
              </div>
              <br>
              <div class="form-group">
                <label for="category_image">Category Image File *(.png / .jpg / .jpeg)</label>
                <input type="file" class="form-control-file" id="category_image" name="category_image" accept="image/png, image/jpeg, image/jpg" required>
              </div>
              <br>
              <div class="form-group">
                <label for="level">Level</label>
                <select class="form-select" name="level" id="level" required>
                  <option selected disabled>Select Level</option>
                  <option value="Easy">Easy</option>
                  <option value="Medium">Medium</option>
                  <option value="Hard">Hard</option>
                </select>
              </div>
              <br>
              <div class="form-group">
                <label for="image">Word-Image File *(.png / .jpg / .jpeg)</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/png, image/jpeg, image/jpg" required>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" name="addword" id="addword" class="btn btn-warning">Add Word-Picture</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <?php include("../../commonPHP/footer_admin.php"); ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php include("../../commonPHP/jsFiles.php"); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>