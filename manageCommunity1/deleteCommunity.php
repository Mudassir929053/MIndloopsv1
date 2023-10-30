<?php 
include '../dbconnect.php';
extract($_REQUEST);
 $sql="delete from community where community_id='$c_id'";
 $result = $conn->query($sql);
 if($result != false){
    echo "Community Deleted successfully";
 }
 else{
    echo "Something went wrong";
 }

?>