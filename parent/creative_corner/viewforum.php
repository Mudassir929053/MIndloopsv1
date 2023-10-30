<?php include("../commonPHP/head.php");
include '../commonPHP/topNavBarLoggedIn.php';
?>

<?php

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '4') {
    echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
 
?>
<head>


<link rel="stylesheet" href="../../assets/css/style.css">
<link href="../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fontawesome.com/icons/infinity?f=classic&s=duotone&an=bounce&sz=lg&sc=%231E3050">

<link rel="stylesheet" href="../../assets/css/parent.css">
</head>
<body class="imagebackground">
<main id="main">
    <!-- 
    <div id="magazine-hero">
    </div> -->
    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
        <h2 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Kidz Creative Corner</h2>

            <br>
            <div class="row gy-4">

                <div class="col-lg-12">
                    <div class="row">
                        <?php
                        // SQL query to retrieve data from the table
                        $sql = "SELECT * FROM `kidzcreativecorner` WHERE published=1 ";
                        $result = $conn->query($sql);
                        // Loop through the result and display data in grid items
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <div class="col-md-12">
                                    <div class="forum-item">
                                        <h5><i class="fa fa-newspaper-o"></i><a href="forum_details.php?forum_id=<?php echo $row['topic_id'] ?>"><?php echo $row['topic_name'] ?></a></h5>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>No data found</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>

<script src="../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
<script src="../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
<script src="../assets/vendor/aos-portfolio/aos.js"></script>
<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../assets/js/main.js"></script>



</body>

</html>