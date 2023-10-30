<?php include("../commonPHP/head.php"); ?>

  <?php include("../commonPHP/topNavBarCheck.php"); ?>


  <style>

    body{
      background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
      background-size: 110%;
      background-position: top center;
    }
    #portfolio-details{
      padding-top:15%;
    }
    .textAll{
      padding-top:2%;
    }

  </style>

  <main id="main">


    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <!-- <div class="row gy-4"> -->

          <!-- <div class="col-lg-12"> -->
            <!-- <div class="portfolio-details-slider"> -->
              <div class="align-items-center" id="canvasContainer">

                <a href="mainTeachingSupport.php" class="btn btn-warning" id="back-button"><i class="bi bi-arrow-left"></i> Return to Teaching Support Overview</a>

                <br>
                <br>
                <div id="fileDetailsPlace" style="text-align:center">
                  <h2 >Teaching Support Details</h2>
                </div>
                <br>
                <div id="filePlace">
                </div>
                

              </div>

      </div>
    </section>


   

  </main><!-- End #main -->

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php  include("../commonPHP/jsFiles.php"); ?>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/teachsupport.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.15.349/build/pdf.min.js"></script>
  <!-- <script src="../assets/js/pdf.min.js"></script> -->


</body>

</html>