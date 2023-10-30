<?php include("../commonPHP/head.php");

include '../dbconnect.php';

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '3') {
    echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}


extract($_GET);
// echo $v_id;
$sql = "SELECT * FROM `tb_videos` where v_id='$v_id'";
$result = $conn->query($sql);

?>

<link rel="stylesheet" href="../assets/css/style.css">
<link href="../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">

<?php include("../commonPHP/topNavBarCheck.php"); ?>

<main id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-md-5 py-5" style="background-image: url('../assets/videos/img/video_banner.png'); background-size:100%;">
                <div class="col-md-10">
                    <div class="text-right">
                        <h1 style="padding-left: 18%; padding-top: 10%; font-size: 7vw;" class="display-1">VIDEOS</h1>
                        <img src="../assets/videos/img/video_thumbnail.png" style=" position: sticky; left:50%;margin-top: -14%; border-radius: 6%;max-height:38%;max-width: 40%;" alt="Video_thumbnail">
                        <!-- <p style="font-size: 2vw;">Do more learn more</p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    while ($row = $result->fetch_assoc()) {
    ?>
        <div class="container mt-1">
            <div class="row">
                <div class="col-12 mb-3">

                    <div class="embed-responsive text-center">
                        
                        <video autoplay loop width="60%" controls>
                            <!-- <source src="http://www.mysite.braaasil.com/video/mel.webm" type="video/webm"> -->
                            <source src="<?= $row['v_path'] ?>" type="video/mp4">
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

   
        <!-- <div class="container-fluid">
            <div class="row">
                <div class="py-3">
                    <h2 class="text-center">MORE TO WATCH</h2>
                </div>
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3">
                            <div class="box px-4"> -->
                                <!-- Box content goes here -->
                                <!-- <a href="#"><img src="../assets/videos/img/bio.png" class="img-fluid" style="border-radius: 10%;" /></a>
                                <h5 style="padding-top: 12px;padding-left: 12px;">Video Title</h5>
                                <span style="color: #656565;padding-left: 12px;">00:30 </span>
                                <span id="diy">D.I.Y</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box px-4"> -->
                                <!-- Box content goes here -->
                                <!-- <a href="#"><img src="../assets/videos/img/tropical.png" class="img-fluid" style="border-radius: 10%;" /></a>
                                <h5 style="padding-top: 12px;padding-left: 12px;">Video Title</h5>
                                <span style="color: #656565;padding-left: 12px;">00:30 </span>
                                <span id="diy">D.I.Y</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box px-4"> -->
                                <!-- Box content goes here -->
                                <!-- <a href="#"><img src="../assets/videos/img/teeth.png" class="img-fluid" style="border-radius: 10%;" /></a>
                                <h5 style="padding-top: 12px;padding-left: 12px;">Video Title</h5>
                                <span style="color: #656565;padding-left: 12px;">00:30 </span>
                                <span id="diy">D.I.Y</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
</main><!-- End #main -->

<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>

<script src="../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
<script src="../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
<script src="../assets/vendor/aos-portfolio/aos.js"></script>
<!-- <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script> -->
<!-- <script src="../assets/js/main.js"></script> -->

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