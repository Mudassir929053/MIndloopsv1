<?php
session_start();
include '../../dbconnect.php';

// Check if the comment_id and content are provided
if (isset($_POST['comment_id']) && isset($_POST['content'])) {
    $user_id = $_SESSION['u_id'];

    // Retrieve the comment_id and content from the POST data
    $comment_id = $_POST['comment_id'];
    $content = $_POST['content'];
    $forum_id = $_GET['forum_id'];
    $forumtopic_id = $_GET['forumtopic_id'];

    // Check if a file is uploaded
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $attachment_name = $_FILES['attachment']['name'];
        $attachment_tmp = $_FILES['attachment']['tmp_name'];

        // Generate a unique file name
        $unique_filename = uniqid() . '_' . $attachment_name;

        $attachment_path = '../../assets/kidzcorner/attachment/' . $unique_filename;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($attachment_tmp, $attachment_path)) {
            // Retrieve the previous attachment if it exists
            $selectQuery = "SELECT attachment FROM kiszspostcomment WHERE comment_id = ?";
            $stmt = $conn->prepare($selectQuery);
            $stmt->bind_param("i", $comment_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($previous_attachment);
            $stmt->fetch();

            // Update the comment with the new attachment
            $updateQuery = "UPDATE kiszspostcomment SET content = ?, attachment = ? WHERE comment_id = ?";
            $stmtUpdate = $conn->prepare($updateQuery);
            $stmtUpdate->bind_param("ssi", $content, $unique_filename, $comment_id);
            $stmtUpdate->execute();

            // Check if the update was successful
            if ($stmtUpdate->affected_rows > 0) {
                // Delete the previous attachment if it exists
                if ($previous_attachment && file_exists('../assets/kidzcorner/attachment/' . $previous_attachment)) {
                    unlink('../assets/kidzcorner/attachment/' . $previous_attachment);
                }

                // Redirect back to the forum topics page
                echo "<script>window.location='forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id'</script>";
                exit();
            } else {
                // Handle the case when the update fails
                echo "Failed to update comment.";
            }
        } else {
            // Failed to move the uploaded file
            echo "Failed to move the attachment file.";
        }
    } else {
        // No file uploaded, update the comment without attachment
        $updateQuery = "UPDATE kiszspostcomment SET content = ? WHERE comment_id = ?";
        $stmtUpdate = $conn->prepare($updateQuery);
        $stmtUpdate->bind_param("si", $content, $comment_id);
        $stmtUpdate->execute();

        // Check if the update was successful
        if ($stmtUpdate->affected_rows > 0) {
            // Redirect back to the forum topics page
            echo "<script>window.location='forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id'</script>";
            exit();
        } else {
            // Handle the case when the update fails
            echo "Failed to update comment.";
        }
    }
} else {
    // Handle the case when the comment_id or content is missing
    echo "Invalid request.";
}

$conn->close();
?>
