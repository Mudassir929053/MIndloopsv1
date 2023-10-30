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
  $sql = "SELECT * FROM tb_loopstype";
  $result= mysqli_query($conn,$sql); 
?>
 <?php include("../commonPHP/adminNavBar.php"); ?>
<body>
  <main id="main">
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">Create Community</h2>
        <br>
        <div class="row gy-4">
          <a href="manageCommunity.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <div class="col-lg-12">
          <form id="insertLpForm" action="addCommunityBackend.php" method="POST" enctype='multipart/form-data'>
            <div class="form-group"> 
                <label for="c_name">Community Name</label>
                <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Enter Title" required>
            </div>
            <br>
            <div class="form-group"> 
                <label for="c_desc">Description</label>
                <textarea class="form-control" id="c_desc" name="c_desc" placeholder="Enter Community description..." maxlength="1000" required></textarea>
            </div>
            <br>       
            <div class="form-group">
                <button type="submit" class="btn btn-warning">Add Community</button>
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