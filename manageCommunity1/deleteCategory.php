<?php 
include '../dbconnect.php';
extract($_REQUEST);
 $sql="delete from community_category where category_id='$c_id'";
 $result = $conn->query($sql);
 if($result != false){
    echo "Community Category Deleted successfully";
 }
 else{
    echo "Something went wrong";
 }

?>