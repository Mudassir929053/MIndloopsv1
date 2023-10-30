<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
?>
<?php 
        
        if(!session_id())
        {
          session_start();
          
          if($_SESSION["userType"]!='2')
          {
            header ('location: ../../login_and_register/login.php');
          }
          
        }
        if(!isset($_GET['forumtopic_id'])){
          header('Location: forumtopic-comments.php');
      }
      include '../../dbconnect.php';
      extract($_GET);
      // echo $forum_id;
      // exit;
      $forum_name ='';
      $sql = "SELECT * from forum_postcomment where subforumtopic_id='$forumtopic_id'";
      $result = $conn->query($sql);
      while($row=$result->fetch_assoc()){
        // $forum_name=($row['forum_name']);
      }
      // echo $forum_name;
      
      ?>


<link href="../../assets/css/teacher.css" rel="stylesheet">

<body>



  <main id="main">

    <!-- <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Create Topic Comment(<?= $forum_name ?>)</h2>

        <br>

        <div class="row gy-4">

          <a href="forumtopic-comments.php?forumtopic_id=<?= $forumtopic_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

          <form id="insertLpForm" action="addtopiccommentBackend.php" method="POST" enctype='multipart/form-data'>
            <div class="form-group"> 
                <label for="c_name">Topic Comment</label>
                <input type="text" class="form-control" id="c_name5" name="c_name5" placeholder="Enter Topic Name" required>
                <input type="hidden" class="form-control" id="forumtopic_id" value="<?= $forumtopic_id?>" name="forumtopic_id">
            </div>
            <br>
            <div class="form-group"> 
                <label for="c_desc">Created By</label>
                <textarea class="form-control" id="c_desc6" name="c_desc6" placeholder="Enter User Name" maxlength="1000" required></textarea>
            </div>
            <!-- <div class="form-group"> 
                <label for="c_name">Created By</label>
                <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Enter Topic Name" required>
                <input type="hidden" class="form-control" id="forum_id" value="<?= $forumtopic_id?>" name="forum_id">
            </div> -->
            <br>       
 
            <div class="form-group">
                <button type="submit" class="btn btn-warning">Add Comment</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
            </div>
            
          </form>


          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php  include("../commonPHP/jsFiles.php"); ?>

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

  $( document ).ready(function() {
    document.getElementById("defaultOpen").click();
});


  </script>

</body>

</html>