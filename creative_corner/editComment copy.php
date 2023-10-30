<?php
if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '3') {
    echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
    exit();
}
include '../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $commentId = $_POST['comment_id'];
    $forumId = $_GET['forum_id'];
    $forumtopicId = $_GET['forumtopic_id'];
    $newContent = $_POST['content'];
// var_dump($_REQUEST);
// var_dump($_FILES);
// exit;
    // Handle attachment update if necessary
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $attachment = $_FILES['attachment'];

        // Specify the directory to store the attachments
        $attachmentDir = "../assets/kidzcorner/attachment/";

        // Generate a unique filename for the attachment
        $attachmentName = uniqid() . '_' . $attachment['name'];

        // Construct the complete file path
        $attachmentPath = $attachmentDir . $attachmentName;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($attachment['tmp_name'], $attachmentPath)) {
            // File uploaded successfully, update the attachment field in the database
            // Update the comment and attachment in the database
            $sql = "UPDATE kiszspostcomment SET content = ?, attachment = ? WHERE comment_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $newContent, $attachmentPath, $commentId);
            $stmt->execute();
            echo "<script>
            alert('Update the comment and attachment in the database');
          </script>";
        } else {
            echo "<script>
            alert('Failed to move the attachment file');
            window.location.href = 'forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id';
          </script>";
        }
    } else {
        // No file was uploaded, so no need to update the attachment field in the database
        $attachmentPath = null;

        // Update the comment without updating the attachment field in the database
        $sql = "UPDATE kiszspostcomment SET content = ? WHERE comment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newContent, $commentId);
        $stmt->execute();
        echo "<script>
        alert('Update the content in the database');
      </script>";
    }

    // Redirect back to the forum page or wherever appropriate
    header("Location: forum_topics.php?forum_id=$forumId&forumtopic_id=$forumtopicId");
    exit();
}
