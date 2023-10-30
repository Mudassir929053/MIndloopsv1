<?php
// Include the database connection file
include("../../dbconnect.php");

function deleteCommunity($communityId)
{
    global $conn;
    // Perform the deletion
    $deleteQuery = "DELETE FROM `community_article` WHERE `article_id` = $communityId";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    if ($deleteResult) {
        // Deletion successful
        return true;
    } else {
        // Deletion failed
        return false;
    }
}

// Check if the article_id, category_id, and community_id parameters are provided in the URL
if (isset($_GET['article_id']) && isset($_GET['category_id']) && isset($_GET['community_id'])) {
    $articleId = $_GET['article_id'];
    $categoryId = $_GET['category_id'];
    $communityId = $_GET['community_id'];

    // Call the deleteCommunity function
    $isDeleted = deleteCommunity($articleId);

    if ($isDeleted) {
        // Display an alert message and redirect to the referring page
        echo "<script>
            alert('Article deleted successfully.');
            location.href = 'community-article.php?category_id=$categoryId&community_id=$communityId';
        </script>";
        exit;
    } else {
        echo "Failed to delete the article.";
    }
} else {
    echo "Invalid parameters provided.";
}

// Close the database connection
  
?>

