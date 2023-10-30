<?php
// Include the database connection
include '../../dbconnect.php';
 

// Check if the comment ID is provided
if (isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];
    $articleId = mysqli_real_escape_string($conn, $_GET['article_id']);
    $category_id = mysqli_real_escape_string($conn, $_GET['category_id']);
    $community_id = mysqli_real_escape_string($conn, $_GET['community_id']);

    // Delete the comment from the database
    $deleteQuery = "DELETE FROM `communityarticlecomment` WHERE `comment_id` = $comment_id";
    $deleteResult = $conn->query($deleteQuery);

    if ($deleteResult) {
        // echo "Comment deleted successfully.";
        echo "<script>alert('Comment deleted successfully.')</script>";
        echo "<script>window.location='view_comments.php?article_id=$articleId&category_id=$category_id&community_id=$community_id'</script>";

    } else {
        echo "Failed to delete the comment.";
    }
} else {
    echo "Invalid comment ID.";
}
?>
