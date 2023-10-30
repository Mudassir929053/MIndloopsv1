<?php
 

// Retrieve the forumtopic_id and comment_id from the URL parameters
$forumtopic_id = $_GET['forumtopic_id'] ?? '';
$forum_id = $_GET['forum_id'] ?? '';
$comment_id = $_GET['comment_id'] ?? '';

if (!empty($forumtopic_id) && !empty($comment_id)) {
    // Construct the delete query
    $sql = "DELETE FROM forum_postcomment WHERE subforumtopic_id = '$forumtopic_id' AND comment_id = '$comment_id'";

    // Execute the delete query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Forum topic deleted successfully.');</script>";
        echo "<script>window.location.href = 'forum_article_comments.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id';</script>";
        exit; // Stop execution after redirecting
    } else {
        echo "Error deleting comment: " . $conn->error;
    }
} else {
    echo "Invalid parameters";
}
?>


