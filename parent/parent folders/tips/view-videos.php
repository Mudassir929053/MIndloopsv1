<?php
include("../commonPHP/head.php");
include '../../dbconnect.php';

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '2') {
    echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
extract($_GET);
// echo $v_id;
 $sql = "SELECT *
FROM tb_tips
LEFT JOIN tb_videos ON tb_tips.t_video_id = tb_videos.v_id WHERE v_id='$v_id'";
 $result = $conn->query($sql);
?>
<link href="../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<?php include("../commonPHP/topNavBarCheck.php"); ?>
<main id="main">
    <?php
    
    while ($row = $result->fetch_assoc()) {
    ?>
        <div class="container">
            
            <div class="row ">
                <div class="col-12">
                    <div class="embed-responsive">
                        <video autoplay loop width="100%" controls>
                            <!-- <source src="http://www.mysite.braaasil.com/video/mel.webm" type="video/webm"> -->
                            <source src="../<?=  $row['v_path'] ?>" type="video/mp4">
                        </video>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3><?= $row['v_title'] ?></h3>
                    <p><?= $row['v_desc'] ?></p>
                    <a href="tip-details.php?t_id=<?= $row['t_id']; ?>" class="btn btn-sm btn-info">Back To Article</a>
                </div>
            </div>
        </div>
    <?php } ?>
    <section id="portfolio" class="portfolio sections-bg">
        <div class="container" data-aos="fade-up">
            <div id="portfolio-isotope" class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">
            </div>
        </div>
    </section>
</main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
</body>

</html>
