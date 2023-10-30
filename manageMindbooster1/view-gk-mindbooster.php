<?php
if (!session_id()) {
    include("../dbconnect.php");
    include("../commonPHP/adminNavBar.php");
    // session_start();
    if ($_SESSION["userType"] != '1') {
        header('location: ../login_and_register/login.php');
    }
}
?>
<?php
include("../commonPHP/jsFiles.php");
?>
<?php
if (isset($_GET['mb_id'])) {
    $mb_id = $_GET['mb_id'];
}
?>
<style>
    body {
        background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 110%;
        background-position: top center;
    }

    .level-one {
        background-color: lightblue;
    }

    .level-two {
        background-color: lightgrey;
    }

    .level-three {
        background-color: antiquewhite;
    }

    .level-four {
        background-color: lightyellow;
    }

    .level-five {
        background-color: pink;
    }

    .level-six {
        background-color: lightcyan;
    }
</style>
<main>
    <div class="container">
        <h2 class="mt-5" style="text-align: center;">Manage General Knowledge Article</h2>
        <br>
        <div class="row gy-4">
            <div class="d-flex justify-content-between">
                <a href="insert-gk-lesson.php?mb_id=<?php echo $mb_id; ?>" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add a New Article</a>
                <a href="manage-mindbooster.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
            </div>
            <div class="col-lg-12">
                <table id="magTbl" class="table datatable table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">SNo.</th>
                            <th scope="col">Thubmnail</th>
                            <th scope="col">Article Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created Date</th>
                            <th scope="col">Released Date</th>
                            <th scope="col" width="150px" style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php
                        // Retrieve lesson data from the database
                        $query = "SELECT * FROM tb_lessons WHERE l_mb_id='$mb_id' ";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $l_id = $row['l_id'];
                                $l_name = $row['l_name'];
                                $l_lesson_desc = $row['l_lesson_desc'];
                                $l_thubmnail = $row['l_image'];
                                $l_created_date = $row['l_created_date'];
                                $l_released_date = $row['l_released_date'];
                        ?>
                                <tr class="<?php echo $rowClass; ?>">
                                    <td><?php echo $counter; ?></td>
                                    <td><img src="<?php echo $l_thubmnail; ?>" alt="Thumbnail" style="width: 100px; height: 100px;"></td>
                                    <td><?php echo $l_name; ?></td>
                                    <td><?= htmlspecialchars(substr(strip_tags($l_lesson_desc), 0, 80)) ?>...</td>
                                    <td><?php echo $l_created_date; ?></td>
                                    <td><?php echo $l_released_date; ?></td>
                                    <td style="text-align: center;">
                                        <!-- <a href="view-lesson.php?l_id=<?php echo $l_id; ?>" class="btn btn-sm btn-link text-danger mx-1 rounded-circle"><i class="bi bi-eye-fill"></i></a> -->
                                        <a href="edit-gk-lesson.php?l_id=<?php echo $l_id; ?>&mb_id=<?php echo $mb_id; ?>" class="btn btn-sm btn-link text-danger mx-1 rounded-circle"><i class="bi bi-pencil-fill"></i></a>
                                        <a href="delete-gk-lesson.php?l_id=<?php echo $l_id; ?>&mb_id=<?php echo $mb_id ?>" class="btn btn-sm btn-link text-danger mx-1 rounded-circle" onclick="return confirm('Are you sure you want to delete this Article?')"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                        <?php
                                $counter++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main><!-- End #main -->
<?php include("../commonPHP/footer_admin.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<script>
    $(document).ready(function() {
        // Initialize DataTable with pagination and search
        $('#magTbl').DataTable();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
</body>

</html>