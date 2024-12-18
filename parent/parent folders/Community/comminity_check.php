<?php include("../commonPHP/head.php"); ?>

<?php

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '2' && $_SESSION["userType"] != '3' && $_SESSION["userType"] != '4') {
    echo "<script> window.location.replace('../../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
 

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

<link rel="stylesheet" href="../../assets/css/style.css">
</link>
<link href="../../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


<?php include("../commonPHP/topNavBarCheck.php"); ?>

<style>
    body {
        background-image: url('../../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 110%;
        background-position: top center;
        background-repeat: no-repeat;
    }
</style>
<style>
    .mindbooster-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    /* .premium {
        filter: blur(5px);
        opacity: 0.6;
    }
    .no-blur {
        backdrop-filter: none;
    } */
    .blur-container {
        position: relative;
    }

    .blur-container:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /*backdrop-filter: blur(4px); /* Adjust the blur value as needed */
    }

    .blur-img1,
    .blur-text {
        filter: blur(5px);
        /* Adjust the blur value as needed */
    }

    .center-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
    }

    .no-click {
        pointer-events: none;
        cursor: default;
        text-decoration: none;
        color: inherit;
    }
</style>

<main id="main">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12 py-5" style="background-image: url('../../assets/videos/img/video_banner.png'); background-size:100%;">
                <div class="col-md-10">
                    <div class="text-right">
                        <h1 style="padding-left: 18%; padding-top: 10%; font-size: 7vw;" class="display-1">VIDEOS</h1>
                        <img src="../../assets/videos/img/video_thumbnail.png" style=" position: sticky; left:50%;margin-top:-14%;border-radius: 6%;max-height:38%;max-width: 40%;" alt="Video_thumbnail">
                        <!-- <p style="font-size: 2vw;">Do more learn more</p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="container py-5">

            <div class="row">
                <?php

                $checkuserrow = $conn->query("SELECT u_name FROM tb_users WHERE u_type = '{$_SESSION["userType"]}'");
                $rowReadUser = $checkuserrow->fetch_object();
                $get_userID = $rowReadUser->u_name;

                // Fetch categories from the database
                $query = "SELECT DISTINCT v_type FROM tb_videos WHERE v_audience = '$get_userID' order by v_type";
                $result = mysqli_query($conn, $query);

                // Check if the query was successful
                if ($result) {
                    $categories = array();

                    // Fetch the category names and store them in the array
                    while ($row = mysqli_fetch_assoc($result)) {
                        $categories[] = $row['v_type'];
                    }

                    // Free the result set
                    mysqli_free_result($result);
                } else {
                    // Handle the query error
                    echo "Error executing query: " . mysqli_error($conn);
                }

                $cat_pos = 0;
                if (isset($_GET['category'])) {
                    $cat_pos = array_search($_GET['category'], $categories);
                }
                ?>

                <div class="col-lg-12">
                    <div class="d-flex justify-content-center pt-5">
                        <div class="container py-5">
                            <ul class="nav nav-tabs fs-4 justify-content-center">
                                <?php
                                // Define the category full names
                                // $categoryFullNames = array(
                                //     'BM' => 'Bahasa Melayu',
                                //     'EN' => 'English',
                                //     'GK' => 'General Knowledge',
                                //     'IS' => 'Islamic Knowledge',
                                //     'MT' => 'Math',
                                //     'SC' => 'Science'
                                // );

                                foreach ($categories as $key => $category) {
                                    echo '<li class="nav-item">';
                                    echo '<a class="nav-link text-uppercase fw-bolder' . ($key == $cat_pos ? ' active' : '') . '" data-bs-toggle="tab" href="#' .  preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $category)) . '">' . htmlspecialchars($category) . '</a>';
                                    echo '</li>';
                                }

                                ?>
                            </ul>

                            <div class="tab-content pt-3">
                                <div class="container py-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" id="search-input" class="form-control" placeholder="Search...">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                foreach ($categories as $key => $category) {
                                    $limit = 6; // number of items per page
                                    $pageParam = "page_" . $key;
                                    $page = isset($_GET[$pageParam]) ? (int)$_GET[$pageParam] : 1;
                                    $offset = ($page - 1) * $limit;
                                    $query = "SELECT * FROM `tb_videos` WHERE v_type = '$category' AND v_audience = '$get_userID'";
                                    $result = mysqli_query($conn, $query);
                                    if (!$result) {
                                        echo "Error executing query: " . mysqli_error($conn);
                                        continue;
                                    }
                                    $total_items = mysqli_num_rows($result);
                                    $total_pages = ceil($total_items / $limit);
                                    $query = "SELECT * FROM `tb_videos` WHERE v_type = '$category'  AND v_audience = '$get_userID' LIMIT $offset, $limit";
                                    $result = mysqli_query($conn, $query);
                                    if (!$result) {
                                        echo "Error executing query: " . mysqli_error($conn);
                                        continue;
                                    }
                                    $i = 0;
                                ?>
                                  <div id="<?php echo  preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $category)); ?>" class="tab-pane fade<?php echo $key == $cat_pos ? ' show active' : ''; ?>">
                                        <div class="row">
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                echo '<div class="row">';
                                                $itemCount = 0; // Counter for tracking the number of items
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $itemCount++;

                                                    if ($isPremiumUser) {
                                                        $isPremium = 'not-premium';
                                                        $isPremium1 = 'not-premium';
                                                    } else {
                                                        $isPremium = ($page == 1 && $itemCount <= 5) ? 'not-premium' : 'premium blur-text no-click '; // Check if item is premium or not
                                                        $isPremium1 = ($page == 1 && $itemCount <= 5) ? 'not-premium' : 'premium'; // Check if item is premium or not
                                                    }
                                                    if ($i % 3 == 0 && $i != 0) {
                                                        echo '</div><div class="row">';
                                                    }
                                                    // Display the item content here
                                                    echo '<div class="col-md-4 col-sm-6 col-12 mb-4 ">';
                                                    echo '<div class="container-fluid shadow p-3 rounded h-100 d-flex flex-column">';
                                                    echo '<video controls src="../' . $row['v_path'] . '" title="YouTube video" alt="" class="img-fluid mindbooster-img ' . $isPremium . '" allowfullscreen></video>';

                                                    //    echo '<img src="' . $row['v_file'] . '" alt="" class="img-fluid mindbooster-img ' . $isPremium . '">';
                                                    echo '<span class="text-danger ' . $isPremium . '"></span>';
                                                    echo '<h4 class="text-black ' . $isPremium . '">' . $row['v_title'] . '</h4>';
                                                    echo '<span class="text-secondary ' . $isPremium . '">' . date('j F Y', strtotime($row['v_rDate'])) . '</span>';
                                                    echo '<p class="text-black ' . $isPremium . '">' . $row['v_desc'] . '</p>';
                                                    echo '<div class="mt-auto">';
                                                    echo '<div class="row align-items-end">';
                                                    echo '<div class="col-md-1 text-start">';
                                                    echo '<a href="https://wa.me/?text=' . urlencode($row['v_title'] . ' - ' . $row['v_desc'] . ' - ' . 'https://192.168.0.108/view-videos.php?v_id=' . $row['v_id']) . '" class="text-end text-danger ' . $isPremium . ' d-block mt-3">';
                                                    echo '<img src="https://img.icons8.com/color/30/null/whatsapp--v1.png"/></a>';
                                                    echo '</div>';
                                                    echo '<div class="col-md-1">';
                                                    echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . urlencode('https://192.168.0.108/view-videos.php?v_id=' . $row['v_id']) . '" class="text-end text-danger ' . $isPremium . ' d-block mt-3">';
                                                    echo '<img src="https://img.icons8.com/fluency/30/null/facebook-new.png"/></a>';
                                                    echo '</div>';
                                                    echo '<div class="col-md-10">';
                                                    echo '<a href="view-videos.php?v_id=' . $row['v_id'] . '" class="text-end text-danger ' . $isPremium . ' d-block mt-3">';
                                                    echo 'Read more</a>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    // Display the "Buy Subscription" button for premium items only
                                                    if ($isPremium1 === 'premium') {
                                                        echo '<div class="blur-container">';
                                                        echo '<div class="blur-img">';
                                                        echo '<button type="button" class="btn text-white btn-sm center-button" style="margin-top: -70%; background-color: #E91E63" data-bs-toggle="modal" data-bs-target="#subscriptionModal">Premium 🔒</button>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                    echo '</div>';
                                                    echo '</div>';
                                                    $i++;
                                                }
                                                echo '</div>';
                                            } else {
                                                echo '<div class="col-md-12">No items found.</div>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        // Pagination
                                        if ($total_pages > 1) {
                                            $url = generateCategoryURL($category, $key); // Generate category-specific URL
                                            echo '<ul class="pagination justify-content-center">';
                                            for ($p = 1; $p <= $total_pages; $p++) {
                                                echo '<li class="page-item' . ($page == $p ? ' active' : '') . '">';
                                                echo '<a class="page-link" href="' . $url . '&' . $pageParam . '=' . $p . '">' . $p . '</a>';
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                        }
                                        ?>
                                    </div>
                                <?php
                                }
                                // Function to generate category-specific URL
                                function generateCategoryURL($categoryKey, $categoryIndex)
                                {
                                    $url_params = $_GET;
                                    foreach ($url_params as $param_key => $param_value) {
                                        if (strpos($param_key, "page_") === 0 || $param_key === "category") {
                                            unset($url_params[$param_key]); // Remove existing page and category parameters
                                        }
                                    }
                                    $url_params["category"] = $categoryKey;
                                    $url_params["page_" . $categoryIndex] = '';
                                    $url = $_SERVER['PHP_SELF'] . '?' . http_build_query($url_params);
                                    return $url;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <!-- Add your subscription details here -->
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ac mauris velit.</p>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    </div>

    </div>

    </div>
    </section>

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
<!-- <script src="../../assets/js/main.js"></script> -->
<script>
    $(document).ready(function() {
        $("#search-input").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            $(".tab-pane.show.active .col-md-4").filter(function() {
                var title = $(this).find(".text-black").text().toLowerCase();
                return title.indexOf(searchText) == -1;
            }).hide();
            $(".tab-pane.show.active .col-md-4").filter(function() {
                var title = $(this).find(".text-black").text().toLowerCase();
                return title.indexOf(searchText) != -1;
            }).show();
        });
    });
</script>
</body>

</html>