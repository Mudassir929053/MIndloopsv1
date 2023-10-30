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
          
          if($_SESSION["userType"]!='1')
          {
            header ('location: ../login_and_register/login.php');
          }
          
        }

      // echo $forum_name;
      
      ?>
<?php

 

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Assuming you have the $_POST data from the form submission
    $subforumtopic_id = $_GET['forumtopic_id'];
    $content = $_POST['content'];
    $created_by = $_POST['created_by'];

    // Prepare and execute the insert query
    $sql = "INSERT INTO `forum_postcomment` (`subforumtopic_id`, `content`, `created_by`, `created_at`, `approved`, `likes`, `dislikes`)
            VALUES ('$subforumtopic_id', '$content', '$created_by', NOW(), 0, 0, 0)";
    $result = $conn->query($sql);

    if ($result !== false) {
     
        echo "<script>alert('Comment inserted successfully.')</script>";

    } else {
        echo "Something went wrong.";
    }
}
$conn->close();
?>


 <style>

body{
  background-image: url('../../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
  background-size: 110%;
  background-position: top center;
}

#magazine-hero{
  background-image: none;
  height: 150px;
}

#imgDiv{
  width: 100%;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
}

#insertLpForm{
        width:60%; 
        margin-left:auto; 
        margin-right:auto; 
        padding:15px; 
        background-color: azure;
        border: solid 1px rgba(255,255,0,0);
        border-radius: 30px;
    }

    #m_id {
        background-color:transparent;
        border:0px;
        outline: none;
    }

    #m_id:focus {
        background-color:transparent;
        border:0px;
        outline: none;
    }

</style>

<style>
body {font-family: Arial;}

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

    <!-- <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <!-- <h2 style="text-align: center;">Create Topic(<?= $forum_name ?>)</h2> -->

        <br>

        <div class="row gy-4">

          <a href="forumtopic-comments.php?forum_id=<?= $forumtopic_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

          <form id="insertLpForm" action="add comment.php" method="POST" enctype='multipart/form-data'>
            <div class="form-group"> 
                <label for="content">Comment</label>
                <input type="text" class="form-control" id="content" name="content" placeholder="Enter Comment" required>
                <input type="hidden" class="form-control" id="forum_id" value="<?= $subforumtopic_id?>" name="subforumtopic_id">
            </div>
            <br>
            <div class="form-group"> 
                <label for="created_by">created</label>
                <textarea class="form-control" id="created_by" name="created_by" placeholder="Enter Topic description..." maxlength="1000" required></textarea>
            </div>
            <br>       
 
            <div class="form-group">
                <button type="submit" class="btn btn-warning" name="submit">Add Comment</button>
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