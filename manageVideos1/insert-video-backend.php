<?php

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '600' );

include '../dbconnect.php';

$v_id = (int)$_POST['v_id'];
$v_title = $_POST['v_title'];
$v_desc = $_POST['v_desc'];
$v_audience = $_POST['v_audience'];
$v_type = $_POST['v_type'];
// $m_imgPath = "pdf/Cover_Pages/" . $_POST['m_imgPath'];
$v_rDate = $_POST['v_rDate'];           

$mime = $_FILES['v_path']['type'];
$file = $_FILES['v_path']['name'];

// var_dump($mime);
$destination='';
if(strstr($mime,"video/")){
    // echo "here";
    $filename   = uniqid() . "_" . time(); // 5dab1961e93a7-1571494241
    $extension  = pathinfo( $_FILES["v_path"]["name"], PATHINFO_EXTENSION ); // jpg
    $basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg

    $source       = $_FILES["v_path"]["tmp_name"];
    $destination  = "../uploaded_video/{$basename}";

    /* move the file */
    move_uploaded_file( $source, $destination );

}
// echo $destination;
// exit;
$sql = "INSERT INTO tb_videos (v_id, v_title, v_rDate, v_desc, v_path, v_audience, v_type) VALUES(?, ?, ?, ?, ?, ?, ?);";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{

    mysqli_stmt_bind_param($stmt, "issssss", $v_id, $v_title, $v_rDate, $v_desc, $destination, $v_audience, $v_type);

    if (mysqli_stmt_execute($stmt)){

        mysqli_stmt_close($stmt);

        echo "<script>alert('Video uploaded successfully'); window.location.replace('manage-video.php'); </script>";

    }else{
        echo json_encode("SQL ERROR:" + mysqli_error($conn));
        echo json_encode("Fail");
    }   
}


?>