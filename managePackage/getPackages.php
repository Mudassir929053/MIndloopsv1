<?php
include("../dbconnect.php");


// initilize all variable
$params = $columns = $totalRecords = $data = array();

$params = $_REQUEST;
//define index of column
$columns = array( 
    0 =>'p_id',
    1 =>'p_name', 
    2 => 'p_desc',
    3 => 'p_duration',
    4 => 'p_price',
    5 => 'p_userNum',
);

$where = $sqlTot = $sqlRec = "";

if( !empty($params['search']['value']) ) { 
    $where .=" WHERE ";
     $where .=" ( p_id LIKE '".$params['search']['value']."%' "; 
    $where .=" OR p_name LIKE '".$params['search']['value']."%' ";
    $where .=" OR p_desc LIKE '".$params['search']['value']."%' ";
    $where .=" OR p_duration LIKE '".$params['search']['value']."%' ";
    $where .=" OR p_price LIKE '".$params['search']['value']."%' ";
    $where .=" OR p_userNum LIKE '".$params['search']['value']."%' )";
}




// getting total number records without any search
$sql = "SELECT p_id,p_name,p_desc,p_duration,p_price,p_userNum FROM tb_spackages";
$sqlTot = $sql;
$sqlRec = $sql;
//concatenate search sql if value exist
if(isset($where) && $where != '') {

    $sqlTot .= $where;
    $sqlRec .= $where;
}

//echo json_encode(intval( $params['draw'] ));
 $sqlRec .=  " ORDER BY ". $columns[0]." DESC  LIMIT ".$params['start']." ,".$params['length']." ";

$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));


$totalRecords = mysqli_num_rows($queryTot);

$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");

//iterate on results row and create new index array of data
while( $row = mysqli_fetch_row($queryRecords) ) { 
    
    $data[] = $row;
}	
for($i=0;$i<intval($totalRecords);$i++){
    if(!empty($data[$i])){
    array_push($data[$i],'<td>
    <a href="updatePackage.html?p_id='.$data[$i][0].'" class="edit" title="Edit"><i class="material-icons">&#xe150;</i></a>
    <a href="" class="delete" onclick="deletePackage(\''.$data[$i][0].'\')" title="Delete"><i class="material-icons">&#xE872;</i></a>
    </td>');}
}
$json_data = array(
        "draw"            => intval( $params['draw'] ),   
        "recordsTotal"    => intval( $totalRecords ),  
        "recordsFiltered" => intval($totalRecords),
        "data"            => $data, // total data array
        );

echo json_encode($json_data);  // send data as json format

?>