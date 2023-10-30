<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id=$_GET['category_id'];
    $community_id=$_GET['community_id'];

    // Check if the form fields are set
    if (isset($_POST['article_title']) && isset($_POST['article_decs']) && isset($_POST['article_id'])) {

        // Escape special characters in the article title and description
                 $articleTitle = mysqli_real_escape_string($conn, $_POST['article_title']);
                 $articleDesc = mysqli_real_escape_string($conn, $_POST['article_decs']);
                 $articleId = $_POST['article_id'];
               

        // Check if a thumbnail file was uploaded
        if (isset($_FILES['article_thumbnail']) && $_FILES['article_thumbnail']['error'] === UPLOAD_ERR_OK) {
            $thumbnail = $_FILES['article_thumbnail'];
            // Set the directory to store the uploaded thumbnail files
            $thumbnailDir = '../../assets/community/thumbnails/';
            // Generate a unique thumbnail file name
            $thumbnailName = date('YmdHis'). '_' . $thumbnail['name'];
            // Move the uploaded thumbnail file to the desired directory
            move_uploaded_file($thumbnail['tmp_name'], $thumbnailDir . $thumbnailName);
        } else {
            $thumbnailName = ''; // If no thumbnail was uploaded, set the thumbnail name to an empty string
        }

        // Check if a file was uploaded
        if (isset($_FILES['article_attachment']) && $_FILES['article_attachment']['error'] === UPLOAD_ERR_OK) {
            $attachment = $_FILES['article_attachment'];
            // Set the directory to store the uploaded files
            $uploadDir = '../../assets/community/community_attachment/';
            // Generate a unique file name
            $attachmentName = date('YmdHis') . '_' . $attachment['name'];
            // Move the uploaded file to the desired directory
            move_uploaded_file($attachment['tmp_name'], $uploadDir . $attachmentName);
        } else {
            $attachmentName = ''; // If no attachment was uploaded, set the attachment name to an empty string
        }

        // Update the article details, thumbnail path, and attachment path in the database
        // Modify this part according to your database structure and connection
        include("../../dbconnect.php");
        $updateSql = "UPDATE community_article SET ca_title = '$articleTitle', ca_content = '$articleDesc', article_thumbnail = '$thumbnailName', attachment = '$attachmentName' WHERE article_id = '$articleId'";
        $result = mysqli_query($conn, $updateSql);
        if ($result) {
            // Article updated successfully
            echo "<script>
            location.href = 'community-category-article.php?category_id=$category_id&community_id=$community_id';
        </script>";    
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
