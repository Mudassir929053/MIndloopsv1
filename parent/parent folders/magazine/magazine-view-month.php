<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
?>
<main id="main">
  <div class="container-fluid">
    <div class="row">
      <img src="../../assets/magazine/img/MagazineBanner1.png" class="img-fluid" alt="" style="width: 100%; padding: 0">
    </div>
  </div>
  <div class="container-fluid mt-5 ">
    <div class="row d-flex justify-content-center">
      <div class="col-md-1">&nbsp;</div>
      <div class="col-md-10">
        <div class="container-fluid mb-3">
          <div class="row d-flex justify-content-center">
            <div class="container">
              <div class="row">
                <a href="index.php" class="btn btn-warning col-lg-1 ">Go To Back</a>
              </div>
            </div>
          </div>
          <?php
          $rows_per_page = 3; // set the number of rows to display per page
          $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // get the current page number from the URL
          $year = isset($_GET['year']) ? (int)$_GET['year'] : null;
          $month = isset($_GET['month']) ? (int)$_GET['month'] : null;
          $query = "SELECT * FROM tb_magazines";
          if ($year && !$month) {
            $query .= " WHERE YEAR(m_rDate) = $year";
          } else if ($year && $month) {
            $query .= " WHERE YEAR(m_rDate) = $year AND MONTH(m_rDate) = $month";
          }
          $query .= " ORDER BY m_rDate DESC";
          // calculate the limit and offset for the query based on the current page number
          $offset = ($current_page - 1) * $rows_per_page;
          $query .= " LIMIT $rows_per_page OFFSET $offset";
          $result = mysqli_query($conn, $query);
          // get the total number of rows
          $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_magazines`"));
          // calculate the total number of pages
          $total_pages = ceil($total_rows / $rows_per_page);
          // Display the magazine images
          if (mysqli_num_rows($result) > 0) { ?>
            <div class="col-md-10">
              <div class="container-fluid">
                <div class="row">
                  <?php
                  while ($row = mysqli_fetch_assoc($result)) {
                    $image_path = $row['m_imgPath'];
                    $m_id = $row['m_id'];
                    $m_rDate = $row['m_rDate'];
                  ?>
                    <div class="col-md-4 p-5 " data-toggle="modal" data-target="#globalModal">
                      <a href="../magazine/flip/index.php?pageNum=1&m_id=<?php echo $m_id; ?>" target="_blank">
                        <img src="../<?= $image_path ?>" class="img-fluid" alt="">

                      </a>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                      <p class="card-text text-danger text-center font-weight-bold">No magazines found for the selected month.</p>
                    </div>
                    <div class="card-footer text-center">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <?php
          $year = isset($_GET['year']) ? (int)$_GET['year'] : null;
          $month = isset($_GET['month']) ? (int)$_GET['month'] : null;
          $url_params = '';
          if ($year) {
            $url_params .= '&year=' . $year;
          }
          if ($month) {
            $url_params .= '&month=' . $month;
          }
          // Modify the SQL query to filter results based on month and year
          $query = "SELECT * FROM tb_magazines WHERE 1=1";
          if ($year) {
            $query .= " AND YEAR(m_rDate) = $year";
          }
          if ($month) {
            $query .= " AND MONTH(m_rDate) = $month";
          }
          $query .= " ORDER BY m_rDate DESC";
          // Execute the modified SQL query to get the filtered results
          $result = mysqli_query($conn, $query);
          // Calculate the total number of rows
          $total_rows = mysqli_num_rows($result);
          // Calculate the total number of pages
          $total_pages = ceil($total_rows / $rows_per_page);
          // Output the pagination links
          if ($total_pages > 1) {
            echo '<nav aria-label="Page navigation">';
            echo '<ul class="pagination justify-content-center">';
            if ($current_page > 1) {
              echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . $url_params . '">Previous</a></li>';
            }
            for ($i = max(1, $current_page - 3); $i <= $current_page; $i++) {
              echo '<li class="page-item' . ($i == $current_page ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . $url_params . '">' . $i . '</a></li>';
            }
            for ($i = $current_page + 1; $i <= min($total_pages, $current_page + 0); $i++) {
              echo '<li class="page-item"><a class="page-link" href="?page=' . $i . $url_params . '">' . $i . '</a></li>';
            }
            if ($current_page < $total_pages) {
              echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . $url_params . '">Next</a></li>';
            }
            echo '</ul>';
            echo '</nav>';
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
<script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
<script src="../../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
<script src="../../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/vendor/aos-portfolio/aos.js"></script>
<!-- <script src="../../assets/js/main.js"></script> -->
<script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<!-- Jquery JS-->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
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
</html+
--+-$_CO