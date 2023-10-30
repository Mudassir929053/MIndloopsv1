<?php 
  if(isset($_GET['success'])){
    ?>
    <script>
      alert("<?= $_GET['success'] ?>");
      window.location.href='admin.php';
    </script>
    <?php
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Match Picture-Word</title>
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <?php
  // require('../../commonPHP/head.php');
  require('../../commonPHP/adminNavBar_quiz.php');
  include '../../dbconnect.php';

  ?>
  <style>
    body {
        background-image: url('../../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 110%;
        background-position: top center;
    }
</style>
</head>

<body>
 
  <!-- <div class="mt-5">&nbsp</div> -->
  <!-- <div class="mt-1">&nbsp</div> -->

  <!-- <div class="container">
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addimage">Add New Picture</button>
            </div>
        </div>
    </div> -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">
      <h2 style="text-align: center;">Manage Word Picture Puzzle</h2>
      <br>
      <div class="row gy-4">
        <a href="insert_wordpicture.php" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add Word-Picture</a>
        <div class="col-lg-12">
          <?php
          $sql = "SELECT * FROM tb_wordmatch";
          $result = mysqli_query($conn, $sql);

          // Check if there are any rows returned
          if (mysqli_num_rows($result) > 0) { ?>
            <table id="mbTbl" class="table datatable table-warning table-striped table-hover text-center">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">GAME LEVEL</th>
                  <th scope="col">IMAGE</th>
                  <th scope="col">WORD NAME</th>
                  <th scope="col">CATEGORY</th>
                  <th scope="col">CATEGORY IMAGE</th>
                  <!-- <th scope="col">Created Date</th> -->
                  <th scope="col" colspan="3" style="text-align: center;">ACTIONS</th>
                </tr>
              </thead>

              <tbody id="tbody">
                <?php
                // Initialize the row number to 1
                $row_number = 1;

                // Loop through each row in the result set
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr>
                    <td scope="row"><?php echo $row_number; ?></td>
                    <td><?php echo $row["game_level"]; ?></td>
                    <td><img src="<?php echo $row["image_url"]; ?>" width="80" height="60"></td>
                    <td><?php echo $row["word_name"]; ?></td>
                    <td><?php echo $row["category"]; ?></td>
                    <td><img src="<?php echo $row["img_category"]; ?>" width="80" height="60"></td>
                    <td><a class="btn btn-primary" href="edit_wordpicture.php?id=<?php echo $row["id"]; ?>"><i class="bi bi-pencil-square"></i></a> &nbsp;&nbsp;
                    <a class="btn btn-danger" href="function.php?dm_delete_word=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure you want to delete this record?')"><i class="bi bi-trash"></i></a></td>
                    <!-- <td><a href="view.php?id=<?php echo $row["id"]; ?>"><i class="bi bi-eye"></i></a></td> -->
                  </tr>
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
  <div class="modal fade" id="addimage" tabindex="-1" aria-labelledby="imageupload" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="imageupload">image File</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="add_elements.php" class="text-center" enctype="multipart/form-data">
          <div class="modal-body p-5">
            <div class="text-center mb-3">
              <img src="images/img.png" class="img-fluid" alt="Upload Image">
            </div>
            <div class="form-group mb-3">
              <label class="form-label" for="image">Image Attachment:</label>
              <div class="input-group">
                <div class="input-group">
                  <input type="file" id="image" name="image" class="form-control" required>
                  <a href="javascript:void(0)" class="btn btn-secondary input-group-text" onclick="document.getElementById('image').click()">Upload</a>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="word_name">Word/Name:</label>
              <input type="text" class="form-control" id="word_name" name="word_name" placeholder="Enter word/name">
            </div>
            <div class="form-group mb-3">
              <label for="category">Category:</label>
              <input type="text" class="form-control" id="category" name="category" placeholder="Enter category">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="add_word_picture">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Page -->
  <?php include("../../commonPHP/footer_admin.php"); ?>
  <?php include("../../commonPHP/jsFiles.php"); ?>
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
</html>