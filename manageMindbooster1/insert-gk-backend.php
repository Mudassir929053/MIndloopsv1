<?php
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '600');
include '../dbconnect.php';

$l_name = $_POST['l_name'];
$mb_id = $_POST['mb_id'];
$l_lesson_desc = $_POST['l_lesson_desc'];
$l_released_date = $_POST['l_released_date'];

$dateTime = date('Y-m-d_H-i-s');

if (isset($_FILES['l_image'])) {
    if (
        ($_FILES['l_image']['type'] == "image/png") ||
        ($_FILES['l_image']['type'] == "image/jpg") ||
        ($_FILES['l_image']['type'] == "image/jpeg")
    ) {
        if (!is_dir("../assets/lessons/lesson_images/" . $dateTime . "/")) {
            mkdir("../assets/lessons/lesson_images/" . $dateTime . "/");
        }

        $source_file = $_FILES['l_image']['tmp_name'];
        $dest_file = "../assets/lessons/lesson_images/" . $dateTime . "/" . $_FILES['l_image']['name'];

        if (file_exists($dest_file)) {
            unlink($dest_file);
        }

        $l_image = $dest_file;

        move_uploaded_file($source_file, $dest_file) or die("Error!!");
    } else {
        echo ("<script LANGUAGE='JavaScript'> window.alert('Image is not in supported format.');</script>");
    }
}

$sql = "INSERT INTO tb_lessons (l_name, l_mb_id, l_lesson_desc, l_image, l_released_date) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    echo "SQL Error: " . mysqli_error($conn);
    exit();
}

mysqli_stmt_bind_param($stmt, "sisss", $l_name, $mb_id, $l_lesson_desc, $l_image, $l_released_date);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    echo "<script> window.location.replace('view-gk-mindbooster.php?mb_id=" . $mb_id . "'); </script>";
} else {
    echo "SQL Error: " . mysqli_error($conn);
    echo "<script>alert('Failed to insert lesson.');</script>";
}

mysqli_close($conn);
?>
