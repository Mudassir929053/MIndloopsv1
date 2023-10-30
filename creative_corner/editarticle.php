<?php
require_once("../commonPHP/head.php");
if (!session_id()) {
  session_start();
}
if ($_SESSION["userType"] != '3') {
  echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
  // header("../login_and_register/login.php");
}

include("../dbconnect.php");

$data = [];
if (isset($_GET['forumtopic_id'])) {
  extract($_GET);
  $sql = "SELECT * from kidzpost where kidzpost_id  ='$forumtopic_id ' and topic_id='$forum_id'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
} else {
  header('Location: forum_details.php?forum_id=' . $forum_id);
}
if (count($data) == 0) {
  header('Location: viewforum.php');
}
// var_dump($data);
// exit;
?>
<?php include("../commonPHP/topNavBarCheck.php"); ?>


<link rel="stylesheet" href="../../assets/css/style.css">
<link href="../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

  #insertLpForm {
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

<style>
  body {
    font-family: Arial;
  }

  /* Style the tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }

  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }
</style>


<body>



  <main id="main">

   
    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

   
      <div class="container-fluid">
        <h2 style="text-align: center;">Update Topic</h2>
        <br>
        <div class="row">
          <a href="forum_topics.php?forum_id=<?= $forum_id ?>&forumtopic_id=<?= $forumtopic_id ?>" class="btn btn-warning col-lg-1 mb-md-2 offset-md-2"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">
            <form id="insertLpForm" action="#" onsubmit="return updateforumtopic(this)" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="forumtopic_id" id="forumtopic_id" value="<?= @$data[0]['kidzpost_id'] ?>">
              <div class="form-group">
                <label for="ft_name">Forum Topic Name</label>
                <input type="text" class="form-control" id="ft_name" name="ft_name" value="<?= @$data[0]['title'] ?>" placeholder="Enter forum topic" required>
              </div>
              <br>
              <div class="form-group">
                <label for="ft_desc">Article Description</label>
                <textarea class="form-control" id="summernote" name="ft_desc" placeholder="This is the mindbooster description..." maxlength="1000" required><?= @$data[0]['content'] ?></textarea>
              </div>
              <br>
              <div class="form-group">
                <label for="c_thumbnail">Cover Image (.png / .jpg / .jpeg)</label>
                <?php if (!empty($data[0]['attachment'])) { ?>
                  <div>
                    <img src="<?= $data[0]['attachment'] ?>" alt="Current Cover Image" style="max-width: 200px; margin-bottom: 10px;">
                  </div>
                <?php } ?>
                <input type="file" class="form-control" id="c_thumbnail" name="c_thumbnail" accept="image/png, image/jpeg, image/jpg">
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-warning">Update Forum Topic</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
              </div>
            </form>
          </div>
        </div>
      </div>

  </main><!-- End #main -->

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include("../commonPHP/jsFiles.php"); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    function updateforumtopic(obj) {
      console.log(obj);
      let formData = new FormData(obj);
      let url = 'editarticle_function.php?updateforumtopic=yes'; // Update the URL to match your PHP file
      fetch(url, {
        method: 'POST',
        body: formData
      }).then(data => data.text()).then(data => {
        alert(data);
        if (data == 'Updated successfully') {
          window.location.href = 'forum_topics.php?forum_id=<?= $forum_id ?>&forumtopic_id=<?= $forumtopic_id ?>';
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