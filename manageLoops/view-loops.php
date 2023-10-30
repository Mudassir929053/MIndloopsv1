<?php
if (!session_id()) {
  include("../dbconnect.php");
  include("../commonPHP/adminNavBar.php");
  // session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
  if (isset($_GET['lp_id'])) {
    $lp_id = $_GET['lp_id'];
  }
  $loops = "SELECT * FROM tb_loops where lp_id = ?";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $loops);
  mysqli_stmt_bind_param($stmt, "s", $lp_id);
  mysqli_stmt_execute($stmt);
  $loops_result = $stmt->get_result();
}
?>
<main id="main">
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">
      <h2 style="text-align: center;">View Loops</h2>
      <br>
      <div class="row gy-4">
        <?php
        while ($row = $loops_result->fetch_assoc()) {
          // var_dump($row);
        ?>
          <a href="manage-loops.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <?php if (!(is_null($row['lp_imgpath']))) { ?>
            <img id="magazine-img" src="<?php echo $row["lp_imgpath"]; ?>" alt="" height="300px" class="col-lg-12">
          <?php  } ?>
          <?php
          $file_name = $row['lp_filepath'];
          $extension = pathinfo($file_name, PATHINFO_EXTENSION);
          if ($extension != 'pdf') {
          ?>
            <iframe class="responsive-iframe" mozallowfullscreen="true" allow="autoplay; fullscreen" src="<?php echo $row['lp_filepath'] ?>" style="border:0px #000000 none;" name="Pong: Star Wars Remix" scrolling="no" msallowfullscreen="true" allowfullscreen="true" webkitallowfullscreen="true" allowtransparency="true" frameborder="0" marginheight="px" marginwidth="320px" height="540px" width="960px">
            </iframe>
          <?php  } else { ?>
            <iframe class="responsive-iframe" mozallowfullscreen="true" allow="autoplay; fullscreen" src="<?php echo $row['lp_filepath'] ?>#toolbar=0" scrolling="no" webkitallowfullscreen="true" allowtransparency="true" frameborder="0" marginheight="px" marginwidth="320px" height="540px" width="960px">
            </iframe>
          <?php  } ?>
          <div class="col-lg-12">
            <table id="mbTbl" class="table table-warning table-borderless table-striped table-hover">
              <thead>
                <tr>
                  <th><strong>ID</strong></th>
                  <th><?php echo $row["lp_id"]; ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Title</strong></td>
                  <td><?php echo $row['lp_title']; ?></td>
                </tr>
                <!-- <tr></tr> -->
                <tr>
                  <td><strong>Description</strong></td>
                  <td><?php echo $row["lp_desc"]; ?></td>
                </tr>
                <!-- <tr></tr>
                                <tr></tr> -->
                <tr>
                  <td><strong>Type</strong></td>
                  <td><strong><?php echo $row["lp_type"] . ""; ?><a href=""><?php //echo $row['a_roomID']; 
                                                                          ?></a></strong></td>
                </tr>
                <tr>
                  <td><strong>Date</strong></td>
                  <td><?php echo $row["lp_date"]; ?></td>
                </tr>
                <tr>
                  <td><strong>Cover Image Path</strong></td>
                  <td><?php echo $row["lp_imgpath"]; ?></td>
                </tr>
                <tr>
                  <td><strong>File Path</strong></td>
                  <td><?php echo $row["lp_filepath"]; ?></td>
                </tr>
              </tbody>
            </table>
          <?php } ?>
          </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
<?php include("../commonPHP/footer_admin.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<script>
  $(document).ready(function() {
    $('#mbtbl').dataTable({
      "columns": [{
          "width": "40%"
        },
        {
          "width": "60%"
        }
      ]
    });
  });
</script>
</body>

</html>