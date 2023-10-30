<?php
session_start();
$user_id = $_SESSION['u_id'];
include '../../dbconnect.php';
date_default_timezone_set("Asia/Kuala_Lumpur");

// Sanitize and escape the comment_content and article_id parameters
$commentContent = mysqli_real_escape_string($conn, $_POST['content']);
$articleId = mysqli_real_escape_string($conn, $_GET['article_id']);
$category_id = mysqli_real_escape_string($conn, $_GET['category_id']);
$community_id = mysqli_real_escape_string($conn, $_GET['community_id']);

// Construct the SQL query to insert the comment
$insertQuery = "INSERT INTO communityarticlecomment (article_id, comment_content, created_by) VALUES ('$articleId', '$commentContent', '$user_id')";

// Execute the query and handle errors
if (mysqli_query($conn, $insertQuery)) {
    echo "Comment submitted successfully";
    header("Location: view_comments.php?article_id=$articleId&category_id=$category_id&community_id=$community_id");
} else {
    // Error occurred during insertion
    echo "Error inserting comment: " . mysqli_error($conn);
}
?>

