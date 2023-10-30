<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form fields are set
    if (isset($_POST['article_title']) && isset($_POST['article_content']) && isset($_POST['article_id'])) {

        // Escape special characters in the article title and description
        $articleTitle = mysqli_real_escape_string($conn, $_POST['article_title']);
        $articleDesc = mysqli_real_escape_string($conn, $_POST['article_content']);
        $articleId = $_POST['article_id'];
        $to_mindloops_id = $_POST['to_mindloops_id'];

        // Get the current thumbnail and attachment from the database
        $query = "SELECT article_thumbnail, attachment FROM to_mindloops_articles WHERE article_id = '$articleId'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $currentThumbnail = $row['article_thumbnail'];
        $currentAttachment = $row['attachment'];

        // Check if a thumbnail file was uploaded
        if (isset($_FILES['article_thumbnail']) && $_FILES['article_thumbnail']['error'] === UPLOAD_ERR_OK) {
            // Delete the current thumbnail if it exists
            if (!empty($currentThumbnail)) {
                unlink('../../assets/tomindloops/tomindloops_attachment/' . $currentThumbnail);
            }

            $thumbnail = $_FILES['article_thumbnail'];
            // Set the directory to store the uploaded thumbnail files
            $thumbnailDir = '../../assets/tomindloops/tomindloops_attachment/';
            // Generate a unique thumbnail file name
            $thumbnailName = date('YmdHis') . '_' . $thumbnail['name'];
            // Move the uploaded thumbnail file to the desired directory
            move_uploaded_file($thumbnail['tmp_name'], $thumbnailDir . $thumbnailName);
        } else {
            $thumbnailName = $currentThumbnail; // If no thumbnail was uploaded, keep the current thumbnail
        }
        if (isset($_FILES['article_attechment']) && $_FILES['article_attechment']['error'] === UPLOAD_ERR_OK) {
            // Delete the current attachment if it exists
            if (!empty($currentAttachment)) {
                unlink('../../assets/tomindloops/tomindloops_attachment/' . $currentAttachment);
            }

            $attachment = $_FILES['article_attechment'];
            // Set the directory to store the uploaded files
            $uploadDir = '../../assets/tomindloops/tomindloops_attachment/';
            // Generate a unique file name
            $attachmentName = date('YmdHis') . '_' . $attachment['name'];
            // Move the uploaded file to the desired directory
            if (move_uploaded_file($attachment['tmp_name'], $uploadDir . $attachmentName)) {
                $attachmentName = $attachmentName; // If file uploaded successfully, update the attachment name
            } else {
                $attachmentName = $currentAttachment; // If file upload failed, keep the current attachment
            }
        } else {
            $attachmentName = $currentAttachment; // If no attachment was uploaded, keep the current attachment
        }


        // Update the article details, thumbnail path, and attachment path in the database
        // Modify this part according to your database structure and connection
        include("../../dbconnect.php");
        $updateSql = "UPDATE to_mindloops_articles SET article_title = '$articleTitle', article_content = '$articleDesc', article_thumbnail = '$thumbnailName', attachment = '$attachmentName' WHERE article_id = '$articleId'";
        $result = mysqli_query($conn, $updateSql);
        if ($result) {
            // Article updated successfully
            echo "<script>location.href = 'to-mindloops-article.php?to_mindloops_id=$to_mindloops_id';</script>";
            // header("Location: to-mindloops-article.php?to_mindloops_id=$to_mindloops_id");
            exit;
        } else {
            // Failed to update the article
            echo "Error updating the article.";
        }
    } else {
        // Required fields not set
        echo "Please fill in all the required fields.";
    }
}
