<?php 
include '../dbconnect.php';
extract($_REQUEST);
 $sql="delete from forum_postcomment where comment_id='$comment_id'";
 $result = $conn->query($sql);
 if($result != false){
    echo "Comment Deleted successfully";
    
 }
 else{
    echo "Something went wrong";
 }
?>