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
<?php include("editarticle.php"); ?>
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
            <div class="container-fload">
                <h2 style="text-align: center;">Update Article</h2>
                <br>
                <div class="row gy-4">
                    <?php
                    $to_mindloops_id = $_GET['to_mindloops_id'];
                    $article_id = $_GET['article_id'];
                    ?>
                    <div class="mx-5">
                        <a href="to-mindloops-article.php?to_mindloops_id=<?= $to_mindloops_id ?>" class="btn btn-warning btn-sm col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        $communityQuery = "SELECT * FROM `to_mindloops_articles` WHERE article_id = '$article_id'";
                        $communityResult = mysqli_query($conn, $communityQuery);
                        // Iterate through each community
                        while ($communityRow = mysqli_fetch_assoc($communityResult)) {
                        ?>
                            <form id="insertLpForm" method="POST" enctype='multipart/form-data'>
                                <div class="form-group">
                                    <label for="article_title">Article Title</label>
                                    <input type="text" class="form-control" id="article_title" name="article_title" placeholder="Enter Title" value="<?= $communityRow['article_title'] ?>" required>
                                    <input type="hidden" class="form-control" id="to_mindloops_id" name="to_mindloops_id" value="<?= $to_mindloops_id ?>" required>
                                    <input type="hidden" class="form-control" id="article_id" name="article_id" value="<?= $article_id ?>" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="article_thumbnail">Upload Thumbnail *(jpg, png, gif, jpeg)</label>
                                    <?php if (!empty($communityRow['article_thumbnail'])) : ?>
                                        <div>
                                            <img src="thumbnails/<?= $communityRow['article_thumbnail'] ?>" alt="Thumbnail">
                                        </div>
                                    <?php else : ?>
                                        <div>No thumbnail uploaded</div>
                                    <?php endif; ?>
                                    <input type="file" class="form-control-file" id="article_thumbnail" name="article_thumbnail" accept="image/*">
                                </div>

                                <br>
                                <div class="form-group">
                                    <label for="article_content">Article Description</label>
                                    <textarea class="form-control" id="summernote" name="article_content" placeholder="Enter Community description..." maxlength="1000" required><?= $communityRow['article_content'] ?></textarea>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="article_attechment">Uploaded File *(jpg, png, gif, jpeg, pdf)</label>
                                    <?php if (!empty($communityRow['attachment'])) : ?>
                                        <div>
                                            File: <a href="upload/<?= $communityRow['attachment'] ?>" target="_blank"><?= $communityRow['attachment'] ?></a>
                                        </div>
                                    <?php else : ?>
                                        <div>No file uploaded</div>
                                    <?php endif; ?>
                                    <input type="file" class="form-control-file" id="article_attechment" name="article_attechment">
                                </div>

                                <br>
                                <div class="form-group mb-5">
                                    <button type="submit" class="btn btn-warning btn-sm float-end ">Update Article </button>
                                    <!-- <button type="reset" class="btn btn-secondary">Clear</button> -->
                                </div>
                            </form>
                    </div>
                <?php
                        }
                ?>
                </div>
                <!-- <div id="summernote"></div> -->
                <script>
                    $('#summernote').summernote({
                        placeholder: 'Article Description',
                        tabsize: 2,
                        minHeight: 120,
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