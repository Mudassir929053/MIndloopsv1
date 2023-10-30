<?php
 include('../../dbconnect.php');
/* ------------------------------------Add Employalibility program ------------------------------------ */

if (isset($_POST['add_member'])) {
  // Get the form data
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirm-password"];
  $mobile = $_POST['mobile'];
  $registerAge = $_POST['registerAge'];
  $grade = $_POST['grade'];
  $u_name = $_POST['u_name'];
  $user_type = 3;
  $user_parent_id = $_POST['user_parent_id'];

  // Validate the form data
  if (empty($email) || empty($mobile)) {
    echo "<script>alert('Please fill in all the fields.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
    exit;
  }

  if (!empty($password) && $password != $confirmPassword) {
    echo "<script>alert('The passwords do not match.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
    exit;
  }
  // Validate the mobile number
  if (strlen($mobile) !== 9) {

    echo "<script>alert('Please enter a 9-digit mobile number.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
    exit;
  }
  // Hash the password
  $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : '';

  $sql = "INSERT INTO tb_users (u_email, u_name, u_contact, u_pwd, u_type, u_age, u_grade, u_parent_user_id) VALUES ('$email', '$u_name', '$mobile', '$hashedPassword', '$user_type', '$registerAge', '$grade', '$user_parent_id')";
  
  // ... previous code ...

  // Execute the SQL query
  if (mysqli_query($conn, $sql)) {
    echo ("<script>window.location.href ='user-profile.php'</script>");
  } else {
    echo "<script>alert('insert course learning details is not successful.');
        location.href = '$_SERVER[HTTP_REFERER]';</script>";
  }
}

/* ------------------------------------Add Employalibility program ------------------------------------ */
/* ------------------------------------ Update Employee Details ------------------------------------ */

if (isset($_POST['update_member'])) {
  // Get the form data
  $email = $_POST["update_email"];
  $password = $_POST["update_password"];
  $confirmPassword = $_POST["confirm-password"];
  $mobile = $_POST['update_mobile'];
  $registerAge = $_POST['registerAge'];
  $u_name = $_POST['u_name'];
  $grade = $_POST['grade'];

  $user_id = $_POST['user_id'];

  // Validate the form data
  if (empty($email) || empty($mobile)) {
    echo "<script>alert('Please fill in all the fields.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
    exit;
  }

  if (!empty($password) && $password != $confirmPassword) {
    echo "<script>alert('The passwords do not match.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
    exit;
  }
  // Validate the mobile number
  if (strlen($mobile) !== 9) {

    echo "<script>alert('Please enter a 9-digit mobile number.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
    exit;
  }
  // Hash the password
  $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : '';

  $sql = "UPDATE tb_users SET u_name='$u_name', u_email='$email', u_contact='$mobile', u_age='$registerAge', u_grade='$grade', u_pwd='$hashedPassword' WHERE u_id='$user_id'";
  
  // Execute the SQL query
  if (mysqli_query($conn, $sql)) {
    echo ("<script>window.location.href ='user-profile.php'</script>");
  } else {
    echo "<script>alert('update employee details is not successful.');
          location.href = '$_SERVER[HTTP_REFERER]';</script>";
  }
}


// Check if the delete button was clicked

// Include the file that establishes the database connection


if (isset($_POST['delete'])) {
    // Get the ID of the record to delete
    $u_id = $_POST['u_id'];

    // Perform the deletion using the existing database connection

    $sql = "DELETE FROM tb_users WHERE u_id = '$u_id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Record deleted successfully.')</script>";
        echo "<script>window.location = 'user-profile.php';</script>";
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
}

// Close the database connection if necessary





/* ------------------------------------ Update Employee Details ------------------------------------ */


if (isset($_POST['update_parent'])) {
  // Get the form data
  $email = $_POST["update_email"];
  $password = $_POST["update_password"];
  $confirmPassword = $_POST["confirm-password"];
  $mobile = $_POST['update_mobile'];
  $user_id = $_POST['user_id'];

  // Validate the form data
  if (empty($email) || empty($mobile)) {
    echo "<script>alert('Please fill in all the fields.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
    exit;
  }

  if (!empty($password) && $password != $confirmPassword) {
    echo "<script>alert('The passwords do not match.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
    exit;
  }
  // Validate the mobile number
  if (strlen($mobile) !== 9) {

    echo "<script>alert('Please enter a 9-digit mobile number.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
    exit;
  }
  // Hash the password
  $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : '';

  $sql = "UPDATE tb_users SET u_email='$email', u_contact='$mobile', u_pwd='$hashedPassword' WHERE u_id='$user_id'";
  
  // Execute the SQL query
  if (mysqli_query($conn, $sql)) {
    echo ("<script>window.location.href ='user-profile.php'</script>");
  } else {
    echo "<script>alert('update employee details is not successful.');
          location.href = '$_SERVER[HTTP_REFERER]';</script>";
  }
}



?>