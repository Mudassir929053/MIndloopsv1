<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
?>
<?php

if (!session_id()) {
  session_start();

  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
if (!isset($_GET['forum_id'])) {
  header('Location: forum-category.php');
}
 
extract($_GET);
// echo $forum_id;
// exit;
$forum_name = '';
$sql = "SELECT * from forum where forum_id='$forum_id'";
// exit;
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
  $forum_name=($row['forum_name']);
}
// echo $forum_name;

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../../assets/css/parent.css">
<body class="imagebackground">



  <main id="main">

    <!-- <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Create Topic(<?= $forum_name ?>)</h2>

        <br>

        <div class="row gy-4">

          <a href="forum-articles.php?forum_id=<?= $forum_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

            <form id="insertLpForm" action="addtopicBackend.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="c_name">Topic Name</label>
                <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Enter Topic Name" required>
                <input type="hidden" class="form-control" id="forum_id" value="<?= $forum_id ?>" name="forum_id">
              </div>
              <br>
              <div class="form-group">
                <label for="c_desc">Topic Description</label>
                <textarea class="form-control" id="summernote" name="c_desc" placeholder="Enter Topic description..." maxlength="1000" required></textarea>
              </div>
              <br>
              <div class="form-group">
                <label for="c_thumbnail">Image</label>
                <input type="file" class="form-control" id="c_thumbnail" name="c_thumbnail" required>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-warning">Add Topic</button>
                <button type="reset" class="btn btn-secondary bg-secondary text-white rounded">Clear</button>
              </div>


            </form>


          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include("../commonPHP/jsFiles.php"); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it

    $(document).ready(function() {
      document.getElementById("defaultOpen").click();
    });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script>
    // document.getElementById("t_id").value = (Math.floor(Math.random() * 90000) + 10000);
    $(document).ready(function() {
      $('#summernote').summernote({
        minHeight: 200
      });
    });
  </script>
</body>

</html>