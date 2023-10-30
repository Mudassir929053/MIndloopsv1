<?php
require_once("../commonPHP/head.php");
if (!session_id()) {
    session_start();
    if ($_SESSION["userType"] != '2') {
        header('location: ../../login_and_register/login.php');
    }
}
include("../../dbconnect.php");
$sql = "SELECT * FROM tb_loopstype";
$result = mysqli_query($conn, $sql);
?>
<?php include("addarticle.php"); ?>
<?php include("../commonPHP/topNavBarLoggedIn.php"); ?>
<link href="../../assets/css/teacher.css" rel="stylesheet">

    

<body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <main id="main">
        <!-- <div id="magazine-hero">
    </div> -->
        <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->
        <section id="portfolio-details" class="portfolio-details">
            <div class="container-fluid">
                <h2 style="text-align: center;">Create Article</h2>
                <br>
                <div class="row gy-4">
                    <?php
                    $category_id = $_GET['category_id'];
                    $user = $_SESSION['u_id'];
                    ?>
                    <a href="community-article.php?category_id=<?= $_GET['category_id'] ?>&community_id=<?= $_GET['community_id'] ?>" class="btn btn-warning btn-sm col-lg-1 mx-5"><i class="bi bi-arrow-left"></i> Back</a>
                    <div class="col-lg-12">
                        <form id="insertLpForm" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="article_title">Article Title</label>
                                <input type="text" class="form-control" id="article_title" name="article_title" placeholder="Enter Title" required>
                                <input type="hidden" class="form-control" id="category_id" name="category_id" value="<?= $category_id ?>" required>
                                <input type="hidden" class="form-control" id="comunity_id" name="comunity_id" value="<?= $_GET['community_id'] ?>" required>
                                <input type="hidden" class="form-control" id="user" name="user" value="<?= $user ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="article_thumbnail">Upload Thumbnail *(jpg, png, gif, jpeg)</label>
                                <input type="file" class="form-control-file" id="article_thumbnail" name="article_thumbnail" accept="image/*">

                            </div>
                            <div class="form-group">
                                <label for="article_description">Article Description</label>
                                <textarea class="form-control" id="summernote" name="article_description" placeholder="Enter Article description..." maxlength="1000" required></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="article_attachment">Upload File *(jpg, png, gif, jpeg, pdf)</label>
                                <input type="file" class="form-control-file" id="article_attachment" name="article_attachment">
                            </div>
                            <br>
                            <div class="form-group mb-5">
                                <button type="submit" class="btn btn-warning btn-sm float-end">Add Article</button>
                                <!-- <button type="reset" class="btn btn-secondary">Clear</button> -->
                            </div>
                        </form>
                    </div>

                </div>
                <!-- <div id="summernote"></div> -->
                <script>
                    $('#summernote').summernote({
                        placeholder: 'Article Description',
                        tabsize: 2,
                        height: 120,
                    });
                </script>
            </div>
        </section>
    </main><!-- End #main -->
    <?php include("../commonPHP/footer.php"); ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php include("../commonPHP/jsFiles.php"); ?>
</body>

</html>