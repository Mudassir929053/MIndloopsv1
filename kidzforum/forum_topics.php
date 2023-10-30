<?php include("../commonPHP/head.php"); ?>

<?php

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '3') {
    echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
include '../dbconnect.php';
// var_dump($_SESSION);
// exit;
?>

<head>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/forum_topics_student.css">
    <link href="../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

</head>
<?php include("../commonPHP/topNavBarCheck.php");
$forumId = $_GET['forum_id'];
?>


<main id="main">
    <div class="container">
        <br>
        <h2 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Forum Details</h2>
        <br>
        <a href="forum_details.php?forum_id=<?php echo $forumId ?>" class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i>Back</a>
        <br>
        <br>
        <?php

        // Retrieve the forum ID from the URL parameter
        $forumId = $_GET['forum_id'];
        $forumtopic_id = $_GET['forumtopic_id'];
        $current_user_id = $_SESSION['u_id'];

        // SQL query to retrieve forum details by ID
        $forumQuery = "SELECT * FROM `forum` WHERE `forum_id` = $forumId";
        $forumResult = $conn->query($forumQuery);

        // Fetch the forum details
        $forumRow = $forumResult->fetch_assoc();

        if ($forumResult->num_rows > 0) {
            // Display the forum details with clickable forum name
        ?>
            <div class="forum-item">
                <h5><i class="fa fa-newspaper-o"></i><?php echo $forumRow['forum_name'] ?> </h5>
                <p><?php echo $forumRow['forum_description'] ?></p>
            </div>
            <?php
            // SQL query to retrieve subtopics related to the forum
            $subtopicsQuery = "SELECT * FROM `forum_topic` WHERE `forum_id` = $forumId and `forumtopic_id` = $forumtopic_id";
            $subtopicsResult = $conn->query($subtopicsQuery);

            if ($subtopicsResult->num_rows > 0) {
                echo '<h5 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Articles</h5>';
                while ($subtopicRow = $subtopicsResult->fetch_assoc()) {

            ?>
                    <div class="forum-item">
                        <h5><i class="fa fa-newspaper-o"></i><?php echo $subtopicRow['ft_name']; ?></h5>
                        <div class="clearfix">

                            <p><?php echo $subtopicRow['ft_description']; ?></p>
                        </div>

                        <div class="like-dislike-buttons">
                            <?php
                            if ($subtopicRow['created_by'] == $current_user_id) {
                            ?>
                                <a href="editarticle.php?forum_id=<?php echo $forumId; ?>&forumtopic_id=<?php echo $forumtopic_id; ?>"><i class="bi bi-pencil-square text-primary" style="font-size: 18px;"></i></a>
                                <a href="deletearticle.php?forum_id=<?php echo $forumId; ?>&forumtopic_id=<?php echo $forumtopic_id; ?>" onclick="return confirmDelete()"><i class="bi bi-trash-fill p-2" style="color: red; font-size: 18px;"></i></a>
                            <?php
                            }
                            ?>
                            <button class="like-button text-success" onclick="likeForumArticle('<?= $forumtopic_id ?>','like')"><i class="fa fa-thumbs-up"></i> <span id="a_likes"><?php echo $subtopicRow['likes']; ?></span></button>
                            <button class="dislike-button text-danger" onclick="likeForumArticle('<?= $forumtopic_id ?>','dislike')"><i class="fa fa-thumbs-down"></i> <span id="a_dislikes"><?php echo $subtopicRow['dislikes']; ?></span></button>
                        </div>
                        <form method="POST" action="function.php?forum_id=<?= $forumId ?>&forumtopic_id=<?= $forumtopic_id ?>">
                            <textarea class="comment-input" name="content" placeholder="Write a comment"></textarea>
                            <input type="hidden" name="forumtopic_id" value="<?php echo $forumtopic_id; ?>">
                            <input type="hidden" name="forumid" value="<?php echo $forumtopic_id; ?>">
                            <button type="submit" class="submit-button">Submit</button>
                        </form>
                    </div>


                    <!-- Comment box with like and dislike buttons -->
                    <div class="comment-box">
                        <?php
                        //getting current_user_id 
                        $current_user_id = $_SESSION['u_id'];
                        // SQL query to retrieve comments for the given subforumtopic_id
                        $commentsQuery = "SELECT fc.comment_id,fc.content, fc.created_at,fc.created_by, tu.u_name,likes,dislikes,created_by
                      FROM forum_postcomment AS fc
                      JOIN tb_users AS tu ON fc.created_by = tu.u_id
                      WHERE fc.subforumtopic_id = $forumtopic_id AND (fc.approved = 1 or fc.created_by=$current_user_id)
                      ORDER BY fc.created_at DESC";
                        $commentsResult = $conn->query($commentsQuery);

                        if ($commentsResult->num_rows > 0) {
                            while ($commentRow = $commentsResult->fetch_assoc()) {
                        ?>
                                <div class="comment border my-2 bg-white">
                                    <p class="comment-text p-3">
                                        <?php echo $commentRow['content']; ?>
                                    </p>
                                    <div class="comment-actions border-top bg-comment-footer p-1 d-flex justify-content-between">
                                        <div>
                                            <span class="comment-author"><i class="bi bi-person" style="font-size: 22px;"></i> <?php echo $commentRow['u_name']; ?></span>
                                            <span class="comment-date small">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('F d, Y', strtotime($commentRow['created_at'])); ?></span>
                                        </div>
                                        <div id="<?= $commentRow['comment_id'] ?>">
                                            <button class="like-button text-success" onclick="likeForumComment(<?= $commentRow['comment_id'] ?>,'like',this)"><i class="fa fa-thumbs-up"></i><?= $commentRow['likes']?$commentRow['likes']:0 ?></button>
                                            <button class="dislike-button text-danger" onclick="likeForumComment(<?= $commentRow['comment_id'] ?>,'dislike',this)"><i class="fa fa-thumbs-down"></i><?= $commentRow['dislikes']?$commentRow['dislikes']:0 ?></button>

                                            <?php
                                            if ($commentRow['created_by'] == $current_user_id) {
                                                // Display update and delete buttons for comments created by the current user
                                            ?>
                                                <div id="<?= $commentRow['comment_id'] ?>" class="no-border" style="display: inline-block;">
                                                    <a href="#" class="text-primary update-button no-border px-3" data-bs-toggle="modal" data-bs-target="#editCommentModal<?= $commentRow['comment_id'] ?>"><i class="fa fa-edit"></i></a>
                                                    <a href="deleteComment.php?comment_id=<?= $commentRow['comment_id'] ?>&forum_id=<?php echo $forumId ?>&forumtopic_id=<?php echo $forumtopic_id ?>" class="text-danger delete-button no-border me-4" onclick="return confirmDelete()"><i class="fa fa-trash"></i></a>

                                                <?php
                                            }
                                                ?>
                                                </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- Edit Comment Modal -->
                                <div class="modal fade" id="editCommentModal<?= $commentRow['comment_id'] ?>" tabindex="-1" aria-labelledby="editCommentModalLabel<?= $commentRow['comment_id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCommentModalLabel<?= $commentRow['comment_id'] ?>">Edit Comment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="editComment.php?comment_id=<?= $commentRow['comment_id'] ?>&forum_id=<?php echo $forumId ?>&forumtopic_id=<?php echo $forumtopic_id ?>" method="POST">
                                                    <input type="hidden" name="comment_id" value="<?= $commentRow['comment_id'] ?>">
                                                    <div class="mb-3">
                                                        <label for="commentContent" class="form-label">Comment:</label>
                                                        <textarea class="form-control" name="content" id="commentContent" rows="3"><?= $commentRow['content'] ?></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        } else {
                            echo "<p>No comments found</p>";
                        }
                        ?>
                    </div>

                    <br>
        <?php
                }
            } else {
                echo "<p>No subtopics found</p>";
            }
        } else {
            echo "<p>No forum found</p>";
        }
        ?>
    </div>

</main><!-- End #main -->

<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete?");
    }
</script>


<script src="../../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
<script src="../../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
<script src="../../assets/vendor/aos-portfolio/aos.js"></script>
<script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script>
    const likeForumArticle = (id, action) => {
        let url = 'likeDislikeQuery.php?likeForumArticle=yes&article_id=' + id + '&action=' + action;
        fetch(url).then(data => data.text()).then(data => {
            let arr_likes = data.split('#');
            document.getElementById('a_likes').innerHTML = arr_likes[0];
            document.getElementById('a_dislikes').innerHTML = arr_likes[1];
        });
    }
    const likeForumComment = (c_id, action, obj) => {
        let url = 'likeDislikeQuery.php?likeForumComment=yes&comment_id=' + c_id + '&action=' + action;
        fetch(url).then(data => data.text()).then(data => {
            let arr_likes = data.split('#');
            obj.parentNode.childNodes[1].childNodes[1].textContent = arr_likes[0];
            obj.parentNode.childNodes[3].childNodes[1].textContent = arr_likes[1];
        });
    }
</script>

</body>

</html>