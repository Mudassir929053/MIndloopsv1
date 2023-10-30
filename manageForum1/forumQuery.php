<?php 
    include '../dbconnect.php';
    $data = [];

    extract($_GET);
    if(!empty($allforum)){
        $sql = "SELECT A.*,B.u_name as owner FROM forum A join tb_users B on A.created_by=B.u_id";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $data[]=$row;
        }
        echo json_encode($data);
    }
    if(!empty($forumtopic)){
        extract($_REQUEST);
        $sql = "SELECT * from forum_topic where forum_id='$forum_id'";
        $result= $conn->query($sql);
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        echo json_encode($data);
    }
    // if(!empty())
    if(!empty($updateforum)){
        extract($_POST);
        $sql = "update forum set forum_name='$forum_name',forum_description='$forum_desc',forum_for='$forum_for',published='$status' where forum_id='$forum_id'";
        $result = $conn->query($sql);
        if($result != false){
            echo "Updated successfully";

        }
        else{
            echo "Something went wrong";
        }
    }   

    if(!empty($updateforumtopic)){
        extract($_POST);
        // exit;
        $sql = "update forum_topic set ft_name='$ft_name',ft_description='$ft_desc',published='$status' where forumtopic_id='$forumtopic_id'";
        $result = $conn->query($sql);
        if($result != false){
            echo "Updated successfully";

        }
        else{
            echo "Something went wrong";
        }
    }

    if(!empty($topiccomments)){
        extract($_REQUEST);
        $sql = "SELECT * FROM `forum_postcomment` LEFT JOIN tb_users ON forum_postcomment.created_by = tb_users.u_id WHERE subforumtopic_id='$forumtopic_id'";
        $result= $conn->query($sql);
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        echo json_encode($data);
    }
    
?>