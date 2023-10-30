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
                <h2 class="title">Teaching Support </h2>
                <form id="viewContribution">
                    <div class="row row-space">
                        <!-- 
                            <div class="input-group"> -->
                        <div class="col-6">
                            <div class="input-group">
                                <label class="label">Type of Teaching Support</label>
                                <input class="input--style-4" type="text" name="ts_type" disabled>

                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <input class="input--style-4" type="text" name="packageID" style="display:none">
                        <div class="col-12">
                            <div class="input-group">
                                <label class="label">Title</label>
                                <input class="input--style-4" type="text" name="ts_title" disabled>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <label class="label">Description</label>
                                <textarea class="input--style-4" style="border: none;outline: none;" id="ts_desc" name="ts_desc" rows="4" cols="55" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-6">
                            <div class="input-group">
                                <label class="label">Date</label>
                                <input class="input--style-4" type="text" name="ts_date" disabled>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <label class="label">Author</label>
                                <input class="input--style-4" type="text" name="ts_author" disabled>

                            </div>
                        </div>
                    </div>
                    <div class="row row-space" id="imgPlace">
                        <label class="label">Cover Image</label>
                    </div>
                    <div class="row row-space" id="filePlace">
                        <label class="label">Attachment</label>
                    </div>


                    <div class="p-t-15">
                        <button class="btn btn--radius-2 " id="btn--assign">Back</button>
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

<!-- Main JS-->
<script src="../assets/js/global.js"></script>
<script>
    const queryString = window.location.search;
    console.log(queryString);
    const urlParams = new URLSearchParams(queryString);
    $('#btn--assign').on('click', function(event) {
        event.preventDefault();
        window.location.replace("manageTeachSupport.php");
    });

    $(document).ready(function() {

        if (urlParams.has('ts_id')) {
            const id = urlParams.get('ts_id');
            $.ajax({
                type: "get",
                url: "getTeachSupportDetails.php?ts_id=" + id,
                success: function(contribute, status, xhr) {
                    console.log(contribute);
                    $('input[name=ts_title]').val(contribute.title);
                    //$('input[name=c_desc]').val(contribute.desc);
                    $("#ts_desc").val(contribute.desc);
                    $('input[name=ts_date]').val(contribute.date);
                    $('input[name=ts_author]').val(contribute.author);
                    $('input[name=ts_type]').val(contribute.contentType);
                    if (contribute.fileImage != '') {
                        $(" <div class='col-12'>" +
                            "<div class='input-group'>" +
                            "<img  src='" + contribute.fileImage + "' style='width: 50%;height: 50%;border: none;' class='frame' id='fileIFrame'></img>" +
                            "</div>").appendTo("#imgPlace");
                    }
                    if (contribute.file != "") {
                        if (contribute.fileSize == "img") {
                            $(" <div class='col-12'>" +
                                "<div class='input-group'>" +
                                "<img  src='" + contribute.file + "' style='width: 100%;height: 100%;border: none;' class='frame' id='fileIFrame'></img>" +
                                "</div>").appendTo("#filePlace");
                        } else {
                            $(" <div class='col-12'>" +
                                "<div class='input-group'>" +
                                "<iframe  src='" + contribute.file + "' style='width: 100%;height: 500px;border: none;' class='frame' id='fileIFrame'></iframe>" +
                                "</div>").appendTo("#filePlace");
                        }
                    }
                    console.log(package);
                },
                error: function(xhr, resp, text) {
                    $('#packageDetailsMessage').fadeIn();
                    $('#packageDetailsMessage').html(xhr.responseText);
                },
            });
        }
    });
</script>
</body>

</html>