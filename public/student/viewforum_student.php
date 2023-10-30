<?php include("../commonPHP/head.php"); ?>

<?php

if (!session_id()) {
    session_start();
}

include '../dbconnect.php';

?>
<head>


<link rel="stylesheet" href="../assets/css/style.css">
<link href="../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fontawesome.com/icons/infinity?f=classic&s=duotone&an=bounce&sz=lg&sc=%231E3050">

</head>

<?php include("../commonPHP/topNavBarCheck.php"); ?>

<style>
    body {
        background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 110%;
        background-position: top center;
    }

.forum-item {
    background-color: #f8f8f8;
    border: 1px solid #e0e0e0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 4px;
    /* text-align: center; */
    transition: background-color 0.3s ease;
}

.forum-item:hover {
    background-color: #f0f0f0;
}

.forum-item .fa-infinity {
    display: block;
    font-size: 36px;
    margin-bottom: 10px;
    color: #ff6f00; /* Adjust the color to your preference */
}

.forum-item h5 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #555;
}

.forum-item a {
    text-decoration: none;
    color: #555;
    transition: color 0.3s ease;
}

.forum-item a:hover {
    color: #ff6f00; /* Adjust the hover color to your preference */
}
.fa-newspaper-o {
    background-color: #ff6f00;
    color: #fff;
    padding: 5px;
    border-radius: 50%;
    margin-right: 10px;
}

</style>
<main id="main">
    <!-- 
    <div id="magazine-hero">
    </div> -->
    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
        <h2 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Creative Corner</h2>

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