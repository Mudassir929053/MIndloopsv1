<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
?>

<?php

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '2') {
    echo "<script> window.location.replace('../../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
include '../../dbconnect.php';
// var_dump($_SESSION);
// exit;
?>

<head>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

</head>

<link href="../../assets/css/teacher.css" rel="stylesheet">

<main id="main">
    <div class="container">
        <br>
        <h2 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Forum Details</h2>
        <br>
        <a href="javascript:history.back()" class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i>Back</a>
        <br>
        <br>
        <?php

        // Retrieve the forum ID from the URL parameter
        $forumId = $_GET['forum_id'];
        $forumtopic_id = $_GET['forumtopic_id'];

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
                        <p><?php echo $subtopicRow['ft_description']; ?></p>
                        <div class="like-dislike-buttons">
                            <button class="like-button"><i class="fa fa-thumbs-up"></i> Like</button>
                            <button class="dislike-button"><i class="fa fa-thumbs-down"></i> Dislike</button>
                        </div>
                        <form method="POST" action="forum_function.php?forum_id=<?= $forumId ?>&forumtopic_id=<?= $forumtopic_id ?>">
                            <textarea class="comment-input" name="content" placeholder="Write a comment"></textarea>
                            <input type="hidden" name="forumtopic_id" value="<?php echo $forumtopic_id; ?>">
                            <input type="hidden" name="forumid" value="<?php echo $forumtopic_id; ?>">
                            <button type="submit" class="submit-button">Submit</button>
                        </form>
                    </div>


                    <!-- Comment box with like and dislike buttons -->
                    <div class="comment-box">
                        <?php
                        // SQL query to retrieve comments for the given subforumtopic_id
                        $commentsQuery = "SELECT fc.content, fc.created_at, tu.u_name
                      FROM forum_postcomment AS fc
                      JOIN tb_users AS tu ON fc.created_by = tu.u_id
                      WHERE fc.subforumtopic_id = $forumtopic_id AND fc.approved = 1
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
                                        <span class="comment-date small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('F d, Y', strtotime($commentRow['created_at'])); ?></span>
                                        </div>
                                        <div>

                                            <button class="like-button"><i class="fa fa-thumbs-up"></i> Like</button>
                                            <button class="dislike-button"><i class="fa fa-thumbs-down"></i> Dislike</button>
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

<script src="../../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
<script src="../../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
<script src="../../assets/vendor/aos-portfolio/aos.js"></script>
<script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../../assets/js/main.js"></script>



</body>

</html>