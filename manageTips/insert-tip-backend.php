<?php
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '600');
include '../dbconnect.php';
$t_id = (int)$_POST['t_id'];
$t_title = $_POST['t_title'];
$t_desc = $_POST['t_desc'];
$t_audience = $_POST['t_audience'];
$t_video_id = $_POST['video'];
$t_type = $_POST['t_type'];
$t_rDate = $_POST['t_rDate'];
$t_author = $_POST['t_author'];
$dateTime = (string) date('Y-m-d_H-i-s');
if (isset($_FILES['t_filePath'])) {
    if (($_FILES['t_filePath']['type'] == "image/png") ||  ($_FILES['t_filePath']['type'] == "image/jpg") || ($_FILES['t_filePath']['type'] == "image/jpeg")) {
        if (!is_dir("../assets/tips/tip_images/" . $dateTime . "/")) {
            mkdir("../assets/tips/tip_images/" . $dateTime . "/");
        }
        $source_file1 = $_FILES['t_filePath']['tmp_name'];
        $dest_file1 = "../assets/tips/tip_images/" . $dateTime . "/" . $_FILES['t_filePath']['name'];
        if (file_exists($dest_file1)) {
            unlink($dest_file1);
            $t_filePath = $dest_file1;
        } else {
            $t_filePath = $dest_file1;
        }
    } else {
        echo ("<script LANGUAGE='JavaScript'> window.alert('Magazine is not in PDF format.');</script>");
    }
}
$sql = "INSERT INTO tb_tips (id, t_id, t_title, t_rDate, t_author, t_desc, t_filePath, t_audience, t_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo json_encode("SQL ERROR");
} else {
    mysqli_stmt_bind_param($stmt, "issssssss", $id, $t_id, $t_title, $t_rDate, $t_author, $t_desc, $t_filePath, $t_audience, $t_type);
    if (mysqli_stmt_execute($stmt)) {
        move_uploaded_file($source_file1, $dest_file1) or die("Error!!");
        mysqli_stmt_close($stmt);
        echo "<script> window.location.replace('manage-tip.php'); </script>";
    } else {
        echo json_encode("SQL ERROR: " . mysqli_error($conn));
        echo json_encode("Fail");
    }
}
