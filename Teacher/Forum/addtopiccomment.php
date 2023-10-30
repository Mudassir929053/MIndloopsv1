<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
?>
<link href="../../assets/css/teacher.css" rel="stylesheet">

  

<body>



  <main id="main">

    <!-- <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Create Forum</h2>

        <br>

        <div class="row gy-4">

          <a href="forum.php" class="btn btn-sm btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

          <form id="insertLpForm" action="addforumBackend.php" method="POST" enctype='multipart/form-data'>
            <div class="form-group"> 
                <label for="c_name">Forum Name</label>
                <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Enter Title" required>
            </div>
            <br>
            
            <div class="form-group">
              <label for="created_by">Forum Created</label>
              <select class="form-select" name="created_by" id="created_by" required="">
                <option selected="" disabled="">Select User</option> 
                <option value="parent">parent</option> 
              </select>
            </div>
            <br>  
            <div class="form-group">
              <label for="forum_for">Forum For</label>
              <select class="form-select" name="forum_for" id="forum_for" required="">
                <option selected="" disabled="">Select User</option> 
                <option value="Kids">Kids</option> 
                <option value="Adults">Adults</option> 
              </select>
            </div>
            <br>       
            <div class="form-group"> 
                <label for="c_desc">Forum Description</label>
                <textarea class="form-control" id="c_desc" name="c_desc" placeholder="Enter Community description..." maxlength="1000" required></textarea>
            </div>
            <br>       
 
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-warning">Add Forum</button>
                <button type="reset" class="btn btn-sm btn-secondary">Clear</button>
            </div>
            
          </form>


          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
</body>

</html>