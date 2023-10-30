<?php 
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
        $sql = "update communityarticlecomment set comment_content='$ca_desc',approved='$status' where comment_id='$comment_id'";
        $result = $conn->query($sql);
        if($result != false){
            echo "Updated successfully";

        }
        else{
            echo "Something went wrong";
        }
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

    if(!empty($communityArticle)){
        extract($_REQUEST);
        $sql = "SELECT A.*, B.u_name as owner from community_article A join tb_users B on A.created_by=B.u_id where cc_id='$cc_id'";
        $result= $conn->query($sql);
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        echo json_encode($data);
    }

    if(!empty($allComments_community_articles)){
        extract($_REQUEST);
        $sql = "SELECT A.comment_id,A.article_id,A.comment_content,B.u_name as created_by, A.created_at,A.likes,A.dislikes,approved FROM communityarticlecomment A join tb_users B on A.created_by=B.u_id where article_id='$artcile_id'";
        $result= $conn->query($sql);
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        echo json_encode($data);
    }
    if(!empty($updateArticle)){
        extract($_REQUEST);
        // var_dump($_FILES['m_filePath']);
        // exit;
        // exit;
        
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
            $sql = "update community_article set ca_title='$ca_name',ca_content='$ca_desc',published='$status',attachment='$dest_file1' where article_id='$ca_id' and cc_id='$cc_id'";
        }
        else{

            $sql = "update community_article set ca_title='$ca_name',ca_content='$ca_desc',published='$status' where article_id='$ca_id' and cc_id='$cc_id'";
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