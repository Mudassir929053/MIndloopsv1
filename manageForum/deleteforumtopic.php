<?php 
include '../dbconnect.php';
extract($_REQUEST);
 $sql="delete from forum_topic where forumtopic_id ='$forum_id'";
 $result = $conn->query($sql);
 if($result != false){
    echo "Forum Topic Deleted successfully";
 }
 else{
    echo "Something went wrong";
 }

?>