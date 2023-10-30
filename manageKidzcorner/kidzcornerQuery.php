<?php 
session_start();

    include '../dbconnect.php';
    $data = [];

    extract($_GET);
    if(!empty($allCommunity)){
        $sql = "Select * from community";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $data[]=$row;
        }
        echo json_encode($data);
    }

    if(!empty($allTopics)){
        $sql = "Select * from kidzcreativecorner";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $data[]=$row;
        }
        echo json_encode($data);
    }
    // if(!empty())
    if(!empty($updateCommunity)){
        extract($_POST);
        $sql = "update community set community_name='$c_name',community_description='$c_desc',published='$status' where community_id='$community_id'";
        $result = $conn->query($sql);
        if($result != false){
            echo "Updated successfully";

        }
        else{
            echo "Something went wrong";
        }
    }
    if(!empty($updateComment)){
        extract($_POST);
        $sql = "update kiszspostcomment set content='$ca_desc',approved='$status' where comment_id='$comment_id'";
        $result = $conn->query($sql);
        if($result != false){
            echo "Updated successfully";

        }
        else{
            echo "Something went wrong";
        }
    }
    if(!empty($allComments_kidz_posts)){
        extract($_REQUEST);
        $sql = "SELECT A.comment_id,A.kidzpost_id,A.content,B.u_name as created_by, A.created_at,A.likes,A.dislikes,approved FROM kiszspostcomment A join tb_users B on A.created_by=B.u_id where kidzpost_id='$kidzpost_id'";
        $result= $conn->query($sql);
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        echo json_encode($data);
    }
    if(!empty($communityCategory)){
        extract($_REQUEST);
        $sql = "SELECT * from community_category where community_id='$community_id'";
        $result= $conn->query($sql);
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        echo json_encode($data);
    }

    if(!empty($kidzcornerArticles)){
        extract($_REQUEST);
        $sql = "SELECT A.*,B.u_name as owner FROM kidzpost A join tb_users B on A.created_by = B.u_id where topic_id='$topic_id'";
        $result= $conn->query($sql);
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        echo json_encode($data);
    }

    if(!empty($updateCategory)){
        extract($_POST);
       
        $sql = "update community_category set cc_name='$c_name',cc_description='$c_desc',published='$status' where category_id='$cc_id'";
        $result = $conn->query($sql);
        if($result != false){
            echo "Updated successfully";

        }
        else{
            echo "Something went wrong";
        }
    }
    if(!empty($updateTopic)){
        extract($_POST);      
        $sql = "update kidzcreativecorner set topic_name='$c_name',description='$c_desc',published='$status' where topic_id='$topic_id'";
        $result = $conn->query($sql);
        if($result != false){
            echo "Updated successfully";

        }
        else{
            echo "Something went wrong";
        }
    }
    if(!empty($communityArticle)){
        extract($_REQUEST);
        $sql = "SELECT * from community_article where cc_id='$cc_id'";
        $result= $conn->query($sql);
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        echo json_encode($data);
    }
    if(!empty($updateArticle)){
        extract($_REQUEST);        
        if (isset($_FILES['m_filePath']) && $_FILES['m_filePath']['name'] !='') {
            $dest_file1='';
            if (($_FILES['m_filePath']['type'] == "image/png") ||  ($_FILES['m_filePath']['type'] == "image/jpg") || ($_FILES['m_filePath']['type'] == "image/jpeg") || ($_FILES['m_filePath']['type'] == "application/pdf")) {
                if (!is_dir("../assets/community/community_attachment/")) {
                    mkdir("../assets/community/community_attachment/");
                }
                $source_file1 = $_FILES['m_filePath']['tmp_name'];
                $dest_file1 = "../assets/community/community_attachment/".time(). $_FILES['m_filePath']['name'];
                if (file_exists($dest_file1)) {
                    unlink($dest_file1);
                    $m_filePath = $dest_file1;
                } else {
                    $m_filePath = $dest_file1;
                }
                move_uploaded_file( $source_file1, $dest_file1 );
            } 
            $sql = "update kidzpost set title='$ca_name',content='$ca_desc',published='$status',attachment='$dest_file1' where kidzpost_id='$kidzpost_id' and topic_id='$topic_id'";
        }
        else{

            $sql = "update kidzpost set title='$ca_name',content='$ca_desc',published='$status' where kidzpost_id='$kidzpost_id' and topic_id='$topic_id'";
        }
    //   exit;
        $result= $conn->query($sql);
        if($result != false){
            echo "Updated successfully";

        }
        else{
            echo "Something went wrong";
        }

    }
    
?>