<?php
session_start();
$user = $_SESSION['u_id'];
 include '../../dbconnect.php';
// echo $user;
extract($_REQUEST);
$liked = false;
$disliked = false;

if(!empty($likeForumArticle)){
    $sql = "SELECT * from kidzpost where kidzpost_id='$article_id'";
    $likes=[];
    $dislikes = [];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           $likes = $row['liked_by'];
           $dislikes = $row['disliked_by']; 
        }
    }
    if($likes){
        $likes = explode(',',$likes);
    }
    else{
        $likes=[];
    }
    if($dislikes){
        $dislikes = explode(',',$dislikes);
    }
    else{
        $dislikes=[];
    }

    if(in_array($user,$likes)){
        unset($likes[array_search($user,$likes)]);
        $liked = true;
    }
    if(in_array($user,$dislikes)){
        unset($dislikes[array_search($user,$dislikes)]);
        $disliked = true;
    }
    if($action == 'like'){
        array_push($likes,$user);
    }
    else{
        array_push($dislikes,$user);
    }
    
    $total_likes = count($likes);
    $total_dislikes = count($dislikes);
    // $likes_str = json_encode($likes);
    $likes_str = implode(',',$likes);

    $dislikes_str = implode(',',$dislikes);
    $sqlupdate = "UPDATE kidzpost SET likes='$total_likes',dislikes='$total_dislikes',liked_by='$likes_str',disliked_by='$dislikes_str' where kidzpost_id='$article_id'";
    if($action=='like' && !$liked){
        $update = $conn->query($sqlupdate);
    }
    else if($action == 'dislike' && !$disliked){

        $update = $conn->query($sqlupdate);
    }
    echo implode('#',[$total_likes,$total_dislikes]);
}
if(!empty($likeForumComment)){
    $sql = "SELECT * FROM kiszspostcomment where comment_id='$comment_id'";
    $likes=[];
    $dislikes = [];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           $likes = $row['liked_by'];
           $dislikes = $row['disliked_by']; 
        }
    }
    if($likes){
        $likes = explode(',',$likes);
    }
    else{
        $likes=[];
    }
    if($dislikes){
        $dislikes = explode(',',$dislikes);
    }
    else{
        $dislikes=[];
    }

    if(in_array($user,$likes)){
        unset($likes[array_search($user,$likes)]);
        $liked = true;
    }
    if(in_array($user,$dislikes)){
        unset($dislikes[array_search($user,$dislikes)]);
        $disliked = true;
    }
    if($action == 'like'){
        array_push($likes,$user);
    }
    else{
        array_push($dislikes,$user);
    }
    
    $total_likes = count($likes);
    $total_dislikes = count($dislikes);
    // $likes_str = json_encode($likes);
    $likes_str = implode(',',$likes);

    $dislikes_str = implode(',',$dislikes);
    $sqlupdate = "UPDATE kiszspostcomment SET likes='$total_likes',dislikes='$total_dislikes',liked_by='$likes_str',disliked_by='$dislikes_str' where comment_id='$comment_id'";
    if($action=='like' && !$liked){
        $update = $conn->query($sqlupdate);
    }
    else if($action == 'dislike' && !$disliked){

        $update = $conn->query($sqlupdate);
    }

    echo implode('#',[$total_likes,$total_dislikes]);
}