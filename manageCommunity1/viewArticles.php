<?php      
  if(!session_id())
  {
    session_start();
    
    if($_SESSION["userType"]!='1')
    {
      header ('location: ../login_and_register/login.php');
    }    
  }

  include ("../dbconnect.php");
 
if(isset($_GET['cc_id'])){
  extract($_GET);
}
else{
  header('Location: manageCommunity.php');
}
$sql = "SELECT A.*, B.u_name as owner from community_article A join tb_users B on A.created_by=B.u_id where article_id = '$ca_id'";
$data=[];
$result= mysqli_query($conn,$sql); 
while($row=$result->fetch_assoc()){
    $data=$row;
}
// var_dump($data);
// exit;
?>
 <?php include("../commonPHP/adminNavBar.php"); ?>
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

    <!-- <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <!-- <h2 style="text-align: center;">Update Article</h2> -->

        <br>

        <div class="row gy-4">

          <a href="communityArticles.php?cc_id=<?= $cc_id ?>&community_id=<?= $community_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">
            <div class="container border bg-white shadow-lg">
                <div class="row p-2">
                  <div class="">
                    <h2 class="text-center"><?= $data['ca_title']?></h2>
                    <div class="article">
                        <?= $data['ca_content']?>
                    </div>
                    <div class="details d-flex justify-content-between">
                      <?php if($data['attachment']){ ?>
                      <p>Attachment:  <a class="btn btn-warning btn-sm" href="<?= $data['attachment'] ?>" target="_blank">Click To view</a></p>
                      <?php } ?>
                      <p>Created By: <?= $data['owner'] ?></p>
                      <p><i class="bi text-danger bi-hand-thumbs-up-fill"></i> <?= $data['likes']?$data['likes']:0 ?> <i class="bi text-secondary bi-hand-thumbs-down-fill"></i> <?= $data['dislikes']?$data['dislikes']:0 ?></p>
                      <p></p>

                    </div>
                    </div>
                </div>
            </div>
          

          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include("../commonPHP/footer_admin.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php  include("../commonPHP/jsFiles.php"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
  // document.getElementById("t_id").value = (Math.floor(Math.random() * 90000) + 10000);
  $(document).ready(function() {
    $('#summernote').summernote({
      minHeight: 200
    });
  });

  function updateArticle(obj){
        console.log(obj);
        let formData = new FormData(obj);
        let url = 'communityQuery.php?updateArticle=yes';
        fetch(url,{
            method: 'POST',
            body: formData
        }).then(data=>data.text()).then(data=>{
            console.log(data);
            // exit;
            // return false;
            alert(data);

            if(data=='Updated successfully'){
                window.location.href = 'communityArticles.php?cc_id=<?= $cc_id ?>&community_id=<?= $community_id ?>';
            }
        });
        return false;

    }
</script>
</body>

</html>