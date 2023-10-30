<?php
include '../../dbconnect.php';
$data = [];
extract($_GET);

if (!empty($updateforumtopic)) {
    extract($_POST);

    // Handle image upload
    if (isset($_FILES['c_thumbnail']) && $_FILES['c_thumbnail']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['c_thumbnail']['tmp_name'];
        $fileName = $_FILES['c_thumbnail']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Generate a unique file name
        $newFileName = uniqid() . '.' . $fileExtension;

        // Set the destination path for the uploaded file
        $destPath = '../../assets/tomindloops/tomindloops_attachment/' . 'uniquename_' . $newFileName;

        // Move the uploaded file to the destination path
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // Update forum topic with image
            $stmt = $conn->prepare("UPDATE kidzpost SET title=?, content=?, attachment=? WHERE kidzpost_id=?");
            $stmt->bind_param("sssi", $ft_name, $ft_desc, $destPath, $forumtopic_id);

            if ($stmt->execute()) {
                echo "Updated successfully";
            } else {
                echo "Something went wrong: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Failed to move the uploaded file.";
        }
    } else {
        // Update forum topic without image
        $stmt = $conn->prepare("UPDATE kidzpost SET title=?, content=? WHERE kidzpost_id=?");
        $stmt->bind_param("ssi", $ft_name, $ft_desc, $forumtopic_id);

        if ($stmt->execute()) {
            echo "Updated successfully";
        } else {
            echo "Something went wrong: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
