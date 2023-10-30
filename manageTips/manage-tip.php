<?php
include '../dbconnect.php';
session_start();
if (!session_id()) {
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
?>
<?php include("../commonPHP/adminNavBar.php"); ?>
<main id="main">
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">
      <h2 style="text-align: center;">Manage Tips</h2>
      <br>
      <div class="row gy-4">
        <a href="insert-tip.php" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add a New Tip</a>
        <div class="col-lg-12">
          <table id="magTbl" class="table  table-warning table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Audience</th>
                <th scope="col" width="10%">Release Date</th>
                <th scope="col">Author</th>
                <th scope="col">Type</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody id="tbody">
              <?php
              // Assuming you have established a database connection
              $queryClass = $conn->query("SELECT * FROM tb_tips ");
              $num = 1;
              if (mysqli_num_rows($queryClass) > 0) {
                while ($row = mysqli_fetch_object($queryClass)) {
              ?>
                  <tr>
                    <td><?php echo $num++; ?>.</td>
                    <td class="wide"><?php echo $row->t_title; ?></td>
                    <td class="wide"><?php echo $row->t_audience; ?></td>
                    <td class="wide"><?php echo $row->t_rDate; ?></td>
                    <td class="wide"><?php echo $row->t_author; ?></td>
                    <td class="wide"><?php echo $row->t_type; ?></td>
                    <td class="text-nowrap">
                      <a href="view-tip.php?t_id=<?php echo $row->t_id; ?>" class="actionBtn" style="color: rgb(227, 21, 104);"><i class="bi bi-eye"></i></a>
                      <a href="edit-tip.php?t_id=<?php echo $row->t_id; ?>" class="actionBtn" style="color: rgb(227, 21, 104);"><i class="bi bi-pencil-square m-2"></i></a>
                      <a href="manage-tip.php" onclick="return deleteTip('<?php echo $row->t_id; ?>');" id="dltBtn" class="actionBtn" style="color: rgb(227, 21, 104);"><i class="bi bi-trash"></i></a>
                    </td>
                  </tr>
                <?php
                }
              } else {
                // Display a message if no data is available
                ?>
                <tr>
                  <td colspan="7">No tips found.</td>
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
</main><!-- End #main -->
<?php include("../commonPHP/footer_admin.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<script>
  $(document).ready(function() {
    $('#magTbl').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>
<script>
  function deleteTip(t_id) {
    var check = confirm("Are you sure to delete the tip with ID = " + t_id + " ?");
    if (check) {
      var dltXML = new XMLHttpRequest();
      dltXML.open("get", "delete-tip.php?t_id=" + t_id);
      dltXML.send();
      dltXML.onload = function() {
        alert("Deleted successfully.");
        window.location.replace("manage-tip.php");
      };
    } else {
      window.location.replace("manage-tip.php");
    }
  }
</script>
</body>

</html>