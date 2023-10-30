<?php include('../commonPHP/head.php'); ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="../assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
<!-- Vendor CSS-->
<link href="../assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
<link href="../assets/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
<!-- Main CSS-->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

<link href="../assets/css/contribute.css" rel="stylesheet" media="all">
<style>
    .borde {
        border: 2px solid gray;
        border-radius: 20px;
    }
    .bala {
       position: absolute;
       top: 22%;
    }
</style>
<?php
// if (isset($_SESSION["userType"])) {
//     if ($_SESSION["userType"] == '3') {
//         header('location: ../login_and_register/login.php');
//     }
// }
include("../commonPHP/topNavBarCheck.php");
?>

<div id="portfolio-details">
        <div class="container-fluid">
            <div class="row">
           
                <img src="../assets/creativity-submission/creativity122.png" alt="" style="padding: 0;"  width="100%">
                <!-- <div class="bg-primary" style="image: url('../assets/home_page/MB\ Banner.png'); height: 600px; background-size: cover;"> -->
            </div>
        </div>
    </div>
<div class="container-fluid bala">
    
    <div class="row">
        <div class="col-lg-12" style="padding: 0;">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-item" role="tabpanel" aria-labelledby="v-pills-item-tab">
                    <div class="">
                        <div class="card-body">
                            <h3 class="text-center ">Creativity Submission</h3>
                            <ul class="nav  justify-content-center py-2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active-black" data-toggle="tab" href="#writer">Writers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#illustrator">Illustrators</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#comic">Comic Serial Creators</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cartoon">Cartoonists</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="writer" class="container-fluid tab-pane active">
                                    <div class=" bg-gra-03" style="margin-top: 0;">
                                        <div class="wrapper wrapper--w680">
                                            <div class="borde p-4">
                                                <div class="card-body">
                                                    <div id="packageDetailsMessage"></div>
                                                    <form id="addContributeWriter" method="POST" action="addContribute.php" enctype="multipart/form-data">
                                                        <div class="row row-space">
                                                            <input type="text" name="c_type" value="1" style="display:none">

                                                            <div class="col-12">
                                                                <div class="input-group">
                                                                    <label class="label">Author</label>
                                                                    <input class="input--style-4 " type="text" name="c_author" placeholder="Author Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group">
                                                                    <label class="label">Title</label>
                                                                    <input class="input--style-4 " type="text" name="c_title" placeholder="Enter Title">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group">
                                                                    <label class="label">Description</label>
                                                                    <textarea class="input--style-4" id="c_desc" name="c_desc" row="4" cols="75"></textarea>
                                                                </div>
                                                            </div>



                                                            <div class="row row-space"><br>
                                                                <!-- <div class="input-group"> -->
                                                                <div class="col-12">
                                                                    <label for="c_file" class="label">Attachment </label>

                                                                </div>
                                                                <div class="col-12">
                                                                    <input type="file" name="c_file" id="c_file" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                                                </div>


                                                            </div>

                                                            <div class="p-t-15 text-right">
                                                                <button class="btn btn-sm bg-warning rounded-pill" id="btn--contribute" type="submit">Submit</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="illustrator" class="container-fluid tab-pane fade">
                                <div class=" bg-gra-03" style="margin-top: 0;">
                                    <div class="wrapper wrapper--w680">
                                        <div class="borde p-4">
                                            <div class="card-body">
                                                <div id="packageDetailsMessage"></div>
                                                <form id="addContributeWriter" method="POST" action="addContribute.php" enctype="multipart/form-data">
                                                    <div class="row row-space">
                                                        <input type="text" name="c_type" value="2" style="display:none">

                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <label class="label">Author</label>
                                                                <input class="input--style-4 " type="text" name="c_author" placeholder="Author Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <label class="label">Title</label>
                                                                <input class="input--style-4 " type="text" name="c_title" placeholder="Enter Title">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <label class="label">Description</label>
                                                                <textarea class="input--style-4" id="c_desc" name="c_desc" row="4" cols="75"></textarea>
                                                            </div>
                                                        </div>



                                                        <div class="row row-space"><br>
                                                            <!-- <div class="input-group"> -->
                                                            <div class="col-12">
                                                                <label for="c_file" class="label">Attachment </label>

                                                            </div>
                                                            <div class="col-12">
                                                                <input type="file" name="c_file" id="c_file" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                                            </div>


                                                        </div>

                                                        <div class="p-t-15 text-right">
                                                            <button class="btn btn--radius-2 bg-warning rounded-pill" id="btn--contribute" type="submit">Submit</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="comic" class="container-fluid tab-pane fade">
                            <div class=" bg-gra-03" style="margin-top: 0;">
                                <div class="wrapper wrapper--w680">
                                    <div class="borde p-4">
                                        <div class="card-body">
                                            <div id="packageDetailsMessage"></div>
                                            <form id="addContributeWriter" method="POST" action="addContribute.php" enctype="multipart/form-data">
                                                <div class="row row-space">
                                                    <input type="text" name="c_type" value="3" style="display:none">

                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <label class="label">Author</label>
                                                            <input class="input--style-4 " type="text" name="c_author" placeholder="Author Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <label class="label">Title</label>
                                                            <input class="input--style-4 " type="text" name="c_title" placeholder="Enter Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <label class="label">Description</label>
                                                            <textarea class="input--style-4" id="c_desc" name="c_desc" row="4" cols="75"></textarea>
                                                        </div>
                                                    </div>


                                                    <div class="row row-space"><br>
                                                        <!-- <div class="input-group"> -->
                                                        <div class="col-12">
                                                            <label for="c_file" class="label">Attachment </label>

                                                        </div>
                                                        <div class="col-12">
                                                            <input type="file" name="c_file" id="c_file" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                                        </div>


                                                    </div>

                                                    <div class="p-t-15 text-right">
                                                        <button class="btn btn--radius-2 bg-warning rounded-pill" id="btn--contribute" type="submit">Submit</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="cartoon" class="container-fluid tab-pane fade">
                        <div class=" bg-gra-03" style="margin-top: 0;">
                            <div class="wrapper wrapper--w680">
                                <div class="borde p-4">
                                    <div class="card-body">
                                        <div id="packageDetailsMessage"></div>
                                        <form id="addContributeWriter" method="POST" action="addContribute.php" enctype="multipart/form-data">
                                            <div class="row row-space">
                                                <input type="text" name="c_type" value="4" style="display:none">

                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <label class="label">Author</label>
                                                        <input class="input--style-4 " type="text" name="c_author" placeholder="Author Name">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <label class="label">Title</label>
                                                        <input class="input--style-4 " type="text" name="c_title" placeholder="Enter Title">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <label class="label">Description</label>
                                                        <textarea class="input--style-4" id="c_desc" name="c_desc" row="4" cols="75"></textarea>
                                                    </div>
                                                </div>


                                                <div class="row row-space"><br>
                                                    <!-- <div class="input-group"> -->
                                                    <div class="col-12">
                                                        <label for="c_file" class="label">Attachment </label>

                                                    </div>
                                                    <div class="col-12">
                                                        <input type="file" name="c_file" id="c_file" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                                    </div>


                                                </div>

                                                <div class="p-t-15 text-right">
                                                    <button class="btn btn--radius-2 bg-warning rounded-pill" id="btn--contribute" type="submit">Submit</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of all tabs -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div id="portfolio-details">     
<div class="container-fluid">
    <div class="row">
    <img src="../assets/creativity-submission/creativity1.png" style="padding: 0;" alt="" width="100%">
    </div>
</div>   
<!-- <div class="bg-primary" style="image: url('../assets/home_page/MB\ Banner.png'); height: 600px; background-size: cover;"> -->   
</div>
<?php include('../commonPHP/footer.php'); ?>
<?php include('../commonPHP/jsFiles.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Jquery JS-->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="../assets/vendor/select2/select2.min.js"></script>
<!-- Template Main JS File -->
<script src="./assets/js/main.js"></script>
<script src="../assets/vendor/datepicker/moment.min.js"></script>
<script src="../assets/vendor/datepicker/daterangepicker.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script>
<!-- Main JS-->
<script src="../assets/js/global.js"></script>
<script src="../assets/js/contribute.js"></script>