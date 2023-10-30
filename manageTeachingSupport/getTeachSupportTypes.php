<?php

include ("../dbconnect.php");

$sql = "SELECT * FROM tb_teachsupporttype";
$result= mysqli_query($conn,$sql); 
$subjectID = array();
$subjectName = array();
$output='';
$tableDiv='';
$i=0;
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    
      $output.='<li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#'.$row['tst_desc'].'">'.$row['tst_desc'].'</a>
    </li>';/* 
    $tableDiv.='
    <div id="'.$row['tst_desc'].'" class="container-fluid tab-pane fade">
      <section id="contributionTableCSS">
      <div class="container">
      
        <div class="row gy-4">
    
          <div class="col-lg-12">
        <table id="teachSupportTable'.$row['tst_desc'].'" class="table datatable table-warning table-striped table-hover" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>No.</th>
            <th>Title</th>
            <th>Description</th>
          <th>Date</th>
          <th>Author</th>
          <th>Content Type</th>
          <th></th>
          <th></th>
        </tr>
    </thead>
     
        </table>
        </div>
    
    </div>
    </div>
    
    </section>
                </div>'; */
}


$data = array(
   "output" => $output,/* 
   "table" => $tableDiv */
);
echo json_encode($data);

?>