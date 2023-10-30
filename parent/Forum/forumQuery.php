<?php 
  
  include '../../dbconnect.php';

    $data = [];
     
    extract($_GET);
    if(!empty($allforum)){
        $sql = "Select * from forum";
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
        $forum_for='Adults';
        $sql = "update forum set forum_name='$forum_name',forum_description='$forum_desc',forum_for='$forum_for' where forum_id='$forum_id'";
        $result = $conn->query($sql);
        if($result != false){
            echo "Updated successfully";

        }
        else{
            echo "Something went wrong";
        }
    }   

    if (!empty($updateforumtopic)) {
        extract($_POST);
    
        // Handle image upload
        if (isset($_FILES['c_thumbnail']) && $_FILES['c_thumbnail']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['c_thumbnail']['tmp_name'];
            $fileName = $_FILES['c_thumbnail']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
    
            // Generate a unique file name
            $newFileName = uniqid() . '.' . $fileExtension;
    
            // Set the destination path for the uploaded file
            $destPath = '../../assets/forum/article_thumbnail/' . $newFileName;
    
            // Move the uploaded file to the destination path
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Update forum topic with image
                $sql = "UPDATE forum_topic SET ft_name='$ft_name', ft_description='$ft_desc', article_thumbnail='$newFileName' WHERE forumtopic_id='$forumtopic_id'";
                $result = $conn->query($sql);
    
                if ($result != false) {
                    echo "Updated successfully";
                } else {
                    echo "Something went wrong: " . $conn->error;
                }
            } else {
                echo "Failed to move the uploaded file.";
            }
        } else {
            // Update forum topic without image
            $sql = "UPDATE forum_topic SET ft_name='$ft_name', ft_description='$ft_desc' WHERE forumtopic_id='$forumtopic_id'";
            $result = $conn->query($sql);
    
            if ($result != false) {
                echo "Updated successfully";
            } else {
                echo "Something went wrong: " . $conn->error;
            }
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