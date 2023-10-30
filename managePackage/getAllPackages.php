<?php

include ("../dbconnect.php");

session_start();
if( !isset($_SESSION["userType"]) ){
    
  $login=false;
}else{
    if($_SESSION['userType']=='1')
 { 
    $login=true;
}else{
    $login=false;
 }
}
$sql = "SELECT * FROM tb_spackages";
$result= mysqli_query($conn,$sql); 
$output = '<div class="row">
<div class="col-lg-11" style="margin-left: auto;
margin-right: auto;">
    <a class="btn btn-success"  style="margin-bottom:10px;" href="createPackage.html"><i class="fa fa-plus"></i>Add New</a>
    <table id="tbList" class="table table-striped table-bordered display nowrap" width="100%" style="margin-bottom:10px;">
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Duration</th>
        <th>Price (RM)</th>
        <th>Number of User</th>
        <th></th>
    </thead>';
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $output .= '
    <tbody>
                 <tr>
                 <td>' .$row['p_id']. '</td>
                 <td width="20%">'. $row['p_name'].'</td>
                 <td width="30%">'.$row['p_desc'].'</td>
                 <td>'.$row['p_duration'].'</td>
                 <td>'. $row['p_price'].'</td>
                 <td>'. $row['p_userNum'].'</td>
                 <td>
                    <a class="btn btn-primary btn-sm" href="updatePackage.html?p_id='.$row['p_id'].'"><i class="fa fa-pencil">Edit</a>
                    <a class="btn btn-danger btn-sm dltBtn" style="margin-left:5px" href="delete.php?p_id='.$row['p_id'].'"><i class="fa fa-trash">Delete</i></a></td>
            </tbody>
    ';
}

$data = array(
    "table"=>$output,
    "login"=>$login
);
echo json_encode($data);

?>