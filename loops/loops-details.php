<?php include("../commonPHP/head.php"); ?>


  <?php include("../commonPHP/topNavBarCheck.php"); ?>

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
  </style>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <!-- <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Portfolio Details</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li><a href="portfolio.html">Portfolio</a></li>
            <li>Portfolio Details</li>
          </ol>
        </div>
      </div>
    </section> -->
    <!-- End Breadcrumbs -->

    <div id="magazine-hero">
    </div>

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <a href="view-loops.php" class="btn btn-warning" id="back-button" style="margin-left: 15px;"><i class="bi bi-arrow-left"></i> Return to Loops</a>

        <br>
        <br>
        <br>

        <div class="row gy-4">

          <div class="col-lg-4">

            <div class="portfolio-details-slider">
              <div class="align-items-center">

                <div class="">
                  <img id="lp_imgpath" src="" alt="">
                </div>

              </div>
              <!-- <div class="swiper-pagination"></div> -->
            </div>
          </div>

          <div class="col-lg-8">
            <div class="portfolio-description">
              <h2 id="lp_title"></h2>
              <p id="lp_desc" class="description-paragraph">
                <!-- BookIt! is a badminton court reservation system developed for the residents of Subang Perdana Goodyear Court 10
                 as a community service project, for the Application Development course (SECJ 3104).<br><br>
                This project was developed using the Python Flask Framework (Backend), Bootstrap (Frontend), and Google Cloud Platform's Bigquery (Database).<br><br>
                This project was completed within 4 Sprints of the Agile SCRUM development method. -->
              </p>
              <a id="viewMoreBtn" href="loops-flipbook.php?pageNum=1" class="btn btn-warning">View More</a>
              <br>
              <br>

              <!-- <p id="editionP" class="date-paragraph"></p> -->
            </div>
          </div>

        </div>

      </div>
    </section>

    <?php //include("../magazine/magazine-slider.php"); ?>

  </main><!-- End #main -->

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php  include("../commonPHP/jsFiles.php"); ?>


<script>

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const lp_id = urlParams.get('lp_id');

  var xhr = new XMLHttpRequest();

  xhr.open("get", "./read-single-loops.php?lp_id=" + lp_id);

  xhr.send();

  xhr.onload = function(){
    var jsonData = JSON.parse(xhr.responseText);

    //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIVED DATA.

    document.getElementById("lp_imgpath").setAttribute("src", jsonData[0].lp_imgpath);

    document.getElementById("lp_title").innerHTML = jsonData[0].lp_title;

    document.getElementById("lp_desc").innerHTML = jsonData[0].lp_desc;

    document.getElementById("viewMoreBtn").setAttribute("href","loops-flipbook.php?pageNum=1&lp_id=" + lp_id);

  }

</script>


</body>

</html>