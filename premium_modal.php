<?php
if (!session_id()) {
  session_start();
}

?>
<style>
  .modal.fade .modal-dialog.modal-dialog-zoom {
    -webkit-transform: translate(0, 0) scale(.5);
    transform: translate(0, 0) scale(.5);
  }

  .modal.show .modal-dialog.modal-dialog-zoom {
    -webkit-transform: translate(0, 0) scale(1);
    transform: translate(0, 0) scale(1);
  }

  .modal-dialog-centered li {
    font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  }


  .modal-body.premium {
    background-repeat: no-repeat;
    background-color: #fcfafd;
    padding: 20px;
    margin-left: 0;
    padding: 0;
  }

  .premium.fs-5 {
    font-weight: 500;
  }

  .modal-subtitle.premium {
    list-style-type: none;
    margin-left: 0;
    padding-left: 0;
    font-size: medium;
    font-weight: 600;
  }

  .btn-primary {
    background-color: #E31568;
    border-radius: 20px;
    border: 0;
    margin-right: 20px;
    padding: 6px 15px;
  }

  .btn-secondary {
    background-color: #fcfafd;
    border-radius: 20px;
    border: none;
    color: black;
    font-weight: 500;
    padding: 6px 15px;
  }



  @media (max-width: 576px) {
    .modal-body .row {
      flex-direction: column;
      align-items: center;
    }

    .modal-body .col-lg-4 {
      display: none;
    }
  }
</style>

<!-- Modal For Student -->
<div class="modal fade" id="premiumModal" tabindex="-1" role="dialog" aria-labelledby="globalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-body premium">
        <div class="row">
          <div class="col-lg-4 col-sm-4 pt-5">
            <?php
            if (isset($_SESSION["userType"])) {
              // User is logged in
              $userID = $_SESSION["userType"];
              if ($userID == 2 || $userID == 4) { ?>
                <img src="../../assets/premium_images/Group_440.png" alt="" style="padding-left: 40px;height:80%;width: 100%;" class="img-fluid">

              <?php } else {
              ?>
                <img src="../assets/premium_images/Group_440.png" alt="" style="padding-left: 40px;height:80%;width: 100%;" class="img-fluid">
            <?php }
            } ?>
            <!-- <img src="../assets/premium_images/Group_440.png" alt="" style="padding-left: 40px;height:80%;width: 100%;" class="img-fluid"> -->
          </div>
          <div class="col-lg-7 col-sm-8">
            <div class="modal-title premium text-center pt-4">
              <b>Don't miss out on</b>
              <p class="premium fs-5">Monthly content updates and exclusive <br>benefits for our premium members!<br>Would you like to enjoy these benefits?</p>
            </div>
            <ul class="list-unstyled p-4">
              <li class="d-flex align-items-center mb-3">
                <i class="fas fa-check icon-img mx-2" style="color: #00BFFF
;"></i>
                <span>Free 30 days unlimited access.</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="fas fa-check icon-img mx-2" style="color: #00BFFF
;"></i>
                <span class="mb-2">Exclusive monthly discounts and offers from our partners.</span>
              </li>
              <li class="d-flex align-items-center">
                <i class="fas fa-check icon-img mx-2" style="color: #00BFFF
;"></i>
                <span>Unlimited Access to all our contents and features.</span>
              </li>
            </ul>



            <div class="text-center">
              <?php
              if (isset($_SESSION["userType"])) {
                // User is logged in
                $userID = $_SESSION["userType"];
                if ($userID == 3) {
                  // Display the "Upgrade to premium" button without the user profile link
                  // echo '<a href="#" class="btn btn-primary btn-md mb-2" data-dismiss="modal">Upgrade to premium</a><br>';
                  echo '<a href="#" class="btn btn-primary btn-md mb-2" data-dismiss="modal" onclick="upgradeToPremium()">Upgrade to premium</a><br>';
                } else {
                  // Display the "Upgrade to premium" button with the user profile link
                  echo '<a href="../subscription/user-profile.php?subs=yes" class="btn btn-primary btn-md mb-2" data-dismiss="modal">Upgrade to premium</a><br>';
                }
              } else {
                // User is not logged in, display the "Upgrade to premium" button without the user profile link
                echo '<a href="#" class="btn btn-primary btn-md mb-2" data-dismiss="modal">Upgrade to premium</a><br>';
              }
              ?>


              <button type="button" class="btn btn-secondary btn-md mb-3" data-bs-dismiss="modal">Not now</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Of Modal For Student -->
<script>
  function upgradeToPremium() {
    alert("Only parents can buy premium membership.");
  }
</script>