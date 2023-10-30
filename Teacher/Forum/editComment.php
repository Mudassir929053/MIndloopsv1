<?php
// Include the database connection file
include '../../dbconnect.php';

// Check if the comment_id and content are provided
if (isset($_POST['comment_id']) && isset($_POST['content'])) {
    // Retrieve the comment_id and content from the POST data
    $comment_id = $_POST['comment_id'];
    $content = $_POST['content'];
    $forum_id = $_GET['forum_id'];
    $forumtopic_id = $_GET['forumtopic_id'];

    // Update the comment in the database
    $updateQuery = "UPDATE forum_postcomment SET content = ? WHERE comment_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $content, $comment_id);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        // Redirect back to the forum topics page
        echo "<script>window.location='forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id'</script>";
        exit();
    } else {
        // Handle the case when the update fails
        echo "Failed to update comment.";
    }
} else {
    // Handle the case when the comment_id or content is missing
    echo "Invalid request.";
}
?>
