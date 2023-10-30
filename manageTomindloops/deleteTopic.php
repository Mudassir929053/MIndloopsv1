<?php 
include '../dbconnect.php';
extract($_REQUEST);
 $sql="delete from to_mindloops_topics where to_mindloops_topic_id ='$topic_id'";
 $result = $conn->query($sql);
 if($result != false){
    echo "Topic Deleted successfully";
 }
 else{
    echo "Something went wrong";
 }

?>