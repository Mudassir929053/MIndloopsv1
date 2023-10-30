<?php
include("../dbconnect.php");
include 'registerprocess.php';
// session_start();
if (isset($_SESSION['userType'])) {
  if ($_SESSION["userType"] == '1') {
    header("location: admin.php");
  } else if ($_SESSION["userType"] == '2') {
    // header("location: ../Teacher/magazine/index.php");
    echo "<script>window.location.href='../Teacher/magazine/index.php'</script>";
  } else if ($_SESSION["userType"] == '3') {
    header("location: ../index/index.php");
  } else if ($_SESSION["userType"] == '4') {
    // header("location: ../Parent/magazine/index.php");
    echo "<script>window.location.href='../parent/magazine/index.php'</script>";
  }
}
$sql = "SELECT * FROM tb_genders";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT * FROM tb_usertypes WHERE ut_id != 1";
$result2 = mysqli_query($conn, $sql2);
?>
<?php
require_once '../assets/securimage/securimage.php';

// Create a new instance of the Securimage class
$securimage = new Securimage();

// Generate the captcha image
// $securimage->show();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mindloops: Login & Registration</title>

  <link href="../assets/img/MindLOOPS_Resouces/ML Icon4.png" rel="icon">
  <link href="../assets/img/MindLOOPS_Resouces/ML Icon4.png" rel="apple-touch-icon">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />
  <!-- MDB -->
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>  -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-REHg5ygKu2B6OwgsY6sh3C0/9ge3ayehoH5kvhD1jK9BCAZ9Ox4Dw0DF6DrS43Dx1l2LAr8BZRl2AkvDrEfVGQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <script src="../assets/js/main.js"></script>
  <style>
    body {
      /* background-image: url('resources/Asset 4.jpg'); */
      background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
    }

    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }

    .h-custom {
      height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }

    .attractive-form {
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 8px;
    }

    .form-label {
      color: #333;
    }

    .form-control {
      background-color: #fff;
      border: 1px solid #ccc;
      color: #333;
    }

    .btn-primary {
      background-color: #3498db;
      color: #fff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #2980b9;
    }

    .form-check-label {
      color: #555;
    }

    .email_reg {
      width: 70%;
    }

    .btn_reg {
      width: 25%;
    }

    @media only screen and (max-width: 600px) {
      .email_reg {
        width: 100%;
      }

      .btn_reg {
        width: 100%;
        margin-top: 5px;
      }
    }

    .form-check {
      padding: 0;
    }
  </style>
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <a href="../index.php"><img src="../assets/img/MindLOOPS_Resouces/Asset_10.png" class="img-fluid" alt="Mindloop Logo"></a>
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5">
              <!-- Pills navs -->
              <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                </li>
              </ul>
              <!-- Pills navs -->
              <!-- Pills content -->
              <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                  <form action="loginprocess.php" method="post">
                    <!-- Email input -->
                    <div class="form-group mb-4">
                      <label for="inputValue">Email Address</label>
                      <input type="email" class="form-control" id="inputValue" name="email" value="<?php if (isset($_COOKIE['email_set'])) {
                                                                                                      echo $_COOKIE['email_set'];
                                                                                                    } ?>" placeholder="Enter Email" required>
                    </div>
                    <!-- Password input -->
                    <div class="form-group mb-4">
                      <label for="inputPassword">Password</label>
                      <input type="password" class="form-control" id="inputPassword" name="password" value="<?php if (isset($_COOKIE['password_set'])) {
                                                                                                              echo $_COOKIE['password_set'];
                                                                                                            } ?>" placeholder="Enter Password" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <!-- Checkbox -->
                      <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" name="remember" value='remember' id="check_box" <?php if (isset($_COOKIE["remember_set"])) { ?> checked <?php } ?> />
                        <label class="form-check-label" for="check_box">
                          Remember me
                        </label>
                      </div>
                      <!-- <a href="#!" class="text-body">Forgot password?</a> -->
                    </div>
                    <br>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-success btn-block mb-4" name="login" value="login">Log In</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                  <form method="post" class="attractive-form" onsubmit="return validateRegistration(this)">
                    <!-- <form method="post" class="attractive-form"> -->

                    <div class="mb-3">
                      <label for="userType" class="form-label">User Type:</label>
                      <select class="form-select" id="userType" required name="userType" onchange="changeForm()">
                        <option value="">Select User Type</option>
                        <option value="2">Teacher</option>
                        <option value="4">Parent</option>
                      </select>
                    </div>
                    <div id="role_manager">
                      <div id="teacherFields" style="display: none">
                        <!-- <h3>Teacher Account Details</h3> -->

                        <div class="mb-3">
                          <label for="name" class="form-label">Referral Code:</label>
                          <input type="text" class="form-control" id="p_refferalcode" name="p_refferalcode" value="<?= @$_GET['referral'] ?>">
                        </div>
                        <div class="mb-3">
                          <label for="name" class="form-label">Name:</label>
                          <input type="text" class="form-control" id="teachername" name="teachername" placeholder="Enter Your Name">
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label d-block">Email:</label>
                          <input type="email" class="form-control d-inline email_reg" id="teacheremail" name="teacheremail" placeholder="Enter your Email"> <button type="button" class="btn btn bg-warning d-inline btn_reg" onclick="checkEmail(document.getElementById('teacheremail'))"> Send OTP</button>

                          <div id="verify_teacher_otp" style="display: none">

                            <input type="number" value="" id="otp_t" placeholder="Enter OTP" class="form-control mt-2 d-inline email_reg"> <button type="button" class="btn btn bg-warning d-inline btn_reg" onclick="verifyEmail(document.getElementById('otp_t'))"> Verify</button>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="mobile" class="form-label">Mobile Number:</label>
                          <input type="number" class="form-control" id="teachermobile" name="teachermobile" placeholder="Enter Your Mobile Number">
                        </div>
                        <div class="mb-3">
                          <label>Select Subject:</label><br>
                          <input type="checkbox" name="teachersubjects[]" value="Math"> Math<br>
                          <input type="checkbox" name="teachersubjects[]" value="Science"> Science<br>
                          <input type="checkbox" name="teachersubjects[]" value="English"> English<br>
                          <input type="checkbox" name="teachersubjects[]" value="History"> History<br>
                          <!-- Add more checkboxes for additional subjects here -->
                        </div>
                        <div class="mb-3">
                          <label for="other" class="form-label">Other:</label>
                          <textarea class="form-control" id="teacherother" name="other" rows="3" placeholder="Enter other Subjects"></textarea>
                        </div>

                        <div class="mb-3">
                          <label for="teacherpassword" class="form-label">Password:</label>
                          <div class="input-group">
                            <input type="password" class="form-control" id="teacherpassword" name="teacherpassword" placeholder="Enter your Password">
                            <button class="btn btn-outline-secondary password-toggle" type="button" onclick="togglePasswordVisibility('teacherpassword')">
                              <i class="fa fa-eye-slash"></i>
                            </button>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="teacherconfirmPassword" class="form-label">Confirm Password:</label>
                          <div class="input-group">
                            <input type="password" class="form-control" id="teacherconfirmPassword" name="teacherconfirmPassword" placeholder="ReEnter your Password">
                            <button class="btn btn-outline-secondary password-toggle" type="button" onclick="togglePasswordVisibility('teacherconfirmPassword')">
                              <i class="fa fa-eye-slash"></i>
                            </button>
                          </div>
                        </div>


                        <!-- Captcha code for teacher -->
                        <div class="mb-3">
                          <label for="teacher_captcha_code" class="form-label">CAPTCHA Code:</label>
                          <input type="text" class="form-control" id="teacher_captcha_code" name="teacher_captcha_code" placeholder="Enter Captcha">
                          <img id="teacher_captcha_image" src="../assets/securimage/securimage_show.php" alt="CAPTCHA Image">
                          <a href="#" onclick="document.getElementById('teacher_captcha_image').src = '../assets/securimage/securimage_show.php?' + Math.random(); return false;">Refresh CAPTCHA</a>
                        </div>
                        <div class="mb-3">
                          <input type="checkbox" class="form-check-input" id="acceptTermst" name="acceptTermst">
                          <label class="form-check-label" for="acceptTerms">I accept the terms and conditions</label>
                        </div>

                      </div>


                      <div id="parentFields" style="display: none">
                        <!-- <h3>Parent Account Details</h3> -->
                        <div class="mb-3">
                          <label for="name" class="form-label">Referral Code:</label>
                          <input type="text" class="form-control" id="p_refferalcode" name="p_refferalcode" value="<?= @$_GET['referral'] ?>">
                        </div>
                        <div class="mb-3">
                          <label for="name" class="form-label">Name:</label>
                          <input type="text" class="form-control" id="parentname" name="parentname" placeholder="Enter your Name">
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label d-block">Email:</label>
                          <input type="email" class="form-control d-inline email_reg" id="email" name="email" placeholder="Enter your Email"> <button type="button" class="btn btn bg-warning d-inline btn_reg" onclick="checkEmail(document.getElementById('email'))"> Send OTP</button>

                          <div id="verify_parent_otp" style="display: none">

                            <input type="number" value="" id="otp_p" class="form-control mt-2 d-inline email_reg" placeholder="Enter OTP"> <button type="button" class="btn btn bg-warning d-inline btn_reg" onclick="verifyEmail(document.getElementById('otp_p'))"> Verify</button>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="mobile" class="form-label">Mobile Number:</label>
                          <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter Your Mobile Number">
                        </div>
                        <div class="mb-3">
                          <label for="numberOfChildren" class="form-label">Number of Children:</label>
                          <select class="form-select" id="numberOfChildren" name="numberOfChildren">
                            <option value="">Select number of children</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password:</label>
                          <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('password')">
                              <i class="fa fa-eye-slash"></i>
                            </button>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="confirmPassword" class="form-label">Confirm Password:</label>
                          <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="ReEnter your Password">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('confirmPassword')">
                              <i class="fa fa-eye-slash"></i>
                            </button>
                          </div>
                        </div>


                        <!-- Captcha code for parent -->
                        <div class="mb-3 form-check">
                          <label for="parent_captcha_code" class="form-label">CAPTCHA Code:</label>
                          <input type="text" class="form-control" id="parent_captcha_code" name="parent_captcha_code" placeholder="Enter Captcha">
                          <img id="parent_captcha_image" src="../assets/securimage/securimage_show.php" alt="CAPTCHA Image">
                          <a href="#" onclick="document.getElementById('parent_captcha_image').src = '../assets/securimage/securimage_show.php?' + Math.random(); return false;">Refresh CAPTCHA</a>
                        </div>
                        <div class="mb-3 form-check">
                          <input type="checkbox" class="form-check-input" id="acceptTerms" name="acceptTerms">
                          <label class="form-check-label" for="acceptTerms">I accept the terms and conditions</label>
                        </div>
                      </div>
                    </div>
                    <button type="register" name="register" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>

              <!-- Pills content -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- MDB -->

  <script type="text/javascript">
    $('#registerConfirmPassword').on('keyup', function() {
      if ($('#registerPassword').val() == $('#registerConfirmPassword').val()) {
        $('#message').html('Matching').css('color', 'green');
      } else
        $('#message').html('Not Matching').css('color', 'red');
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    let validEmail = false;

    function changeForm() {
      var userType = document.getElementById("userType").value;
      var teacherFields = document.getElementById("teacherFields");
      var parentFields = document.getElementById("parentFields");
      // var studentFields = document.getElementById("studentFields");
      if (userType === "2") { //teacher
        teacherFields.style.display = "block";
        parentFields.style.display = "none";
        // studentFields.style.display = "none";
      } else if (userType === "4") {
        teacherFields.style.display = "none";
        parentFields.style.display = "block";
        // studentFields.style.display = "none";
      } else if (userType === "3") {
        teacherFields.style.display = "none";
        parentFields.style.display = "none";
        // studentFields.style.display = "block";
      } else {
        teacherFields.style.display = "none";
        parentFields.style.display = "none";
        // studentFields.style.display = "none";
      }
    }

    const checkEmail = (obj) => {
      let rType = 'parent';
      var re = /\S+@\S+\.\S+/;
      if (obj.value == '') {
        alert('Please enter email');
        obj.focus();
        return false
      }
      if (!re.test(obj.value)) {

        alert('Invalid Email id');
        obj.focus();
        return false;
      }

      let url = 'manage_otp.php?checkEmail=yes&email=' + obj.value;
      // console.log(url)

      fetch(url).then(data => data.text()).then(data => {
        if (data == 'true') {
          alert('This Email id has already been registered. User another email to create new account.');
          return false;
        }
        sendOtp(obj.value, rType);

        if (obj.name == 'teacheremail') {
          alert("OTP sent to: " + obj.value);
          document.getElementById('verify_teacher_otp').style.display = 'block';
          rType = 'teacher';
        } else {
          alert("OTP sent to: " + obj.value);
          document.getElementById('verify_parent_otp').style.display = 'block';
        }
      });
      // sendOtp(obj.value,rType);
    }
    const sendOtp = (email, rType) => {
      // console.log(obj)
      let url = 'manage_otp.php?sendOtp=yes&email=' + email + '&rType=' + rType
      // console.log(url)
      fetch(url).then(data => data.text()).then(data => console.log(data));

    }

    const verifyEmail = (obj) => {
      // console.log(obj.id);
      let field = {};
      let email_field = '';
      if (obj.value.length < 6) {
        alert("Invalid OTP");
        obj.focus();
        return false;
      }
      let url = 'manage_otp.php?verifyEmail=yes&ent_otp=' + obj.value;
      // console.log(url)
      fetch(url).then(data => data.text()).then(data => {
        if (data == 'true') {
          obj.style.borderColor = 'green';
          obj.readOnly = true;
          if (obj.id == 'otp_t') {
            field = document.getElementById('teacherFields');
            email_field = document.getElementById('teacheremail');
          } else {
            field = document.getElementById('teacherFields');
            email_field = document.getElementById('email');

          }
          let buttons = field.getElementsByTagName("button");
          // console.log(buttons);
          email_field.readOnly = true;
          email_field.style.borderColor = 'green'
          for (let i = 0; i < buttons.length; i++) {
            // console.log(buttons[i]);
            buttons[i].disabled = true;
          }
          validEmail = true;
        } else {
          alert('Invalid OTP');
          obj.style.borderColor = 'red';
          obj.readOnly = false;
          obj.focus();
          validEmail = false;
        }
      });
    }

    function togglePasswordVisibility(inputId) {
      var passwordInput = document.getElementById(inputId);
      var passwordToggle = passwordInput.nextElementSibling;

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggle.innerHTML = ' <i class="fa fa-eye"></i></i>';
      } else {
        passwordInput.type = "password";
        passwordToggle.innerHTML = ' <i class="fa fa-eye-slash"></i></i>';
      }
    }

    const validateRegistration = (form) => {
      var userType = form.userType.value;
      var re = /\S+@\S+\.\S+/;
      // Validate based on the selected user type
      if (userType === "2") {
        // Teacher validation
        var teacherName = form.teachername.value.trim();
        var teacherEmail = form.teacheremail.value.trim();
        var teacherMobile = form.teachermobile.value.trim();
        var teacherSubjects = form.querySelectorAll('input[name="teachersubjects[]"]:checked');
        var teacherPassword = form.teacherpassword.value;
        var teacherConfirmPassword = form.teacherconfirmPassword.value;
        var teacherCaptchaCode = form.teacher_captcha_code.value;
        var acceptTerms = form.acceptTermst.checked;
        // console.log(acceptTerms)
        // Perform validation for teacher fields
        if (teacherName === "") {
          alert("Please enter your name.");
          form.teachername.focus();
          return false;
        }

        if (teacherEmail === "") {
          alert("Please enter your email.");
          form.teacheremail.focus();
          return false;
        }
        if (!re.test(teacherEmail)) {
          alert("Please enter valid email11.");
          form.teacheremail.focus();
          return false;
        }
        if (!validEmail) {
          alert("Please verify you email first");
          return false;
        }
        if (teacherMobile == '') {
          alert('Please enter mobile number');
          form.teachermobile.focus();
          return false;
        }
        if (!/^\d+$/.test(teacherMobile)) {
          alert('Please enter valid mobile number');
          form.teachermobile.focus();
          return false;
        }
        if (teacherSubjects == '') {
          alert("Please select a subject");
          return false;
        }
        if (teacherPassword == '') {
          alert("Please enter Password");
          form.teacherpassword.focus()
          return false
        }
        if (teacherPassword != teacherConfirmPassword) {
          alert('Password do not match');
          return false;
        }
        if (teacherCaptchaCode == '') {
          alert('Please enter CAPTCHA code');
          form.teacher_captcha_code.focus();
          return false;

        }
        if (!acceptTerms) {
          alert("Please accept terms and conditions");
          form.acceptTerms.focus();
          return false;
        }

        // Add more validation rules for teacher fields if needed

      } else if (userType === "4") {
        // Parent validation
        var parentName = form.parentname.value.trim();
        var parentEmail = form.email.value.trim();
        var parentMobile = form.mobile.value.trim();
        var numberOfChildren = form.numberOfChildren.value;
        var parentPassword = form.password.value;
        var parentConfirmPassword = form.confirmPassword.value;
        var parentCaptchaCode = form.parent_captcha_code.value;
        var acceptTerms = form.acceptTerms.checked;

        // Perform validation for parent fields
        if (parentName === "") {
          alert("Please enter your name");
          form.parentname.focus();
          return false;
        }

        if (parentEmail === "") {
          alert("Please enter your email.");
          form.email.focus();
          return false;
        }
        if (!re.test(parentEmail)) {
          alert("Please enter your email.");
          form.email.focus();
          return false;
        }
        if (!validEmail) {
          alert("Please verify you email first");
          return false;
        }
        if (parentMobile == '') {
          alert('Please enter mobile number');
          form.mobile.focus();
          return false;
        }
        if (!/^\d+$/.test(parentMobile)) {
          alert('Please enter valid mobile number');
          form.mobile.focus();
          return false;
        }
        if (numberOfChildren == '') {
          alert('Please select no of children');
          return false;
        }

        if (parentPassword == '') {
          alert("Please enter Password");
          form.parentPassword.focus()
          return false
        }
        if (parentPassword != parentConfirmPassword) {
          alert('Password do not match');
          return false;
        }
        if (parentCaptchaCode == '') {
          alert('Please enter CAPTCHA code');
          form.parent_captcha_code.focus();
          return false;

        }
        if (!acceptTerms) {
          alert("Please accept terms and conditions");
          form.acceptTerms.focus();
          return false;
        }
        // Add more validation rules for parent fields if needed
      } else {
        // If no user type is selected
        alert("Please select a user type.");
        return false;
      }
      return true;
    }
  </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>

</html>