<?php
if (!session_id()) {
  session_start();
}
if ($_SESSION["userType"] != '2' && $_SESSION["userType"] != '3' && $_SESSION["userType"] != '4') {
  echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
  // header("../login_and_register/login.php");
}
include 'subscriber-member-function.php';
?>


<link rel="stylesheet" href="../assets/css/style.css">
</link>
<link href="../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->

<style>
  body {
    background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
    background-size: 100%;
    background-position: top center;
  }

  .img-fluid1 {
    height: 100%;
    width: 100%;
    border-radius: 10%;
    /* margin-bottom: 5%; */

  }
</style>

<body>
  
  <h1 class="text-center my-5 text-danger">Subscription Details</h1>
  <?php
  $subscriber_id = $_SESSION['u_id'];
  // Perform the query
  $sql = "SELECT * FROM tb_users WHERE u_parent_user_id = '$subscriber_id'";
  $result = mysqli_query($conn, $sql);

  // Get the row count
  $row_count = mysqli_num_rows($result);

  // Hide the button if row count is 3 or greater
  if ($row_count >= 3) {
    $hide_button = 'd-none'; // Add the "d-none" class to hide the button
  } else {
    $hide_button = ''; // Empty string to show the button
  }
  ?>
  <?php
  // Get the subscriber ID from the session
  $subscriber_id = $_SESSION['u_id'];

  // Fetch subscription data from database
 $sql = "SELECT * FROM tb_users LEFT JOIN subscription on tb_users.u_id = subscription.subscriber_id WHERE u_id = '$subscriber_id'";
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

      $progress = round($elapsed_duration / $total_duration * 100);
      // $progress=35;
      $days_left = round($remaining_duration / (24 * 60 * 60));
  ?>

      <div class="container text-center">
        <div class="progress " role="progressbar" aria-label="Subscription progress" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100">
          <?php if ($progress < 25) { ?>
            <div class="progress-bar bg-success" style="width: <?php echo $progress; ?>%"></div>
          <?php } elseif ($progress < 50) { ?>
            <div class="progress-bar bg-info" style="width: <?php echo $progress; ?>%"></div>
          <?php } elseif ($progress < 75) { ?>
            <div class="progress-bar bg-warning" style="width: <?php echo $progress; ?>%"></div>
          <?php } else { ?>
            <div class="progress-bar bg-danger" style="width: <?php echo $progress; ?>%"></div>
          <?php } ?>
        </div>
        <p class="mt-3"><?php echo $days_left; ?> days left</p>
      </div>

      <div class="container ">
        <!-- <button type="button" class="btn btn-warning btn-center btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#addMember">
          Add Member
        </button> -->
        <button type="button" class="btn btn-warning btn-center btn-sm fw-bold <?php echo $hide_button; ?>" data-bs-toggle="modal" data-bs-target="#addMember">
          Add Member
        </button>
        <!-- Modal -->
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
      </div>
      <div class="row p-3">
        <div class="col-3 shadow p-3 mb-5 bg-body-tertiary rounded mx-3">
          <p><span class="fw-bold pe-3">Account Email:</span><?php echo   $row['u_email']; ?></p>
          <p><span class="fw-bold pe-3">Account Type:</span><?php echo $row['u_name']; ?></p>
          <p><span class="fw-bold pe-3">Mobile No:</span><?php echo $row['u_contact']; ?></p>
          <p><?php #echo $row['u_pwd']; 
              ?></p>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-warning btn-sm fw-bold btn-center" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['u_id']; ?>">
            Update Details
          </button>
        </div>
        <div class="col-3">
        </div>
      </div>
      <!-- Modal -->
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
                <button type="submit" name="update_member" class="btn btn-warning btn-sm m-3">Update</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
      </div>
      </div>
  <?php
    }
  } else {
    echo "No subscriptions found.";
  }
  ?>
  </div>
  </div>
  <?php
  // Get the subscriber ID from the session
  $subscriber_id = $_SESSION['u_id'];
  // Fetch subscription data from database
  $sql = "SELECT * FROM tb_users LEFT JOIN subscription on tb_users.u_id = subscription.subscriber_id WHERE u_parent_user_id = '$subscriber_id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $column_counter = 0; // initialize column counter
  ?>
    <div class="container shadow p-3 mb-5 bg-body-tertiary rounded">
      <div class="row">
        <?php
        while ($row = $result->fetch_assoc()) {
          if ($column_counter % 3 == 0) {
            // start a new row after every 3 columns
            if ($column_counter > 0) {
              echo '</div></div>';
            }
            echo '<div class="col">';
            echo '<div class="row">';
          }
        ?>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
            <div class="shadow p-3 bg-body-tertiary rounded">
              <!-- Content for this column -->
              <p><span class="fw-bold pe-3">Account Email <span class=" justify-content-center">:</span></span><?php echo $row['u_email']; ?></p>
              <p><span class="fw-bold pe-3">Account Type:</span><?php echo $row['u_name']; ?></p>
              <p><span class="fw-bold pe-3">Mobile No:</span><?php echo $row['u_contact']; ?></p>
              <p><span class="fw-bold pe-3">Birth Date:</span><?php echo $row['u_age']; ?></p>
          <p><span class="fw-bold pe-3">Grade:</span><?php echo $row['u_grade']; ?></p>
          
              <!-- <p><?php echo $row['u_id']; ?></p> -->
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-warning btn-sm fw-bold btn-center" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['u_id']; ?>">
                Update Details
              </button>
            </div>
          </div>
          <!-- Modal -->
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
                      <label for="registerAge" class="form-label fw-bold">Birth Date.</label>
                      <div class="input-group">
                        <input type="date" class="form-control" id="registerAge" name="registerAge" placeholder="Enter Date of Birth" aria-label="Mobile"  value="<?php echo $row['u_age']; ?>">

                      </div>
                    </div>
                    <div>
  <label for="grade" class="form-label fw-bold">Grade:</label>
  <div class="input-group">
    <select class="form-select" id="grade" name="grade">
      <option value="1"<?php if ($row['u_grade'] == '1') echo ' selected'; ?>>Grade 1</option>
      <option value="2"<?php if ($row['u_grade'] == '2') echo ' selected'; ?>>Grade 2</option>
      <option value="3"<?php if ($row['u_grade'] == '3') echo ' selected'; ?>>Grade 3</option>
      <option value="4"<?php if ($row['u_grade'] == '4') echo ' selected'; ?>>Grade 4</option>
      <option value="5"<?php if ($row['u_grade'] == '5') echo ' selected'; ?>>Grade 5</option>
      <option value="6"<?php if ($row['u_grade'] == '6') echo ' selected'; ?>>Grade 6</option>
      <option value="7"<?php if ($row['u_grade'] == '7') echo ' selected'; ?>>Grade 7</option>
      <option value="8"<?php if ($row['u_grade'] == '8') echo ' selected'; ?>>Grade 8</option>
      <option value="9"<?php if ($row['u_grade'] == '9') echo ' selected'; ?>>Grade 9</option>
      <option value="10"<?php if ($row['u_grade'] == '10') echo ' selected'; ?>>Grade 10</option>
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
          <!--END  Modal -->
        <?php
          $column_counter++;
        }
        // close the last row and column
        echo '</div></div>';
        ?>
      </div>
    </div>

  <?php
  } else {
    echo "No Student subscriptions found.";
  }
  ?>

  <div class="container-fluid">
    <div class="row">
      <?php include '../commonPHP/footer.php' ?>
    </div>
  </div>

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>