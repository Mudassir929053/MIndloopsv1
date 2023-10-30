<?php include("../commonPHP/head.php"); ?>
<?php
if (!session_id()) {
    session_start();
}
?>
<link rel="stylesheet" href="../assets/css/style.css">
</link>
<link rel="stylesheet" href="../assets/css/teachSupport.css">
</link>
<link href="../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script> -->
<!-- Vendor CSS-->
<style>
    body {
        background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 110%;
        background-position: top center;
    }
</style>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
<?php include("../commonPHP/topNavBarCheck.php"); ?>
<main id="main">
    <div id="portfolio-details">
        <div class="container-fluid">
            <div class="row">
                <img src="../assets/creativity-submission/CS-Banner 2.png" alt="" style="padding:0;" width="100%">
                <!-- <div class="bg-primary" style="image: url('../assets/home_page/MB\ Banner.png'); height: 600px; background-size: cover;"> -->
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="text-center table-responsive">
                <div class="d-flex justify-content-center pt-5">
                    <ul class="nav nav-tabs fs-4">
                        <li class="nav-item ">
                            <button class="nav-link active text-uppercase fw-bolder" data-bs-toggle="tab" data-bs-target="#category1">writers</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link text-uppercase fw-bolder" data-bs-toggle="tab" data-bs-target="#category2">illustrators</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link text-uppercase fw-bolder" data-bs-toggle="tab" data-bs-target="#category3">comic serial creators</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link text-uppercase fw-bolder" data-bs-toggle="tab" data-bs-target="#category1">cartoonists</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="category1">
                        <div class=" text-center ">
                            <div class="row">
                                <div class="col-lg-2 col-md-6  px-4 py-5"></div>
                                <div class="col-lg-8 col-md-6  bg-white px-4 py-5">
                                    <div class="container-fluid shadow p-3 mb-5 rounded text-center">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <img src="../assets/mindbooster/28-09-2022_10-21-59_20220613Tilawah .jpg" alt="" style="padding:0;" width="100%">
                                                <!-- <img src="../assets/mindbooster/28-09-2022_10-21-59_20220613Tilawah .jpg" alt="responsive webite" class="img-fluid"> -->
                                            </div>
                                            <div class="col-md-5 text-start pt-3">
                                                <h3 class="text-black">Material Title</h3>
                                                <p class="text-danger ">Author's Name</p>
                                                <!-- <span class="text-secondary">5 March 2023</span> -->
                                                <p class="text-black">Jabatan Meteorologi Malaysia meramalkan angin Monsun Timur Laut aktif menjelang penghujung tahun 2022 di mana,
                                                    hujan lebat akan berterusan dan boleh menyebabkan banjir.<span><strong> (Description)</strong></span></p>
                                                <!-- <a href="../magazine/magazine-description.php" class="text-end text-danger d-block mt-3">Read more</a> -->
                                                <img src="../assets/creativity-submission/btn_print.png" class="float-end text-danger d-block mt-3" alt="Print Submission">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid shadow p-3 mb-5 rounded text-center">
                                        <div class="row">
                                            <div class="col-md-7 ">
                                                <img src="../assets/mindbooster/28-09-2022_10-21-59_20220613Tilawah .jpg" alt="" style="padding:0;" width="100%">
                                            </div>
                                            <div class="col-md-5 text-start pt-3">
                                                <h3 class="text-black">Material Title</h3>
                                                <p class="text-danger ">Author's Name</p>
                                                <!-- <span class="text-secondary">5 March 2023</span> -->
                                                <p class="text-black">Jabatan Meteorologi Malaysia meramalkan angin Monsun Timur Laut aktif menjelang penghujung tahun 2022 di mana,
                                                    hujan lebat akan berterusan dan boleh menyebabkan banjir.<span><strong> (Description)</strong></span></p>
                                                <!-- <a href="../magazine/magazine-description.php" class="text-end text-danger d-block mt-3">Read more</a> -->
                                                <img src="../assets/creativity-submission/btn_print.png" class="float-end text-danger d-block mt-3" alt="Print Submission">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 bg-white px-4 py-5"></div>
                                <!-- <div class="col-lg-1 border-start border-danger border-2 bg-white col-12 py-5">
                                    <p class="text-black fs-3 fw-bolder">YEAR</p>
                                    <div id="accordionExample">
                                        <div>
                                            <h2 id="heading2023">
                                                <li class="list-unstyled collapsed" data-bs-toggle="collapse" data-bs-target="#collapse2023" aria-expanded="true" aria-controls="collapse2023">
                                                    <span class="text-danger fs-4 me-3">&gt;</span> <span class="text-black fs-5">2023</span>
                                                </li>
                                            </h2>
                                            <div id="collapse2023" class="collapse" aria-labelledby="heading2023" data-bs-parent="#accordionExample" data-bs-show="false">
                                                <div>
                                                    <ul class="list-unstyled">
                                                        <li>Jan</li>
                                                        <li>Feb</li>
                                                        <li>Mar</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h2 id="heading2022">
                                                <li class="list-unstyled collapsed" data-bs-toggle="collapse" data-bs-target="#collapse2022" aria-expanded="true" aria-controls="collapse2022">
                                                    <span class="text-danger fs-4 me-3">&gt;</span> <span class="text-black fs-5">2022</span>
                                                </li>
                                            </h2>
                                            <div id="collapse2022" class="collapse" aria-labelledby="heading2022" data-bs-parent="#accordionExample">
                                                <div>
                                                    <ul class="list-unstyled">
                                                        <li>Jan</li>
                                                        <li>Feb</li>
                                                        <li>Mar</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="category2">
                    </div>
                    <div class="tab-pane fade" id="category3">
                    </div>
                </div>
            </div>
        </div>
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
<script>
    var toggleIcon = document.querySelector(".toggle-icon");
    document.querySelector("#collapse2023").addEventListener('show.bs.collapse', function() {
        toggleIcon.textContent = "-";
    });
    document.querySelector("#collapse2023").addEventListener('hide.bs.collapse', function() {
        toggleIcon.textContent = "+";
    });
</script>
</body>
</html>