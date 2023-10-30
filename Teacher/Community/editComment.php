<?php
// Include the database connection file
include '../../dbconnect.php';

// Check if the comment_id and content are provided
if (isset($_POST['comment_id']) && isset($_POST['content'])) {
    // Retrieve the comment_id and content from the POST data
    $comment_id = $_POST['comment_id'];
    $content = $_POST['content'];
    $articleId = mysqli_real_escape_string($conn, $_GET['article_id']);
    $category_id = mysqli_real_escape_string($conn, $_GET['category_id']);
    $community_id = mysqli_real_escape_string($conn, $_GET['community_id']);

    // Update the comment in the database
    $updateQuery = "UPDATE communityarticlecomment 
                    SET 
                        comment_content = ?,
                        updated_at = NOW()
                    WHERE comment_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $content, $comment_id);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        // Display an alert message and redirect to the view_comments page
        echo "<script>
            alert('Comment updated successfully.');
            window.location.href = 'view_comments.php?article_id=$articleId&category_id=$category_id&community_id=$community_id';
        </script>";
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
