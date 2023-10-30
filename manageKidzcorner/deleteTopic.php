<?php 
include '../dbconnect.php';
extract($_REQUEST);
// var_dump($_REQUEST);
// exit;
 $sql="delete from kidzcreativecorner where topic_id = $topic_id";
 $result = $conn->query($sql);
 if($result != false){
    echo "Topic Deleted successfully";
 }
 else{
    echo "Something went wrong";
 }

?>