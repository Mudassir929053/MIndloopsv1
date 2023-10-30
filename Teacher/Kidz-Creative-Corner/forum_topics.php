<?php include("../commonPHP/head.php");
include '../commonPHP/topNavBarLoggedIn.php';
?>

<?php

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '2') {
    echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
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


<style>
    body {
        background-image: url('../../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 110%;
        background-position: top center;
        background-repeat: no-repeat;
    }

    .forum-item {
        background-color: #f8f8f8;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }



    .forum-item:hover {
        background-color: #f0f0f0;
    }

    .forum-item .fa-infinity {
        display: block;
        font-size: 36px;
        margin-bottom: 10px;
        color: #ff6f00;
    }

    .forum-item h5 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #555;
    }

    .forum-item a {
        text-decoration: none;
        color: #555;
        transition: color 0.3s ease;
    }

    .forum-item a:hover {
        color: #ff6f00;
    }

    .comment-box {
        background-color: #f8f8f8;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
        border-radius: 4px;
    }

    .comment-input {
        width: 100%;
        height: 100px;
        resize: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .like-dislike-buttons {
        display: flex;
        justify-content: right;
        margin-top: 10px;
    }

    .like-button,
    .dislike-button {
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 16px;
        padding-right: 10px;
        padding-bottom: 10px;
        margin-left: 10px;
        color: #555;
        transition: color 0.3s ease;
    }

    .like-button:hover,
    .dislike-button:hover {
        color: #ff6f00;
    }

    .submit-button {
        background-color: #ff6f00;
        color: #fff;
        border: none;
        cursor: pointer;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
    }

    .submit-button:hover {
        background-color: #e65c00;
        animation: none;
    }

    .fa-newspaper-o {
        background-color: #ff6f00;
        color: #fff;
        padding: 5px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .bg-comment-footer {
        background-color: #f8f8f8;
        padding: 10px;
        display: flex;
        align-items: flex-start;
    }

    .comment-actions {
        display: flex;
        /* justify-content:flex-start; */
        align-items: center;
        width: 100%;
    }

    .comment-actions .comment-info {
        display: flex;
        align-items: flex-end;
    }

    .comment-actions .comment-author {
        color: #555;
        font-weight: bold;
        margin-right: 10px;
    }

    .comment-actions .comment-date {
        color: #777;
    }

    .comment-actions .like-button,
    .comment-actions .dislike-button {
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 14px;
        color: #555;
        transition: color 0.3s ease;

    }

    .comment-actions .like-button:hover,
    .comment-actions .dislike-button:hover {
        color: #ff6f00;
    }

    .comment-actions .like-button i,
    .comment-actions .dislike-button i {
        margin-right: 5px;
    }

    .comment-attachment img {
        max-width: auto;
        /* Adjust the maximum width as needed */
        height: 400px;
    }

    .comment-attachment.pdf-attachment {
        max-width: auto;
        /* Adjust the maximum width for PDF attachments */
        height: 400px;
        /* Adjust the height for PDF attachments */
    }

    .comment-attachment iframe {
        width: 100%;
        height: 100%;
    }
</style>
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
        $forumQuery = "SELECT * FROM `kidzcreativecorner` WHERE `topic_id` = $forumId";
        $forumResult = $conn->query($forumQuery);

        // Fetch the forum details
        $forumRow = $forumResult->fetch_assoc();

        if ($forumResult->num_rows > 0) {
            // Display the forum details with clickable forum name
        ?>
            <div class="forum-item">
                <h5><i class="fa fa-newspaper-o"></i><?php echo $forumRow['topic_name'] ?> </h5>
                <p><?php echo $forumRow['description'] ?></p>
            </div>
            <?php
            // SQL query to retrieve subtopics related to the forum
            $subtopicsQuery = "SELECT * FROM `kidzpost` WHERE `topic_id` = $forumId and `kidzpost_id` = $forumtopic_id";
            $subtopicsResult = $conn->query($subtopicsQuery);

            if ($subtopicsResult->num_rows > 0) {
                echo '<h5 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Articles</h5>';
                while ($subtopicRow = $subtopicsResult->fetch_assoc()) {
            ?>
                    <div class="forum-item">
                        <h5><i class="fa fa-newspaper-o"></i><?php echo $subtopicRow['title']; ?></h5>
                        <p><?php echo $subtopicRow['content']; ?></p>
                        <div class="like-dislike-buttons">
                            <button class="like-button"><i class="fa fa-thumbs-up"></i> Like</button>
                            <button class="dislike-button"><i class="fa fa-thumbs-down"></i> Dislike</button>
                        </div>


                    </div>


                    <!-- Comment box with like and dislike buttons -->
                    <div class="comment-box">
                        <?php
                        // SQL query to retrieve comments for the given subforumtopic_id
                        $commentsQuery = "SELECT fc.content, fc.attachment, fc.created_at, tu.u_name
                      FROM kiszspostcomment AS fc
                      JOIN tb_users AS tu ON fc.created_by = tu.u_id
                      WHERE fc.kidzpost_id = $forumtopic_id AND fc.approved = 1
                      ORDER BY fc.created_at DESC";
                        $commentsResult = $conn->query($commentsQuery);

                        if ($commentsResult->num_rows > 0) {
                            while ($commentRow = $commentsResult->fetch_assoc()) {
                        ?>
                                <div class="comment border my-2 bg-white">
                                    <p class="comment-text p-3">
                                        <?php echo $commentRow['content']; ?>
                                    </p>
                                    <?php if (!empty($commentRow['attachment'])) { ?>
                                        <?php $attachmentExtension = pathinfo($commentRow['attachment'], PATHINFO_EXTENSION); ?>
                                        <?php if ($attachmentExtension === 'pdf') { ?>
                                            <div class="comment-attachment pdf-attachment">
                                                <iframe src="../assets/kidzcorner/attachment/<?php echo $commentRow['attachment']; ?>" frameborder="0"></iframe>
                                            </div>
                                        <?php } else { ?>
                                            <div class="comment-attachment">
                                                <img src="../assets/kidzcorner/attachment/<?php echo $commentRow['attachment']; ?>" alt="Attachment">
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
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