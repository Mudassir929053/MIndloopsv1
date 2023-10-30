<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Picture-Word</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style1.css">
    <?php
    // require('../../commonPHP/head.php');
    require('../../commonPHP/adminNavBar.php');
    include '../../dbconnect.php';
    include 'function.php';
    ?>

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
<?php
// Check if the form has been submitted
if(isset($_POST['deleteid'])) {
    // Get the wordsearch ID from the form data
    $id = $_POST['deleteid'];

    // Prepare the SQL query
    $sql = "DELETE FROM tb_wordsearch WHERE wordsearch_id = $id";

    // Execute the SQL query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Redirect to the manage-wordsearch page
        echo "<script>location.href='manage-wordsearch.php';</script>";
    } else {
        echo "<script>alert('something went wrong');
              location.href = '$_SERVER[HTTP_REFERER]';</script>";
        exit();
    }
}

?>

<body class="bg">
    <!-- ======= Header ======= -->

    <!-- End Header -->
    <div class="mt-5">&nbsp</div>
    <div class="mt-5">&nbsp</div>
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <h2 style="text-align: center;">Manage Word Search</h2>

            <br>

            <div class="row gy-4">

                <a href="insert-wordsearch.php" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add a New Word</a>

                <div class="col-lg-12">

                    <table id="mbTbl" class="table datatable table-warning table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type of Mode</th>
                                <th scope="col">Theme</th>
                                <th scope="col">Words</th>
                                <th scope="col" colspan="3" style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <?php
                        $sql = "SELECT * FROM tb_wordsearch";
                        $result = mysqli_query($conn, $sql);

                        // Check if there are any rows returned
                        if (mysqli_num_rows($result) > 0) { ?>
                            <tbody id="tbody">
                                <?php
                                // Initialize the row number to 1
                                $row_number = 1;

                                // Loop through each row in the result set
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td scope="row"><?php echo $row_number; ?></td>
                                        <td><?php echo $row["wordsearch_level"]; ?></td>
                                        <td><?php echo $row["wordsearch_theme"]; ?></td>
                                        <td><?php echo $row["wordsearch_words"]; ?></td>
                                        <td><a href="edit-wordsearch.php?id=<?php echo $row["wordsearch_id"]; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                        <td><a href="index?deleteid=<?php echo $row["wordsearch_id"]; ?>"><i class="bi bi-trash"></i></a></td>

                                    <?php
                                    // Increment the row number
                                    $row_number++;
                                }
                                    ?>
                            </tbody>
                    </table>

                <?php } else { ?>
                    <p>No records found.</p>
                <?php } ?>
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
                            <input type="text" class="form-control" id="word" name="text-field-3">

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
</body>

</html>