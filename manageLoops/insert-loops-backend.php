<?php

// @ini_set( 'upload_max_size' , '64M' );
// @ini_set( 'post_max_size', '64M');
// @ini_set( 'max_execution_time', '600' );


include '../dbconnect.php';

$lp_title = $_POST["lp_title"];
$lp_desc = $_POST["lp_desc"];
$lp_type = $_POST["lp_type"];
$lp_date  = $_POST["lp_date"];


// var_dump($_POST);
// var_dump($_FILES);

// exit;
date_default_timezone_set("Asia/Kuala_Lumpur");
// $lp_date =  datetime('Y-m-d H:i:s');

if (!empty($_FILES['lp_imgpath']['name'])) {

    if (($_FILES['lp_imgpath']['type'] == "image/png") ||  ($_FILES['lp_imgpath']['type'] == "image/jpg") || ($_FILES['lp_imgpath']['type'] == "image/jpeg")) {

        $date = new DateTime();
        $date = $date->format('d-m-Y_H-i-s');
        $source_file1 = $_FILES['lp_imgpath']['tmp_name'];
        $dest_file1 = "../assets/loops/img/" . $date . "_" . $_FILES['lp_imgpath']['name'];
        $lp_imgpath = $dest_file1;

        if (isset($source_file1) && isset($dest_file1)) {
            $moved = move_uploaded_file($source_file1, $dest_file1)
                or die("Error!!");
        } else {
            $moved = false;
        }
    } else {
        echo ("<script LANGUAGE='JavaScript'> window.alert('Loops is not in image format.');</script>");
    }
}

// if ( !empty($_FILES['lp_imgpath1']['name']) ) {

//     if (($_FILES['lp_imgpath1']['type'] == "image/png") ||  ($_FILES['lp_imgpath1']['type'] == "image/jpg") || ($_FILES['lp_imgpath1']['type'] == "image/jpeg")) {

//         $date = new DateTime();
//         $date = $date->format('d-m-Y_H-i-s');
//         $source_file2 = $_FILES['lp_imgpath1']['tmp_name'];
//         $dest_file2 = "../assets/loops/img/".$date."_".$_FILES['lp_imgpath1']['name'];
//         $lp_imgpath = $dest_file2;

//         if(isset($source_file2) && isset($dest_file2)){
//             $moved = move_uploaded_file( $source_file2, $dest_file2 )
//             or die ("Error!!");
//         }else {
//             $moved = false;
//         }



//     }else{
//         echo ("<script LANGUAGE='JavaScript'> window.alert('Loops is not in image format.');</script>");
//     }
// }


if (!empty($_FILES['lp_filepath']['name'])) {

    $allowedTypes = array('application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

    // if ($_FILES['lp_filepath']['type'] == "application/pdf") {
    if (in_array($_FILES['lp_filepath']['type'], $allowedTypes)) {
        $date = new DateTime();
        $date = $date->format('d-m-Y_H-i-s');
        $source_file = $_FILES['lp_filepath']['tmp_name'];
        $dest_file = "../assets/loops/files/" . $date . "_" . $_FILES['lp_filepath']['name'];
        $lp_filepath = $dest_file;

        if (isset($source_file) && isset($dest_file)) {
            $file_moved = move_uploaded_file($source_file, $dest_file)
                or die("Error!!");
        } else {
            $file_moved = false;
        }
    }
    // else{
    // 	echo ("<script LANGUAGE='JavaScript'> window.alert('The Loops is not in PDF format.');</script>");
    // }
}

$sql = "INSERT INTO tb_loops (lp_title, lp_imgpath, lp_filepath, lp_desc, lp_date, lp_type) VALUES(?, ?, ?, ?, ?, ?);";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo json_encode("SQL ERROR");
} else {

    if ($moved && $file_moved) {

        mysqli_stmt_bind_param($stmt, "ssssss", $lp_title, $lp_imgpath, $lp_filepath, $lp_desc, $lp_date, $lp_type);

        if (mysqli_stmt_execute($stmt)) {


            mysqli_stmt_close($stmt);

            header("Location: manage-loops.php");
        } else {
            echo ("SQL ERROR:" . mysqli_error($conn));
            echo ("Fail");
        }
    } else {
        echo "Not uploaded because of error #" . $_FILES["lp_filepath"]["error"];
        // echo "Not uploaded because of error #".$_FILES["lp_path"]["error"];
    }
}
