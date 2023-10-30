<?php
include '../dbconnect.php';

if (isset($_POST['edit_mindbooster'])) {
    // Get form data
    $mb_id = $_POST['mb_id'];
    // $mb_sub_code = $_POST['mb_sub_code'];
    $mb_sub_name = $_POST['mb_sub_name'];
    $mb_sub_name1 = strtoupper($mb_sub_name);
    $mb_sub_desc = $_POST['mb_sub_desc'];
    $mb_sub_released_date = $_POST['mb_sub_released_date'];

    // Check if a new image file is uploaded
    if (!empty($_FILES['mb_sub_image']['name'])) {
        $upload_dir = "../assets/mindbooster/";
        $file_name = $_FILES['mb_sub_image']['name'];
        $file_tmp = $_FILES['mb_sub_image']['tmp_name'];
        $file_path = $upload_dir . $file_name;

        // Move the uploaded image to the designated directory
        if (move_uploaded_file($file_tmp, $file_path)) {
            $mb_sub_image = $file_path;
        } else {
            echo "<script>alert('Failed to upload the image file.');</script>";
        }
    } else {
        // Keep the existing image path if no new file is uploaded
        $query = "SELECT mb_sub_image FROM tb_mindbooster WHERE mb_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $mb_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $existing_image);
        mysqli_stmt_fetch($stmt);

        $mb_sub_image = $existing_image;

        mysqli_stmt_close($stmt);
    }

    // Update the record in the database
    $query = "UPDATE tb_mindbooster SET  mb_sub_name = ?, mb_sub_desc = ?, mb_sub_image = ?, mb_sub_released_date = ? WHERE mb_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $mb_sub_name1, $mb_sub_desc, $mb_sub_image, $mb_sub_released_date, $mb_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Mind Booster updated successfully.');</script>";
        echo "<script>window.location.href = 'manage-mindbooster.php';</script>";
    } else {
        echo "<script>alert('Failed to update Mind Booster.');</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
