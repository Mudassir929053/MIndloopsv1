<?php 
include '../dbconnect.php';
date_default_timezone_set("Asia/Kuala_Lumpur");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);

    // Check if a file was uploaded successfully
    if (isset($_FILES['c_thumbnail']) && $_FILES['c_thumbnail']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['c_thumbnail']['tmp_name'];
        $fileName = $_FILES['c_thumbnail']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Generate a unique file name
        $newFileName = uniqid() . '.' . $fileExtension;

        // Set the destination path for the uploaded file
        $destPath = '../assets/forum/article_thumbnail/' . $newFileName;

        // Move the uploaded file to the destination path
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // File uploaded successfully, proceed with inserting the record into the database
            $sql = "INSERT INTO forum_topic (forum_id, ft_name, ft_description, article_thumbnail, created_by) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "isssi", $forum_id, $c_name, $c_desc, $newFileName, $user_id);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);
                    echo '<script>alert("Topic added successfully");</script>';
                    echo '<script>window.location.replace("forum_details.php?forum_id=' . $forum_id . '");</script>';
                } else {
                    echo '<script>alert("Failed to add topic");</script>';
                    echo '<script>window.location.replace("addTopic.php?forum_id=' . $forum_id . '");</script>';
                }
            } else {
                echo '<script>alert("Failed to prepare SQL statement");</script>';
                echo '<script>window.location.replace("addTopic.php?forum_id=' . $forum_id . '");</script>';
            }
        } else {
            echo '<script>alert("Failed to move the uploaded file");</script>';
            echo '<script>window.location.replace("addTopic.php?forum_id=' . $forum_id . '");</script>';
        }
    } else {
        echo '<script>alert("No file was uploaded");</script>';
        echo '<script>window.location.replace("addTopic.php?forum_id=' . $forum_id . '");</script>';
    }
}
?>
