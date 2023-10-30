<?php include("../commonPHP/head.php"); ?>
<?php include("../commonPHP/topNavBarCheck.php"); ?>
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/student.css">
<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 d-none d-sm-block " style="background-image: url('../assets/discount_images/discount_thumbnail.png'); background-size: 100% 100%; background-repeat: no-repeat; height: 100vh;"></div>
      <!-- <div class="col-md-12 d-lg-none d-xl-block d-xxl-none" style="background-image: url('../../assets/discount_images/discount_thumbnail.png'); background-size: 100%; background-repeat: no-repeat; height: 25vh;"></div> -->
      <div class="col-md-12 d-lg-none d-lg-block d-md-none d-md-block" style="background-image: url('../assets/discount_images/discount_thumbnail.png'); background-size: 100%; background-repeat: no-repeat; height: 25vh;"></div>
    </div>
  </div>
  <div class="container">
    <br>
    <div class="d-grid gap-2 d-md-flex justify-content-md-start my-5">
      <a href="your-discount.php" class="btn btn-outline-warning text-danger fw-bolder btn-sm rounded-pill py-2 px-4" type="button">
        <span class="emoji" style="margin-right: 5px;">🎁</span> View Used Coupons
      </a>
    </div>
    <?php
    // Assuming you have a database connection established

    // Retrieve the discount categories from the database
    $sql = "SELECT DISTINCT discount_category FROM discounts";
    $result = mysqli_query($conn, $sql);
    // Check if there are any categories
    if (mysqli_num_rows($result) > 0) {
      $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
      <div class="container">
        <h3 class="text-center">Discount Categories</h3>
        <div class="container">
          <div class="row">
            <div class="col">
              <ul class="nav nav-pills justify-content-center text-uppercase mt-3" id="category-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="category-all-tab" data-toggle="pill" href="#category-all">All</a>
                </li>
                <?php
                // Generate the category tabs dynamically
                foreach ($categories as $category) {
                  // var_dump($category);
                  echo '<li class="nav-item">
                  <a class="nav-link" id="category-' . $category['discount_category'] . '-tab" data-toggle="pill" href="#category-' . $category['discount_category'] . '">' . $category['discount_category'] . '</a>
                </li>';
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
       
        <div class="tab-content">
          <div id="category-all" class="container tab-pane active">
            <h3 class="my-4 text-danger bg-white">All Discounts</h3>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
              <?php
              $query = "SELECT d.`discount_id`, d.`logo_image`, d.`title`, d.`start_date`, d.`end_date`, d.`description`, d.`discount_code`, d.`created_at`, d.`updated_at`
        FROM `discounts` d
        LEFT JOIN `redemptions` r ON d.`discount_id` = r.`discountId`
        WHERE r.`redemption_id` IS NULL";
              $result = mysqli_query($conn, $query);
              if (mysqli_num_rows($result) > 0) {
                $counter = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                  $discount_id = $row['discount_id'];
                  $logo_image = $row['logo_image'];
                  $title = $row['title'];
                  $description = $row['description'];
                  // Limit description to 100 characters
                  $description = substr($description, 0, 100);
              ?>
                  <div class="col mb-4" style="cursor: pointer;" onclick="window.location='collect_coupon.php?discount_id=<?php echo $discount_id; ?>'">
                    <div class="card h-100">
                      <img src="../assets/discount_images/<?php echo $logo_image; ?>" class="card-img-top custom-img" alt="Discount Logo">

                      <!-- <img src="../../assets/discount_images/<?php #echo $logo_image; 
                                                                  ?>" class="card-img-top" alt="Discount Logo"> -->
                      <div class="card-body d-flex pt-5 flex-column justify-content-end">
                        <h5 class="card-title text-success"><?php echo $title; ?></h5>
                        
                      </div>
                    </div>
                  </div>
              <?php
                 
                }
              } else {
                echo '<div class="col text-center">😔 Sorry, no discounts available at the moment.</div>';
              }
              ?>
            </div>
          </div>
          <?php
         
          // Generate the category content dynamically
          foreach ($categories as $category) {
            $categoryName = $category['discount_category'];
            $categoryQuery = "SELECT d.`discount_id`, d.`logo_image`, d.`title`, d.`start_date`, d.`end_date`, d.`description`,  d.`discount_code`, d.`created_at`, d.`updated_at`
            FROM `discounts` d
            LEFT JOIN `redemptions` r ON d.`discount_id` = r.`discountId`
            WHERE r.`redemption_id` IS NULL AND d.`discount_category` = '$categoryName'";
            $categoryResult = mysqli_query($conn, $categoryQuery);
            echo '<div id="category-' . $categoryName . '" class="container tab-pane fade">';
            echo '<h3 class="my-4 text-danger bg-white">' . $categoryName . '</h3>';
            if (mysqli_num_rows($categoryResult) > 0) {
              echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">';
              while ($row = mysqli_fetch_assoc($categoryResult)) {
                $discount_id = $row['discount_id'];
                $logo_image = $row['logo_image'];
                $title = $row['title'];
                $description = $row['description'];
                // Limit description to 100 characters
                $description = substr($description, 0, 100);
          ?>
                <div class="col mb-4" onclick="window.location='collect_coupon.php?discount_id=<?php echo $discount_id; ?>'">
                  <div class="card h-100">
                    <img src="../assets/discount_images/<?php echo $logo_image; ?>" class="card-img-top custom-img"  alt="Discount Logo">
                    <div class="card-body d-flex flex-column pt-5 justify-content-end">
                      <h5 class="card-title text-success"><?php echo $title; ?></h5>
                      
                    </div>
                  </div>
                </div>
          <?php
              }
              echo '</div>';
            } else {
              echo '<div class="col text-center">😔 Sorry, no discounts available in ' . $categoryName . ' category.</div>';
             
            }
            echo '</div>';
          }
          ?>
        </div>
      </div>
    <?php
    } else {
      echo "No categories found.";
    }
   
    ?>
  </div>


</main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<!-- <script src="../assets/vendor/jquery/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <script>
          $(document).ready(function() {
            // Enable Bootstrap Scrollspy to detect the active category tab
            $('body').scrollspy({
              target: '#category-tabs'
            });
            // Adjust the category tabs container width based on the number of tabs
            var numTabs = $('#category-tabs').find('.nav-link').length;
            var containerWidth = numTabs * 120; // Adjust the width as needed
            // $('#category-tabs').css('width', containerWidth + 'px');
          });
</script>
</body>

</html>