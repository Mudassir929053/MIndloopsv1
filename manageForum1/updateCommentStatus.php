<?php
// Assuming you have a database connection established
include '../dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the comment ID and new status from the AJAX request
  $commentId = $_POST['commentId'];
  $newStatus = $_POST['newStatus'];

  // Update the comment status in the database
  $sql = "UPDATE forum_postcomment SET approved = '$newStatus' WHERE comment_id = '$commentId'";
  $result = $conn->query($sql);

  if ($result) {
    // Status update successful
    echo "Comment status updated successfully.";
  } else {
    // Error occurred while updating status
    echo "Error updating comment status.";
  }
} else {
  // Redirect or handle the situation when the script is accessed directly
  echo "Invalid request.";
}
?>
