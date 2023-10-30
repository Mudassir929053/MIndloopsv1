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
include ("../../dbconnect.php");

?>

<link rel="stylesheet" href="../../assets/css/style.css">
<link href="../../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">




<style>
    body {
        background-image: url('../../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 110%;
        background-position: top center;
    }

    .container-fluid img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .forum-item {
        background-color: #f8f8f8;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 4px;
        /* text-align: center; */
        transition: background-color 0.3s ease;
    }

    .forum-item:hover {
        background-color: #f0f0f0;
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
        /* Adjust the hover color to your preference */
    }

    .fa-newspaper-o {
        background-color: #ff6f00;
        color: #fff;
        padding: 5px;
        border-radius: 50%;
        margin-right: 10px;
    }
</style>
<main id="main">
    <div class="container">
        <br>
        <h2 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Kidz Creative Corner</h2>
        <br>
        <a href="viewforum.php" class="btn btn-warning btn-sm "><i class="bi bi-arrow-left"></i>Back</a>
        <br>
        <br>
        <?php
        $rows_per_page = 4;
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        
        $offset = ($current_page - 1) * $rows_per_page;
        

        // Retrieve the forum ID from the URL parameter
        $forumId = $_GET['forum_id'];

        // SQL query to retrieve forum details by ID
        $forumQuery = "SELECT * FROM `kidzcreativecorner` WHERE `topic_id` = $forumId";
        $forumResult = $conn->query($forumQuery);

        // Fetch the forum details
        $forumRow = $forumResult->fetch_assoc();

        if ($forumResult->num_rows > 0) {
            // Display the forum details with clickable forum name
            echo '<div class="forum-item">';
            echo '<h5><i class="fa fa-newspaper-o"></i>' . $forumRow['topic_name'] . '</h5>';
            echo '<p>' . $forumRow['description'] . '</p>';
            echo '</div>';
            // SQL query to retrieve subtopics related to the forum
            $subtopicsQuery = "SELECT * FROM `kidzpost` WHERE `topic_id` = $forumId LIMIT $rows_per_page OFFSET $offset";
            $subtopicsResult = $conn->query($subtopicsQuery);
            echo '<h4 style="text-align: center; font-size: 36px; color: #ff6f00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Articles</h4>';
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
                        echo '<img class="mb-4" src="../' . $subtopicRow['attachment'] . '" alt="Thumbnail" class="thumbnail">';
                        echo '<h5><i class="fa fa-newspaper-o"></i><a href="forum_topics.php?forum_id=' . $forumId . '&forumtopic_id=' . $subtopicRow['kidzpost_id'] . '">' . $subtopicRow['title'] . '</a></h5>';
                        echo '<p><strong>' . date('d F Y', strtotime($subtopicRow['created_at'])) . '</strong></p>';
                        echo '</div>';
                        echo '</div>';
                        $count++;
                    }
                } else {
                    echo '<div class="col-md-12">No subtopics found.</div>';
                }
                $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `kidzpost` WHERE `topic_id` = $forumId "));
$total_pages = ceil($total_rows / $rows_per_page);

if ($total_pages > 1) {
    echo '<nav aria-label="Page navigation">';
    echo '<ul class="pagination justify-content-center py-3">';

    if ($current_page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?forum_id=' . $forumId . '&page=' . ($current_page - 1) . '">Previous</a></li>';
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        echo '<li class="page-item' . ($i == $current_page ? ' active' : '') . '"><a class="page-link" href="?forum_id=' . $forumId . '&page=' . $i . '">' . $i . '</a></li>';
    }

    if ($current_page < $total_pages) {
        echo '<li class="page-item"><a class="page-link" href="?forum_id=' . $forumId . '&page=' . ($current_page + 1) . '">Next</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
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