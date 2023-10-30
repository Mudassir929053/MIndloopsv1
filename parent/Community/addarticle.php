<?php
   include("../../dbconnect.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form fields are set
    if (isset($_POST['article_title']) && isset($_POST['article_description'])) {

        // Escape special characters in the article title and description
        $articleTitle = mysqli_real_escape_string($conn, $_POST['article_title']);
        $articleDesc = mysqli_real_escape_string($conn, $_POST['article_description']);

        $to_mindloops_id = $_POST['category_id'];
        $comunity_id = $_POST['comunity_id'];
        $user = $_POST['user'];

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

        // Save the article details, thumbnail path, and attachment path to the database
        // Modify this part according to your database structure and connection
        $sql = "INSERT INTO community_article (ca_title, cc_id, ca_content, created_by, article_thumbnail, attachment) VALUES ('$articleTitle', '$to_mindloops_id', '$articleDesc', '$user', '$thumbnailName', '$attachmentName')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // Article added successfully
            // Retrieve the auto-generated article ID
            $articleId = mysqli_insert_id($conn);
            
            // Update the file names in the database to match the generated file names
            $updateSql = "UPDATE community_article SET thumbnail_filename = '$thumbnailName', attachment_filename = '$attachmentName' WHERE article_id = '$articleId'";
            // mysqli_query($conn, $updateSql);
            echo "<script>
            location.href = 'community-article.php?category_id=$to_mindloops_id&community_id=$comunity_id';
        </script>";        
            // header("Location: to-mindloops-article.php?to_mindloops_id=$to_mindloops_id");
            exit;
        } else {
            // Failed to add the article
            echo "Error adding the article.";
        }
    } else {
        // Required fields not set
        echo "Please fill in all the required fields.";
    }
}
?>

