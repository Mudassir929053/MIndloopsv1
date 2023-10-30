<?php
// Include the database connection file
include("../../dbconnect.php");
function deleteCommunity($communityId)
{
    global $conn;
    // Perform the deletion
    $deleteQuery = "DELETE FROM `to_mindloops_articles` WHERE `article_id` = $communityId";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    if ($deleteResult) {
        // Deletion successful
        return true;
    } else {
        // Deletion failed
        return false;
    }
}
// Check if the community_id parameter is provided in the URL
if (isset($_GET['article_id'])) {
    $communityId = $_GET['article_id'];
    // Call the deleteCommunity function
    $isDeleted = deleteCommunity($communityId);
    if ($isDeleted) {
        echo "<script>
		location.href = '$_SERVER[HTTP_REFERER]';</script>";
    } else {
        echo "Failed to delete the community.";
    }
}
// Close the database connection
mysqli_close($conn);
