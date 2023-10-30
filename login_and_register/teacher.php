<?php include("../commonPHP/head.php"); ?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Mindloops</title>
    <meta content="" name="description">
    <meta content="" name="keywords"> -->

    <!-- Favicons -->
    <!-- <link href="../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
    <link href="../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

    <!-- Vendor CSS Files -->
    <!-- <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/gallery/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/gallery/swiper-bundle.min.css" rel="stylesheet"> -->


    <!-- Template Main CSS File -->
    <!-- <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/package.css" rel="stylesheet"> -->

<!-- 
</head> -->

    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.15.349/build/pdf.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Vendor JS Files -->
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

<!-- <body>
    parent
    <header id="head"></header> -->
    <!-- ======= Hero Section ======= -->
    <?php include ("../commonPHP/topNavBarCheck.php"); ?>
    <?php include("../index/_discover.php"); ?>
    <hr>
    <br>
    <br>
    <main id="main">
  
  <?php include("../magazine/magazine-slider.php"); ?>

    <!-- ======= Our Clients Section ======= -->
    <section id="Subscribe" class="clients">
      <div class="container" data-aos="fade-up">

        <!-- <div class="section-title">
          <h2>Clients</h2>
        </div> -->
        <div class="cards">

          <div class="card" id="leftGrid">
            <h5>Family Package</h5>
            <p>Discover fun ways to learn and explore with your family at the tip of the finger.</p>
            <button id="discoverFamilyP"  onclick = "document.location='../subscription/familyPackagePage.html'">Discover Family Package</button>

            <div class="parent">
              <img class="image1" src="../assets/img/MindLOOPS_Resouces/MicrosoftTeams-image (3).png" />
              <img class="image2" src="../assets/img/MindLOOPS_Resouces/Mak_1.png" />
              <img class="image3" src="../assets/img/MindLOOPS_Resouces/Aliff_1_green.png" />
              <img class="image4" src="../assets/img/MindLOOPS_Resouces/Adik_2.png" />
            </div>
          </div>

          <div class="card" id="rightGrid">
            <h5>Educators Package</h5>
            <p>Discover fun ways to learn and explore with your family at the tip of the finger.</p>
            <button id="discoverSingleP" onclick = "document.location='../subscription/singlePackagePage.html'">Discover Educators Package</button>

            <div class="parent">
              <img class="image1" src="../assets/img/MindLOOPS_Resouces/Asset 13.png" />
              <img class="image3" src="../assets/img/MindLOOPS_Resouces/Asset 11.png" />
              <img class="image2" src="../assets/img/MindLOOPS_Resouces/Asset 12.png" />
            </div>
          </div>
  
        </div>

      </div>
    </section><!-- End Our Clients Section -->

  </main><!-- End #main -->
    <footer id="foot"></footer>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    
            <?php  include("../commonPHP/jsFiles.php"); ?>

    <script>
        $(document).ready(function () {
            // $.ajax({
            //     type: "get",
            //     url: "../commonPHP/topNavBarCheck.php",
            //     dataType: "html",
            //     success: function (html) {
            //         $('#head').append(html);

            //     },
            // });
            $.ajax({
                type: "get",
                url: "../commonPHP/footer.php",
                dataType: "html",
                success: function (html) {
                    $('#foot').append(html);
                },
            });
        });
        $(function () {
            $('#discoverFamilyP').on('click', function () {
                $.ajax({
                    type: "get",
                    url: "../manageSubscription/checkSubscriptionStatus.php",
                    success: function (output, status, xhr) {
                        var result = $.parseJSON(output);
                        if (result.subscribedStatus == true) {
                            console.log(result.login);
                            window.location.href = "../manageSubscription/teacher_subscribe.html";

                        } else {
                            //alert("You should subscribe to get unlimited access!");
                            window.location.href = "../subscription/familyPackagePage.html";
                        }
                    },
                    error: function (xhr, resp, text) {
                        alert("Something went wrong!");
                    },
                });



            });
        });
        $(function () {
            $('#discoverSingleP').on('click', function () {
                $.ajax({
                    type: "get",
                    url: "../manageSubscription/checkSubscriptionStatus.php",
                    success: function (output, status, xhr) {
                        var result = $.parseJSON(output);
                        if (result.subscribedStatus == true) {
                            console.log(result.login);
                            window.location.href = "../manageSubscription/teacher_subscribe.html";

                        } else {
                            //alert("You should subscribe to get unlimited access!");
                            window.location.href = "../subscription/singlePackagePage.html";
                        }
                    },
                    error: function (xhr, resp, text) {
                        alert("Something went wrong!");
                    },
                });



            });
        });
    </script>

</body>

</html>