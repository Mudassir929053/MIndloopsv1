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
  if(isset($_GET['community_id'])){
    extract($_GET);
    $sql = "SELECT * from community where community_id='$community_id'";
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
<body>
  <main id="main">
   
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">Update Community</h2>
        <br>
        <div class="row gy-4">
          <a href="manageCommunity.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <div class="col-lg-12">
          <form id="insertLpForm" action="#" onsubmit="return updateCommunity(this)" method="POST">
          <input type="hidden" name='community_id' id='community_id' value="<?= @$data[0]['community_id'] ?>">
            <div class="form-group"> 
                <label for="c_name">Community Name</label>
                <input type="text" class="form-control" id="c_name" name="c_name" value="<?= @$data[0]['community_name'] ?>" placeholder="Enter Title" required>
            </div>
            <br>
            <div class="form-group"> 
                <label for="c_desc">Description</label>
                <textarea class="form-control" id="c_desc" name="c_desc" placeholder="This is the mindbooster description..." maxlength="1000" required><?= @$data[0]['community_description'] ?></textarea>
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
                <button type="submit" class="btn btn-warning">Update Community</button>
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
  <script>
    function updateCommunity(obj){
        console.log(obj);
        let formData = new FormData(obj);
        let url = 'communityQuery.php?updateCommunity=yes';
        fetch(url,{
            method: 'POST',
            body: formData
        }).then(data=>data.text()).then(data=>{
            alert(data);
            if(data=='Updated successfully'){
                window.location.href = 'manageCommunity.php';
            }
        });
        return false;
    }
  </script>
</body>
</html>