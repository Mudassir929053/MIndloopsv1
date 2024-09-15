<?php

if (!isset($_COOKIE['userType']) && (isset($no_redirect))) {
  $no_redirect = true;
  header('Location: ../public/index.php');
  exit;
} else {
  $user_type = isset($_COOKIE['userType']) ? $_COOKIE['userType'] : '';
}
?>
<?php if ($user_type == 'Student') { ?>

  <link rel="stylesheet" href="../assets/css/global_modal_student.css">

<?php } else if ($user_type == 'Teacher') { ?>

  <link rel="stylesheet" href="../assets/css/global_modal_teacher.css">

<?php } else if ($user_type == 'Parent') { ?>

  <link rel="stylesheet" href="../assets/css/global_modal_parent.css">

<?php
}
?> 

<?php if ($user_type == 'Student') { ?>
  <!-- Modal For Student -->
  <div class="modal fade" id="globalModal" tabindex="-1" role="dialog" aria-labelledby="globalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-7 col-md-12 pt-md-5 mt-md-5">
              <b class="modal-title">Talk to your guardian</b>
              <p class="modal-subtitle">To enjoy our contents!</p>
              <a href="/mindloops/login_and_register/login.php" class="btn btn-primary btn-sm">Subscribe Now</a>
              <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal">Ask me Later</a>
            </div>
            <div class="col-lg-5 col-md-12">
            <img class="img-fluid" src="../assets/global_modal_images/student.png" alt="Student Image">
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Of Modal For Student -->
<?php } else if ($user_type == 'Teacher') { ?>

  <!-- Modal For Teacher -->
  <div class="modal fade" id="globalModal" tabindex="-1" role="dialog" aria-labelledby="globalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body pt-5 pb-5">
        <div class="row">
          <div class="col-lg-7 col-md-12 pt-md-5 mt-md-5">
            <b class="modal-title">Explore & Discover</b>
            <p class="modal-subtitle">Learning materials to be used for your classroom when you subscribe with us!</p>
            <a href="/mindloops/login_and_register/login.php" class="btn btn-primary btn-sm">Subscribe Now</a>
            <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal">Ask me Later</a>
          </div>
          <div class="col-lg-5 col-md-12 pt-lg-5">
            <img class="img-fluid" src="../assets/global_modal_images/teacher.png" alt="Teacher Image">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- End Of Modal For Teacher -->


<?php } else if ($user_type == 'Parent') { ?>

  <!-- Modal For Parent -->
  <div class="modal fade" id="globalModal" tabindex="-1" role="dialog" aria-labelledby="globalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body pt-5 pb-5 px-2">
          <div class="row">
            <div class="col-lg-6 col-md-12 pt-md-5 mt-md-5 offset-md-1">
              <b class="modal-title">Like What you're looking at?</b>
              <p class="modal-subtitle">Subscribe now to gain access to learning materials for your children!</p>
              <a href="/mindloops/login_and_register/login.php" class="btn btn-primary btn-sm">Subscribe Now</a>
              <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal">Ask me Later</a>
            </div>
            <div class="col-lg-4 col-md-12 pt-lg-5">
            <img class="img-fluid" src="../assets/global_modal_images/parent.png" alt="Parent Image">
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Of Modal For Parent -->


<?php
}
?>