<?php include("../commonPHP/head.php"); ?>
<?php
if (!session_id()) {
  session_start();
}
if ($_SESSION["userType"] != '2' && $_SESSION["userType"] != '3' && $_SESSION["userType"] != '4') {
  echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
}
include 'subscriber-member-function.php';
// $couponcode = 'ML523NSD';

?>
<?php
// Get the subscriber ID from the session
$subscriber_id = $_SESSION['u_id'];

// Fetch subscription data from the database
$sql = "SELECT * FROM tb_users WHERE u_id = '$subscriber_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $_SESSION['referralcode'] = $row['u_referral_code'];
  }
}

if (isset($_GET['subs'])) {
  $show_active = '';
  $active = '';
  $view_sub = ' show active';
  $view_tab = ' active';
} else {
  $show_active = ' show active';
  $active = 'active';

  $view_sub = '';
  $view_tab = '';
}
// Get the subscription start and end dates
?>
<link rel="stylesheet" href="../assets/css/style.css">
<link href="../../assets/css/packageTest.css" rel="stylesheet">
</link>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
<link rel="stylesheet" href="../../assets/css/parent.css">
<body class="imagebackground">
  <?php include("../commonPHP/topNavBarCheck.php"); ?>
  <?php
  $subscriber_id = $_SESSION['u_id'];
  // Perform the query
  $sql = "SELECT * FROM tb_users WHERE u_parent_user_id = '$subscriber_id'";
  $result = mysqli_query($conn, $sql);
  // Get the row count
  $row_count = mysqli_num_rows($result);
  ?>
  <?php
  $subscriber_id = $_SESSION['u_id'];

  // Perform the query
  $sql = "SELECT COUNT(*) AS child_count FROM tb_users WHERE u_parent_user_id = '$subscriber_id'";
  $result = mysqli_query($conn, $sql);

  // Check if the query was successful
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $child_count = $row['child_count'];
  } else {
    // Handle the query error
    echo "Error: " . mysqli_error($conn);
  }
  ?>
  <?php
  // Get the subscriber ID from the session
  $subscriber_id = $_SESSION['u_id'];
  // Fetch subscription data from database
  $sql = "SELECT * FROM tb_users LEFT JOIN subscription on tb_users.u_id = subscription.subscriber_id WHERE u_id = '$subscriber_id' order by s_end_date desc limit 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      // Get the subscription start and end dates
  ?>

      <div class="container my-5">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end my-2">

          <button class="btn btn-sm btn-warning rounded-0 fw-bolder float-right" data-bs-toggle="modal" data-bs-target="#reffrealmodal">🎁 Refer & Earn</button>

          <!-- <button type="button" class="btn btn-outline-primary me-1 btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#reffrealmodal">Update</button> -->
          <div class="modal fade custom-modal" id="reffrealmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <img src="../../assets/img/Referral_bg.png" class="img-fluid full-width" alt="Cover Image">
                    <button class="btn coupon-button text-danger fw-bold" id="coupon-button" data-coupon="<?= $_SESSION['referralcode'] ?>">
                      <?= $_SESSION['referralcode'] ?>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <script>
            document.getElementById('coupon-button').addEventListener('click', function() {
              var code = this.getAttribute('data-coupon');
              navigator.clipboard.writeText(code)
                .then(function() {
                  alert('Code copied to clipboard');
                })
                .catch(function() {
                  alert('Failed to copy code to clipboard');
                });
            });
          </script>

        </div>
        <ul class="nav nav-pills mb-3 fw-bolder rounded-0 justify-content-center text-uppercase" id="pills-tab" role="tablist">
          <li class="nav-item mx-3" role="presentation">
            <button class="nav-link1 btn-sm text-uppercase rounded-0 btn-warning <?= $active ?>" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profile</button>
          </li>
          <!-- <li class="nav-item mx-3" role="presentation">
            <button class="nav-link btn-sm text-uppercase rounded-0 btn-warning <?= $view_tab ?>" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Subscription</button>
          </li> -->
          <li class="nav-item mx-3" role="presentation">
            <button class="nav-link1 btn-sm text-uppercase rounded-0 btn-warning" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Manage Children</button>
          </li>
          <li class="nav-item mx-3" role="presentation">
            <button class="nav-link1 btn-sm text-uppercase rounded-0 btn-warning" id="pills-referrals-tab" data-bs-toggle="pill" data-bs-target="#pills-referrals" type="button" role="tab" aria-controls="pills-referrals" aria-selected="false">Your Referrals</button>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade <?= $show_active ?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="container py-5">
              <div class="row justify-content-center">
                <div class="col col-md-9 col-lg-7 col-xl-5">
                  <div class="card border-0 shadow" style="border-radius: 15px;">
                    <div class="card-body p-4">
                      <div class="d-flex align-items-center">
                        <div class=" d-flex justify-content-center flex-column">
                          <h5 class="mb-1"><?php echo $row['u_name']; ?></h5>
                          <div class="mb-3 text-center text-secondary">Parent Account</div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-start align-items-center bg-light rounded p-2 mb-2">
                        <div class="me-3">
                          <p class="small text-muted mb-1">Email</p>
                          <p class="mb-0"><?php echo   $row['u_email']; ?></p>
                        </div>
                      </div>
                      <div class="d-flex justify-content-start align-items-center bg-light rounded p-2 mb-2">
                        <div class="me-3">
                          <p class="small text-muted mb-1">Mobile No</p>
                          <p class="mb-0"><?php echo $row['u_contact']; ?></p>
                        </div>
                      </div>
                      <div class="d-flex justify-content-start align-items-center bg-light rounded p-2 mb-2">

                        <div>
                          <p class="small text-muted mb-1">Children</p>
                          <p class="small text-muted mb-1"><?php echo $child_count; ?></p>
                        </div>

                      </div>
                      <div class="d-flex pt-1">
                        <!-- <button type="button" class="btn btn-warning btn-sm fw-bold btn-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Update Details
                  </button> -->
                        <button type="button" class="btn btn-outline-primary me-1 flex-grow-1" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['u_id']; ?>">Update</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="exampleModal<?php echo $row['u_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Update Details</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="post">
                    <div class="row mb-3">
                      <div>
                        <label for="email" class="form-label fw-bold">Email</label>
                        <div class="input-group">
                          <input type="email" class="form-control" id="email" name="update_email" placeholder="Enter Email" aria-label="Email" value="<?php echo $row['u_email']; ?>">
                        </div>
                      </div>
                      <input type="hidden" name="user_id" value="<?= $row['u_id'] ?>">
                      <div>
                        <label for="mobile" class="form-label fw-bold">Mobile No.</label>
                        <div class="input-group">
                          <input type="number" class="form-control" id="mobile" name="update_mobile" placeholder="Enter Mobile Number" aria-label="Mobile" value="<?php echo $row['u_contact']; ?>">
                        </div>
                      </div>
                      <div>
                        <label for="password" class="form-label fw-bold">Password</label>
                        <div class="input-group">
                          <input type="password" class="form-control" id="password" name="update_password" placeholder="Enter Password" aria-label="Password" aria-describedby="password-addon">
                          <button class="btn btn-outline-secondary" type="button" id="password-addon" data-bs-toggle="tooltip" data-bs-placement="top" title="Show password" onclick="togglePasswordVisibility('password-addon', 'password')">
                            <i class="bi bi-eye"></i>
                          </button>
                        </div>
                      </div>
                      <div>
                        <label for="confirm-password" class="form-label fw-bold">Confirm Password</label>
                        <div class="input-group">
                          <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="confirm-password-addon">
                          <button class="btn btn-outline-secondary" type="button" id="confirm-password-addon" data-bs-toggle="tooltip" data-bs-placement="top" title="Show password" onclick="togglePasswordVisibility('confirm-password-addon', 'confirm-password')">
                            <i class="bi bi-eye"></i>
                          </button>
                        </div>
                        <div class="invalid-feedback">
                          Please enter the same password as above.
                        </div>
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col text-end">
                    <button type="submit" name="update_parent" class="btn btn-warning btn-sm m-3">Update</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
      <?php
    }
  } else {
    echo "No subscriptions found.";
  }
      ?>

      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade <?= $view_sub ?>" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <div class="container">
            <h1 class="text-center my-5 text-danger" id="subs">Subscription</h1>
            <div class="row">
              <div class="container">
                <?php
                $user_id = $_SESSION['u_id'];
                $usersql = "SELECT * FROM tb_users WHERE u_id = '$user_id'";
                $result = $conn->query($usersql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    // Store the user details in session variables
                    $_SESSION['u_email'] = $row['u_email'];
                    $_SESSION['name'] = $row['u_name'];
                    // $_SESSION['u_full_name'] = $row['u_full_name'];
                    // Add any other details you want to store in session variables
                    // ...
                  }
                }
                ?>
                <?php
                // Get the subscriber ID from the session
                $subscriber_id = $_SESSION['u_id'];
                // Fetch subscription data from the database
                $sql = "SELECT * FROM tb_users LEFT JOIN subscription ON tb_users.u_id = subscription.subscriber_id WHERE u_id = '$subscriber_id' order by s_end_date desc limit 1";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    // Get the subscription start and end dates
                    $start_date = $row['s_start_date'];
                    $end_date = $row['s_end_date'];
                    // Calculate the subscription progress
                    $start_time = strtotime($start_date);
                    $end_time = strtotime($end_date);
                    $current_time = time();
                    $total_duration = $end_time - $start_time;
                    $elapsed_duration = $current_time - $start_time;
                    $remaining_duration = $end_time - $current_time;
                    $progress = ($total_duration > 0) ? round($elapsed_duration / $total_duration * 100) : 0;
                    $days_left = ($total_duration > 0) ? round($remaining_duration / (24 * 60 * 60)) : 0;
                    // Check if subscription is active or expired
                    $is_active = ($current_time >= $start_time && $current_time <= $end_time);
                    // Show the progress bar and days left if the subscription is active
                    if ($is_active) {
                ?>
                      <div class="container text-center">
                        <div class="progress " role="progressbar" aria-label="Subscription progress" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100">
                          <?php if ($progress < 25) { ?>
                            <div class="progress-bar bg-danger" style="width: <?php echo $progress; ?>%"></div>
                          <?php } elseif ($progress < 50) { ?>
                            <div class="progress-bar bg-danger" style="width: <?php echo $progress; ?>%"></div>
                          <?php } elseif ($progress < 75) { ?>
                            <div class="progress-bar bg-danger" style="width: <?php echo $progress; ?>%"></div>
                          <?php } else { ?>
                            <div class="progress-bar bg-danger" style="width: <?php echo $progress; ?>%"></div>
                          <?php } ?>
                        </div>
                        <p class="mt-3"><?php echo $days_left; ?> days left</p>
                      </div>
                    <?php
                    } else {
                      // Show the package details if the subscription is expired
                    ?>
                      <div id="package_single">
                        <?php
                        $sql = "SELECT * FROM tb_spackages WHERE p_id LIKE '1%'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                          $output = '<div class="container" id="packageContainer">
                        <div class="row" id="packages">';
                          $i = 0;
                          $cssArray = array();
                          while ($row = $result->fetch_assoc()) {
                            if ($i % 2 == 0) {
                              $back = '#52c9ef';
                            } else {
                              $back = '#ea2d48';
                            }
                            $output .= '<div class="col-md-5">
                            <div class="pricingTable" style="background: ' . $back . '">
                                <div class="pricingTable-header">
                                    <br><br>
                                    <h3 class="title">' . $row['p_name'] . '</h3>
                                </div>';
                            $description = $row['p_desc'];
                            $str_arr = explode(",", $description);
                            foreach ($str_arr as $value) {
                              $output .= '<ul class="pricing-content">
                                <li>' . $value . '</li>
                            </ul>';
                            }
                            $duration = $row['p_duration'];
                            $price = $row['p_price'];
                            $durationType = substr($duration, strpos($duration, " ") + 1);
                            $frontCurrency = 'RM';
                            $frontPrice = strtok($price, '.');
                            if (($pos = strpos($price, ".")) !== FALSE) {
                              $backPrice = substr($price, strpos($price, ".") + 1);
                            } else {
                              $backPrice = "00";
                            }
                            if ($backPrice != '0') {
                              $output .= '<div class="price-value">
                                <span class="currency">' . $frontCurrency . '</span>
                                <span class="amount">' . $frontPrice . '</span>
                                <span class="cent">' . $backPrice . '</span>
                                <span class="duration">per ' . strtolower($durationType) . '</span>
                            </div>';
                            } else {
                              $output .= '<div class="price-value">
                                <span class="cent">' . $frontCurrency . '</span>
                                <span class="amount">' . $frontPrice . '</span>
                                <span class="currency">.00</span>
                                <span class="duration">/ ' . strtolower($durationType) . '</span>
                            </div>';
                            }
                            $modalID = 'modal_' . $row['p_id'];
                            $output .= '<div class="pricingTable-signup">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#' . $modalID . '">Buy Now</button>
                        </div>
                    </div>
                </div>';
                            $output .= '<div class="modal fade" id="' . $modalID . '" tabindex="-1" aria-labelledby="modalLabel_' . $modalID . '" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                              <div class="modal-body">
                                  <div class="mb-3">
                                      <h5 class="text-center">Your Order</h5>
                                      <p><span class="fw-bold">Name:</span> ' . $_SESSION['name'] . '</p>
                                      <p><span class="fw-bold">Email:</span> ' . $_SESSION['u_email'] . '</p>
                                      <p><span class="fw-bold">Package Name:</span> ' . $row['p_name'] . '</p>
 
                                      <div class="mb-3">
                                      <label for="couponCode" class="form-label fw-bold">Coupon Code:</label>
                                      <div class="input-group">
                                        <input type="text" class="form-control" id="couponCode" name="couponCode">
                                        <button class="btn btn-success btn-sm fw-bold" id="applyCoupon" type="button">Apply</button>
                                      </div>
                                      <div id="couponCodeStatus" class="mt-2"></div>
                                    </div>
 
                                      <p>
                                      <span class="fw-bold">Packege Amount:</span>
                                      <span  class="fw-bold" style="float: right;">RM: ' . $row['p_price'] . '</span>
                                    </p>
                                      <p>
                                      <span class="fw-bold">Discount Amount:</span>
                                      <span id="discountAmount" class="fw-bold" style="float: right;">RM: 0</span>
                                    </p>
                                    <p>
                                      <span class="fw-bold">Pay Amount:</span>
                                      <span id="totalAmount" class="fw-bold" style="float: right;">RM: ' . $row['p_price'] . '</span>
                                    </p>
                                  </div>
                                  <form action="billplz/billplzpost.php" method="post">
                                  <input type="hidden" class="form-control" name="packagename" value="' . $row['p_name'] . '" readonly>
                                  <input type="hidden" class="form-control" name="amount" id="amountValue" value="' . $row['p_price'] . '" readonly>
                                  <input type="hidden" class="form-control" name="pid" value="' . $row['p_id'] . '" readonly>
                                  <input type="hidden" class="form-control" name="name" value="' . $_SESSION['name'] . '" readonly>
                                  <input type="hidden" class="form-control" name="email" value="' . $_SESSION['u_email'] . '" readonly>
                                  <input type="hidden" class="form-control" name="couponAmount" id="couponAmount" value="">
                                  <input type="hidden" class="form-control" name="u_id" value="' . $_SESSION['u_id'] . '" readonly>
                                  <button type="submit" class="btn btn-warning btn-sm fw-bold rounded-0" id="purchaseButton">Confirm Purchase</button>
                                </form>
 
 
 
                              </div>
                          </div>
                      </div>
                  </div>';
                            array_push($cssArray, "subscriptionPackage" . $i);
                            $i++;
                          }
                          $output .= "</div></div>";
                          echo $output;
                        } else {
                          echo "No results";
                        }
                        ?>
                      </div>
                <?php
                    }
                  }
                }
                ?>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                  $(document).ready(function() {
                    $('#applyCoupon').click(function() {
                      var couponCode = $('#couponCode').val();
                      $.ajax({
                        url: 'validate_coupon.php',
                        type: 'POST',
                        data: {
                          couponCode: couponCode
                        },
                        dataType: 'json',
                        success: function(response) {
                          if (response.valid) {
                            var discountPercentage = response.discount; // Assuming the response contains the discount percentage
                            var packageAmount = parseFloat($('#amountValue').val());
                            var discount = (discountPercentage / 100) * packageAmount;
                            var discountedAmount = packageAmount - discount;
                            var discountedAmount1 = Number(discount).toFixed(2);;
                            $('#discountAmount').text('RM: ' + discountedAmount1).css('color', 'green');
                            $('#totalAmount').text('RM: ' + discountedAmount).css('color', 'green');
                            $('#couponCodeStatus').text('Coupon applied successfully!').css('color', 'green');
                            // Set the coupon amount in the hidden input field
                            $('#couponAmount').val(discount);
                          } else {
                            $('#discountAmount').text('').css('color', 'green'); // Clear the discount amount
                            $('#totalAmount').text('RM: ' + $('#amountValue').val()).css('color', 'black'); // Reset the total amount to the original value
                            $('#couponCodeStatus').text('Invalid coupon code. Please try again.').css('color', 'red');
                          }
                        },

                        error: function() {
                          $('#discountAmount').text('').css('color', 'green'); // Clear the discount amount
                          $('#totalAmount').text('RM: ' + $('#amountValue').val()).css('color', 'green'); // Reset the total amount to original value
                          $('#couponCodeStatus').text('Error occurred while validating the coupon code.').css('color', 'red');
                        }
                      });
                    });
                  });
                </script>
                <div class="row justify-content-center">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="card-title">Subscription Details</h5>
                      </div>
                      <div class="container">
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>Subscription Name</th>
                                <th>Transaction ID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Discount</th>
                                <th>Paid Amount</th>
                                <th>Total Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              // Retrieve subscription data from the database
                              $stmt = $conn->prepare("SELECT * FROM subscription WHERE subscriber_id = ?");
                              $stmt->bind_param("s", $_SESSION['u_id']);
                              $stmt->execute();
                              $result = $stmt->get_result();

                              // Check if there are any subscription records
                              if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                  $subscriptionType = $row['s_packege_code'];
                                  $transaction_id = $row['transaction_id'];
                                  $startDate = $row['s_start_date'];
                                  $endDate = $row['s_end_date'];

                                  $formattedStartDate = date('F j, Y', strtotime($startDate));
                                  $formattedEndDate = date('F j, Y', strtotime($endDate));

                                  $discountAmount = $row['s_discount_amount'] / 100; // Assuming the discount amount is stored in the 'discount_amount' column
                                  $PaidAmount = $row['s_amount'] / 100; // Assuming the discount amount is stored in the 'discount_amount' column
                                  $totalAmount = $row['s_total_amount'] / 100; // Assuming the total amount is stored in the 'total_amount' column
                              ?>
                                  <tr>
                                    <td><?php echo $subscriptionType; ?></td>
                                    <td><?php echo $transaction_id; ?></td>
                                    <td><?php echo $formattedStartDate; ?></td>
                                    <td><?php echo $formattedEndDate; ?></td>
                                    <td>RM <?php echo $discountAmount; ?></td>
                                    <td>RM <?php echo $PaidAmount; ?></td>
                                    <td>RM <?php echo $totalAmount; ?></td>
                                  </tr>
                              <?php
                                }
                              } else {
                                // Display a message if there are no subscription records
                                echo '<tr><td colspan="6" class="text-center">Oops! No subscription records found.</td></tr>';
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
          <!-- <h1>Hello</h1> -->
          <div class="container">
            <h1 class="text-center my-5 text-danger">Manage Children</h1>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <?php
              $user_id = $_SESSION['u_id'];
              // Perform the query
              $sql = "SELECT * FROM tb_users WHERE u_parent_user_id = '$user_id'";
              $result = mysqli_query($conn, $sql);
              // Get the row count
              $row_count = mysqli_num_rows($result);
              // Check if the user has a subscription
              $sql_subscription = "SELECT * FROM subscription WHERE subscriber_id = '$user_id'";
              $result_subscription = mysqli_query($conn, $sql_subscription);
              $row_count_subscription = mysqli_num_rows($result_subscription);
              if ($row_count_subscription > 0) {
                // Check if the user has added three children
                if ($row_count < 4) {
                  // Display the "Add 3 Child" button
                  echo '
        <button type="button" class="btn btn-warning btn-center btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#addMember">
            Add  Child
        </button>';
                }
              } else {
                // Check if the user has added at least one child
                if ($row_count >= 1) {
                  // Display the "Add More" button
                  echo '
        <button type="button" class="btn btn-warning btn-center btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#requestModal">
            Add More
        </button>';
                } else {
                  // Display the "Add Member" button
                  echo '
        <button type="button" class="btn btn-warning btn-center btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#addMember">
            Add Member
        </button>';
                }
              }
              ?>
            </div>
            <div class="row">
              <div class="container py-5">
                <div class="row justify-content-center">
                  <div class="col-md-8">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="card-title">Children Details</h5>
                      </div>
                      <div class="card-body">
                        <?php
                        // Get the subscriber ID from the session
                        $subscriber_id = $_SESSION['u_id'];
                        // Fetch subscription data from database
                        $sql = "SELECT * FROM tb_users LEFT JOIN subscription ON tb_users.u_id = subscription.subscriber_id WHERE u_parent_user_id = '$subscriber_id'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                          $column_counter = 0; // initialize column counter
                        ?>
                          <div class="col">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Date of Birth</th>
                                  <th>Age</th>
                                  <th>Grade</th>
                                  <th width="10px">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                  if ($column_counter % 3 == 0) {
                                    // start a new row after every 3 columns
                                    if ($column_counter > 0) {
                                      echo '</tbody></table></div></div><div class="col"><div class="row"><table class="table"><tbody>';
                                    }
                                  }
                                  $birthDate = $row['u_age'];
                                  $today = new DateTime();
                                  $diff = $today->diff(new DateTime($birthDate));
                                  $age = $diff->y;
                                ?>
                                  <tr>
                                    <td><?php echo $row['u_name']; ?></td>
                                    <td><?php echo $row['u_email']; ?></td>
                                    <td><?php echo $row['u_age']; ?></td>
                                    <td><?php echo $age; ?></td>
                                    <td><?php echo $row['u_grade']; ?></td>
                                    <td>
                                      <div class="d-flex">
                                        <button type="button" class="btn btn-outline-primary me-1 btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#editModel<?php echo $row['u_id']; ?>">Update</button>
                                        <form method="post" action="subscriber-member-function.php">
                                          <input type="hidden" name="u_id" id="u_id" value="<?php echo $row['u_id']; ?>">
                                          <button type="submit" name="delete" class="btn btn-danger btn-sm fw-bold ms-2">Delete</button>
                                        </form>
                                      </div>
                                    </td>
                                  </tr>
                                  <div class="modal fade" id="editModel<?php echo $row['u_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Details</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <form method="post">
                                            <div class="row mb-3">
                                              <div>
                                                <label for="email" class="form-label fw-bold">Email</label>
                                                <div class="input-group">
                                                  <input type="email" class="form-control" id="email" name="update_email" placeholder="Enter Email" aria-label="Email" value="<?php echo $row['u_email']; ?>">
                                                </div>
                                              </div>
                                              <div>
                                                <label for="u_name" class="form-label fw-bold">Name</label>
                                                <div class="input-group">
                                                  <input type="text" class="form-control" id="u_name" name="u_name" placeholder="Enter Name" aria-label="u_name" value="<?= $row['u_name'] ?>">
                                                </div>
                                              </div>
                                              <input type="hidden" name="user_id" value="<?= $row['u_id'] ?>">
                                              <div>
                                                <label for="mobile" class="form-label fw-bold">Mobile No.</label>
                                                <div class="input-group">
                                                  <input type="number" class="form-control" id="mobile" name="update_mobile" placeholder="Enter Mobile Number" aria-label="Mobile" value="<?php echo $row['u_contact']; ?>">
                                                </div>
                                              </div>
                                              <div>
                                                <label for="registerAge" class="form-label fw-bold">Birth Date.</label>
                                                <div class="input-group">
                                                  <input type="date" class="form-control" id="registerAge" name="registerAge" placeholder="Enter Date of Birth" aria-label="Mobile" value="<?php echo $row['u_age']; ?>">
                                                </div>
                                              </div>
                                              <div>
                                                <label for="grade" class="form-label fw-bold">Grade:</label>
                                                <div class="input-group">
                                                  <select class="form-select" id="grade" name="grade">
                                                    <option value="1" <?php if ($row['u_grade'] == '1') echo ' selected'; ?>>Grade 1</option>
                                                    <option value="2" <?php if ($row['u_grade'] == '2') echo ' selected'; ?>>Grade 2</option>
                                                    <option value="3" <?php if ($row['u_grade'] == '3') echo ' selected'; ?>>Grade 3</option>
                                                    <option value="4" <?php if ($row['u_grade'] == '4') echo ' selected'; ?>>Grade 4</option>
                                                    <option value="5" <?php if ($row['u_grade'] == '5') echo ' selected'; ?>>Grade 5</option>
                                                    <option value="6" <?php if ($row['u_grade'] == '6') echo ' selected'; ?>>Grade 6</option>
                                                    <option value="7" <?php if ($row['u_grade'] == '7') echo ' selected'; ?>>Grade 7</option>
                                                    <option value="8" <?php if ($row['u_grade'] == '8') echo ' selected'; ?>>Grade 8</option>
                                                    <option value="9" <?php if ($row['u_grade'] == '9') echo ' selected'; ?>>Grade 9</option>
                                                    <option value="10" <?php if ($row['u_grade'] == '10') echo ' selected'; ?>>Grade 10</option>
                                                  </select>
                                                </div>
                                                <div>
                                                  <label for="password" class="form-label fw-bold">Password</label>
                                                  <div class="input-group">
                                                    <input type="password" class="form-control" id="password" name="update_password" placeholder="Enter Password" aria-label="Password" aria-describedby="password-addon">
                                                    <button class="btn btn-outline-secondary" type="button" id="password-addon" data-bs-toggle="tooltip" data-bs-placement="top" title="Show password" onclick="togglePasswordVisibility('password-addon', 'password')">
                                                      <i class="bi bi-eye"></i>
                                                    </button>
                                                  </div>
                                                </div>
                                                <div>
                                                  <label for="confirm-password" class="form-label fw-bold">Confirm Password</label>
                                                  <div class="input-group">
                                                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="confirm-password-addon">
                                                    <button class="btn btn-outline-secondary" type="button" id="confirm-password-addon" data-bs-toggle="tooltip" data-bs-placement="top" title="Show password" onclick="togglePasswordVisibility('confirm-password-addon', 'confirm-password')">
                                                      <i class="bi bi-eye"></i>
                                                    </button>
                                                  </div>
                                                  <div class="invalid-feedback">
                                                    Please enter the same password as above.
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col text-end">
                                                <button type="submit" name="update_member" class="btn btn-warning">Update</button>
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <?php
                                  $column_counter++;
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        <?php
                        } else {
                          echo "No Student subscriptions found.";
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-referrals" role="tabpanel" aria-labelledby="pills-referrals-tab">
        <div class="container">
          <h1 class="text-center my-5 text-danger">Referral</h1>
          <div class="row">
            <div class="container py-5">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title">Referral Details</h5>
                    </div>
                    <div class="card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>S No.</th>
                            <th>Name </th>
                            <th>Email </th>
                            <th>Referral Code</th>
                            <th>Referral Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // Fetch referral data from the database
                          $sql = "SELECT * FROM tb_users WHERE u_referral_by = '$subscriber_id'";
                          $result = $conn->query($sql);
                          $referral_count = $result->num_rows;
                          $serial_number = 0;

                          if ($referral_count > 0) {
                            while ($row = $result->fetch_assoc()) {
                              $serial_number++;
                              $u_name = $row['u_name'];
                              $u_email = $row['u_email'];
                              $referral_code = $row['u_referral_code'];
                              $referral_date = $row['created_date'];

                              // Display the referral status based on your logic
                              $referral_status = "Active";
                              // if ($referral_status == 'active') {
                              //     $referral_status = 'Active';
                              // } else {
                              //     $referral_status = 'Expired';
                              // }
                          ?>
                              <tr>
                                <td><?php echo $serial_number; ?></td>
                                <td><?php echo $u_name; ?></td>
                                <td><?php echo $u_email; ?></td>
                                <td><?php echo $referral_code; ?></td>
                                <td><?php echo $referral_date; ?></td>
                              </tr>
                          <?php
                            }
                          } else {

                            // Display a message if there are no referral records
                            echo '<tr><td colspan="5">No referral records found.</td></tr>';
                          }
                          ?>
                        </tbody>
                      </table>

                      <p>Referral Count: <?php echo $referral_count; ?></p>

                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-body text-center">
              <!-- Add your subscription details here -->
              <p class="mb-4">To expand the number of children in your account, kindly click on the 'Request' button. This will enable you to add more children and enhance your membership experience.</p>
              <button type="button" class="btn btn-warning btn-sm me-2" data-bs-dismiss="modal">Pay</button>
              <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="addMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Member</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post">
                <input type="hidden" name="user_parent_id" value="<?= $subscriber_id ?>">
                <input type="hidden" name="user_type" value="4">
                <input type="hidden" name="user_name" value="<?= $row['u_name'] ?>">
                <div class="row mb-3">
                  <!-- <div>
                      <label for="registerName" class="form-label fw-bold">Full Name.</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="registerName" name="registerName" placeholder="Enter User Name" aria-label="Mobile">
                      </div>
                    </div> -->
                  <div>
                    <label for="email" class="form-label fw-bold">Email</label>
                    <div class="input-group">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" aria-label="Email">
                    </div>
                  </div>
                  <div>
                    <label for="u_name" class="form-label fw-bold">Name</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="u_name" name="u_name" placeholder="Enter Name" aria-label="u_name" value="">
                    </div>
                  </div>
                  <div>
                    <label for="mobile" class="form-label fw-bold">Mobile No.</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number" aria-label="Mobile">
                    </div>
                  </div>
                  <div>
                    <label for="registerAge" class="form-label fw-bold">Birth Date.</label>
                    <div class="input-group">
                      <input type="date" class="form-control" id="registerAge" name="registerAge" placeholder="Enter Date of Birth" aria-label="Mobile">
                    </div>
                  </div>
                  <div>
                    <label for="grade" class="form-label fw-bold">Grade:</label>
                    <div class="input-group">
                      <select class="form-select" id="grade" name="grade">
                        <option value="1">Grade 1</option>
                        <option value="2">Grade 2</option>
                        <option value="3">Grade 3</option>
                        <option value="4">Grade 4</option>
                        <option value="5" selected>Grade 5</option>
                        <option value="6">Grade 6</option>
                        <option value="7">Grade 7</option>
                        <option value="8">Grade 8</option>
                        <option value="9">Grade 9</option>
                        <option value="10">Grade 10</option>
                      </select>
                    </div>
                  </div>
                  <div>
                    <label for="password" class="form-label fw-bold">Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" aria-label="Password" aria-describedby="password-addon">
                      <button class="btn btn-outline-secondary" type="button" id="password-addon" data-bs-toggle="tooltip" data-bs-placement="top" title="Show password" onclick="togglePasswordVisibility('password-addon', 'password')">
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                  </div>
                  <div>
                    <label for="confirm-password" class="form-label fw-bold">Confirm Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="confirm-password-addon">
                      <button class="btn btn-outline-secondary" type="button" id="confirm-password-addon" data-bs-toggle="tooltip" data-bs-placement="top" title="Show password" onclick="togglePasswordVisibility('confirm-password-addon', 'confirm-password')">
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                    <div class="invalid-feedback">
                      Please enter the same password as above.
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-end">
                    <button type="submit" name="add_member" class="btn btn-sm fw-bold btn-warning">Add Member</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Edit Profile Modal -->
      <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
        </div>
      </div>
      </div>
      </div>
      <?php include '../commonPHP/footer.php' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<?php include("../commonPHP/jsFiles.php"); ?>

<script>
  function togglePasswordVisibility(buttonId, passwordId) {
    var passwordInput = document.getElementById(passwordId);
    var buttonIcon = document.getElementById(buttonId).querySelector('i');
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      buttonIcon.classList.remove('bi-eye');
      buttonIcon.classList.add('bi-eye-slash');
    } else {
      passwordInput.type = "password";
      buttonIcon.classList.remove('bi-eye-slash');
      buttonIcon.classList.add('bi-eye');
    }
  }

  function checkPasswordConfirmation() {
    var password = $('#password').val();
    var confirm_password = $('#confirm-password').val();
    if (password != confirm_password) {
      $('#confirm-password').addClass('is-invalid');
    } else {
      $('#confirm-password').removeClass('is-invalid');
    }
  }
  $(document).ready(function() {
    $('#confirm-password').on('input', checkPasswordConfirmation);
    $('#password').on('input', checkPasswordConfirmation);
  });
</script>
<script>
  function showGrade(grade) {
    document.getElementById("gradeDisplay").innerHTML = grade;
  }

  function showGradeL(grade) {
    document.getElementById("gradeDisplayL").innerHTML = grade;
  }
</script>
<script>
  // Get the current date
  var currentDate = new Date();
  // Calculate the date six years ago
  var sixYearsAgo = new Date();
  sixYearsAgo.setFullYear(sixYearsAgo.getFullYear() - 6);
  // Format the six years ago date as "YYYY-MM-DD"
  var maxDate = sixYearsAgo.toISOString().split('T')[0];
  // Set the maximum date for the input field
  document.getElementById('registerAge').setAttribute('max', maxDate);
</script>

</html>