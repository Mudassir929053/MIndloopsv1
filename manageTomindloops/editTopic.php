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
  $data=[];
  if(isset($_GET['topic_id'])){
    extract($_GET);
    $sql = "SELECT * from to_mindloops_topics where to_mindloops_topic_id ='$topic_id'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $data[]=$row;
    }
    
  }
  
  else {
    header('Location: manageCommunity.php');
  }
  if(count($data)==0){
    header('Location: manageCommunity.php');
  }
// var_dump($data);
// exit;
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

    <div id="magazine-hero">
    </div>

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Update Topic</h2>

        <br>

        <div class="row gy-4">

          <a href="manageTopics.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

          <form id="insertLpForm" action="#" onsubmit="return updateTopic(this)" method="POST">

          <input type="hidden" name='topic_id' id='topic_id' value="<?= @$data[0]['to_mindloops_topic_id'] ?>">

            <div class="form-group"> 
                <label for="c_name">Community Name</label>
                <input type="text" class="form-control" id="c_name" name="c_name" value="<?= @$data[0]['topic_name'] ?>" placeholder="Enter Title" required>
            </div>
            <br>
            <div class="form-group"> 
                <label for="c_desc">Description</label>
                <textarea class="form-control" id="c_desc" name="c_desc" placeholder="This is the mindbooster description..." maxlength="1000" required><?= @$data[0]['description'] ?></textarea>
            </div>
            <br>
           
            <div class="form-group"> 
                <label for="c_desc">Status</label>
                    <select class="form-control" name="status">
                        <option <?= @$data[0]['published']==0?'selected':'' ?> value="0">Unpublish</option>
                        <option <?= @$data[0]['published']==1?'selected':'' ?> value="1">Publish</option>

                    </select>

                </div>
            

            <br>

            <div class="form-group">
                <button type="submit" class="btn btn-warning">Update Topic</button>
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
  <script>
    function updateTopic(obj){
        console.log(obj);
        let formData = new FormData(obj);
        let url = 'communityQuery.php?updateTopic=yes';
        fetch(url,{
            method: 'POST',
            body: formData
        }).then(data=>data.text()).then(data=>{
            alert(data);
            if(data=='Updated successfully'){
                window.location.href = 'manageTopics.php';
            }
        });
        return false;

    }
  </script>

</body>

</html>