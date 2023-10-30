<?php
 
extract($_REQUEST);

$sql = "DELETE FROM forum_topic WHERE forumtopic_id = '$forumtopic_id' AND forum_id = '$forum_id'";
$result = $conn->query($sql);

if ($result !== false) {
    echo "<script>alert('Forum topic deleted successfully.');</script>";
    echo "<script>window.location.href = 'forum-articles.php?forum_id=$forum_id';</script>";
} else {
    echo "Something went wrong.";
}
?>
