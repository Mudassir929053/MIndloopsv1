<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Mindloops</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../assets/img/MindLOOPS_Resouces/ML Icon4.png" rel="icon">
  <link href="../assets/img/MindLOOPS_Resouces/ML Icon4.png" rel="apple-touch-icon">

    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="
    https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="../assets/css/style.css" rel="stylesheet">


    <!-- Icons font CSS-->
    <link href="../assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Vendor CSS-->
    <link href="../assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../assets/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="../assets/css/main.css" rel="stylesheet" media="all">
</head>

<?php include("../commonPHP/adminNavBar.php") ?>
<header id="head"></header>
<div class="page-wrapper bg-gra-02 p-t-130 p-b-100">
    <div class="wrapper wrapper--w680">
        <div class="card card-4">
            <div class="card-body">
                <div id="packageDetailsMessage"></div>
                <h2 class="title">Add Teaching Support </h2>
                <form id="addTeachSupport" method="POST" action="addTeachSupportDB.php" enctype="multipart/form-data">
                    <div class="row row-space">
                        <!-- <div class="input-group"> -->
                        <div class="col-12">
                            <label class="label">Type of Teaching Support</label>
                        </div>
                        <div class="col-6">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="ts_type" id="ts_type" required>
                                    <option disabled="disabled" selected="selected">Choose option</option>
                                    <option value="pedagogy">Pedagogy</option>
                                    <option value="curriculum">Curriculum</option>
                                    <option value="assessment">Assessment</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                    <br>
                    <div class="row row-space">
                        <div class="col-12">
                            <div class="input-group">
                                <label class="label">Title</label>
                                <input class="input--style-5" type="text" name="ts_title" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <label class="label">Description</label>
                                <textarea class="input--style-5" style="border: none;outline: none;" id="ts_desc" name="ts_desc" rows="4" cols="55" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-6">
                            <div class="input-group">
                                <label class="label">Date &nbsp</label>
                                <div class="input-group-icon">
                                    <input class="input--style-5 js-datepicker" type="text" name="ts_date" required>
                                    <span><i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <label class="label">Author</label>
                                <input class="input--style-5" type="text" name="ts_author" required>

                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <!-- <div class="input-group"> -->
                        <div class="col-12">
                            <label for="ts_img" class="label">Cover Image *(.png / .jpg / .jpeg)</label>

                            <!-- </div>
                        <div class="col-12"> -->
                            <input type="file" class="input--style-5" name="ts_img" id="ts_img" accept="image/png, image/jpeg, image/jpg" required>
                        </div>
                    </div><br>
                    <div class="row row-space">
                        <div class="col-12">
                            <label for="ts_file" class="label">Attachment *(.pdf)</label>

                            <!-- </div>
                        <div class="col-12"> -->
                            <input type="file" class="input--style-5" name="ts_file" id="ts_file" accept="application/pdf" required>
                        </div>
                    </div>
                    <!-- <div class="col-6">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="package_type" id="package_type">
                                    <option disabled="disabled" selected="selected">Choose option</option>
                                    <option value="2">Family Package</option>
                                    <option value="1">Single Package</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div> -->
                    <!-- </div> -->

                    <div class="p-t-15">
                        <button class="btn btn--radius-2 " id="btn--addNewPackage" type="submit">Add</button>
                    </div>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>

<?php include("../commonPHP/footer_admin.php") ?>
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
<script>
    $(function() {
        $('#addTeachSupport').ajaxForm({
            /* beforeSubmit: ShowRequest, */
            success: SubmitSuccesful,
            error: AjaxError
        });
    });

    function ShowRequest(formData, jqForm, options) {
        var queryString = $.param(formData);
        alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
        return true;
    }

    function AjaxError() {
        alert("An AJAX error occured.");
    }

    function SubmitSuccesful(responseText, statusText) {
        /* alert("SuccesMethod:\n\n" + responseText); */
        location.href = "manageTeachSupport.php";
    }
    $(document).ready(function() {

    });
</script>
</body>

</html>