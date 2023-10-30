<?php include("../commonPHP/head.php"); ?>
<?php include("../../dbconnect.php"); ?>
<?php
if (!session_id()) {
    session_start();
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
<link rel="stylesheet" href="../assets/css/style.css">
</link>
<link rel="stylesheet" href="../assets/css/teachSupport.css">
</link>
<link href="../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script> -->
<!-- Vendor CSS-->
<link rel="stylesheet" href="../../assets/css/parent.css">
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
<?php include("../commonPHP/topNavBarCheck.php"); ?>
<body class="imagebackground">
<main id="main">
    <div id="portfolio-details">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" style="background-image: url('../../assets/loops/img/Loop_Banner.png'); background-size:100%; background-repeat: no-repeat;">
                    <div class="col-md-10">
                        <div class="text-right" style="padding-left: 65%; padding-top: 12%; padding-bottom: 12%;">
                            <h1 class="display-1" style="font-size: 6vw;">LOOPS</h1>
                            <p style="font-size: 2vw;">Do more learn more</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="text-center table-responsive">
                <div class=" pt-5">
                    <ul class="nav nav-tabs fs-4 d-flex justify-content-center">
                        <li class="nav-item">
                            <button class="nav-link active text-uppercase fw-bolder" data-bs-toggle="tab" data-bs-target="#category1">Bonding Time</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link text-uppercase fw-bolder" data-bs-toggle="tab" data-bs-target="#category2">Teaching Resources</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="category1">
                        <div class=" text-center ">
                            <div class="container  py-5 px-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" id="search-input1" class="form-control" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container1 py-3 px-5">
                                    <div class="row d-flex justify-content-center">
                                        <?php
                                        $rows_per_page = 6;
                                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $offset = ($current_page - 1) * $rows_per_page;
                                        $type = '1';
                                        $query = "SELECT * FROM `tb_loops` WHERE `lp_type` = '$type' LIMIT $rows_per_page OFFSET $offset";
                                        $result = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            $count = 0;
                                            $itemCount = 0;;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $itemCount++;
                                                if ($isPremiumUser) {
                                                    $isPremium = 'not-premium';
                                                    $isPremium1 = 'not-premium';
                                                } else {
                                                    $isPremium = ($current_page == 1 && $itemCount <= 5) ? 'not-premium' : 'premium blur-text no-click '; // Check if item is premium or not
                                                    $isPremium1 = ($current_page == 1 && $itemCount <= 5) ? 'not-premium' : 'premium'; // Check if item is premium or not
                                                }
                                              
                                                echo '<div class="col-lg-4 col-md-6 col-sm-12">';
                                                echo '<div class="card shadow p-3 rounded  d-flex flex-column">';
                                                echo '<a href="loops-bondingtime-details.php?lp_id=' . $row['lp_id'] . '" class="' . $isPremium . '">';
                                                echo '<img src="../' . $row['lp_imgpath'] . '" class="card-img-top ' . $isPremium . '" style=" object-fit: cover; width: 100%; height: 200px;" />';
                                                echo '</a>';
                                                echo '<div class="card-body">';
                                                echo '<h4 class="card-title text-dark ' . $isPremium . '">' . $row['lp_title'] . '</h4>';
                                                echo '<span class="text-secondary ' . $isPremium . '">' . date('j F Y', strtotime($row['lp_date'])) . '</span>';
                                                echo '<p class="card-text text-dark ' . $isPremium . '">' . $row['lp_desc'] . '</p>';
                                                echo '<a href="loops-bondingtime-details.php?lp_id=' . $row['lp_id'] . '" class="text-danger d-flex justify-content-end ' . $isPremium . '">Read More</a>';
                                                if ($isPremium1 === 'premium') {
                                                    echo '<div class="blur-container">';
                                                    echo '<div class="blur-img">';
                                                    echo '<button type="button" class="btn text-white btn-sm center-button" style="margin-top: -70%; background-color: #E91E63" data-bs-toggle="modal" data-bs-target="#premiumModal">Premium 🔒</button>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                $count++;
                                            }
                                            $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_loops` WHERE `lp_type` = '$type'"));
                                            $total_pages = ceil($total_rows / $rows_per_page);
                                            if ($total_pages > 1) {
                                                echo '<nav aria-label="Page navigation">';
                                                echo '<ul class="pagination justify-content-center py-3">';
                                                if ($current_page > 1) {
                                                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
                                                }
                                                for ($i = 1; $i <= $total_pages; $i++) {
                                                    echo '<li class="page-item' . ($i == $current_page ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                                }
                                                if ($current_page < $total_pages) {
                                                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
                                                }
                                                echo '</ul>';
                                                echo '</nav>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-1 col-md-6 bg-white px-4 py-5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="category2">
                        <div class=" text-center ">
                            <div class="container  py-5 px-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" id="search-input2" class="form-control" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container2 py-3 px-5">
                                    <div class="row d-flex justify-content-center" >
                                        <?php
                                        $type = '2';
                                        $query = "SELECT * FROM `tb_mindbooster`";
                                        $result = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            $count = 0;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $mb_id = $row['mb_id'];
                                                echo '<div class="col-lg-4 col-md-6 col-sm-12">';
                                                echo '<div class="card shadow p-3 rounded  d-flex flex-column">';
                                                echo '<img src="../' . $row['mb_sub_image'] . '" class="card-img-top" style=" object-fit: cover; width: 100%; height: 200px;" />';
                                                echo '<div class="card-body">';
                                                echo '<h4 class="card-title text-dark">' . $row['mb_sub_name'] . '</h4>';
                                                echo '<span class="text-secondary">' . date('j F Y', strtotime($row['mb_sub_released_date'])) . '</span>';
                                                echo '<p class="card-text text-dark">' . $row['mb_sub_desc'] . '</p>';
                                                   $sub_name = strtoupper($row['mb_sub_name']);
                                                // $sub_name = "GENERAL KNOWLEDGE";
                                                if ($sub_name == "GENERAL KNOWLEDGE") { 
                                                  echo '<a href="view_general_knowledge.php?mb_id='.$mb_id.'" class="btn btn-warning">Read More</a>';
                                              }
                                              else{

                                           
                                                echo '<select class="form-control bg-info mt-auto" onchange="window.location.href=\'lesson.php?mb_id=' . $mb_id . '&grade=\'+this.value">';
                                                echo '<option value="">Select Grade</option>';
                                                echo '<option value="1">Level 1</option>';
                                                echo '<option value="2">Level 2</option>';
                                                echo '<option value="3">Level 3</option>';
                                                echo '<option value="4">Level 4</option>';
                                                echo '<option value="5">Level 5</option>';
                                                echo '<option value="6">Level 6</option>';
                                                echo '</select>';
                                            } 
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                $count++;
                                              
                                            }
                                          
                                        }
                                        ?>
                                    </div>
                                     <div class="col-lg-1 col-md-6 bg-white px-4 py-5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    </div>
   
</main><!-- End #main -->
<?php include("../../premium_modal.php"); ?>
<?php include("../commonPHP/footer.php"); ?>
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
        $("#search-input1").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            $(".container1 #talent1 .col-md-3").filter(function() {
                var title = $(this).find(".card-title").text().toLowerCase();
                return title.indexOf(searchText) == -1;
            }).hide();
            $(".container1 #talent1 .col-md-3").filter(function() {
                var title = $(this).find(".card-title").text().toLowerCase();
                return title.indexOf(searchText) != -1;
            }).show();
        });
        $("#search-input2").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            $(".container2 #talent2 .col-md-3").filter(function() {
                var title = $(this).find(".card-title").text().toLowerCase();
                return title.indexOf(searchText) == -1;
            }).hide();
            $(".container2 #talent2 .col-md-3").filter(function() {
                var title = $(this).find(".card-title").text().toLowerCase();
                return title.indexOf(searchText) != -1;
            }).show();
        });
    });
</script>
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