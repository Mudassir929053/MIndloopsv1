<?php
require_once("../commonPHP/head.php");
?>
<?php
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
if (isset($_GET['article_id'])) {
    extract($_GET);
} else {
    header('Location: to-mindloops.php');
}
 $sql = "SELECT * FROM `to_mindloops_articles` LEFT JOIN tb_users ON tb_users.u_id = to_mindloops_articles.created_by where article_id = '$article_id'";
$data = [];
$result = mysqli_query($conn, $sql);
while ($row = $result->fetch_assoc()) {
    $data = $row;
}
// var_dump($data);
// exit;
?>
<link href="../../assets/css/teacher.css" rel="stylesheet">

<main id="main">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <div>
                    <h1><a href="#" class="text-danger">Article</a><a href="to-mindloops-article.php?to_mindloops_id=<?= $data['topic_id'] ?>" class="btn btn-warning float-end btn-sm ">Back</a><a href="edit-article.php?article_id=<?= $data['article_id'] ?>&to_mindloops_id=<?= $data['topic_id'] ?>" class="btn btn-primary float-end mx-2 btn-sm ">Edit</a></h1>
                    <br>
                </div>
                <div class="container-fluid mb-5">
                    <div class="row p-2">
                        <h2 class="text-center"><?= $data['article_title'] ?></h2>
                        <div class="article">
                            <?= $data['article_content'] ?>
                        </div>
                        <div class="details d-flex justify-content-between">
                            <?php if ($data['attachment']) { ?>
                                <p>Attachment: <a class="btn btn-warning btn-sm" href="upload/<?= $data['attachment'] ?>" target="_blank">Click To view</a></p>
                            <?php } ?>
                            <p>Created By: <?= $data['u_name'] ?></p>
                           
                        </div>
                    </div>
                </div>
                

            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>
    </div>
</main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
</body>

</html>