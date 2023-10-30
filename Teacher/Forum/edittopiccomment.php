<?php
require_once("../commonPHP/head.php");

if (!session_id()) {
    session_start();

    if ($_SESSION["userType"] != '2') {
        header('location: ../../login_and_register/login.php');
    }
}

include("../../dbconnect.php");

if (isset($_POST['update'])) {
  // Get the new values from the form
  $newContent = $_POST['content'];
  $comment_id = $_POST['comment_id'];

  // Get the current date and time
  $newCreatedAt = date('Y-m-d H:i:s');

  // Perform the update query
  $sql = "UPDATE forum_postcomment SET
          content = '$newContent',
          created_at = '$newCreatedAt'
          WHERE comment_id = '$comment_id'";

  // Execute the query and handle the result
  $result = $conn->query($sql);
  if ($result !== false) {
      echo "Updated successfully";
  } else {
      echo "Something went wrong";
  }
}


// Retrieve the existing values of the comment from the database
$data = [];
if (isset($_GET['comment_id'])) {
  extract($_GET);
  $sql = "SELECT * FROM forum_postcomment WHERE comment_id = '$comment_id' AND subforumtopic_id = '$forumtopic_id'";
  $result = $conn->query($sql);
  if ($result !== false) {
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $data[] = $row;
          }
      } else {
          header('Location: forum-category.php');
          exit; // Terminate script execution after redirecting
      }
  } else {
      echo "Something went wrong with the query: " . $conn->error;
      exit; // Terminate script execution
  }
} else {
  header('Location: forum-category.php');
  exit; // Terminate script execution after redirecting
}

?>

<?php include("../commonPHP/topNavBarLoggedIn.php"); ?>


 <style>

body{
  background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
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

    <div id="magazine-hero">
    </div>

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Update Topic</h2>

        <br>

        <div class="row gy-4">

          <a href="forumtopic-comments.php?forumtopic_id=<?= $forumtopic_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

          <form id="insertLpForm" action="#"  method="POST">

          <input type="hidden" name='comment_id' id='comment_id' value="<?= @$data[0]['comment_id'] ?>">

            <div class="form-group"> 
                <label for="content">forumtopic Name</label>
                <input type="text" class="form-control" id="content" name="content" value="<?= @$data[0]['content'] ?>" placeholder="Enter forumtopic" required>
            </div>
            <br>
            <!-- <div class="form-group"> 
                <label for="ft_desc">Description</label>
                <textarea class="form-control" id="ft_desc" name="ft_desc" placeholder="This is the mindbooster description..." maxlength="1000" required><?= @$data[0]['ft_description'] ?></textarea>
            </div> -->
            <br>
       
            

            <br>

            <div class="form-group">
                <button type="submit" class="btn btn-warning" name="update">Update Forum Topic</button>
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
  
</body>

</html>