<?php
include '../dbconnect.php';
extract($_REQUEST);
$sql = "DELETE FROM kidzpost WHERE topic_id = '$forum_id' AND kidzpost_id = '$forumtopic_id'";
$result = $conn->query($sql);
// exit;
if ($result !== false) {
    echo "<script>alert('Forum topic deleted successfully.');</script>";
    echo "<script>window.location.href = 'forum_details.php?forum_id=$forum_id';</script>";
} else {
    echo "Something went wrong.";
}
?>
