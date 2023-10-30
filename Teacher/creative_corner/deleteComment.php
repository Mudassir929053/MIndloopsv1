<?php
// Include the database connection
include '../../dbconnect.php';

// Check if the comment ID is provided
if (isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];
    $forum_id = $_GET['forum_id'];
    $forumtopic_id = $_GET['forumtopic_id'];


    // Delete the comment from the database
    $deleteQuery = "DELETE FROM `kiszspostcomment` WHERE `comment_id` = $comment_id";
    $deleteResult = $conn->query($deleteQuery);

    if ($deleteResult) {
        // echo "Comment deleted successfully.";
        echo "<script>alert('Comment deleted successfully.')</script>";
        echo "<script>window.location='forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id'</script>";

    } else {
        echo "Failed to delete the comment.";
    }
} else {
    echo "Invalid comment ID.";
}
?>
