<?php 
include '../dbconnect.php';
extract($_REQUEST);
 $sql="delete from forum where forum_id='$forum_id'";
 $result = $conn->query($sql);
 if($result != false){
    echo "Forum Deleted successfully";
 }
 else{
    echo "Something went wrong";
 }

?>