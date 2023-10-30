<?php
if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
}
include("../commonPHP/adminNavBar.php");
?>

<main id="main">
   
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <h2 style="text-align: center;">Add a Discover Image</h2>
            <br>
            <div class="row gy-4">
                <a href="manage.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
                <div class="col-lg-12">
                    <form id="insertMagForm" action="insert-backend.php" method="POST" enctype='multipart/form-data'>
                        <div class="form-group">
                            <label for="cd_id"><b>ID (Auto Generated)</b></label>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="cd_title">Title</label>
                            <input type="text" class="form-control" id="cd_title" name="cd_title" placeholder="Explore More" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="cd_desc">Description (less than 1000 characters.)</label>
                            <textarea class="form-control" id="cd_desc" name="cd_desc" placeholder="This is the image of Discover 1." maxlength="1000" required></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="cd_imgPath">Image *(.png / .jpg / .jpeg/ .webp / .avif)</label>
                            <input type="file" class="form-control-file" id="cd_imgPath" name="cd_imgPath" accept="image/png, image/jpeg, image/jpg image/webp image/avif" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Submit</button>
                            <button type="reset" class="btn btn-secondary">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php include("../commonPHP/footer_admin.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>


</body>

</html>