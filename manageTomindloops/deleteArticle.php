<?php 
include '../dbconnect.php';
extract($_REQUEST);
 $sql="delete from to_mindloops_articles where article_id='$ca_id'";
 $result = $conn->query($sql);
 if($result != false){
    echo "Article Deleted successfully";
 }
 else{
    echo "Something went wrong";
 }

?>