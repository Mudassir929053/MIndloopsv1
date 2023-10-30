<?php include("../commonPHP/head.php"); ?>

<?php include("../commonPHP/topNavBarCheck.php"); ?>
<link href="../../assets/css/teacher.css" rel="stylesheet">



<main>
  <div class="container">
    <br>
    <div class="d-grid gap-2 d-md-flex justify-content-md-start my-5">
  <a href="discount.php" class="btn btn-outline-warning text-danger fw-bolder btn-sm rounded-pill py-2 px-4" type="button">
    <span class="emoji" style="margin-right: 5px;">🎉</span> View Available Coupons
  </a>
</div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">
      <?php
      $query = "SELECT d.`discount_id`, d.`logo_image`, d.`title`, d.`start_date`, d.`end_date`, d.`description`, d.`discount_code`, d.`created_at`, d.`updated_at`, r.`redeemed_at` 
      FROM `discounts` d LEFT JOIN `redemptions` r ON d.`discount_id` = r.`discountId` 
      WHERE r.`redemption_id`";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $discount_id = $row['discount_id'];
          $logo_image = $row['logo_image'];
          $title = $row['title'];
          $redeemed_at = $row['redeemed_at'];
          $formatted_redeemed_at = date("l, j F Y", strtotime($redeemed_at));
          ?>
          <div class="col mb-4">
            <div class="card h-100">
            <img src="../../assets/discount_images/<?php echo $logo_image; ?>" class="card-img-top custom-img" alt="Discount Logo">
                    
              <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title text-success"><?php echo $title; ?></h5>
                <p class="text-muted">Cheers! I'm glad you enjoyed the discounts.</p>
                <p class="card-text text-danger">Redeemed on <span class="text-info"><?php echo $formatted_redeemed_at; ?></span></p>
              </div>
            </div>
          </div>
        <?php
        }
      } else {
        echo '
        <div class="col-12 my-5">
          <div class="text-center">
            <p class="text-danger mt-3 display-6">Oops! You haven\'t redeemed any discounts yet. 😔</p>
            <p class="text-muted">Don\'t miss out on incredible savings! Explore our available coupons and unlock amazing deals on your next order!</p>
          </div>
        </div>
      ';
      }
      ?>
    </div>
  </div>
</main>



<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/teachsupport.js"></script>
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
<script src="../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
<script src="../assets/vendor/aos-portfolio/aos.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
