<?php include("../commonPHP/head.php"); ?>

<?php

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '2' && $_SESSION["userType"] != '3' && $_SESSION["userType"] != '4') {
    echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
?>

<link rel="stylesheet" href="../assets/css/style.css">
</link>
<link href="../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->


<?php include("../commonPHP/topNavBarCheck.php"); ?>
<style>
    .img-fluid {
        height: 35vh;
        width: 80%;
        border-radius: 10%;
        margin-bottom: 5%;
    }
</style>

<body>

    <main id="main">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" style="background-image: url('../assets/loops/img/Loop_Banner.png'); background-size:100%;background-repeat: no-repeat;">
                    <div class="col-md-10">
                        <div class="text-right" style="padding-left: 65%; padding-top: 8%;">
                            <h1 class="display-1" style="font-size: 6vw;">LOOPS</h1>
                            <p style="font-size: 2vw;">Do more learn more</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="py-5">
                    <h2 class="text-center">Puzzles</h2>
                </div>
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3">
                            <div class="box px-4">
                                <!-- Box content goes here -->
                                <a href="#"><img src="../assets/loops/img/thubnail.png" class="img-fluid" /></a>
                                <h4>Game Name</h4>
                                <p>Puzzle Game</p>
                                <p>Difficulty</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box px-4">
                                <!-- Box content goes here -->
                                <a href="#"><img src="../assets/loops/img/Game_thumbnail.png" class="img-fluid" /></a>
                                <h4>Game Name</h4>
                                <p>Puzzle Game</p>
                                <p>Difficulty</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box px-4">
                                <!-- Box content goes here -->
                                <a href="#"><img src="../assets/loops/img/game.png" class="img-fluid" /></a>
                                <h4>Game Name</h4>
                                <p>Puzzle Game</p>
                                <p>Difficulty</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="background-color:#FFE9AC">
            <div class="row">
                <div class="py-5">
                    <h2 class="text-center">ART & CRAFT</h2>
                </div>
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3">
                            <div class="box px-4">
                                <!-- Box content goes here -->
                                <a href="#"><img src="../assets/loops/img/thubnail.png" class="img-fluid" /></a>
                                <h4>Article Name</h4>
                                <p>Descriptions</p>
                                <p style="color: red;">Read More</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box px-4">
                                <!-- Box content goes here -->
                                <a href="#"><img src="../assets/loops/img/Game_thumbnail.png" class="img-fluid" /></a>
                                <h4>Article Name</h4>
                                <p>Descriptions</p>
                                <p style="color: red;">Read More</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box px-4">
                                <!-- Box content goes here -->
                                <a href="#"><img src="../assets/loops/img/game.png" class="img-fluid" /></a>
                                <h4>Article Name</h4>
                                <p>Descriptions</p>
                                <p style="color: red;">Read More</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="py-5">
                    <h2 class="text-center">QUIZZES</h2>
                </div>
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3">
                            <div class="box px-4">
                                <!-- Box content goes here -->
                                <a href="#"><img src="../assets/loops/img/thubnail.png" class="img-fluid" /></a>
                                <h4>Game Name</h4>
                                <p>Puzzle Game</p>
                                <p>Difficulty</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box px-4">
                                <!-- Box content goes here -->
                                <a href="#"><img src="../assets/loops/img/Game_thumbnail.png" class="img-fluid" /></a>
                                <h4>Game Name</h4>
                                <p>Puzzle Game</p>
                                <p>Difficulty</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box px-4">
                                <!-- Box content goes here -->
                                <a href="#"><img src="../assets/loops/img/game.png" class="img-fluid" /></a>
                                <h4>Game Name</h4>
                                <p>Puzzle Game</p>
                                <p>Difficulty</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div id="magazine-hero">
        </div> -->

        <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

        <!-- <section id="portfolio-details" class="portfolio-details">
            <div class="container"> -->

        <!-- <h2 style="text-align: center;">Loops</h2> -->

        <!-- <br> -->

        <!-- <div class="row gy-4"> -->

        <!-- <a href="../index/index.php" class="btn btn-warning col-lg-2"><i class="bi bi-arrow-left"></i> Back to Home Page</a> -->

        <!-- <div class="col-lg-12"> This is the basic background template -->



        <!-- <section id="portfolio" class="portfolio sections-bg">
                            <div class="container" data-aos="fade-up"> -->

        <!-- <div class="section-header">
                <h2>Portfolio</h2>
                <p>Quam sed id excepturi ccusantium dolorem ut quis dolores nisi llum nostrum enim velit qui ut et autem uia reprehenderit sunt deleniti</p>
                </div> -->

        <!-- <div id="portfolio-isotope" class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

                                    <div>
                                        <ul class="portfolio-flters" id="portfolio-flters"> -->
        <!-- <li data-filter="*" class="filter-active">All</li> -->
        <!-- <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-product">Product</li>
                        <li data-filter=".filter-branding">Branding</li>
                        <li data-filter=".filter-books">Books</li> -->
        </ul><!-- End Portfolio Filters -->
        <!-- </div> -->

        <!-- <div id="wrapTarget" class="row gy-4 portfolio-container"> -->

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

    <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->



    <script>
        var userType;

        var userTypeXHR = new XMLHttpRequest();

        userTypeXHR.open('get', '../commonPHP/check-usertype.php');

        userTypeXHR.send();

        userTypeXHR.onload = function() {

            var userTypeData = JSON.parse(userTypeXHR.responseText);

            userType = userTypeData["userType"];

            var ulFilters = document.getElementById("portfolio-flters");

            if (userTypeData["userType"] === "Teacher") {

                var liReadToGoLessons = document.createElement("li");
                liReadToGoLessons.innerHTML = "Read To Go Lessons";
                liReadToGoLessons.setAttribute("data-filter", ".filter-readToGoLessons");
                ulFilters.appendChild(liReadToGoLessons);

                var liRecources = document.createElement("li");
                liRecources.innerHTML = "Recources";
                liRecources.setAttribute("data-filter", ".filter-resources");
                ulFilters.appendChild(liRecources);


            } else if (userTypeData["userType"] === "Parent") {


                var liTeachingResources = document.createElement("li");
                liTeachingResources.innerHTML = "Teaching Resources";
                liTeachingResources.setAttribute("data-filter", ".filter-teachingResources");
                ulFilters.appendChild(liTeachingResources);

                var liActivities = document.createElement("li");
                liActivities.innerHTML = "Activities";
                liActivities.setAttribute("data-filter", ".filter-activities");
                ulFilters.appendChild(liActivities);

                var liSkills = document.createElement("li");
                liSkills.innerHTML = "Skills";
                liSkills.setAttribute("data-filter", ".filter-skills");
                ulFilters.appendChild(liSkills);

                var liFamilyGames = document.createElement("li");
                liFamilyGames.innerHTML = "Family Games";
                liFamilyGames.setAttribute("data-filter", ".filter-familyGames");
                ulFilters.appendChild(liFamilyGames);


            } else if (userTypeData["userType"] === "Student") {


                // var liPuzzles = document.createElement("li");
                // liPuzzles.innerHTML = "Puzzles";
                // liPuzzles.setAttribute("data-filter",".filter-puzzles");
                // ulFilters.appendChild(liPuzzles);

                // var liArtsCrafts = document.createElement("li");
                // liArtsCrafts.innerHTML = "Arts & Craft";
                // liArtsCrafts.setAttribute("data-filter",".filter-artsCrafts");
                // ulFilters.appendChild(liArtsCrafts);

                // var liQuizzes = document.createElement("li");
                // liQuizzes.innerHTML = "Quizzes";
                // liQuizzes.setAttribute("data-filter",".filter-quizzes");
                // ulFilters.appendChild(liQuizzes);


            }

        }
    </script>


    <script>
        var allLoopsXHR = new XMLHttpRequest();

        allLoopsXHR.open('get', '../loops/read-all-loops.php');

        allLoopsXHR.send();

        allLoopsXHR.onload = function() {

            var wrapTarget = document.getElementById("wrapTarget");
            var jsonLoopsData = JSON.parse(allLoopsXHR.responseText);

            for (var i = 0; i < jsonLoopsData.length; i++) {

                // if(userType === jsonLoopsData[i].t_audience){


                var portfolioItemDiv = document.createElement("div");
                portfolioItemDiv.classList.add("col-xl-4");
                portfolioItemDiv.classList.add("col-md-6");
                portfolioItemDiv.classList.add("portfolio-item");

                var filterClass;

                switch (jsonLoopsData[i].lp_type) {
                    case "LPT1":
                        filterClass = "filter-puzzles";
                        break;
                    case "LPT2":
                        filterClass = "filter-artsCrafts";
                        break;
                    case "LPT3":
                        filterClass = "filter-quizzes";
                        break;
                    case "LPT4":
                        filterClass = "filter-teachingResources";
                        break;
                    case "LPT5":
                        filterClass = "filter-activities";
                        break;
                    case "LPT6":
                        filterClass = "filter-skills";
                        break;
                    case "LPT7":
                        filterClass = "filter-familyGames";
                        break;
                    case "LPT8":
                        filterClass = "filter-readToGoLessons";
                        break;
                    case "LPT9":
                        filterClass = "filter-resources";
                        break;
                    default:
                        filterClass = "";
                }

                portfolioItemDiv.classList.add(filterClass);




                var portfolioWrapDiv = document.createElement("div");
                portfolioWrapDiv.classList.add("portfolio-wrap");


                var aImg = document.createElement("a");
                aImg.setAttribute("href", jsonLoopsData[i].lp_imgpath);
                aImg.setAttribute("target", "_blank");
                aImg.setAttribute("data-gallery", "portfolio-gallery-app");
                // aImg.classList.add("glightbox");


                var img = document.createElement("img");
                img.setAttribute("src", jsonLoopsData[i].lp_imgpath);
                img.classList.add("img-fluid");

                aImg.appendChild(img);
                portfolioWrapDiv.appendChild(aImg);


                var portfolioInfoDiv = document.createElement("div");
                portfolioInfoDiv.classList.add("portfolio-info");

                var h4Title = document.createElement("h4");

                var aTitle = document.createElement("a");
                aTitle.innerHTML = jsonLoopsData[i].lp_title;
                aTitle.setAttribute("href", "./loops-details.php?lp_id=" + jsonLoopsData[i].lp_id);
                aTitle.setAttribute("title", "More Details");


                h4Title.appendChild(aTitle);
                portfolioInfoDiv.appendChild(h4Title);


                var pDesc = document.createElement("p");
                pDesc.innerHTML = jsonLoopsData[i].lp_desc;

                portfolioInfoDiv.appendChild(pDesc);
                portfolioWrapDiv.appendChild(portfolioInfoDiv);
                portfolioItemDiv.appendChild(portfolioWrapDiv);
                wrapTarget.appendChild(portfolioItemDiv);

                // }

            }

        }
    </script>


    <?php include("../commonPHP/jsFiles.php"); ?>

    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
    <script src="../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/aos-portfolio/aos.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/js/main.js"></script>


</body>

</html>