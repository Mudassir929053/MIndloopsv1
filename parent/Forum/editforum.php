<?php
require_once("../commonPHP/head.php");

if (!session_id()) {
    session_start();

    if ($_SESSION["userType"] != '1') {
        header('location: ../login_and_register/login.php');
    }
}
extract($_GET);

include("../../dbconnect.php");
$data = [];
if (isset($_GET['forum_id'])) {
  extract($_GET);
  $sql = "SELECT * from forum where forum_id='$forum_id'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
} else {
  header('Location: forum.php');
}
if (count($data) == 0) {
  header('Location: forum.php');
}


?>
<?php include("../commonPHP/topNavBarLoggedIn.php"); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/parent.css">
<body class="imagebackground">
  <main id="main">
    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">Update Forum</h2>
        <br>
        <div class="row gy-4">
          <a href="forum.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <div class="col-lg-12">
            <form id="insertLpForm" action="#" onsubmit="return updateforum(this)" method="POST">
              <input type="hidden" name='forum_id' id='forum_id' value="<?= @$data[0]['forum_id'] ?>">
              <div class="form-group">
                <label for="forum_name">forum Name</label>
                <input type="text" class="form-control" id="forum_name" name="forum_name" value="<?= @$data[0]['forum_name'] ?>" placeholder="Enter Title" required>
              </div>
          
              <!-- <div class="form-group">
                <label for="forum_desc">User</label>
                <input class="form-control" name="forum_for"<?= @$data[0]['forum_for'] == 'adults' ? 'selected' : '' ?> value="adults">
              </div> -->
              <br>
              <div class="form-group">
                <label for="forum_desc">Description</label>
                <textarea class="form-control" id="summernote" name="forum_desc" placeholder="This is the Forum description..." maxlength="1000" required><?= @$data[0]['forum_description'] ?></textarea>
              </div>
              <br>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-warning">Update forum</button>
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
    function updateforum(obj) {
      console.log(obj);
      let formData = new FormData(obj);
      let url = 'forumQuery.php?updateforum=yes';
      fetch(url, {
        method: 'POST',
        body: formData
      }).then(data => data.text()).then(data => {
        alert(data);
        if (data == 'Updated successfully') {
          window.location.href = 'forum.php';
        }
      });
      return false;
    }
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