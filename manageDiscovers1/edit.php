<?php
if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
}
include("../commonPHP/adminNavBar.php");
include('../dbconnect.php');

$sql = "SELECT * FROM tb_discovers
            WHERE cd_id = '" . $_GET['cd_id'] . "'";

$result = mysqli_query($conn, $sql);
if (!$result)
    echo $conn->error;

if (mysqli_num_rows($result) != 1) {
    echo "SQL ERROR";
} else {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
}
?>

<main id="main">
    <div id="magazine-hero">
    </div>
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <h2 style="text-align: center;">Update Dicover Image (ID = <?php echo $row['cd_id']; ?>)</h2>
            <br>
            <div class="row gy-4">
                <a href="manage.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
                <div class="col-lg-12">
                    <form id="editMagForm" action="edit-backend.php" method="POST" enctype='multipart/form-data'>
                        <div class="form-group">
                            <label for="cd_id"><b>Discover Image ID</b></label>
                            <input type="text" class="form-control-plaintext" id="cd_id" name="cd_id" aria-describedby="emailHelp" value="<?php echo $row['cd_id']; ?>" readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="cd_title">Title</label>
                            <input type="text" class="form-control" id="cd_title" name="cd_title" placeholder="Discover" value="<?php echo $row['cd_title']; ?>" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="cd_desc">Description (less than 1000 characters.)</label>
                            <textarea class="form-control" id="cd_desc" name="cd_desc" placeholder="This is the magazine description..." maxlength="1000" required><?php echo $row['cd_desc']; ?></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="currFilePath"><b>Current Image *(.png / .jpg / .jpeg/ .webp / .avif)</b></label>
                            <input type="text" class="form-control-plaintext" id="currFilePath" name="currFilePath" aria-describedby="emailHelp" value="<?php echo $row['cd_imgPath']; ?>" style="font-size: 13px;" readonly>
                        </div>
                        <div class="form-group">
                            <label for="cd_imgPathNew"><b></b></label><!--New Image-->
                            <input type="file" class="form-control-file" id="cd_imgPathNew" name="cd_imgPathNew" accept="image/png, image/jpeg, image/jpg ,image/webp, image/avif">
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Update Discover Image</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>