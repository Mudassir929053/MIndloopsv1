<?php

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '600' );

include '../dbconnect.php';


// var_dump($_FILES);
// exit;


$v_id = (int)$_POST['v_id'];
$v_title = $_POST['v_title'];
$v_desc = $_POST['v_desc'];
// $m_imgPath = "pdf/Cover_Pages/" . $_POST['m_imgPath'];
$v_rDate = $_POST['v_rDate'];           
// $m_filePath = "pdf/Magazine_Full/" . $_POST['m_filePath'];
// $m_edition = $_POST['m_edition'];
// $v_path = $_POST['v_path'];
$v_audience = $_POST['v_audience'];
$v_type = $_POST['v_type'];
$mime = $_FILES['v_path']['type'];
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
$video='';
$video_path='';
if($destination){
   
    // $video="$destination";


    $sql = "UPDATE tb_videos SET v_title = ?, v_path = ?, v_rDate = ?, v_desc = ?, v_audience = ?, v_type = ? WHERE v_id = ?;";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo ("SQL ERROR222");
}else{

    mysqli_stmt_bind_param($stmt, "ssssssi", $v_title, $destination, $v_rDate, $v_desc, $v_audience, $v_type, $v_id);

    if(mysqli_stmt_execute($stmt))
    echo "Video Updated Successfully";
}
}
else{
    $sql = "UPDATE tb_videos SET v_title = ?, v_rDate = ?, v_desc = ?, v_audience = ?, v_type = ? WHERE v_id = ?;";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo ("SQL ERROR111");
}else{

    mysqli_stmt_bind_param($stmt, "sssssi", $v_title, $v_rDate, $v_desc, $v_audience, $v_type, $v_id);

    if(mysqli_stmt_execute($stmt))
        echo "Video Details Updated Successfully";
}
}
// $m_pageLimit = (int)$_POST['m_pageLimit'];

// // STORE PDF FILE IN FOLDER [ERROR: FILE IS NOT BEING STORED]
// if(isset($_FILES['file']['name']))
// {
//     $cpath="assets/";
//     $file_parts = pathinfo($_FILES["file"]["name"]);
//     $file_path = 'assets'.time().'.'.$file_parts['extension'];
//     move_uploaded_file($_FILES["file"]["tmp_name"], $cpath.$file_path);
//     $cv2 = $file_path;
// }



?>