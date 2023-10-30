<?php
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '600');
include('../dbconnect.php');

$cd_id = $_POST['cd_id'];
$cd_title = $_POST['cd_title'];
$cd_desc = $_POST['cd_desc'];
$currFilePath = $_POST['currFilePath'];
$dateTime = (string) date('Y-m-d_H-i-s');

if (isset($_FILES['cd_imgPathNew'])) {

    if (($_FILES['cd_imgPathNew']['type'] == "image/png") ||  ($_FILES['cd_imgPathNew']['type'] == "image/jpg") || ($_FILES['cd_imgPathNew']['type'] == "image/jpeg") ||  ($_FILES['cd_imgPathNew']['type'] == "image/webp") || ($_FILES['cd_imgPathNew']['type'] == "image/avif")) {
        $source_file2 = $_FILES['cd_imgPathNew']['tmp_name'];
        $dest_file2 = "../assets/home_page/" . $dateTime . "_" . $_FILES['cd_imgPathNew']['name'];

        if (file_exists($dest_file2)) {
            unlink($dest_file2);
            $cd_imgPath = $dest_file2;
        } else {
            $cd_imgPath = $dest_file2;
        }
        move_uploaded_file($source_file2, $dest_file2)
            or die("Error!!");
    } else {
        echo ("<script LANGUAGE='JavaScript'> window.alert('Image is not in (.png / .jpg / .jpeg) format.');</script>");
        // echo json_encode("SQL ERROR:" + mysqli_error($conn));
        $cd_imgPath = $currFilePath;
    }
} else {
    $cd_imgPath = $currFilePath;
}

$sql = "UPDATE tb_discovers SET cd_title = ?, cd_desc = ?, cd_imgPath = ?
            WHERE cd_id = ?;";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo $cd_imgPath;
    echo json_encode("SQL ERROR");
} else {
    mysqli_stmt_bind_param($stmt, "sssi", $cd_title, $cd_desc, $cd_imgPath, $cd_id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        echo "<script> window.location.replace('manage.php'); </script>";
    } else {
        echo json_encode("SQL ERROR:" + mysqli_error($conn));
        echo json_encode("Fail");
    }
}
