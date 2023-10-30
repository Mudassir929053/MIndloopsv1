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
?>
<style>
    .icon-large {
        font-size: 20px;
        /* Adjust the font size as needed */
    }
</style>
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
                            <p>Created By: <?= $data['u_full_name'] ?></p>
                            <p><i class="bi text-danger bi-hand-thumbs-up-fill"></i> <?= $data['likes'] ? $data['likes'] : 0 ?> <i class="bi text-secondary bi-hand-thumbs-down-fill"></i> <?= $data['dislikes'] ? $data['dislikes'] : 0 ?></p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <h3>Comments</h3>
                    <?php
                    // Sanitize and escape the article_id parameter
                    $articleId = mysqli_real_escape_string($conn, $_GET['article_id']);

                    // Construct the SQL query to fetch comments for the specified article
                    $commentsQuery = "SELECT * FROM to_mindloops_article_comments LEFT JOIN tb_users ON tb_users.u_id = to_mindloops_article_comments.comment_author WHERE article_id = '$articleId'";

                    $commentsResult = mysqli_query($conn, $commentsQuery);

                    // Check if there are any comments
                    if (mysqli_num_rows($commentsResult) > 0) {
                        // Iterate through each comment
                        while ($commentRow = mysqli_fetch_assoc($commentsResult)) {
                            $commentId = $commentRow['comment_id'];
                            $commentContent = $commentRow['comment_content'];
                            $commentAuthor = $commentRow['u_full_name'];
                            $commentDate = $commentRow['comment_date'];
                    ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p class="card-text text-black"><?= $commentContent ?></p>
                                    <p class="card-text"><small class="text-muted">By <span class="text-danger"> <?= $commentAuthor ?></span> on <?= $commentDate ?></small></p>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        // Display a message when there are no comments
                        ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <p class="card-text text-black">No comments yet.</p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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