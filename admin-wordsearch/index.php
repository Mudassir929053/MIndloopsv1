<!DOCTYPE html>
<html lang="en">
<?php
// require('../../commonPHP/head.php');
require('../../commonPHP/adminNavBar.php');
include '../../dbconnect.php';
include 'function.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Word Search</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php include("../../commonPHP/jsFiles.php"); ?>


    <!-- <link rel="stylesheet" href="style1.css"> -->


    <style>
        body {
            background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
            background-size: 110%;
            background-position: top center;
        }

        #magazine-hero {
            background-image: none;
            height: 150px;
        }

        #imgDiv {
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body class="bg">
    <!-- ======= Header ======= -->

    <!-- End Header -->
    
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <h2 style="text-align: center;">Manage Word Search</h2>

            <br>

            <div class="row gy-4">

                <a href="insert-wordsearch.php" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add a New Word</a>

                <div class="col-lg-12">

                    <!-- HTML table -->
                    <table id="mbTbl" class="table datatable table-warning table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type of Level</th>
                                <th scope="col">Category</th>
                                <th scope="col">Category Image</th>
                                <th scope="col">Words</th>
                                <th scope="col" colspan="2" style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieve the wordsearch records from the database
                            $sql = "SELECT * FROM tb_wordsearch";
                            $result = mysqli_query($conn, $sql);

                            // Check if there are any rows returned
                            if (mysqli_num_rows($result) > 0) {
                                // Loop through each row in the result set
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td scope="row"><?php echo $i++; ?></td>
                                        <td><?php echo $row["wordsearch_level"]; ?></td>
                                        <td><?php echo $row["wordsearch_category"]; ?></td>
                                        <td>
                                            <img src="../../assets/games/wordsearch/upload/<?php echo $row["wordsearch_image"]; ?>" alt="<?php echo $row["wordsearch_category"]; ?>" style="max-width: 100px;">
                                        </td>


                                        <td><?php echo $row["wordsearch_words"]; ?></td>
                                        <td>
                                            <a class="btn btn-primary" href="edit-wordsearch.php?id=<?php echo $row["wordsearch_id"]; ?>"><i class="bi bi-pencil-square"></i></a>

                                            <a class="btn btn-danger" href="function.php?dm_delete_word=<?php echo $row["wordsearch_id"]; ?>" onclick="return confirm('Are you sure you want to delete this record?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No records found.</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </section>



    <!-- Start Modal Page -->
    <div class="modal fade" id="addnewword" tabindex="-1" aria-labelledby="addnewword" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <form method="POST" action="" class="shadow p-3" enctype="multipart/form-data">
                    <div class="modal-body p-5">
                        <h2 class="mb-4">ADD NEW WORDS</h2>
                        <div class="form-group">
                            <label for="text-field-1">THEME</label>
                            <input type="text" class="form-control" id="theme" name="text-field-1">
                        </div>
                        <div class="form-group">
                            <label for="text-field-2">LEVEL</label>
                            <input type="text" class="form-control" id="level" name="text-field-2">
                        </div>
                        <div class="form-group">
                            <label for="dropdown">WORDS</label>
                            <input type="file" accept="image/png,image/jpeg" class="form-control" id="word" name="text-field-3">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addword">Add</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <!-- End Modal Page -->
    <script>
        function deletecourse() {
            var x = confirm("Are you sure want to delete this test?");

            if (x == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <!-- <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script>
        const dataTable = new simpleDatatables.DataTable("#mbTbl", {
            searchable: true,
            fixedHeight: false,
            sortable: true
        });
    </script>
</body>
<?php include("../../commonPHP/footer_admin.php"); ?>

</html>