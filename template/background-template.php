<?php include("../commonPHP/head.php"); ?>

<?php 
  
    if(!session_id())
    {
        session_start();
    }
    if($_SESSION["userType"]!='2' && $_SESSION["userType"]!='3' && $_SESSION["userType"]!='4')
    {
        echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
        // header("../login_and_register/login.php");
    }
?>


  <?php include("../commonPHP/topNavBarCheck.php"); ?>

  <main id="main">

    <div id="magazine-hero">
    </div>

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Tips</h2>

        <br>

        <div class="row gy-4">

          <a href="../index/index.php" class="btn btn-warning col-lg-2"><i class="bi bi-arrow-left"></i> Back to Home Page</a>

          <div class="col-lg-12">       
            
            <!-- PUT CONTENTS HERE -->

          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php  include("../commonPHP/jsFiles.php"); ?>

</body>

</html>