<?php

include ("../dbconnect.php");

$sql = "SELECT * FROM tb_subjects";
$result= mysqli_query($conn,$sql); 
$subjectID = array();
$subjectName = array();
$output='';
$i=0;
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    array_push($subjectID, $row['sj_id']);
    array_push($subjectName, $row['sj_name']);
    if($i==0)
    {
        $output .= '<label class="radio-container m-r-70">'.$row['sj_name'].'
    <input type="radio" checked="checked" name="subject" value="'.$row['sj_id'].'">
    <span class="checkmark"></span>
  </label><br>';
}else{
    $output .= '<label class="radio-container m-r-70">'.$row['sj_name'].'
    <input type="radio" name="subject" value="'.$row['sj_id'].'">
    <span class="checkmark"></span>
  </label><br>';
  }
  $i++;
}


$data = array(
   "subjectID" => $subjectID,
   "subjectName" => $subjectName,
   "output" => $output
);
echo json_encode($data);

?>