<?php include("../commonPHP/head.php"); ?>
<?php include '../dbconnect.php';


?>
<?php
if (!session_id()) {
    session_start();
}
?>
<link rel="stylesheet" href="../../assets/css/style.css">
</link>
<link rel="stylesheet" href="../../assets/css/teachSupport.css">
</link>
<link href="../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script> -->
<!-- Vendor CSS-->
<style>
    body {
        background-image: url('../../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 110%;
        background-position: top center;
    }
</style>
<style>
    .mindbooster-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
</style>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
<?php include("../commonPHP/topNavBarCheck.php"); ?>
<main id="main">
    <div id="portfolio-details" data-toggle="modal" data-target="#globalModal">
        <div class="container-fluid">
            <div class="row">
                <img src="../../assets/creativity-submission/CS-Banner 2.png" alt="" style="padding:0;" width="100%">
                <!-- <div class="bg-primary" style="image: url('../assets/home_page/MB\ Banner.png'); height: 600px; background-size: cover;"> -->
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container py-5">
            <div class="row">
                <?php

                // $checkuserrow = $conn->query("SELECT u_name FROM tb_users WHERE u_type = '{$_COOKIE["userType"]}'");
                // $rowReadUser = $checkuserrow->fetch_object();
                // $get_userID = $rowReadUser->u_name;

                // Fetch categories from the database
            //    $query = "SELECT DISTINCT c_type FROM tb_contributes WHERE c_type = '{$_COOKIE["userType"]}' ";
               $query = "SELECT DISTINCT c_type FROM tb_contributes ";
                
                // $query = "SELECT DISTINCT c_type FROM tb_contributes WHERE t_audience = '$get_userID'";
                $result = mysqli_query($conn, $query);

                // Check if the query was successful
                if ($result) {
                    $categories = array();

                    // Fetch the category names and store them in the array
                    while ($row = mysqli_fetch_assoc($result)) {
                        $categories[] = $row['c_type'];
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
                                // // Define the category full names
                                // $categoryFullNames = array(
                                //     1 => 'Bahasa Melayu',
                                //     3 => 'Bahasa Melayu',
                                //     // 'BM' => 'Bahasa Melayu',
                                //     // 'EN' => 'English',
                                //     // 'GK' => 'General Knowledge',
                                //     // 'IS' => 'Islamic Knowledge',
                                //     // 'MT' => 'Math',
                                //     // 'SC' => 'Science'
                                // );

                                foreach ($categories as $key => $category) {
                                    echo '<li class="nav-item">';
                                    echo '<a class="nav-link text-uppercase fw-bolder' . ($key == $cat_pos ? ' active' : '') . '" data-bs-toggle="tab" href="#' . $category . '">' . $category . '</a>';
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
                                    $limit = 9; // number of items per page
                                    $pageParam = "page_" . $key;
                                    $page = isset($_GET[$pageParam]) ? (int)$_GET[$pageParam] : 1;
                                    $offset = ($page - 1) * $limit;
                                    $query = "SELECT * FROM `tb_contributes` WHERE c_type = '$category'";
                                    $result = mysqli_query($conn, $query);
                                    if (!$result) {
                                        echo "Error executing query: " . mysqli_error($conn);
                                        continue;
                                    }
                                    $total_items = mysqli_num_rows($result);
                                    $total_pages = ceil($total_items / $limit);
                                    $query = "SELECT * FROM `tb_contributes` WHERE c_type = '$category' LIMIT $offset, $limit";
                                    $result = mysqli_query($conn, $query);
                                    if (!$result) {
                                        echo "Error executing query: " . mysqli_error($conn);
                                        continue;
                                    }
                                    $i = 0;
                                ?>
                                    <div id="<?php echo $category; ?>" class="tab-pane fade<?php echo $key == $cat_pos ? ' show active' : ''; ?>">
                                        <div class="row search-results" data-toggle="modal" data-target="#globalModal">
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                echo '<div class="row">';
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    if ($i % 3 == 0 && $i != 0) {
                                                        echo '</div><div class="row" >';
                                                    }
                                                    // Display the item content here
                                                    echo '<div class="col-md-4 col-sm-6 col-12 mb-4">';
                                                    echo '<div class="container-fluid shadow p-3 rounded h-100 d-flex flex-column">';
                                                    echo '<img src="../' . $row['c_file'] . '" alt="" class="img-fluid mindbooster-img">';
                                                    // echo '<span class="text-danger">Living Skills</span>';
                                                    echo '<h4 class="text-black">' . $row['c_title'] . '</h4>';
                                                    echo '<span class="text-secondary">' . date('j F Y', strtotime($row['c_date'])) . '</span>';
                                                    $c_desc = $row['c_desc'];
                                                    if (strlen($c_desc) > 100) {
                                                      $c_desc = substr($c_desc, 0, 100) . "...";
                                                      echo '<p class="text-black">' . $c_desc . ' <a href="#" class="text-danger">(description)</a></p>';
                                                    } else {
                                                      echo '<p class="text-black">' . $c_desc . '</p>';
                                                    }
                                                    echo '<div class="mt-auto">';
                                                    echo '<div class="row align-items-end">';
                                                    echo '<div class="col-md-1 text-start">';
                                                    echo '<a href="https://wa.me/?text=' . urlencode($row['c_title'] . ' - ' . $row['c_desc'] . ' - ' . 'https://192.168.0.108/mindbooster-description.php?mb=' . $row['c_id']) . '" class="text-end text-danger d-block mt-3">';
                                                    echo '<img src="https://img.icons8.com/color/30/null/whatsapp--v1.png"/></a>';
                                                    echo '</div>';
                                                    echo '<div class="col-md-1">';
                                                    echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . urlencode('https://192.168.0.108/mindbooster-description.php?mb=' . $row['c_id']) . '" class="text-end text-danger d-block mt-3">';
                                                    echo '<img src="https://img.icons8.com/fluency/30/null/facebook-new.png"/></a>';
                                                    echo '</div>';
                                                    echo '<div class="col-md-10">';
                                                    echo '<a href="#" data-toggle="modal" data-target="#globalModal" class="text-end text-danger d-block mt-3">';
                                                    echo 'Read more</a>';
                                                    echo '</div>';
                                                    echo '</div>';

                                                    echo '</div>';
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
                        $(".tab-pane.show.active .col-md-4").hide();
                        $(".tab-pane.show.active .col-md-4").filter(function() {
                            var title = $(this).find(".text-black").text().toLowerCase();
                            return title.indexOf(searchText) !== -1;
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
<?php include("../commonPHP/footer.php");
include("../global_modal.php");
?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
<script src="../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
<script src="../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/aos-portfolio/aos.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<!-- Jquery JS-->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<!-- <script src="../assets/js/manageTeachSupport.js"></script> -->
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
                    // alink.setAttribute("href","mindbooster-description.php?mb_id=" + result[i].mb_id);
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