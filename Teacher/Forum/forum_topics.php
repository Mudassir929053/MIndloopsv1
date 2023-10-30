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
// Retrieve the forum ID from the URL parameter
$forumId = $_GET['forum_id'];
$forumtopic_id = $_GET['forumtopic_id'];
$current_user_id = $_SESSION['u_id'];
?>

<head>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

</head>

<link href="../../assets/css/teacher_forum.css" rel="stylesheet">

<main id="main">
    <div class="container-fluid">
        <?php
        // SQL query to retrieve subtopics related to the forum
        $subtopic = "SELECT * FROM `forum_topic` WHERE `forum_id` = $forumId and `forumtopic_id` = $forumtopic_id";
        $subtopicResult = $conn->query($subtopic);
        if ($subtopicResult->num_rows > 0) {
            while ($subtopicRow1 = $subtopicResult->fetch_assoc()) {
        ?>
                <div class="row p-md-5">
                    <div class="col-md-4 offset-md-3 display-5 px-md-5">
                        <?php echo $subtopicRow1['ft_name']; ?>
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
                                    <a class="dropdown-item" href="editarticle.php?forum_id=<?php echo $forumId; ?>&forumtopic_id=<?php echo $forumtopic_id; ?>"><span class="rounded-circle bg-white"><i class="bi bi-pencil-fill text-warning"></i></span></a>
                                    <a class="dropdown-item" href="deletetopic.php?forum_id=<?php echo $forumId; ?>&forumtopic_id=<?php echo $forumtopic_id; ?>" onclick="return confirmDelete()"><i class="bi bi-trash-fill text-danger"></i></a>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
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
        <?php }
        } ?>
    </div>
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-md-3">
                <?php
                // SQL query to retrieve forum details by ID
                $forumQuery = "SELECT * FROM `forum` WHERE `forum_id` = $forumId";
                $forumResult = $conn->query($forumQuery);
                // Fetch the forum details
                $forumRow = $forumResult->fetch_assoc();
                if ($forumResult->num_rows > 0) {
                    // Display the forum details with clickable forum name
                    echo '<div class="fs-4">Other related sub-topics in "' . $forumRow['forum_name'] . '"</div>';
                    // SQL query to retrieve subtopics related to the forum
                    $subtopicsQuery = "SELECT * FROM `forum_topic` WHERE `forum_id` = $forumId";
                    $subtopicsResult = $conn->query($subtopicsQuery);

                    if ($subtopicsResult->num_rows > 0) {
                        echo '<div class="forum-item">';
                        echo '<div class="subtopics-header d-md-none" onclick="toggleSubtopics()">Toggle Subtopics</div>';
                        echo '<ul class="subtopics-list">';
                        $colors = array('bullet-red', 'bullet-yellow', 'bullet-lightblue', 'bullet-orange');
                        $i = 0;
                        while ($subtopicRow = $subtopicsResult->fetch_assoc()) {
                            $colorClass = $colors[$i % count($colors)];
                            $forumtopic_id1 = $subtopicRow['forumtopic_id'];
                            //    echo $forumId;
                            $redirectUrl = 'forum_topics.php?forumtopic_id=' . $forumtopic_id1 . '&forum_id=' . $forumId;
                ?>
                            <li class="list <?php echo $colorClass; ?>">
                                <a href="<?php echo $redirectUrl; ?>"><?php echo $subtopicRow['ft_name']; ?></a>
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

            <!-- Add JavaScript to toggle subtopics list on mobile view -->
            <script>
                const subtopicsList = document.querySelector('.subtopics-list');
                const subtopicsHeader = document.querySelector('.subtopics-header');

                function toggleSubtopics() {
                    if (subtopicsList.style.display === 'none') {
                        subtopicsList.style.display = 'block';
                    } else {
                        subtopicsList.style.display = 'none';
                    }
                }
            </script>

            <?php
            // SQL query to join the forum_topic and tb_users tables
            $subtopicsQuery = "SELECT ft.forumtopic_id, ft.forum_id, ft.ft_name, ft.ft_description, ft.created_by, ft.ft_created_at, ft.published, ft.ft_image, ft.article_thumbnail, ft.likes, ft.dislikes, ft.liked_by, ft.disliked_by, u.u_name
                    FROM forum_topic AS ft
                    JOIN tb_users AS u ON ft.created_by = u.u_id
                    WHERE ft.forum_id = $forumId AND ft.forumtopic_id = $forumtopic_id";

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
                                        <div class="date"><?php echo date('F d, Y', strtotime($subtopicRow['ft_created_at'])); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-5">
                                <div class="col bordered" id="summernote">
                                    <?php echo $subtopicRow['ft_description']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col py-3 d-flex justify-content-between">
                                    <div>
                                        <button class="like-button border-0 bg-white" style="color:rgb(49, 215, 185)" onclick="likeForumArticle('<?= $forumtopic_id ?>','like')"><i class="fa fa-thumbs-up"></i> <span id="a_likes"><?php echo $subtopicRow['likes']; ?></span></button>
                                        <button class="dislike-button border-0 bg-white" style="color:rgb(236, 44, 72)" onclick="likeForumArticle('<?= $forumtopic_id ?>','dislike')"><i class="fa fa-thumbs-down"></i> <span id="a_dislikes"><?php echo $subtopicRow['dislikes']; ?></span></button>
                                        <button href="#" class="add-comment border-0 px-md-3 py-md-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#addcomment<?= $subtopicRow['forum_id'] ?>">
                                            <i class="fa fa-comments px-2"></i>Add Response
                                        </button>
                                    </div>
                                    <div>
                                        <?php
                                        // SQL query to count the number of comments for the given subforumtopic_id
                                        $commentCountQuery = "SELECT COUNT(*) AS comment_count FROM forum_postcomment WHERE subforumtopic_id = $forumtopic_id And (approved='1' OR created_by= $current_user_id) ";
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
                        <div class="modal fade" id="addcomment<?= $subtopicRow['forum_id'] ?>" tabindex="-1" aria-labelledby="editCommentModalLabel<?= $commentRow['comment_id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addcomment<?= $subtopicRow['forum_id'] ?>">Add Comment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="function.php?forum_id=<?= $forumId ?>&forumtopic_id=<?= $forumtopic_id ?>" method="POST">
                                            <div class="mb-3">
                                                <label for="commentContent" class="form-label">Comment:</label>
                                                <textarea class="form-control" name="content" id="commentContent" placeholder="Write a comment"></textarea>
                                                <input type="hidden" name="forumtopic_id" value="<?php echo $forumtopic_id; ?>">
                                                <input type="hidden" name="forum_id" value="<?= $subtopicRow['forum_id'] ?>">
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
                $commentsQuery = "SELECT fc.comment_id, fc.content, fc.created_at, tu.u_name, likes, dislikes, created_by
                  FROM forum_postcomment AS fc
                  JOIN tb_users AS tu ON fc.created_by = tu.u_id
                  WHERE fc.subforumtopic_id = $forumtopic_id AND (fc.approved = 1 OR fc.created_by=$current_user_id)
                  ORDER BY fc.created_at DESC";
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
                                    <div class="col-12 col-md-2 offset-md-7 py-1">
                                        <div class="dropdown d-flex justify-content-end">
                                            <button class="like-button border-0 bg-light" style="color:rgb(49, 215, 185)" onclick="likeForumComment(<?= $commentRow['comment_id'] ?>,'like',this)"><i class="fa fa-thumbs-up"></i><?= $commentRow['likes'] ?></button>
                                            <button class="dislike-button border-0 bg-light" style="color:rgb(236, 44, 72)" onclick="likeForumComment(<?= $commentRow['comment_id'] ?>,'dislike',this)"><i class="fa fa-thumbs-down"></i><?= $commentRow['dislikes'] ?></button>
                                            <?php
                                            if ($commentRow['created_by'] == $current_user_id) {
                                                // Display update and delete buttons for comments created by the current user
                                            ?>
                                                <button class="btn btn-link" type="button" id="optionsDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown" style="border: none;">
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editCommentModal<?= $commentRow['comment_id'] ?>"><span class="rounded-circle bg-white"><i class="bi bi-pencil-fill text-warning"></i></span></a>
                                                    <a class="dropdown-item" href="deleteComment.php?comment_id=<?= $commentRow['comment_id'] ?>&forum_id=<?php echo $forumId ?>&forumtopic_id=<?php echo $forumtopic_id ?>" onclick="return confirmDelete()"><i class="bi bi-trash-fill text-danger"></i></a>
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
                                <div class="row py-5">
                                    <div class="col">
                                        <?php echo $commentRow['content']; ?>
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
<!-- <script src="../../assets/js/main.js"></script> -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  

</body>

</html>