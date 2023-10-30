<?php 
include '../../dbconnect.php';
extract($_REQUEST);
 $sql="delete from forum where forum_id='$forum_id'";
 $result = $conn->query($sql);
 if ($result !== false) {
  
  echo "<script>alert('Forum deleted successfully.');</script>";
  echo "<script>window.location.href = 'forum.php';</script>";
} else {
  echo "Something went wrong.";
}
