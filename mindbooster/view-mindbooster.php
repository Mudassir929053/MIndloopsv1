<?php include("../commonPHP/head.php"); ?>

<?php 
  
    if(!session_id())
    {
        session_start();
    }
    // if($_SESSION["userType"]='2' || $_SESSION["userType"]='4' )
    // {
    //     echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
    // }
?>

  <link rel="stylesheet" href="../assets/css/style.css" ></link>
  <link href="../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">

  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
  <script src="../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/vendor/aos-portfolio/aos.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>


  <?php include("../commonPHP/topNavBarCheck.php"); ?>

  <main id="main">

    <div id="magazine-hero">
    </div>

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Mind Booster</h2>

        <br>

        <div class="row gy-4">

          <a href="../index/index.php" class="btn btn-warning col-lg-2"><i class="bi bi-arrow-left"></i> Back to Home Page</a>

          <div class="col-lg-12">       <!-- This is the basic background template -->
            


          <section id="portfolio" class="portfolio sections-bg">
            <div class="container" data-aos="fade-up">

                <div id="portfolio-isotope" class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

                <div>
                    <ul class="portfolio-flters" id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>

                        <?php 
                            if($_SESSION['userType']='1' ){
                            $sj = "SELECT * FROM tb_subjects";
                            $sj_result= mysqli_query($conn,$sj); 

                            ?>

                            <?php
                                while ($row = mysqli_fetch_array($sj_result,MYSQLI_ASSOC)):;
                                
                            ?>
                                <li data-filter=".filter-<?php echo $row['sj_id']; ?>"><a  href="../mindbooster/view-mindbooster.php?sj_id=<?php echo $row['sj_id']; ?>" ><?php echo $row['sj_name']; ?></a></li>

                            <?php
                                endwhile;
                            ?>
                            </ul>
                            </li>
                        <?php }?> 


                        <!-- <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-product">Product</li>
                        <li data-filter=".filter-branding">Branding</li>
                        <li data-filter=".filter-books">Books</li> -->



                    </ul><!-- End Portfolio Filters -->
                </div>

                <div id="wrapTarget" class="row gy-4 portfolio-container">
                    

                    <!--<div class="col-xl-4 col-md-6 portfolio-item filter-app">   Every element has this [portfolioItemDiv]-->
                    <!-- <div class="portfolio-wrap">  [portfolioWrapDiv] -->
                       <!-- <a href="../assets/magazine/Cover_Pages/Front_Cover_June_2022.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="../assets/magazine/Cover_Pages/Front_Cover_June_2022.jpg" class="img-fluid" alt=""></a>  [aImg & img] -->
                        <!-- <div class="portfolio-info"> [portfolioInfoDiv] -->
                            <!-- <h4><a href="portfolio-details.html" title="More Details">App 1</a></h4>  [h4Title & aTitle] -->
                           <!-- <p>Lorem ipsum, dolor sit amet consectetur</p>  [pDesc] -->
                       <!--  </div>
                    </div>
                    </div>End Portfolio Item -->

                    <!--<div class="col-xl-4 col-md-6 portfolio-item filter-product">
                    <div class="portfolio-wrap">
                        <a href="assets/img/portfolio/product-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/product-1.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                        <h4><a href="portfolio-details.html" title="More Details">Product 1</a></h4>
                        <p>Lorem ipsum, dolor sit amet consectetur</p>
                        </div>
                    </div>
                    </div> End Portfolio Item -->

                    <!-- <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                    <div class="portfolio-wrap">
                        <a href="assets/img/portfolio/branding-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/branding-1.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                        <h4><a href="portfolio-details.html" title="More Details">Branding 1</a></h4>
                        <p>Lorem ipsum, dolor sit amet consectetur</p>
                        </div>
                    </div>
                    </div> End Portfolio Item -->

                    <!--<div class="col-xl-4 col-md-6 portfolio-item filter-books">
                    <div class="portfolio-wrap">
                        <a href="assets/img/portfolio/books-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/books-1.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                        <h4><a href="portfolio-details.html" title="More Details">Books 1</a></h4>
                        <p>Lorem ipsum, dolor sit amet consectetur</p>
                        </div>
                    </div>
                    </div> End Portfolio Item -->

                    <!--<div class="col-xl-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <a href="assets/img/portfolio/app-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/app-2.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                        <h4><a href="portfolio-details.html" title="More Details">App 2</a></h4>
                        <p>Lorem ipsum, dolor sit amet consectetur</p>
                        </div>
                    </div>
                    </div> End Portfolio Item -->

                    <!--<div class="col-xl-4 col-md-6 portfolio-item filter-product">
                    <div class="portfolio-wrap">
                        <a href="assets/img/portfolio/product-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/product-2.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                        <h4><a href="portfolio-details.html" title="More Details">Product 2</a></h4>
                        <p>Lorem ipsum, dolor sit amet consectetur</p>
                        </div>
                    </div>
                    </div> End Portfolio Item -->

                    <!--<div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                    <div class="portfolio-wrap">
                        <a href="assets/img/portfolio/branding-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/branding-2.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                        <h4><a href="portfolio-details.html" title="More Details">Branding 2</a></h4>
                        <p>Lorem ipsum, dolor sit amet consectetur</p>
                        </div>
                    </div>
                    </div> End Portfolio Item -->

                    <!--<div class="col-xl-4 col-md-6 portfolio-item filter-books">
                    <div class="portfolio-wrap">
                        <a href="assets/img/portfolio/books-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/books-2.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                        <h4><a href="portfolio-details.html" title="More Details">Books 2</a></h4>
                        <p>Lorem ipsum, dolor sit amet consectetur</p>
                        </div>
                    </div>
                    </div> End Portfolio Item -->

                    <!--<div class="col-xl-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <a href="assets/img/portfolio/app-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/app-3.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                        <h4><a href="portfolio-details.html" title="More Details">App 3</a></h4>
                        <p>Lorem ipsum, dolor sit amet consectetur</p>
                        </div>
                    </div>
                    </div> End Portfolio Item -->

                    <!--<div class="col-xl-4 col-md-6 portfolio-item filter-product">
                    <div class="portfolio-wrap">
                        <a href="assets/img/portfolio/product-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/product-3.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                        <h4><a href="portfolio-details.html" title="More Details">Product 3</a></h4>
                        <p>Lorem ipsum, dolor sit amet consectetur</p>
                        </div>
                    </div>
                    </div> End Portfolio Item -->

                    <!--<div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                    <div class="portfolio-wrap">
                        <a href="assets/img/portfolio/branding-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/branding-3.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                        <h4><a href="portfolio-details.html" title="More Details">Branding 3</a></h4>
                        <p>Lorem ipsum, dolor sit amet consectetur</p>
                        </div>
                    </div>
                    </div> End Portfolio Item -->

                    <!--<div class="col-xl-4 col-md-6 portfolio-item filter-books">
                    <div class="portfolio-wrap">
                        <a href="assets/img/portfolio/books-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/books-3.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                        <h4><a href="portfolio-details.html" title="More Details">Books 3</a></h4>
                        <p>Lorem ipsum, dolor sit amet consectetur</p>
                        </div>
                    </div>
                    </div> End Portfolio Item -->

                </div><!-- End Portfolio Container -->

                </div>

            </div>
          </section>



          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php  include("../commonPHP/jsFiles.php"); ?>


  <!-- <script>

    var userType;

    var userTypeXHR = new XMLHttpRequest();

    userTypeXHR.open('get','../commonPHP/check-usertype.php');

    userTypeXHR.send();

    userTypeXHR.onload = function(){

        var userTypeData = JSON.parse(userTypeXHR.responseText);

        userType = userTypeData["userType"];

        var ulFilters = document.getElementById("portfolio-flters");

        if(userTypeData["userType"] === "Student"){


            var liLivingSkills = document.createElement("li");
            liLivingSkills.innerHTML = "Living Skills";
            liLivingSkills.setAttribute("data-filter",".filter-livingSkills");
            ulFilters.appendChild(liLivingSkills);

            var liStudySmart = document.createElement("li");
            liStudySmart.innerHTML = "Study Smart";
            liStudySmart.setAttribute("data-filter",".filter-studySmart");
            ulFilters.appendChild(liStudySmart);

            var liCitizenship = document.createElement("li");
            liCitizenship.innerHTML = "Citizenship";
            liCitizenship.setAttribute("data-filter",".filter-citizenship");
            ulFilters.appendChild(liCitizenship);


        }

    }

  </script> -->

  
  <script>


    var allTipsXHR = new XMLHttpRequest();

    allTipsXHR.open('get','../mindbooster/read-all-mindbooster.php');

    allTipsXHR.send();

    allTipsXHR.onload = function(){

        var wrapTarget = document.getElementById("wrapTarget");
        var jsonTipsData = JSON.parse(allTipsXHR.responseText);

        for(var i = 0; i<jsonTipsData.length; i++){

            if(userType === jsonTipsData[i].t_audience){
                

                var portfolioItemDiv = document.createElement("div");
                portfolioItemDiv.classList.add("col-xl-4");
                portfolioItemDiv.classList.add("col-md-6");   
                portfolioItemDiv.classList.add("portfolio-item");

                var filterClass;

                switch(jsonTipsData[i].t_type) {
                    case "Living Skills":
                        filterClass = "filter-livingSkills";
                        break;
                    case "Study Smart":
                        filterClass = "filter-studySmart";
                        break;
                    case "Citizenship":
                        filterClass = "filter-citizenship";
                        break;
                    case "Children":
                        filterClass = "filter-children";
                        break;
                    case "Teens":
                        filterClass = "filter-teens";
                        break;
                    case "Tutoring":
                        filterClass = "filter-tutoring";
                        break;
                    case "Bonding":
                        filterClass = "filter-bonding";
                        break;
                    case "Councelling":
                        filterClass = "filter-councelling";
                        break;
                    case "Classroom Management":
                        filterClass = "filter-classroomManagement";
                        break;
                    case "Co-Curriculum":
                        filterClass = "filter-coCurriculum";
                        break;
                    default:
                        filterClass = "";
                }

                portfolioItemDiv.classList.add(filterClass);




                var portfolioWrapDiv = document.createElement("div");
                portfolioWrapDiv.classList.add("portfolio-wrap");


                var aImg = document.createElement("a");
                aImg.setAttribute("href", jsonTipsData[i].t_filePath);
                aImg.setAttribute("data-gallery", "portfolio-gallery-app");
                aImg.classList.add("glightbox");


                var img = document.createElement("img");
                img.setAttribute("src", jsonTipsData[i].t_filePath);
                img.classList.add("img-fluid");

                aImg.appendChild(img);
                portfolioWrapDiv.appendChild(aImg);

                
                var portfolioInfoDiv = document.createElement("div");
                portfolioInfoDiv.classList.add("portfolio-info");

                var h4Title = document.createElement("h4");

                var aTitle = document.createElement("a");
                aTitle.innerHTML = jsonTipsData[i].t_title;
                aTitle.setAttribute("href", "../portfolio-details.html");
                aTitle.setAttribute("title", "More Details");


                h4Title.appendChild(aTitle);
                portfolioInfoDiv.appendChild(h4Title);


                var pDesc = document.createElement("p");
                pDesc.innerHTML = jsonTipsData[i].t_desc;

                portfolioInfoDiv.appendChild(pDesc);
                portfolioWrapDiv.appendChild(portfolioInfoDiv);
                portfolioItemDiv.appendChild(portfolioWrapDiv);
                wrapTarget.appendChild(portfolioItemDiv);

            }

        }

    }


  </script>

</body>

</html>