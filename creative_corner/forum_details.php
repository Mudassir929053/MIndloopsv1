<?php include("../commonPHP/head.php"); ?>

<?php

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '3') {
    echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
include ("../dbconnect.php");

?>

<link rel="stylesheet" href="../../assets/css/style.css">
<link href="../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


<?php include("../commonPHP/topNavBarCheck.php"); ?>

<!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
<link rel="stylesheet" href="../assets/css/student.css">
<main id="main">
    <div class="container">
        <br>
        <h2 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Creative Corner</h2>
        <br>
        <a href="viewforum.php" class="btn btn-warning btn-sm "><i class="bi bi-arrow-left"></i>Back</a>
        <br>
        <br>
        <?php

        // Retrieve the forum ID from the URL parameter
        $forumId = $_GET['forum_id'];

        // SQL query to retrieve forum details by ID
        $forumQuery = "SELECT * FROM `kidzcreativecorner` WHERE `topic_id` = $forumId";
        $forumResult = $conn->query($forumQuery);
       $user_name = $_SESSION['u_id'];

        // Fetch the forum details
        $forumRow = $forumResult->fetch_assoc();

        if ($forumResult->num_rows > 0) {
            // Display the forum details with clickable forum name
            echo '<div class="forum-item">';
            echo '<h5><i class="fa fa-newspaper-o"></i>' . $forumRow['topic_name'] . '</h5>';
            echo '<p>' . $forumRow['description'] . '</p>';
            echo '</div>';
            // SQL query to retrieve subtopics related to the forum
            $subtopicsQuery = "SELECT k.`kidzpost_id`, k.`topic_id`, k.`title`, k.`content`, k.`created_by`, k.`created_at`, k.`updated_at_at`, k.`published`, k.`attachment`, k.`likes`, k.`dislikes`, k.`liked_by`, k.`disliked_by`, u.`u_name`
            FROM `kidzpost` k
            JOIN `tb_users` u ON k.`created_by` = u.`u_id`
            WHERE k.`topic_id` = $forumId AND (k.`published` = 1 OR k.`created_by` = ".$_SESSION['u_id'].")
            ";
            $subtopicsResult = $conn->query($subtopicsQuery);
            echo '<h4 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Articles</h4>';
            echo '<a href="addArticle.php?topic_id='. $forumId .'&ca_name=' . $forumRow['topic_name'] . '" class="btn btn-warning btn-sm  mx-2"><i class="bi bi-plus-circle"></i> Add Article</a>';
            echo '<br>';
            echo '<br>'; ?>
            <div class="row">
                <?php
                $count = 0;
                if ($subtopicsResult->num_rows > 0) {
                    while ($subtopicRow = $subtopicsResult->fetch_assoc()) {
                        if ($count % 4 == 0) {
                            echo '</div><div class="row">';
                        }
                        echo '<div class="col-md-3 col-sm-6 col-12 mb-4">';
                        echo '<div class="container-fluid shadow p-3 h-100 d-flex flex-column rounded border" onclick="redirectToPage(' . $forumId . ', ' . $subtopicRow['kidzpost_id'] . ')">';
                        echo '<img class="mb-4 thumbnail" src="' . $subtopicRow['attachment'] . '" alt="Thumbnail" class="thumbnail">';
                        echo '<h5><i class="fa fa-newspaper-o"></i><a href="forum_topics.php?forum_id=' . $forumId . '&forumtopic_id=' . $subtopicRow['kidzpost_id'] . '">' . $subtopicRow['title'] . '</a></h5>';
                        echo '<div class="d-flex justify-content-between">';
                        echo '<p><i class="bi bi-person p-1" style="font-size: 22px;"></i><strong>' . $subtopicRow['u_name'] . '</strong></p>';
                        echo '<p class="text-end"><strong>' . date('d F Y', strtotime($subtopicRow['created_at'])) . '</strong></p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                          $count++;
                    }
                } else {
                    echo '<div class="col-md-12">No subtopics found.</div>';
                }
                ?>
            </div>

            <script>
                function redirectToPage(forumId, forumtopicId) {
                    window.location.href = 'forum_topics.php?forum_id=' + forumId + '&forumtopic_id=' + forumtopicId;
                }
            </script>


    </div>
<?php
        } else {
            echo "<p>No forum found</p>";
        }

        // Close the database connection
        $conn->close();
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