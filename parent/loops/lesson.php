<?php include("../commonPHP/head.php"); ?>
<?php include("../commonPHP/topNavBarCheck.php");
// Get the user ID of the logged-in user (you need to implement this based on your authentication mechanism)
$userID = $_SESSION['u_id'];
$isPremiumUser = false;
// Retrieve the user's subscription end date from the database
$query = "SELECT s_end_date FROM subscription WHERE subscriber_id = $userID";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error executing query: " . mysqli_error($conn);
    // Handle the error appropriately
} else {
    while ($user = mysqli_fetch_assoc($result)) {
        $subscriptionEndDate = $user['s_end_date'];
        // Compare the subscription end date with the current date
        $currentDate = date('Y-m-d');
        $isPremiumUser = ($subscriptionEndDate >= $currentDate);
    }
}
?>
<link rel="stylesheet" href="../../assets/css/parent.css">
<body class="imagebackground">
<main>
    <div class="container">
        <a href="view-loops.php" class="btn btn-warning col-lg-2 my-5">Go  Back</a>
        <h1>LESSONS</h1>
        <br>
        <?php


        $mb_id = $_GET['mb_id']; // Get the mb_id from the URL parameter
        $level = $_GET['grade']; // Get the level from the URL parameter


        // Define the number of lessons to display per page and the current page number
        $lessonsPerPage = 8;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        // Calculate the offset for the SQL query based on the current page and lessons per page
        $offset = ($currentPage - 1) * $lessonsPerPage;
        // Fetch the lessons based on mb_id, level, and pagination
        $query = "SELECT * FROM `tb_lessons` WHERE `l_mb_id` = $mb_id AND `l_level` = $level LIMIT $offset, $lessonsPerPage";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
        ?>
            <div class="row">
                <?php
                $lessonCount = 0; // Variable to keep track of the number of lessons displayed
                $lessonCount = ($currentPage - 1) * $lessonsPerPage; // Calculate the starting lesson count for the current page
                while ($row = mysqli_fetch_assoc($result)) {
                    // Retrieve lesson data
                    $l_id = $row['l_id'];
                    $l_image = $row['l_image'];
                    $l_name = $row['l_name'];
                    $lessonPlan = $row['l_lesson_plan'];
                    $lessonDesc = $row['l_lesson_desc'];
                    $worksheet = $row['l_worksheet'];
                    $exercise = $row['l_exercise'];
                    $supplementaryNote = $row['l_supplementary_note'];
                    $quiz = $row['l_quiz'];
                    $createdDate = $row['l_created_date'];
                    $releasedDate = $row['l_released_date'];
                    // Check if image is available, otherwise use a thumbnail image
                    $imagePath = '../' . ($l_image ? $l_image : '../assets/mindbooster/math.jfif');
                    // Check if the lesson should be blurred for non-premium users
                    $isBlurred = !$isPremiumUser && ($lessonCount >= 3 || $currentPage > 1); // Blurs lessons starting from the fourth lesson on the first page, and all lessons on subsequent pages

                    // Increment the lesson count
                    $lessonCount++;
                ?>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card shadow rounded-lg">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center <?php echo ($isBlurred && !$isPremiumUser) ? 'blurred' : ''; ?>" style="background-color: #F5F5F5;">
                                <div style="height: 200px; display: flex; align-items: center; justify-content: center; position: relative;">
                                    <?php if ($isBlurred) { ?>
                                        <!-- Blurred image for non-premium users -->
                                        <img src="<?php echo $imagePath; ?>" alt="Lesson Image" style="max-height: 100%; max-width: 100%; object-fit: contain; filter: blur(5px);">
                                        <?php if (!$isPremiumUser) { ?>
                                            <!-- Button code for non-premium users -->
                                            <button type="button" class="btn text-white btn-sm center-button premium-button" data-toggle="modal" data-target="#premiumModal" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #E91E63;">Premium 🔒</button>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <!-- Non-blurred image for premium users or non-blurred images -->
                                        <img src="<?php echo $imagePath; ?>" alt="Lesson Image" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                    <?php } ?>
                                </div>
                                <?php if ($isBlurred) { ?>
                                    <a href="#" class="text-center btn btn-warning btn-sm mt-3">
                                        <span class="text-black font-weight-bold" data-toggle="modal" data-target="#globalModal" style="font-size: 18px; filter: blur(5px);"><?php echo $l_name; ?></span>
                                    </a>
                                <?php } else { ?>
                                    <a href="lesson_view.php?l_id=<?php echo $l_id; ?>&mb_id=<?php echo $mb_id; ?>&grade=<?php echo $level; ?>" class="text-center btn btn-warning btn-sm mt-3">
                                        <span class="text-black font-weight-bold" style="font-size: 18px; "><?php echo $l_name; ?></span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php
            // Calculate the total number of lessons
            $totalLessonsQuery = "SELECT COUNT(*) AS total FROM `tb_lessons` WHERE `l_mb_id` = $mb_id AND `l_level` = $level";
            $totalLessonsResult = mysqli_query($conn, $totalLessonsQuery);
            $totalLessons = mysqli_fetch_assoc($totalLessonsResult)['total'];
            // Calculate the total number of pages
            $totalPages = ceil($totalLessons / $lessonsPerPage);
            // Display pagination links
            ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-5">
                    <?php
                    for ($i = 1; $i <= $totalPages; $i++) {
                        $isActive = $i == $currentPage ? ' active' : '';
                    ?>
                        <li class="page-item<?php echo $isActive; ?>">
                            <a class="page-link" href="?mb_id=<?php echo $mb_id; ?>&grade=<?php echo $level; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        <?php } else { ?>
            <div class="container p-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <p class="card-text text-danger text-center font-weight-bold">No lessons found for the selected level.</p>
                            </div>
                            <div class="card-footer text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
        // Close the database connection
          
        ?>
    </div>
    <div class="modal fade" id="globalModal" tabindex="-1" role="dialog" aria-labelledby="globalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="globalModalLabel">Premium Content</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                    <!-- <span aria-hidden="true">&times;</span>
        </button> -->
                </div>
                <div class="modal-body">
                    <p>Premium content requires payment to access.</p>
                    <p>Failure to pay will result in the data being hidden from view.</p>
                    <p>Users will not be able to view the full range of content without payment.</p>
                    <p>Valuable information or entertainment may be missed out on if payment is not made.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Pay</button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include("../../premium_modal.php"); ?>
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>