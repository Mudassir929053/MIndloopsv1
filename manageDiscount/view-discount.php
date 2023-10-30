<?php
if (!session_id()) {
    session_start();
    if ($_SESSION["userType"] != '1') {
        header('location: ../login_and_register/login.php');
    }
}
include("../dbconnect.php");
if (isset($_GET['discount_id'])) {
    extract($_GET);
} else {
    header('Location: index.php');
}
$discount_id = $_GET['discount_id']; // Escape the variable to prevent SQL injection
$sql = "SELECT d.discount_id, d.title, d.description, d.discount_category, d.logo_image, d.start_date, d.end_date, d.discount_code, d.created_at, COUNT(r.user_id) AS total_redeems
        FROM discounts AS d
        LEFT JOIN redemptions AS r ON d.discount_id = r.discountId
        WHERE d.discount_id = '$discount_id'
        GROUP BY d.discount_id";
$data = [];
$result = mysqli_query($conn, $sql);
while ($row = $result->fetch_assoc()) {
    $data = $row;
}
?>
<?php
include 'discount-function.php';
include("../commonPHP/adminNavBar.php"); ?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<style>
    body {
        background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 110%;
        background-position: top center;
    }
    #magazine-hero {
        background-image: none;
        height: 150px;
    }
    #imgDiv {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }
    .card{color: teal}
</style>
<main id="main">
    <!-- <div id="magazine-hero">
    </div> -->
    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->
    <!-- <div class="py-5"></div> -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <h2 style="text-align: center; flex: 1;">View Discount</h2>
                        <a class="btn btn-warning btn-sm" href="index.php">Back</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container my-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <img src="../assets/discount_images/<?= $data['logo_image'] ?>" class="card-img-top" alt="Discount Image">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title text-warning"><?= $data['title'] ?></h5>
                                    <h5 class="card-title text-danger"><?= $data['discount_category'] ?></h5>
                                    <p class="card-text text-warning"><?= $data['description'] ?></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="card-text text-warning"><strong>Discount Code:</strong> <?= $data['discount_code'] ?></p>
                                            <p class="card-text text-warning"><strong>Start Date: </strong><?= date('Y, F, d', strtotime($data['start_date'])) ?> </p>
                                            <p class="card-text text-warning"><strong>End Date: </strong> <?= date('Y, F, d', strtotime($data['end_date'])) ?></p>
                                            <p class="card-text badge bg-info rounded-pill display-3"><strong>Total Redeems : </strong> <?= $data['total_redeems'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <br><br>
        </div>
    </section>
</main><!-- End #main -->
<?php include("../commonPHP/footer_admin.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
</body>
</html>