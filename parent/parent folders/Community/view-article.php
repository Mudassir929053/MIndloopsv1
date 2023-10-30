<?php include("../../commonPHP/head.php"); ?>

<?php

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '4') {
    echo "<script> window.location.replace('../../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
 
// var_dump($_SESSION);
// exit;
?>

<head>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<?php include("../commonPHP/topNavBarCheck.php"); ?>

<style>
    body {
        background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
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
</style>
<main id="main">
    <div class="container">
        <br>
        <!-- <h2 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Forum Details</h2> -->
        <br>
        <a href="javascript:history.back()" class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i>Back</a>
        <br>
        <br>
        <?php

        // Retrieve the forum ID from the URL parameter
        $article_id = $_GET['article_id'];
        // $forumtopic_id = $_GET['forumtopic_id'];

        // SQL query to retrieve forum details by ID
        $forumQuery = "SELECT * FROM `community_article` WHERE `article_id` = $article_id";
        $forumResult = $conn->query($forumQuery);

        // Fetch the forum details
        $forumRow = $forumResult->fetch_assoc();

        if ($forumResult->num_rows > 0) {
            // Display the forum details with clickable forum name
        ?>

            <?php
            // SQL query to retrieve subtopics related to the forum
            $subtopicsQuery = "SELECT * FROM `community_article` WHERE `article_id` = $article_id ";
            $subtopicsResult = $conn->query($subtopicsQuery);

            if ($subtopicsResult->num_rows > 0) {
                echo '<h5 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Articles</h5>';
                while ($subtopicRow = $subtopicsResult->fetch_assoc()) {

            ?>
                    <div class="forum-item">
                        <h5><i class="fa fa-newspaper-o"></i><?php echo $subtopicRow['ca_title']; ?></h5>
                        <p><?php echo $subtopicRow['ca_content']; ?></p>
                        <div class="like-dislike-buttons">
                            <button class="like-button text-success" onclick="likeForumArticle('<?= $article_id ?>','like')"><i class="fa fa-thumbs-up"></i> <span id="a_likes"><?php echo $subtopicRow['likes']; ?></span></button>
                            <button class="dislike-button text-danger" onclick="likeForumArticle('<?= $article_id ?>','dislike')"><i class="fa fa-thumbs-down"></i> <span id="a_dislikes"><?php echo $subtopicRow['dislikes']; ?></span></button>
                        </div>
                        <form method="POST" action="insert.php?article_id=<?= $article_id ?>">
                            <textarea class="comment-input" name="content" placeholder="Write a comment"></textarea>
                            <!-- <input type="hidden" name="forumtopic_id" value="<?php #echo $forumtopic_id; ?>"> -->
                            <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
                            <button type="submit" class="submit-button">Submit</button>
                        </form>
                    </div>


                    <!-- Comment box with like and dislike buttons -->
                    <div class="comment-box">
                        <?php
                        // SQL query to retrieve comments for the given subforumtopic_id
                        $commentsQuery = "SELECT * FROM `communityarticlecomment`  JOIN tb_users ON communityarticlecomment.created_by = tb_users.u_id
                        WHERE communityarticlecomment.article_id = $article_id AND approved = '1'";

                        $commentsResult = $conn->query($commentsQuery);

                        if ($commentsResult->num_rows > 0) {
                            while ($commentRow = $commentsResult->fetch_assoc()) {
                        ?>
                                <div class="comment border my-5 bg-white">
                                    <p class="comment-text p-3">
                                        <?php echo $commentRow['comment_content']; ?>
                                    </p>
                                    <div class="comment-actions border-top bg-comment-footer p-1 d-flex justify-content-between">
                                        <div>
                                            <span class="comment-author"><i class="bi bi-person" style="font-size: 22px;"></i> <?php echo $commentRow['u_name']; ?></span>
                                            <span class="comment-date small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('F d, Y', strtotime($commentRow['created_at'])); ?></span>
                                        </div>
                                        <div id="<?= $commentRow['comment_id'] ?>">

                                            <button class="like-button text-success" onclick="likeForumComment(<?= $commentRow['comment_id'] ?>,'like',this)"><i class="fa fa-thumbs-up"></i><?= $commentRow['likes'] ?></button>
                                            <button class="dislike-button text-danger" onclick="likeForumComment(<?= $commentRow['comment_id'] ?>,'dislike',this)"><i class="fa fa-thumbs-down"></i><?= $commentRow['dislikes'] ?></button>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>No comments yet</p>";
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