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

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="portfolio-details-slider">
              <div class="align-items-center">

                <div class="">
                  <img id="mImg" src="" alt="">
                </div>

              </div>
              <!-- <div class="swiper-pagination"></div> -->
            </div>
          </div>

          <div class="col-lg-8">
            <div class="portfolio-description">
              <h2 id="mTitle"></h2>
              <p id="descP" class="description-paragraph">
                <!-- BookIt! is a badminton court reservation system developed for the residents of Subang Perdana Goodyear Court 10
                 as a community service project, for the Application Development course (SECJ 3104).<br><br>
                This project was developed using the Python Flask Framework (Backend), Bootstrap (Frontend), and Google Cloud Platform's Bigquery (Database).<br><br>
                This project was completed within 4 Sprints of the Agile SCRUM development method. -->
              </p>
              <a id="viewMoreBtn" href="flip/index.php?pageNum=1" class="btn btn-warning">View More</a>
              <br>
              <br>
              <p id="authorP" class="date-paragraph"></p>
              <p id="dateP" class="date-paragraph"></p>
              <p id="editionP" class="date-paragraph"></p>
            </div>
          </div>

        </div>

      </div>
    </section>

    <?php include("../magazine/magazine-slider.php"); ?>

  </main><!-- End #main -->

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php  include("../commonPHP/jsFiles.php"); ?>


<script>

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const m_id = urlParams.get('m_id');

  var xhr = new XMLHttpRequest();

  xhr.open("get", "../magazine/read-single-magazine.php?m_id=" + m_id);

  xhr.send();

  xhr.onload = function(){
    var jsonData = JSON.parse(xhr.responseText);

    //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIVED DATA.

    document.getElementById("mImg").setAttribute("src","../assets/" + jsonData[0].m_imgPath);

    document.getElementById("mTitle").innerHTML = jsonData[0].m_title;

    document.getElementById("descP").innerHTML = jsonData[0].m_desc;

    document.getElementById("authorP").innerHTML = "<b>Author: </b><small style=\"color:#2ac1dc;\">" + jsonData[0].m_author + "</small>";

    document.getElementById("dateP").innerHTML = "<b>Date Published: </b><small style=\"color:#2ac1dc;\">" + jsonData[0].m_rDate.substring(0,10) + "</small>";

    document.getElementById("editionP").innerHTML = "<b>Edition: </b><small style=\"color:#2ac1dc;\">" + jsonData[0].m_edition + "</small>";

    document.getElementById("viewMoreBtn").setAttribute("href","flip/index.php?pageNum=1&m_id=" + m_id);
    

  }

</script>


</body>

</html>