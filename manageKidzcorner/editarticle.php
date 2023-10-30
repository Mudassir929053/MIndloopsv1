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
 
if(isset($_GET['kidzpost_id'])){
  extract($_GET);
}
else{
  header('Location: manageCommunity.php');
}
$sql = "SELECT * FROM kidzpost where kidzpost_id = '$kidzpost_id'";
$data=[];
$result= mysqli_query($conn,$sql); 
while($row=$result->fetch_assoc()){
    $data=$row;
}
?>
 <?php
  include("../commonPHP/adminNavBar.php");
  include("../commonPHP/summernote.php");
  ?>

<body>



  <main id="main">

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Update Post</h2>

        <br>

        <div class="row gy-4">

        <a href="kidzcornerArticles.php?topic_id=<?= $topic_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

          <form id="insertLpForm" action="#" onsubmit="return updateArticle(this)" method="POST" enctype='multipart/form-data'>
            <div class="form-group"> 
                <label for="c_name">Title</label>
                <input type="text" class="form-control" id="ca_name" name="ca_name" value="<?= $data['title']?>" placeholder="Enter Title" required>
                <input type="hidden" class="form-control" id="kidzpost_id" name="kidzpost_id" value="<?= $data['kidzpost_id'] ?>">
                <input type="hidden" class="form-control" id="topic_id" name="topic_id" value="<?= $topic_id ?>">
            </div>
            <br>
            <div class="form-group"> 
                <label for="c_desc">Description</label>
                <textarea class="form-control" id="summernote" name="ca_desc" placeholder="Enter Community description..." maxlength="1000" required><?= $data['content']?></textarea>
            </div>
            <br>  
            
            <div class="form-group"> 
                <label for="c_desc">Status</label>
                    <select class="form-control" name="status">
                        <option <?= @$data['published']==0?'selected':'' ?> value="0">Unpublish</option>
                        <option <?= @$data['published']==1?'selected':'' ?> value="1">Publish</option>

                    </select>

                </div>
            
             <br>
            <div class="form-group">
                <label for="m_filePath">Upload File *(jpg,png,gif,jpeg,pdf)</label>
                <input type="file" class="form-control-file" id="m_filePath" name="m_filePath" >
            </div>
 
            <div class="form-group">
                <button type="submit" class="btn btn-warning">Update Post </button>
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
  // document.getElementById("t_id").value = (Math.floor(Math.random() * 90000) + 10000);
  $(document).ready(function() {
    $('#summernote').summernote({
      minHeight: 200
    });
  });

  function updateArticle(obj){
        // console.log(obj);
        let formData = new FormData(obj);
        let url = 'kidzcornerQuery.php?updateArticle=yes';
        fetch(url,{
            method: 'POST',
            body: formData
        }).then(data=>data.text()).then(data=>{
            console.log(data);
            // exit;
            // return false;
            alert(data);

            if(data=='Updated successfully'){
                window.location.href = 'kidzcornerArticles.php?topic_id=<?= $topic_id ?>';
            }
        });
        return false;

    }
</script>
</body>

</html>