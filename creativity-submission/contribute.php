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
<?php
if (isset($_SESSION["userType"])) {
    if ($_SESSION["userType"] == '3') {
        header('location: ../login_and_register/login.php');
    }
}
include("../commonPHP/topNavBarCheck.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-11" style="margin:auto auto;padding-top:10%;">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-item" role="tabpanel" aria-labelledby="v-pills-item-tab">
                    <div class="card card-outline-secondary my-4">
                        <div class="card-body">
                            <ul class="nav nav-tabs justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#writer">Writers</a>
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
                                    <div class="page-wrapper bg-gra-03 p-b-100">
                                        <div class="wrapper wrapper--w680">
                                            <div class="card card-4">
                                                <div class="card-body">
                                                    <div id="packageDetailsMessage"></div>
                                                    <form id="addContributeWriter" method="POST" action="addContribute.php" enctype="multipart/form-data">
                                                        <div class="row row-space">
                                                            <input type="text" name="c_type" value="1" style="display:none">

                                                            <div class="col-12">
                                                                <div class="input-group">
                                                                    <label class="label">Author</label>
                                                                    <input class="input--style-4" type="text" name="c_author" placeholder="Your name">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group">
                                                                    <label class="label">Title</label>
                                                                    <input class="input--style-4" type="text" name="c_title" placeholder="Contribution Title">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group">
                                                                    <label class="label">Description</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <textarea class="input--style-4" id="c_desc" name="c_desc" rows="4" cols="55"></textarea>
                                                                <br><br>
                                                            </div>


                                                            <div class="row row-space"><br>
                                                                <!-- <div class="input-group"> -->
                                                                <div class="col-12">
                                                                    <label for="c_file" class="label">Attachment *(.png / .jpg / .jpeg / .pdf)</label>

                                                                </div>
                                                                <div class="col-12">
                                                                    <input type="file" class="input--style-4" name="c_file" id="c_file" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                                                </div>
                                                                <p>** Note: It is better to upload image with height not more than 400px.</p>

                                                            </div>

                                                            <div class="p-t-15">
                                                                <button class="btn btn--radius-2 " id="btn--contribute" type="submit">Contribute</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="illustrator" class="container-fluid tab-pane fade">
                                <div class="page-wrapper bg-gra-03 p-b-100">
                                    <div class="wrapper wrapper--w680">
                                        <div class="card card-4">
                                            <div class="card-body">
                                                <div id="packageDetailsMessage"></div>
                                                <form id="addContributeIllustrator" method="POST" action="addContribute.php" enctype="multipart/form-data">
                                                    <div class="row row-space">
                                                        <input type="text" name="c_type" value="2" style="display:none">

                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <label class="label">Author</label>
                                                                <input class="input--style-4" type="text" name="c_author" placeholder="Your name">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <label class="label">Title</label>
                                                                <input class="input--style-4" type="text" name="c_title" placeholder="Contribution Title">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <label class="label">Description</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <textarea class="input--style-4" id="c_desc" name="c_desc" rows="4" cols="55"></textarea>
                                                            <br><br>
                                                        </div>


                                                        <div class="row row-space"><br>
                                                            <!-- <div class="input-group"> -->
                                                            <div class="col-12">
                                                                <label for="c_file" class="label">Attachments *(.png / .jpg / .jpeg / .pdf)</label>

                                                            </div>
                                                            <div class="col-12">
                                                                <input type="file" class="input--style-4" name="c_file" id="c_file" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                                            </div>
                                                            <p>** Note: It is better to upload image with height not more than 400px.</p>

                                                        </div>

                                                        <div class="p-t-15">
                                                            <button class="btn btn--radius-2 " id="btn--contribute" type="submit">Contribute</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="comic" class="container-fluid tab-pane fade">
                            <div class="page-wrapper bg-gra-03 p-b-100">
                                <div class="wrapper wrapper--w680">
                                    <div class="card card-4">
                                        <div class="card-body">
                                            <div id="packageDetailsMessage"></div>
                                            <form id="addContributeComic" method="POST" action="addContribute.php" enctype="multipart/form-data">
                                                <div class="row row-space">
                                                    <input type="text" name="c_type" value="4" style="display:none">

                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <label class="label">Author</label>
                                                            <input class="input--style-4" type="text" name="c_author" placeholder="Your name">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <label class="label">Title</label>
                                                            <input class="input--style-4" type="text" name="c_title" placeholder="Contribution Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <label class="label">Description</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="input--style-4" id="c_desc" name="c_desc" rows="4" cols="55"></textarea>
                                                        <br><br>
                                                    </div>


                                                    <div class="row row-space"><br>
                                                        <!-- <div class="input-group"> -->
                                                        <div class="col-12">
                                                            <label for="c_file" class="label">Attachments *(.png / .jpg / .jpeg / .pdf)</label>

                                                        </div>
                                                        <div class="col-12">
                                                            <input type="file" class="input--style-4" name="c_file" id="c_file" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                                        </div>
                                                        <p>** Note: It is better to upload image with height not more than 400px.</p>

                                                    </div>

                                                    <div class="p-t-15">
                                                        <button class="btn btn--radius-2 " id="btn--contribute" type="submit">Contribute</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="cartoon" class="container-fluid tab-pane fade">
                        <div class="page-wrapper bg-gra-03 p-b-100">
                            <div class="wrapper wrapper--w680">
                                <div class="card card-4">
                                    <div class="card-body">
                                        <div id="packageDetailsMessage"></div>
                                        <form id="addContributeCartoon" method="POST" action="addContribute.php" enctype="multipart/form-data">
                                            <div class="row row-space">
                                                <input type="text" name="c_type" value="3" style="display:none">

                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <label class="label">Author</label>
                                                        <input class="input--style-4" type="text" name="c_author" placeholder="Your name">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <label class="label">Title</label>
                                                        <input class="input--style-4" type="text" name="c_title" placeholder="Contribution Title">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <label class="label">Descriptionn</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <textarea class="input--style-4" id="c_desc" name="c_desc" rows="4" cols="55"></textarea>
                                                    <br><br>
                                                </div>


                                                <div class="row row-space"><br>
                                                    <!-- <div class="input-group"> -->
                                                    <div class="col-12">
                                                        <label for="c_file" class="label">Attachments *(.png / .jpg / .jpeg / .pdf)</label>

                                                    </div>
                                                    <div class="col-12">
                                                        <input type="file" class="input--style-4" name="c_file" id="c_file" accept="image/png, image/jpeg, image/jpg, application/pdf" required>
                                                    </div>
                                                    <p>** Note: It is better to upload image with height not more than 400px.</p>

                                                </div>

                                                <div class="p-t-15">
                                                    <button class="btn btn--radius-2 " id="btn--contribute" type="submit">Contribute</button>
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