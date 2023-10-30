<?php include("../commonPHP/head.php"); ?>
<?php include '../../dbconnect.php'; ?>
<?php
if (!session_id()) {
    session_start();
}
// Get the user ID of the logged-in user (you need to implement this based on your authentication mechanism)
$userID = $_SESSION['u_id'];
$isPremiumUser = false;

// Retrieve the user's subscription end date from the database
$query = "SELECT s_end_date FROM subscription WHERE subscriber_id = $userID";
// exit;
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
<link rel="stylesheet" href="../../assets/css/teachSupport.css">
</link>
<link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-***" crossorigin="anonymous" />

<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script> -->
<!-- Vendor CSS-->

<link href="../../assets/css/teacher.css" rel="stylesheet">


<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
<?php include("../commonPHP/topNavBarCheck.php"); ?>
<main id="main">

    <div id="portfolio-details">
        <div class="container-fluid">
            <div class="row">
                <img src="../../assets/tips/tip_images/Tips Banner.png" alt="" style="padding:0;" width="100%">
                <!-- <div class="bg-primary" style="image: url('../assets/home_page/MB\ Banner.png'); height: 600px; background-size: cover;"> -->
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <?php
                $user_type = ["2" => "Teacher", "3" => "Student", "4" => "Parent"];
                $checkuserrow = $conn->query("SELECT u_name FROM tb_users WHERE u_type = '{$_SESSION["userType"]}'");
                $rowReadUser = $checkuserrow->fetch_object();
                // $get_userID = $rowReadUser->u_name;
                $get_userID = $user_type[$_SESSION['userType']];
                // Fetch categories from the database
                $query = "SELECT DISTINCT t_type FROM tb_tips WHERE t_audience = '$get_userID' order by t_type";
                $result = mysqli_query($conn, $query);
                // Check if the query was successful
                if ($result) {
                    $categories = array();
                    // Fetch the category names and store them in the array
                    while ($row = mysqli_fetch_assoc($result)) {
                        $categories[] = $row['t_type'];
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
                                    echo '<a class="nav-link text-uppercase fw-bolder' . ($key == $cat_pos ? ' active' : '') . '" data-bs-toggle="tab" href="#' .  preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $category)) . '">' . $category . '</a>';
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
                                    $query = "SELECT * FROM `tb_tips` WHERE t_type = '$category'";
                                    $result = mysqli_query($conn, $query);
                                    if (!$result) {
                                        echo "Error executing query: " . mysqli_error($conn);
                                        continue;
                                    }
                                    $total_items = mysqli_num_rows($result);
                                    $total_pages = ceil($total_items / $limit);
                                    // $query = "SELECT * FROM `tb_tips` WHERE t_type = '$category' LIMIT $offset, $limit DESC";
                                    $query = "SELECT * FROM `tb_tips` WHERE t_type = '$category' ORDER BY id DESC LIMIT $offset, $limit";
                                    $result = mysqli_query($conn, $query);
                                    if (!$result) {
                                        echo "Error executing query: " . mysqli_error($conn);
                                        continue;
                                    }
                                    $i = 0;
                                ?>
                                    <div id="<?php echo preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $category)); ?>" class="tab-pane fade<?php echo $key == $cat_pos ? ' show active' : ''; ?>">
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
                                                        $isPremium = ($page == 1 && $itemCount <= 3) ? 'not-premium' : 'premium blur-text no-click '; // Check if item is premium or not
                                                        $isPremium1 = ($page == 1 && $itemCount <= 3) ? 'not-premium' : 'premium'; // Check if item is premium or not
                                                    }
                                                    if ($i % 3 == 0 && $i != 0) {
                                                        
                                                    }
                                                    // Display the item content here
                                                    echo '<div class="col-lg-4 col-md-6 col-sm-12">';
                                                    echo '<div class="container-fluid shadow p-3 rounded h-100 d-flex flex-column">';
                                                    echo '<img src="../' . $row['t_filePath'] . '" alt="" class="img-fluid mindbooster-img ' . $isPremium . '">';
                                                    echo '<span class="text-danger ' . $isPremium . '"></span>';
                                                    echo '<h4 class="text-black ' . $isPremium . '">' . $row['t_title'] . '</h4>';
                                                    echo '<span class="text-secondary ' . $isPremium . '">' . date('j F Y', strtotime($row['t_rDate'])) . '</span>';
                                                    //    echo '<p class="text-black ' . $isPremium . '">' . $row['t_desc'] . '</p>';
                                                    //    $t_desc = $row['t_desc'];
                                                    //    if (strlen($t_desc) > 80) {
                                                    //        $t_desc = substr($t_desc, 0, 80) . "...";
                                                    //        echo '<p class="text-black ' . $isPremium . '">' . $t_desc . ' <a href="tip-details.php?t_id='.$row['t_id'].'" class="text-danger">(description)</a></p>';
                                                    //    } else {
                                                    //        echo '<p class="text-black ' . $isPremium . '">' . $t_desc . '</p>';
                                                    //    }
                                                    echo '<div class="my-4">';
                                                    echo '<div class="row align-items-end">';
                                                    echo '<div class="col-md-1">';
                                                    echo '<a href="https://wa.me/?text=' . urlencode($row['t_title'] . ' - ' . $row['t_desc'] . ' - ' . 'https://192.168.0.108/tips/tip-details.php?t_id=' . $row['t_id']) . '" class="text-danger ' . $isPremium . ' mt-3">';
                                                    echo '<img src="https://img.icons8.com/color/30/null/whatsapp--v1.png"/></a>';
                                                    echo '</div>';
                                                    echo '<div class="col-md-1">';
                                                    echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . urlencode('https://192.168.0.108/tips/tip-details.php?t_id=' . $row['t_id']) . '" class="text-danger ' . $isPremium . ' mt-3">';
                                                    echo '<img src="https://img.icons8.com/fluency/30/null/facebook-new.png"/></a>';
                                                    echo '</div>';
                                                    echo '<div class="col-md-10">';
                                                    echo '<a href="tip-details.php?t_id=' . $row['t_id'] . '" class="text-end text-danger ' . $isPremium . ' d-block mt-3">';
                                                    echo 'Read more</a>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    // Display the "Buy Subscription" button for premium items only
                                                    if ($isPremium1 === 'premium') {
                                                        echo '<div class="blur-container">';
                                                        echo '<div class="blur-img">';
                                                        echo '<button type="button" class="btn text-white btn-sm center-button" style="margin-top: -70%; background-color: #E91E63" data-bs-toggle="modal" data-bs-target="#premiumModal">Premium 🔒</button>';
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
        </div>
        </section>
    </div>
    </div>
    </div>
    </div>
</main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<?php include("../../premium_modal.php"); ?>

<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "getYear.php",
            data: "{}",
            success: function(data) {
                var data = jQuery.parseJSON(data);
                const urlParams = new URLSearchParams(window.location.search);
                const year_selected = urlParams.get('year');
                const d = new Date();
                let present_year = d.getFullYear();
                var s = '<option value="' + present_year + '">' + 'This Year' + '</option>';
                if (year_selected == null) {
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].mb_year != present_year) {
                            s += '<option value="' + data[i].mb_year + '">' + data[i].mb_year + '</option>';
                        }
                    }
                } else {
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].mb_year != present_year) {
                            if (data[i].mb_year == year_selected) {
                                s += '<option value="' + data[i].mb_year + '" selected>' + data[i].mb_year + '</option>';
                            } else {
                                s += '<option value="' + data[i].mb_year + '">' + data[i].mb_year + '</option>';
                            }
                        }
                    }
                }
                $("#Year").html(s);
            }
        });
    });
    $(document).ready(function() {
        $("#Year").change(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const subject = urlParams.get('sj_id');
            var year = $('#Year').val();
            window.location.replace(`?sj_id=${subject}&year=${year}`);
        });
    });
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        const year_select = urlParams.get('year');
        const sj_id_select = urlParams.get('sj_id');
        $.ajax({
            type: "get",
            url: "read-mindbooster.php",
            data: {
                sj_id: sj_id_select,
                year: year_select
            },
            success: function(output, status, xhr) {
                // var result = $.parseJSON(output);
                var result = jQuery.parseJSON(output);
                //console.log(result);
                var mainContainer = document.getElementById("mainContainer");
                for (var i = 0; i < result.length; i++) {
                    var swiperSlideDiv = document.createElement("div");
                    swiperSlideDiv.classList.add("swiper-slide");
                    // var alink = document.createElement("a");
                    // alink.setAttribute("href","tip-details.php?mb_id=" + result[i].mb_id);
                    var alink = document.createElement("a");
                    alink.setAttribute("href", result[i].mb_filePath);
                    alink.setAttribute("target", "_blank");
                    alink.setAttribute("data-gallery", "portfolio-gallery-app");
                    // aImg.classList.add("glightbox");
                    var image = document.createElement("img");
                    image.setAttribute("src", result[i].mb_filePath);
                    image.classList.add("img-fluid");
                    image.setAttribute("height", "300px");
                    image.setAttribute("data-gallery", "images-gallery");
                    alink.appendChild(image);
                    swiperSlideDiv.appendChild(alink);
                    mainContainer.appendChild(swiperSlideDiv);
                }
            },
            error: function(xhr, resp, text) {
                $('#packageDetailsMessage').fadeIn();
                $('#packageDetailsMessage').html(xhr.responseText);
            },
        });
    });
</script>
</body>

</html>