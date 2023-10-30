<?php include("../commonPHP/head.php"); 

include '../../dbconnect.php';

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '2' && $_SESSION["userType"] != '3' && $_SESSION["userType"] != '4') {
    echo "<script> window.location.replace('../../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}


extract($_GET);
// echo $v_id;
$sql = "SELECT * FROM `tb_videos` where v_id='$v_id'";
$result = $conn->query($sql);

?>

<link rel="stylesheet" href="../../assets/css/style.css">
</link>
<link href="../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">

<?php include("../commonPHP/topNavBarCheck.php"); ?>

<link href="../../assets/css/teacher.css" rel="stylesheet">


<main id="main">
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-md-5 py-5" style="background-image: url('../../assets/videos/img/video_banner.png'); background-size:100%;">
                <div class="col-md-10">
                    <div class="text-right">
                        <h1 style="padding-left: 18%; padding-top: 10%; font-size: 7vw;" class="display-1">VIDEOS</h1>
                        <img src="../../assets/videos/img/video_thumbnail.png" style=" position: sticky; left:50%;margin-top: -14%; border-radius: 6%;max-height:38%;max-width: 40%;" alt="Video_thumbnail">
                        <!-- <p style="font-size: 2vw;">Do more learn more</p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
                 while($row = $result->fetch_assoc()) {
            ?>
    <div class="containervideo mt-1">
        <div class="row">
            <div class="col-12">
            <a href="videos.php" class="btn btn-sm bg-warning mt-4 mx-5 px-4 ">Go To Videos</a>
                <div class="embed-responsive text-center">
                <video autoplay loop width="60%" controls >
            <!-- <source src="http://www.mysite.braaasil.com/video/mel.webm" type="video/webm"> -->
                    <source src="../<?= $row['v_path'] ?>" type="video/mp4">
                </video>
                </div>
                
            </div>
            <div class="col text-center">
                <h3><?= $row['v_title'] ?></h3>
                <p><?= $row['v_desc'] ?></p>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <!-- <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Videos</h2>

        <br>

        <div class="row gy-4">

          <a href="../index/index.php" class="btn btn-warning col-lg-2"><i class="bi bi-arrow-left"></i> Back to Home Page</a>

          <div class="col-lg-12">       This is the basic background template -->



    <section id="portfolio" class="portfolio sections-bg">
        <div class="container" data-aos="fade-up">

            <!-- <div class="section-header">
                <h2>Portfolio</h2>
                <p>Quam sed id excepturi ccusantium dolorem ut quis dolores nisi llum nostrum enim velit qui ut et autem uia reprehenderit sunt deleniti</p>
                </div> -->

            <div id="portfolio-isotope" class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">
            </div>
        </div>
        <!-- <div>
            <ul style="color:#656565;" class="portfolio-flters" id="portfolio-flters">
                <li data-filter="*" class="filter-active">All</li> -->
        <!-- <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-product">Product</li>
                        <li data-filter=".filter-branding">Branding</li>
                        <li data-filter=".filter-books">Books</li> -->
        </ul><!-- End Portfolio Filters -->
        <!-- </div> -->
        
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

<?php include("../commonPHP/jsFiles.php"); ?>

<script src="../../assets/vendor//bootstrap/js/bootstrap.min.js"></script>



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

            var liProDev = document.createElement("li");
            liProDev.innerHTML = "Professional Development";
            liProDev.setAttribute("data-filter", ".filter-proDev");
            ulFilters.appendChild(liProDev);

            var liCaseStudy = document.createElement("li");
            liCaseStudy.innerHTML = "Case Study";
            liCaseStudy.setAttribute("data-filter", ".filter-caseStudy");
            ulFilters.appendChild(liCaseStudy);

            var liExplore = document.createElement("li");
            liExplore.innerHTML = "Explore";
            liExplore.setAttribute("data-filter", ".filter-explore");
            ulFilters.appendChild(liExplore);


        } else if (userTypeData["userType"] === "Parent") {


            var liParenting = document.createElement("li");
            liParenting.innerHTML = "Parenting";
            liParenting.setAttribute("data-filter", ".filter-parenting");
            ulFilters.appendChild(liParenting);

            var liExplore = document.createElement("li");
            liExplore.innerHTML = "Explore";
            liExplore.setAttribute("data-filter", ".filter-explore");
            ulFilters.appendChild(liExplore);


        } else if (userTypeData["userType"] === "Student") {


            var liDIY = document.createElement("li");
            liDIY.innerHTML = "D.I.Y";
            liDIY.setAttribute("data-filter", ".filter-diy");
            liDIY.setAttribute("class", "tab_heading");
            ulFilters.appendChild(liDIY);

            var liLessons = document.createElement("li");
            liLessons.innerHTML = "Lessons";
            liLessons.setAttribute("data-filter", ".filter-lessons");
            liLessons.setAttribute("class", "tab_heading");

            ulFilters.appendChild(liLessons);

            var liExplore = document.createElement("li");
            liExplore.innerHTML = "Explore";
            liExplore.setAttribute("data-filter", ".filter-explore");
            liExplore.setAttribute("class", "tab_heading");

            ulFilters.appendChild(liExplore);


        }

    }
</script>


<script>
    var allTipsXHR = new XMLHttpRequest();

    allTipsXHR.open('get', '../videos/read-all-videos.php');

    allTipsXHR.send();

    allTipsXHR.onload = function() {

        var wrapTarget = document.getElementById("wrapTarget");
        var jsonVidsData = JSON.parse(allTipsXHR.responseText);

        for (var i = 0; i < jsonVidsData.length; i++) {

            if (userType === jsonVidsData[i].v_audience) {


                var portfolioItemDiv = document.createElement("div");
                portfolioItemDiv.classList.add("col-xl-4");
                portfolioItemDiv.classList.add("col-md-6");
                portfolioItemDiv.classList.add("portfolio-item");

                var filterClass;

                switch (jsonVidsData[i].v_type) {
                    case "D.I.Y":
                        filterClass = "filter-diy";
                        break;
                    case "Lessons":
                        filterClass = "filter-lessons";
                        break;
                    case "Parenting":
                        filterClass = "filter-parenting";
                        break;
                    case "Professional Development":
                        filterClass = "filter-proDev";
                        break;
                    case "Case Study":
                        filterClass = "filter-caseStudy";
                        break;
                    case "Explore":
                        filterClass = "filter-explore";
                        break;
                    default:
                        filterClass = "";
                }

                portfolioItemDiv.classList.add(filterClass);




                var portfolioWrapDiv = document.createElement("div");
                portfolioWrapDiv.classList.add("portfolio-wrap");



                var aImg = document.createElement("a");
                aImg.setAttribute("href", jsonVidsData[i].v_path);
                aImg.setAttribute("height", "600");
                aImg.setAttribute("data-gallery", "portfolio-gallery-app");
                aImg.classList.add("glightbox");


                var vid = document.createElement("iframe");
                vid.setAttribute("src", "https://www.youtube.com/embed/" + jsonVidsData[i].v_path.slice(-11));
                vid.setAttribute("width", "720");
                vid.setAttribute("height", "600");
                vid.setAttribute("allow", "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture");
                vid.setAttribute("allowfullscreen", true);
                vid.classList.add("img-fluid");

                aImg.appendChild(vid);
                portfolioWrapDiv.appendChild(aImg);


                var portfolioInfoDiv = document.createElement("div");
                portfolioInfoDiv.classList.add("portfolio-info");

                var h4Title = document.createElement("h4");

                var aTitle = document.createElement("a");
                aTitle.innerHTML = jsonVidsData[i].v_title;
                aTitle.setAttribute("href", "./video-details.php?v_id=" + jsonVidsData[i].v_id);
                aTitle.setAttribute("title", "More Details");


                h4Title.appendChild(aTitle);
                portfolioInfoDiv.appendChild(h4Title);


                var pDesc = document.createElement("p");
                pDesc.innerHTML = jsonVidsData[i].v_desc;

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