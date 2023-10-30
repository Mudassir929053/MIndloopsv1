<?php

// @ini_set( 'upload_max_size' , '64M' );
// @ini_set( 'post_max_size', '64M');
// @ini_set( 'max_execution_time', '600' );


include '../dbconnect.php';

function deleteAll($dir) {
    foreach(glob($dir . '/*') as $file) {
    if(is_dir($file))
    deleteAll($file);
    else
    unlink($file);
    }
    rmdir($dir);
}

$lp_id = $_POST["lp_id"];
$lp_title = $_POST["lp_title"];
$lp_desc = $_POST["lp_desc"];
$lp_type = $_POST["lp_type"];
$lp_date = $_POST["lp_date"];

date_default_timezone_set("Asia/Kuala_Lumpur");
// $lp_date =  date('Y-m-d H:i:s');

if ( (!empty($_FILES['lp_imgpath']['name']) ) && empty($_FILES['lp_imgpath1']['name']) ) {
    
    if (($_FILES['lp_imgpath']['type'] == "image/png") ||  ($_FILES['lp_imgpath']['type'] == "image/jpg") || ($_FILES['lp_imgpath']['type'] == "image/jpeg")) {

        $date = new DateTime();
        $date = $date->format('d-m-Y_H-i-s');
        $source_file1 = $_FILES['lp_imgpath']['tmp_name'];
        $dest_file1 = "../assets/loops/img/".$date."_".$_FILES['lp_imgpath']['name'];
        $lp_imgpath = $dest_file1;

        $prev_data= get_prev($lp_id);
        unlink($prev_data[0]['lp_imgpath']);

        if(isset($source_file1) && isset($dest_file1)){
            $moved = move_uploaded_file( $source_file1, $dest_file1 )
            or die ("Error!!");
        }else {
            $moved = false;
        }



    }else{
        echo ("<script LANGUAGE='JavaScript'> window.alert('Loops is not in image format.');</script>");
    }
}
if(empty($_FILES['lp_imgpath1']['name']) && empty($_FILES['lp_imgpath']['name'])){

    $prev_data= get_prev($lp_id);
    $lp_imgpath = $prev_data[0]['lp_imgpath'];
    $moved = true;


}

if ( (!empty($_FILES['lp_imgpath1']['name']) ) && empty($_FILES['lp_imgpath']['name'])) {
    
    if (($_FILES['lp_imgpath1']['type'] == "image/png") ||  ($_FILES['lp_imgpath1']['type'] == "image/jpg") || ($_FILES['lp_imgpath1']['type'] == "image/jpeg")) {

        $date = new DateTime();
        $date = $date->format('d-m-Y_H-i-s');
        $source_file2 = $_FILES['lp_imgpath1']['tmp_name'];
        $dest_file2 = "../assets/loops/img/".$date."_".$_FILES['lp_imgpath1']['name'];
        $lp_imgpath = $dest_file2;

        $prev_data= get_prev($lp_id);
        unlink($prev_data[0]['lp_imgpath']);

        if(isset($source_file2) && isset($dest_file2)){
            $moved = move_uploaded_file( $source_file2, $dest_file2 )
            or die ("Error!!");
        }else {
            $moved = false;
        }



    }else{
        echo ("<script LANGUAGE='JavaScript'> window.alert('Loops is not in image format.');</script>");
    }
}


if ( !empty($_FILES['lp_filepath']['name']) ) {

    if ($_FILES['lp_filepath']['type'] == "application/pdf") {
        $date = new DateTime();
        $date = $date->format('d-m-Y_H-i-s');
        $source_file = $_FILES['lp_filepath']['tmp_name'];
        $dest_file = "../assets/loops/files/".$date."_".$_FILES['lp_filepath']['name'];
        $lp_filepath = $dest_file;

        $prev_data= get_prev($lp_id);
        unlink($prev_data[0]['lp_filepath']);

        if(isset($source_file) && isset($dest_file)){
            $file_moved = move_uploaded_file( $source_file, $dest_file )
            or die ("Error!!");
        }else {
            $file_moved = false;
        }
    }
    // else{
    // 	echo ("<script LANGUAGE='JavaScript'> window.alert('The Loops is not in PDF format.');</script>");
    // }
}else if(empty($_FILES['lp_filepath']['name'])){

    $prev_data= get_prev($lp_id);
    $lp_filepath = $prev_data[0]['lp_filepath'];
    $file_moved= true;


}


if($_FILES['zip_file']['name'] != '')  
    {  
         $file_name = $_FILES['zip_file']['name'];  
         $array = explode(".", $file_name);  
         $name = $array[0];  
         $ext = $array[1];  
         if($ext == 'zip')  
         {  
              $path = '../assets/loops/games/';  
              $date = new DateTime();
              $date = $date->format('d-m-Y_H-i-s');
              $location = $path . $date."_". $file_name;  
              $lp_gamespath = $location;

              $lp_filepath = pathinfo($lp_gamespath, PATHINFO_FILENAME);
              $lp_filepath = '../assets/loops/games/'.$lp_filepath ;

              $prev_data= get_prev($lp_id);
              

              if(is_dir($prev_data[0]['lp_filepath'])){
                $dirname = $prev_data[0]['lp_filepath'];
                deleteAll($dirname);
                }


              $file_moved = move_uploaded_file($_FILES['zip_file']['tmp_name'], $location);
              if($file_moved)  
              {  
                   $zip = new ZipArchive;  
                   if($zip->open($location))  
                   {  
                        $zip->extractTo($path);  
                        $zip->close();  
                   }  

                   unlink($location);  
                   rmdir($path . $name);  
                   rename($path.$name , $path . $date."_". $name );
              }  
         }  
}else if(empty($_FILES['lp_filepath']['name'])){

    $prev_data= get_prev($lp_id);
    $lp_filepath = $prev_data[0]['lp_filepath'];
    $file_moved= true;


}


$sql = "UPDATE tb_loops SET lp_title = ?, lp_imgpath = ?, lp_filepath = ?, lp_desc = ?, lp_date = ? , lp_type = ? WHERE lp_id = ? ";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)){
    echo json_encode("SQL ERROR");
}else{

    if( $moved || $file_moved ) { 

        mysqli_stmt_bind_param($stmt, "ssssssi", $lp_title, $lp_imgpath, $lp_filepath, $lp_desc, $lp_date, $lp_type, $lp_id );

        if (mysqli_stmt_execute($stmt)){


            mysqli_stmt_close($stmt);

            header("Location: manage-loops.php");
            
        }else{
            echo $lp_id; echo $lp_title; echo $lp_imgpath; echo $lp_filepath; echo $lp_desc; echo $lp_type;
            echo json_encode("SQL ERROR:" + mysqli_error($conn));
            echo json_encode("Fail");
        }       
    } else {
    echo "Not uploaded because of error #".$_FILES["lp_path"]["error"];
    // echo "Not uploaded because of error #".$_FILES["lp_path"]["error"];
    }
    
}

function get_prev($lp_id){
    include ("../dbconnect.php");
    $sql = "SELECT * FROM tb_loops where lp_id = ? ";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "i", $lp_id);

    mysqli_stmt_execute($stmt); 
    $stmt_result = $stmt->get_result();
    $finalData = array();

    while($row = $stmt_result->fetch_assoc()){    
        $data = array(
            "status" => "success",
            "lp_id" => $row["lp_id"],
            "lp_title" => $row["lp_title"],
            "lp_desc" => $row["lp_desc"],
            "lp_type" => $row["lp_type"],
            "lp_date" => $row["lp_date"],
            "lp_imgpath" => $row["lp_imgpath"],
            "lp_filepath" => $row["lp_filepath"]
            

        );
        
        array_push($finalData, $data);
    }
    
    return $finalData;

}


?>