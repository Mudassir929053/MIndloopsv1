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
 
if(isset($_GET['comment_id'])){
  extract($_GET);
}
else{
  header('Location: manageCommunity.php');
}
$sql = "SELECT * FROM kiszspostcomment where comment_id  = '$comment_id'";
$data=[];
$result= mysqli_query($conn,$sql); 
while($row=$result->fetch_assoc()){
    $data=$row;
}
?>
 <?php include("../commonPHP/adminNavBar.php"); ?>
 
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

        <h2 style="text-align: center;">Comment</h2>

        <br>

        <div class="row gy-4">

          <a href="manageComments.php?ca_id=<?= $ca_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

          <form id="insertLpForm" action="#" onsubmit="return updateComment(this)" method="POST" enctype='multipart/form-data'>
           
            <div class="form-group"> 
                <label for="c_desc">Article Comment</label>
                <input type="hidden" class="form-control" id="ca_id" name="ca_id" value="<?= $ca_id ?>">
                <input type="hidden" class="form-control" id="cc_id" name="comment_id" value="<?= $comment_id ?>">
                <textarea class="form-control" name="ca_desc" placeholder="Enter Community description..." maxlength="1000" required><?= $data['content'] ?></textarea>
            </div>
            <br>  
            
            <div class="form-group"> 
                <label for="c_desc">Status</label>
                    <select class="form-control" name="status">
                        <option <?= @$data['approved']==0?'selected':'' ?> value="0">Unpublish</option>
                        <option <?= @$data['approved']==1?'selected':'' ?> value="1">Publish</option>

                    </select>

                </div>
            
             <br>
            
            <div class="form-group">
                <button type="submit" class="btn btn-warning">Update Comment </button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->
<script>
  // document.getElementById("t_id").value = (Math.floor(Math.random() * 90000) + 10000);
  
  function updateComment(obj){
        // console.log(obj);
        // return false;
        let formData = new FormData(obj);
        let url = 'kidzcornerQuery.php?updateComment=yes&comment_id=<?= $comment_id ?>';
        fetch(url,{
            method: 'POST',
            body: formData
        }).then(data=>data.text()).then(data=>{
            // console.log(data);
            alert(data);

            if(data=='Updated successfully'){
                window.location.href = 'manageComments.php?kidzpost_id=<?= $kidzpost_id ?>';
            }
        });
        return false;

    }
</script>
</body>

</html>