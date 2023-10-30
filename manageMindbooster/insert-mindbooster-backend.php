<?php

@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '600');

include '../dbconnect.php';

// $mb_sub_code = $_POST['mb_sub_code'];
$mb_sub_name = $_POST['mb_sub_name'];
$mb_sub_name1 = strtoupper($mb_sub_name);
$mb_sub_desc = $_POST['mb_sub_desc'];
$mb_sub_image = $_FILES['mb_sub_image']['name'];
$mb_sub_released_date = $_POST['mb_sub_released_date'];

$target_dir = "../assets/mindbooster/";
$target_file = $target_dir . basename($_FILES['mb_sub_image']['name']);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a valid format
if ($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png") {
    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES['mb_sub_image']['tmp_name'], $target_file)) {
        // Insert the data into the database
        $sql = "INSERT INTO tb_mindbooster (mb_sub_name, mb_sub_desc, mb_sub_image, mb_sub_released_date) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $mb_sub_name1, $mb_sub_desc, $target_file, $mb_sub_released_date);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                header("Location: manage-mindbooster.php");
                exit();
            } else {
                echo "SQL ERROR: " . mysqli_error($conn);
            }
        } else {
            echo "SQL ERROR: " . mysqli_error($conn);
        }
    } else {
        echo "Error moving uploaded file.";
    }
} else {
    echo "Invalid image file format. Only JPG, JPEG, and PNG are allowed.";
}

?>
