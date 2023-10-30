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
if ($_SESSION["userType"] != '4') {
    echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
 
// Retrieve the forum ID from the URL parameter
$category_id = $_GET['category_id'];
$article_id = $_GET['article_id'];
$community_id = $_GET['community_id'];
$current_user_id = $_SESSION['u_id'];
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
        background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 100%;
        background-position: top center;
        background-repeat: no-repeat;
    }
    .btn-primary {
        background-color: #E31568;
        border-radius: 20px;
        border: 0;
        margin-right: 20px;
        padding: 6px 15px;
    }
    .btn-secondary {
        background-color: #fcfafd;
        border-radius: 20px;
        border: none;
        color: black;
        font-weight: 500;
        padding: 6px 15px;
    }
    .avatar-sm {
        width: 100%;
        height: 80px;
        font-size: 30px;
        border: 1px solid black;
    }
    .initials {
        line-height: 70px;
        /* Adjust the line-height to vertically center the initials */
    }
    .forum-item ul {
        list-style: none;
        /* Remove default bullets */
    }
    .forum-item ul li::before {
        content: "";
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 15px;
    }
    .bullet-red::before {
        background-color: red;
    }
    .bullet-yellow::before {
        background-color: yellow;
    }
    .bullet-lightblue::before {
        background-color: lightblue;
    }
    .bullet-orange::before {
        background-color: orange;
    }
    .list {
        padding-bottom: 12px;
    }
    .list a {
        color: black;
        transition: transform 0.3s ease-in-out;
    }
    .list:hover {
        transform: scale(0.9);
        background-color: #f2f2f2;
        /* Add a background color for the hover effect */
    }
    .list a:hover {
        color: blue;
    }
    .dropdown-item {
        display: block;
        width: 50%;
        padding: 0.25rem 1rem;
        clear: both;
        font-weight: 400;
        color: #212529;
        text-align: inherit;
        text-decoration: none;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
    }
    .dropdown-menu {
        background-color: transparent;
        min-width: 20px;
        border: none;
        top: auto;
        bottom: 100%;
    }
    .custom-dropdown-button {
        background-color: transparent;
        border: none;
        padding: 0;
    }
    .subtopics-header {
        cursor: pointer;
        text-decoration: underline;
        color: blue;
        margin-bottom: 10px;
    }
    .subtopics-list {
        display: block;
    }
    @media (max-width: 767px) {
        .subtopics-list {
            display: none;
        }
    }
    .container.mb-md-5 {
        padding: 0 15px;
        /* Add padding for responsiveness */
    }
    @media (max-width: 767px) {
        .col-10.col-md-2.py-1 {
            flex-basis: 100%;
            max-width: 100%;
            margin-bottom: 10px;
        }
        .row.py-5>.col {
            flex-basis: 100%;
            max-width: 100%;
        }
        .col.py-3.d-flex.justify-content-between {
            flex-wrap: wrap;
        }
        .col.py-3.d-flex.justify-content-between>div {
            flex-basis: 100%;
            max-width: 100%;
            margin-bottom: 10px;
        }
    }
</style>
<main id="main">
    <div class="container-fluid">
        <?php
        $article_id = $_GET['article_id'];
        $category_id = $_GET['category_id'];
        // SQL query to retrieve subtopics related to the forum
        $subtopic = "SELECT * FROM `community_article` WHERE `cc_id` = $category_id and `article_id` = $article_id";
        $subtopicResult = $conn->query($subtopic);
        if ($subtopicResult->num_rows > 0) {
            while ($subtopicRow1 = $subtopicResult->fetch_assoc()) {
        ?>
                <div class="row p-md-5">
                    <div class="col-md-4 offset-md-3 display-5 px-md-5">
                        <?php echo $subtopicRow1['ca_title']; ?>
                    </div>
                    <div class="col-md-1 offset-md-4 px-md-4">
                        <div class="dropdown">
                            <i class="bi bi-bookmark" onclick="bookmarkPage()"></i>
                            <?php
                            if ($subtopicRow1['created_by'] == $current_user_id) {
                                // Display update and delete buttons for comments created by the current user
                            ?>
                                <button class="btn btn-link" type="button" id="optionsDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-vertical" aria-labelledby="optionsDropdown" style="border: none;">
                                    <a class="dropdown-item" href="edit-article.php?article_id=<?php echo $article_id; ?>&category_id=<?php echo $category_id; ?>&community_id=<?php echo $community_id; ?>"><span class="rounded-circle bg-white"><i class="bi bi-pencil-fill text-warning"></i></span></a>
                                    <a class="dropdown-item" href="delete-article.php?article_id=<?php echo $article_id; ?>&category_id=<?php echo $category_id; ?>&community_id=<?php echo $community_id; ?>" onclick="return confirmDelete()"><i class="bi bi-trash-fill text-danger"></i></a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-md-3">
                <?php
                // SQL query to retrieve forum details by ID
                $forumQuery = "SELECT * FROM `community_category` WHERE `category_id` = $category_id";
                $forumResult = $conn->query($forumQuery);
                // Fetch the forum details
                $forumRow = $forumResult->fetch_assoc();
                if ($forumResult->num_rows > 0) {
                    // Display the forum details with clickable forum name
                    echo '<div class="fs-5">Other related articles in </br><span class="fs-3 text-danger">' . $forumRow['cc_name'] . '</span></div>';
                    // SQL query to retrieve subtopics related to the forum
                    $subtopicsQuery = "SELECT * FROM `community_article` WHERE `cc_id` = $category_id";
                    $subtopicsResult = $conn->query($subtopicsQuery);
                    if ($subtopicsResult->num_rows > 0) {
                        echo '<div class="forum-item">';
                        echo '<ul>';
                        $colors = array('bullet-red', 'bullet-yellow', 'bullet-lightblue', 'bullet-orange');
                        $i = 0;
                        while ($subtopicRow = $subtopicsResult->fetch_assoc()) {
                            $colorClass = $colors[$i % count($colors)];
                            $article_id1 = $subtopicRow['article_id'];
                            //    echo $forumId;
                            $redirectUrl = 'view_comments.php?article_id=' . $article_id1 . '&category_id=' . $category_id . '&community_id=' . $community_id;
                ?>
                            <li class="list <?php echo $colorClass; ?>">
                                <a href="<?php echo $redirectUrl; ?>"><?php echo $subtopicRow['ca_title']; ?></a>
                            </li>
                <?php
                            $i++;
                        }
                        echo '</ul>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
            <?php
            // SQL query to join the forum_topic and tb_users tables
            $subtopicsQuery = "SELECT *
                    FROM community_article AS ft
                    JOIN tb_users AS u ON ft.created_by = u.u_id
                    WHERE ft.cc_id = $category_id AND ft.article_id = $article_id";
            $subtopicsResult = $conn->query($subtopicsQuery);
            if ($subtopicsResult->num_rows > 0) {
                while ($subtopicRow = $subtopicsResult->fetch_assoc()) {
                    $nameWords = explode(" ", $subtopicRow['u_name']);
                    $initials = '';
                    foreach ($nameWords as $word) {
                        $initials .= substr($word, 0, 1);
                    }
            ?>
                    <div class="col-md-9">
                        <div class="container mb-md-5">
                            <div class="row">
                                <div class="col-12 col-md-1">
                                    <div class="avatar">
                                        <div class="rounded-circle bg-white text-primary text-center avatar-placeholder avatar-sm">
                                            <span class="initials"><?php echo strtoupper($initials); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 col-md-2 py-1">
                                    <div class="d-flex flex-column justify-content-center align-items-center align-items-md-start">
                                        <div class="username"><?php echo $subtopicRow['u_name']; ?></div>
                                        <div class="date"><?php echo date('F d, Y', strtotime($subtopicRow['created_at'])); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-5">
                                <div class="col">
                                    <?php echo $subtopicRow['ca_content']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col py-3 d-flex justify-content-between">
                                    <div>
                                        <button class="like-button border-0 bg-white" style="color:rgb(49, 215, 185)" onclick="likeForumArticle('<?= $article_id ?>','like')"><i class="fa fa-thumbs-up"></i> <span id="a_likes"><?php echo $subtopicRow['likes']; ?></span></button>
                                        <button class="dislike-button border-0 bg-white" style="color:rgb(236, 44, 72)" onclick="likeForumArticle('<?= $article_id ?>','dislike')"><i class="fa fa-thumbs-down"></i> <span id="a_dislikes"><?php echo $subtopicRow['dislikes']; ?></span></button>
                                        <button href="#" class="add-comment border-0 px-md-3 py-md-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#addcomment<?= $subtopicRow['article_id'] ?>">
                                            <i class="fa fa-comments px-2"></i>Add Response
                                        </button>
                                    </div>
                                    <div>
                                        <?php
                                        // SQL query to count the number of comments for the given subforumtopic_id
                                        $commentCountQuery = "SELECT COUNT(*) AS comment_count FROM communityarticlecomment WHERE article_id = $article_id And approved='1'";
                                        $commentCountResult = $conn->query($commentCountQuery);
                                        $commentCountRow = $commentCountResult->fetch_assoc();
                                        $commentCount = $commentCountRow['comment_count'];
                                        ?>
                                        <p class="text-secondary" style="padding-top: 10px;"><?php echo $commentCount; ?> comments</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <!-- Comment Modal -->
                        <div class="modal fade" id="addcomment<?= $subtopicRow['article_id'] ?>" tabindex="-1" aria-labelledby="editCommentModalLabel<?= $commentRow['comment_id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addcomment<?= $subtopicRow['article_id'] ?>">Add Comment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="insert.php?category_id=<?= $category_id ?>&article_id=<?= $article_id ?>" method="POST">
                                            <div class="mb-3">
                                                <label for="commentContent" class="form-label">Comment:</label>
                                                <textarea class="form-control" name="content" id="commentContent" placeholder="Write a comment"></textarea>
                                                <input type="hidden" name="forumtopic_id" value="<?php echo $article_id; ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End of Comment Modal -->
                <?php
                }
            }
                ?>
                <!-- Comment box with like and dislike buttons -->
                <?php
                //getting current_user_id 
                $current_user_id = $_SESSION['u_id'];
                // SQL query to retrieve comments for the given subforumtopic_id
                $commentsQuery = "SELECT * FROM `communityarticlecomment`  JOIN tb_users ON communityarticlecomment.created_by = tb_users.u_id
                        WHERE communityarticlecomment.article_id = $article_id AND (approved = '1' or created_by=$current_user_id)";
                // exit;
                $commentsResult = $conn->query($commentsQuery);
                if ($commentsResult->num_rows > 0) {
                    while ($commentRow = $commentsResult->fetch_assoc()) {
                        $nameWords = explode(" ", $commentRow['u_name']);
                        $initials = '';
                        foreach ($nameWords as $word) {
                            $initials .= substr($word, 0, 1);
                        }
                ?>
                        <div class="container bg-light mb-4">
                            <div class="comment-container">
                                <div class="row">
                                    <div class="col-2 col-md-1">
                                        <div class="avatar">
                                            <div class="rounded-circle bg-white text-primary text-center avatar-placeholder avatar-sm">
                                                <span class="initials"><?php echo strtoupper($initials); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 col-md py-1">
                                        <div class="d-flex flex-column justify-content-center align-items-center align-items-md-start">
                                            <div class="username"><?php echo $commentRow['u_name']; ?></div>
                                            <div class="date"><?php echo date('F d, Y', strtotime($commentRow['created_at'])); ?></div>
                                        </div>
                                    </div>
                                    <div class="col offset-md-8" id="<?= $commentRow['comment_id'] ?>">
                                        <div class="col dropdown">
                                            <button class="like-button border-0 bg-light" style="color:rgb(49, 215, 185)" onclick="likeForumComment(<?= $commentRow['comment_id'] ?>,'like',this)"><i class="fa fa-thumbs-up"></i><?= $commentRow['likes'] ?></button>
                                            <button class="dislike-button border-0 bg-light" style="color:rgb(236, 44, 72)" onclick="likeForumComment(<?= $commentRow['comment_id'] ?>,'dislike',this)"><i class="fa fa-thumbs-down"></i><?= $commentRow['dislikes'] ?></button>
                                            <?php
                                            if ($commentRow['created_by'] == $current_user_id) {
                                                // Display update and delete buttons for comments created by the current user
                                            ?>
                                                <button class="btn btn-link" type="button" id="optionsDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-center" aria-labelledby="optionsDropdown" style="border: none;">
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editCommentModal<?= $commentRow['comment_id'] ?>"><span class="rounded-circle bg-white"><i class="bi bi-pencil-fill text-warning"></i></span></a>
                                                    <a class="dropdown-item" href="deleteComment.php?comment_id=<?= $commentRow['comment_id'] ?>&article_id=<?php echo $article_id ?>&category_id=<?php echo $category_id ?>&community_id=<?php echo $community_id ?>" onclick="return confirmDelete()"><i class="bi bi-trash-fill text-danger"></i></a>
                                                </div>
                                            <?php
                                            }
                                            ?>
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
                                                <form action="editComment.php?comment_id=<?= $commentRow['comment_id'] ?>&article_id=<?php echo $article_id ?>&category_id=<?php echo $category_id ?>&community_id=<?php echo $community_id ?>" method="POST">
                                                    <input type="hidden" name="comment_id" value="<?= $commentRow['comment_id'] ?>">
                                                    <div class="mb-3">
                                                        <label for="commentContent" class="form-label">Comment:</label>
                                                        <textarea class="form-control" name="content" id="commentContent" rows="3"><?= $commentRow['comment_content'] ?></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row py-5">
                                    <div class="col">
                                        <?php echo $commentRow['comment_content']; ?>
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
                <!--END of Comment box with like and dislike buttons -->
                    </div>
        </div>
    </div>
    </div>
</main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
<script src="../../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
<script src="../../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/vendor/aos-portfolio/aos.js"></script>
<!-- <script src="../../assets/js/main.js"></script> -->
<script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<!-- Jquery JS-->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script>
    function bookmarkPage() {
        // Check if the browser supports the `window.sidebar` object (for Firefox)
        if (window.sidebar && window.sidebar.addPanel) {
            window.sidebar.addPanel(document.title, window.location.href, '');
        }
        // Check if the browser supports the `window.external` object (for Internet Explorer)
        else if (window.external && ('AddFavorite' in window.external)) {
            window.external.AddFavorite(window.location.href, document.title);
        }
        // Check if the browser supports the `window.opera` object (for Opera)
        else if (window.opera && window.print) {
            var elem = document.createElement('a');
            elem.setAttribute('href', window.location.href);
            elem.setAttribute('title', document.title);
            elem.setAttribute('rel', 'sidebar');
            elem.click();
        }
        // For other browsers, display a message instructing the user how to bookmark manually
        else {
            alert("To bookmark this page, press Ctrl/Cmd + D.");
        }
    }
</script>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete?");
    }
</script>
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