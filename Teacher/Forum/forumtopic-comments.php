<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
?>
<?php

if (!session_id()) {
    session_start();

    if ($_SESSION["userType"] != '2') {
        header('location: ../../login_and_register/login.php');
    }
}
if (!isset($_GET['forumtopic_id'])) {
    header('Location: forum-category.php');
}
include '../../dbconnect.php';
extract($_GET);
// echo $forum_id;
// exit;
$forum_name = '';
$ft_description = '';
$sql = "SELECT * from forum_topic where forumtopic_id='$forumtopic_id'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $forum_name = ($row['ft_name']);
    $ft_description = $row['ft_description'];
}
// echo $forum_name;

?>
<link href="../../assets/css/teacher.css" rel="stylesheet">

<main id="main">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1><a href="#" class="text-danger"></a><a href="forum-category.php?forum_id=<?= $forum_id ?>" class="btn btn-warning btn-sm">Back</a></h1>
                    <h1><a href="#" class="text-danger"></a><a href="addtopiccomments.php?forumtopic_id=<?= $forumtopic_id ?>&forum_name=<?= $forum_name ?>" class="btn btn-warning btn-sm">Add Comment</a></h1>
                </div>
                <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="card-text text-black"><?= $forum_name ?></h4>
                                <p class="card-text text-black"><?= $ft_description ?></p>
                            </div>
                        </div>
                <div class="container-fluid">
                    <h3>Comments</h3>
                    <?php
                    $forumtopic_id = $_GET['forumtopic_id'];
                    include("../../commonPHP/dbconnect.php");
                    $communityQuery = "SELECT * FROM `forum_postcomment` WHERE subforumtopic_id='$forumtopic_id'";
                    $communityResult = mysqli_query($conn, $communityQuery);

                    // Check if there are any comments
                    if (mysqli_num_rows($communityResult) > 0) {
                        // Iterate through each comment
                        while ($communityRow = mysqli_fetch_assoc($communityResult)) {
                            $communityId = $communityRow['subforumtopic_id'];
                            $communityIdd = $communityRow['comment_id'];
                            $communityName = $communityRow['content'];
                            $created_at = new DateTime($communityRow['created_at']);
                    ?>
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-end">
                                    <a href="edittopiccomment.php?forumtopic_id=<?= $communityId ?>&comment_id=<?= $communityIdd ?>"><i class="bi bi-pencil-fill p-2" style="color: orange;"></i></a>
                                    <a href="deletetopiccomment.php?forumtopic_id=<?= $communityId ?>&comment_id=<?= $communityIdd ?>"><i class="bi bi-trash-fill" style="color: red;"></i></a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text text-black"><?= $communityName ?></p>
                                    <p class="card-text"><small class="text-muted">Posted on <?= $created_at->format('d M Y h:i A') ?></small></p>
                                    <div class="d-flex">
                                        <a href="#" class="like-comment" data-comment-id="<?= $communityIdd ?>"><i class="bi bi-hand-thumbs-up-fill p-2" style="color: green;"></i></a>
                                        <a href="#" class="dislike-comment" data-comment-id="<?= $communityIdd ?>"><i class="bi bi-hand-thumbs-down-fill p-2" style="color: red;"></i></a>
                                    </div>
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

                    mysqli_close($conn);
                    ?>
                </div>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>
    </div>
</main>
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
</body>
<script>
                    // Live Search functionality
                    const searchInput = document.getElementById('searchInput');
                    const communityTable = document.getElementById('communityTable');
                    searchInput.addEventListener('keyup', (event) => {
                        const searchText = event.target.value.toLowerCase();
                        const rows = communityTable.getElementsByTagName('tr');
                        for (let row of rows) {
                            const communityName = row.getElementsByTagName('td')[1].textContent.toLowerCase();
                            const communityDescription = row.getElementsByTagName('td')[2].textContent.toLowerCase();
                            if (communityName.includes(searchText) || communityDescription.includes(searchText)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        }
                    });
                </script>

</html>