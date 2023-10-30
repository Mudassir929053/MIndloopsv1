<?php
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '600');

include '../dbconnect.php';

$cd_title = $_POST['cd_title'];
$cd_desc = $_POST['cd_desc'];
$dateTime = (string) date('Y-m-d_H-i-s');

if (isset($_FILES['cd_imgPath'])) {

    if (($_FILES['cd_imgPath']['type'] == "image/png") ||  ($_FILES['cd_imgPath']['type'] == "image/jpg") || ($_FILES['cd_imgPath']['type'] == "image/jpeg") ||  ($_FILES['cd_imgPath']['type'] == "image/webp") || ($_FILES['cd_imgPath']['type'] == "image/avif")) {
        $source_file1 = $_FILES['cd_imgPath']['tmp_name'];
        $dest_file1 = "../assets/home_page/" . $dateTime . "_" . $_FILES['cd_imgPath']['name'];

        if (file_exists($dest_file1)) {
            unlink($dest_file1);
            $cd_imgPath = $dest_file1;
        } else {
            $cd_imgPath = $dest_file1;
        }
    } else {
        echo ("<script LANGUAGE='JavaScript'> window.alert('This image is not in png/jpg/jpeg format.');</script>");
    }
}

$sql = "INSERT INTO tb_discovers (cd_title, cd_desc, cd_imgPath) 
            VALUES(?, ?, ?);";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo json_encode("SQL ERROR");
} else {

    mysqli_stmt_bind_param($stmt, "sss", $cd_title, $cd_desc, $cd_imgPath);

    if (mysqli_stmt_execute($stmt)) {

        move_uploaded_file($source_file1, $dest_file1)
            or die("Error!!");

        mysqli_stmt_close($stmt);
        echo "<script> window.location.replace('manage.php'); </script>";
    } else {
        echo json_encode("SQL ERROR:" + mysqli_error($conn));
        echo json_encode("Fail");
    }
}
