<?php
include '../../dbconnect.php';
if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '2') {
    echo "<script> window.location.replace('../../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
date_default_timezone_set("Asia/Kuala_Lumpur");
extract($_POST);
$user_id = $_SESSION['u_id'];
if ($conn) {
    // Set the value for forum_for as "Adults"
    $forum_for = "Adults";

    $sql = "INSERT INTO forum (forum_name, forum_for, forum_description, created_by) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $c_name, $forum_for, $c_desc, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: forum.php");
        exit();
    } else {
        echo "SQL ERROR: " . mysqli_error($conn);
    }
} else {
    echo "Connection failed.";
}
?>

?>

