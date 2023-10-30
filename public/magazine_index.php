<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarCheck.php");
 include '../global_modal.php'; 
 include '../dbconnect.php';
// include("_discover.php");
?>


<style>
  .img-fluid {
    padding: 0px;
}
</style>
<main id="main">



  <div class="container-fluid"  data-toggle="modal" data-target="#globalModal">
    <div class="row">
      <img src="../assets/magazine/img/MagazineBanner1.png" class="img-fluid" alt="" style="width: 100%; padding: 0">
    </div>
  </div>
  <!-- <div class="container py-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" id="search-input" class="form-control" placeholder="Search...">
                                        </div>
                                    </div>
                                </div> -->

  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-md-1">&nbsp;</div>
      <div class="col-md-10">
        <div class="container-fluid mb-3">
          <div class="row d-flex justify-content-center">
            <div class="col-md-2 p-5 order-1">


              <div class="col-lg-1 border-start border-danger border-2 bg-white col-12" style="padding-left:20px;"  data-toggle="modal" data-target="#globalModal">
                <p class="text-black fs-3 fw-bolder">YEAR</p>
                <div id="accordionExample">
                  <?php
                  // Retrieve the year data from the URL parameter
                  $year = isset($_GET['year']) ? (int)$_GET['year'] : null;

                  // Get all distinct years with magazines in the database
                  $year_query = "SELECT DISTINCT YEAR(m_rDate) AS year FROM tb_magazines ORDER BY m_rDate DESC";
                  if ($year) {
                    $year_query = "SELECT DISTINCT YEAR(m_rDate) AS year FROM tb_magazines WHERE YEAR(m_rDate) = $year ORDER BY m_rDate DESC";
                  }
                  $year_result = mysqli_query($conn, $year_query);

                  // Loop through each year
                  while ($year_row = mysqli_fetch_assoc($year_result)) {
                    $year = $year_row['year'];
                    $months = array();
                    // Loop through each month for the current year
                    for ($month = 1; $month <= 12; $month++) {
                      $month_query = "SELECT COUNT(*) as total FROM tb_magazines WHERE YEAR(m_rDate) = $year AND MONTH(m_rDate) = $month";
                      $month_result = mysqli_query($conn, $month_query);
                      $month_count = mysqli_fetch_assoc($month_result)['total'];
                      $month_name = date('F', mktime(0, 0, 0, $month, 1, $year));
                      if ($month_count > 0) {
                        $months[] = '<li><a class="text-secondary"  data-toggle="modal" data-target="#globalModal" >' . $month_name . '</a></li>';
                      } else {
                        $months[] = '<li><a class="text-secondary" >' . $month_name . '</a></li>';
                      }
                    }
                    // Display the year and months in the accordion
                    echo '<div>';
                    echo '<h2 id="heading' . $year . '">';
                    echo '<li class="list-unstyled collapsed" onclick="toggleDropdown(\'collapse' . $year . '\')" aria-expanded="true" aria-controls="collapse' . $year . '"><span class="text-danger fs-4 me-3">&gt;</span><span class="text-black fs-5">' . $year . '</span></li>';
                    echo '</h2>';
                    echo '<div id="collapse' . $year . '" class="collapse" aria-labelledby="heading' . $year . '" data-bs-parent="#accordionExample">';
                    echo '<div>';
                    echo '<ul class="list-unstyled">';
                    echo implode("\n", $months);
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                  }

                  // Close the database connection
                  ?>


                </div>
              </div>



            </div>

            <?php
            $rows_per_page = 6; // set the number of rows to display per page
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // get the current page number from the URL
            ?>
            <?php
            $offset = ($current_page - 1) * $rows_per_page; // calculate the number of rows to skip
            $query = $conn->query("SELECT * FROM `tb_magazines`");
            if (mysqli_num_rows($query) > 0) { 
              $image_count = 0;
            ?>
              <div class="col-md-10">
                <div class="container-fluid">
                  <div class="row mt-3">
                    <?php
                    while ($rows = mysqli_fetch_object($query)) {
                      $image_path = $rows->m_imgPath; // fetch image path from database
                      $m_id = $rows->m_id; // fetch id from database
                      $date = date_create($rows->m_rDate);
                      $year = date_format($date, "Y");
                      $month = date_format($date, "m");
                      if ($month >= 1 && $month <= 6) {
                        $image_count++;
                        if ($image_count > $offset && $image_count <= ($offset + $rows_per_page)) {
                    ?>
                          <div class="col-md-4 p-5"  data-toggle="modal" data-target="#globalModal">
                            <a >
                            <img src="<?= $image_path ?>" class="img-fluid" alt="" >
                            </a>
                          </div>
                    <?php
                        }
                      }
                    }
                    ?>

                  <?php
                }

                $total_rows = $image_count; // Total number of images from January to June (10 pages * 3 images per page)
                $total_pages = ceil($total_rows / $rows_per_page); // calculate the total number of pages
                if ($total_pages > 1) {
                  ?>
                    <div class="col-md-10" data-toggle="modal" data-target="#globalModal">
                      <div class="container-fluid">
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center">
                            <?php
                            if ($current_page > 1) {
                              echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
                            }
                            for ($i = 1; $i <= $total_pages; $i++) {
                              echo '<li class="page-item' . ($i == $current_page ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($current_page < $total_pages) {
                              echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
                            }
                            ?>
                          </ul>
                        </nav>
                      </div>
                    </div>
                  <?php
                }
                  ?>


                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
      <div class="col-md-1">&nbsp;</div>
    </div>
  </div>


</main><!-- End #main -->

<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>

</body>

<script>
  function toggleDropdown(collapseId) {
    const collapse = document.getElementById(collapseId);
    const accordions = document.querySelectorAll('[id^="collapse"]');
    accordions.forEach(acc => {
      if (acc.id !== collapseId && acc.classList.contains('show')) {
        acc.classList.remove('show');
      }
    });
    if (collapse.classList.contains('show')) {
      collapse.classList.remove('show');
    } else {
      collapse.classList.add('show');
    }
  }
</script>
<script>
  $(document).ready(function() {
    $("#search-input").on("keyup", function() {
      var searchText = $(this).val().toLowerCase();
      $(".tab-pane.show.active .col-md-4").filter(function() {
        var title = $(this).find(".text-black").text().toLowerCase();
        return title.indexOf(searchText) == -1;
      }).hide();
      $(".tab-pane.show.active .col-md-4").filter(function() {
        var title = $(this).find(".text-black").text().toLowerCase();
        return title.indexOf(searchText) != -1;
      }).show();
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</html>