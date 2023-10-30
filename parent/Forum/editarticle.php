<?php      
require_once("../commonPHP/head.php");
  if(!session_id())
  {
    session_start();
    
    if($_SESSION["userType"]!='4')
    {
      header ('location: ../login_and_register/login.php');
    }    
  }

  include ("../../dbconnect.php");
  $data=[];
  if(isset($_GET['forumtopic_id'])){
    extract($_GET);
    $sql = "SELECT * from forum_topic where forumtopic_id ='$forumtopic_id ' and forum_id='$forum_id'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $data[]=$row;
    }  
  }
  
  else {
    header('Location: forum-category.php?forum_id='.$forum_id);
  }
  if(count($data)==0){
    header('Location: forum.php');
  }
// var_dump($data);
// exit;
?>
 <?php include("../commonPHP/topNavBarLoggedIn.php"); ?>

 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/parent.css">
<body class="imagebackground">
  <main id="main">

    <div id="magazine-hero">
    </div>

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Update Topic</h2>

        <br>

        <div class="row gy-4">

          <a href="forum-articles.php?forum_id=<?= $forum_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

          <form id="insertLpForm" action="#" onsubmit="return updateforumtopic(this)" method="POST">

          <input type="hidden" name='forumtopic_id' id='forumtopic_id' value="<?= @$data[0]['forumtopic_id'] ?>">

            <div class="form-group"> 
                <label for="ft_name">forumtopic Name</label>
                <input type="text" class="form-control" id="ft_name" name="ft_name" value="<?= @$data[0]['ft_name'] ?>" placeholder="Enter forumtopic" required>
            </div>
            <br>
            <div class="form-group"> 
                <label for="ft_desc">Description</label>
                <textarea class="form-control" id="summernote" name="ft_desc" placeholder="This is the mindbooster description..." maxlength="1000" required><?= @$data[0]['ft_description'] ?></textarea>
            </div>
            <br>
            <div class="form-group">
                  <label for="c_thumbnail">Cover Image *(.png / .jpg / .jpeg)</label>
                  <input type="file" class="form-control" id="c_thumbnail" name="c_thumbnail" accept="image/png, image/jpeg, image/jpg">
              </div>

            

            <br>

            <div class="form-group">
                <button type="submit" class="btn btn-warning">Update Forum Topic</button>
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

  <?php  include("../commonPHP/jsFiles.php"); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    function updateforumtopic(obj){
        console.log(obj);
        let formData = new FormData(obj);
        let url = 'forumQuery.php?updateforumtopic=yes';
        fetch(url,{
            method: 'POST',
            body: formData
        }).then(data=>data.text()).then(data=>{
            alert(data);
            if(data=='Updated successfully'){
                window.location.href = 'forum-articles.php?forum_id=<?= $forum_id ?>';
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