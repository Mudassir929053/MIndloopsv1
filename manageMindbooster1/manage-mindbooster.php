<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
include("../commonPHP/adminNavBar.php");
include("../commonPHP/head.php");
include("../dbconnect.php");
?>
<?php
include("../commonPHP/jsFiles.php");
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
<main>
  <div class="container">
    <h2 style="text-align: center;">Manage Mind Booster</h2>
    <br>
    <div class="row gy-4">
      <a href="insert-mindbooster.php" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add a New Mind Booster</a>
      <div class="col-lg-12">
        <table id="magTbl" class="table datatable table-warning table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">SNo.</th>
              <!-- <th scope="col">Subject Code</th> -->
              <th scope="col">Subject Name</th>
              <th scope="col">Subject Desc</th>
              <th scope="col">Subject Image</th>
              <th scope="col">Released Date</th>
              <th scope="col" width="150px" style="text-align: center;">Actions</th>
            </tr>
          </thead>
          <tbody id="tbody">
            <?php
            // Retrieve mind booster data from the database
            $query = "SELECT * FROM tb_mindbooster";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
              $counter = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                // $mb_sub_code = $row['mb_sub_code'];
                $mb_id = $row['mb_id'];
                $mb_sub_name = $row['mb_sub_name'];
                $mb_sub_desc = $row['mb_sub_desc'];
                $mb_sub_image = $row['mb_sub_image'];
                $mb_sub_released_date = $row['mb_sub_released_date'];
            ?>
                <tr>
                  <td><?php echo $counter; ?></td>
                  <!-- <td><?php #echo $mb_sub_code; 
                            ?></td> -->
                  <td><?php echo $mb_sub_name; ?></td>
                  <td>
                    <?php
                    $description = $mb_sub_desc;
                    if (strlen($description) > 100) {
                      $description = substr($description, 0, 100) . '...';
                    }
                    echo $description;
                    ?>
                  </td>
                  <td><img src="<?php echo $mb_sub_image; ?>" alt="Subject Image" style="max-width: 100px;"></td>
                  <td><?php echo $mb_sub_released_date; ?></td>
                  <td style="text-align: center;">
                    <?php
                    $sub_name = strtoupper($mb_sub_name);
                    if ($sub_name == "GENERAL KNOWLEDGE") { ?>
                      <a href="view-gk-mindbooster.php?mb_id=<?php echo $mb_id; ?>" class="btn btn-sm btn-link text-danger mx-1 rounded-circle"><i class="bi bi-eye-fill bi-lg"></i></a>
                      <a href="edit-mindbooster.php?mb_id=<?php echo $mb_id; ?>" class="btn btn-sm btn-link text-danger mx-1 rounded-circle"><i class="bi bi-pencil-fill bi-lg"></i></a>
                    <?php } else { ?>
                      <a href="view-mindbooster.php?mb_id=<?php echo $mb_id; ?>" class="btn btn-sm btn-link text-danger mx-1 rounded-circle"><i class="bi bi-eye-fill bi-lg"></i></a>
                      <a href="edit-mindbooster.php?mb_id=<?php echo $mb_id; ?>" class="btn btn-sm btn-link text-danger mx-1 rounded-circle"><i class="bi bi-pencil-fill bi-lg"></i></a>
                    <?php } ?>
                    <a href="delete-mindbooster.php?mb_id=<?php echo $mb_id; ?>" class="btn btn-sm btn-link text-danger mx-1 rounded-circle" onclick="deleteMindBooster(<?php echo $mb_id; ?>)"><i class="bi bi-trash-fill bi-lg"></i></a>
                  </td>
                </tr>
            <?php
                $counter++;
              }
            } else {
              // No records found
              echo '<tr><td colspan="7" style="text-align: center;">No Records to be shown</td></tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      // Initialize DataTable with pagination and search
      $('#magTbl').DataTable();
    });
  </script>
</main><!-- End #main -->
<?php include("../commonPHP/footer_admin.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
</body>

</html>