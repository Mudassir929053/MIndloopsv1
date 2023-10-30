<?php
include "../dbconnect.php";

if (isset($_POST['edit_lesson'])) {
    $l_id = $_POST['l_id'];
    $mb_id = $_POST['mb_id'];
    $l_name = $_POST['l_name'];
    $l_lesson_desc = $_POST['l_lesson_desc'];
    $l_released_date = $_POST['l_released_date'];

    // Check if a new image file is uploaded
    if (!empty($_FILES['l_image']['name'])) {
        $upload_dir = "../assets/lesson_images/";
        $file_name = $_FILES['l_image']['name'];
        $file_tmp = $_FILES['l_image']['tmp_name'];
        $file_path = $upload_dir . $file_name;

        // Move the uploaded image to the designated directory
        if (move_uploaded_file($file_tmp, $file_path)) {
            $l_image = $file_path;
        } else {
            echo "<script>alert('Failed to upload the image file.');</script>";
        }
    } else {
        // Retrieve the previous image path from the database
        $query = "SELECT l_image FROM tb_lessons WHERE l_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $previous_image);
        mysqli_stmt_fetch($stmt);

        $l_image = $previous_image;

        mysqli_stmt_close($stmt);
    }

    // Update the record in the database
    $query = "UPDATE tb_lessons SET l_name = ?, l_lesson_desc = ?, l_image = ?, l_released_date = ? WHERE l_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $l_name, $l_lesson_desc, $l_image, $l_released_date, $l_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('article updated successfully.');</script>";
        echo "<script>window.location.href = 'view-gk-mindbooster.php?mb_id=$mb_id';</script>";
    } else {
        echo "<script>alert('Failed to update Lesson.');</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
