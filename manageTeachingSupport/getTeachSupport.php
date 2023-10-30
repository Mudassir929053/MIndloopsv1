<?php
include("../dbconnect.php");
// initilize all variable
$params = $columns = $totalRecords = $data = array();


$params = $_REQUEST;
if(!empty($_GET['category']) ){
    $category = $_GET['category'];
    //echo $category;
}else{
    $category="notSet";
}
/* if(!empty($_GET['publishStatus']) ){
    $pStatus = $_GET['publishStatus'];
    //echo $category;
}else{
    $pStatus="notSet";
} */
//define index of column
$columns = array( 
    0 =>'a.ts_title',
    1 =>'a.ts_desc', 
    2 => 'a.ts_date',
    3 => 'a.ts_author',
    4 => 'b.tst_desc',
    /* 4 => 'tb_contenttypes.cn_desc' */
);

$where = $sqlTot = $sqlRec = "";

if($category!="notSet")
{
    $where .=" WHERE ";
    if($category == "pedagogy"){
        $where .=" ( a.ts_type = 'TS1' ";
    }else if($category == "curriculum"){
        $where .=" ( a.ts_type = 'TS2' ";
    }else if($category == "assessment"){
        $where .=" ( a.ts_type = 'TS3' ";
    }
}/* else if($pStatus!="notSet")
{
    $where .=" WHERE ";
    if($pStatus == "published"){
        $where .=" ( a.c_part != '' AND a.c_partID !='' ";
    }else if($pStatus == "unpublish"){
        $where .=" ( a.c_part = '' AND a.c_partID ='' ";
    }
    
} */
else{
if( !empty($params['search']['value']) ) { 
    $where .=" WHERE ";
     $where .=" ( a.ts_title LIKE '".$params['search']['value']."%' "; 
    $where .=" OR a.ts_desc LIKE '".$params['search']['value']."%' ";
    $where .=" OR a.ts_date LIKE '".$params['search']['value']."%' ";
    $where .=" OR a.ts_author LIKE '".$params['search']['value']."%' ";
    $where .=" OR b.tst_desc LIKE '".$params['search']['value']."%' )";
}
} 


if($category!="notSet"){ 
    if( !empty($params['search']['value']) ) {    
    $where .=" AND ( a.ts_title LIKE '".$params['search']['value']."%' "; 
    $where .=" OR a.ts_desc LIKE '".$params['search']['value']."%' ";
    $where .=" OR a.ts_date LIKE '".$params['search']['value']."%' ";
    $where .=" OR a.ts_author LIKE '".$params['search']['value']."%' ";
    $where .=" OR b.tst_desc LIKE '".$params['search']['value']."%' ))";
    }else{
        $where .= ")";
    }
}


// getting total number records without any search
$sql = "SELECT a.ts_title, a.ts_desc , a.ts_date, a.ts_author, b.tst_desc , a.ts_id
FROM tb_teachsupport AS a ";
$joins = "JOIN tb_teachsupporttype AS b
ON (a.ts_type = b.tst_id)";
$sqlTot = $sql.$joins;
$sqlRec = $sql.$joins;
//concatenate search sql if value exist
if(isset($where) && $where != '') {

    $sqlTot .= $where;
    $sqlRec .= $where;
}

//echo json_encode(intval( $params['draw'] ));
 $sqlRec .=  " ORDER BY ". $columns[2]." DESC    LIMIT ".$params['start']." ,".$params['length']." ";
//echo  $sqlRec;
$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));



$totalRecords = mysqli_num_rows($queryTot);

$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");

//iterate on results row and create new index array of data
while( $row = mysqli_fetch_row($queryRecords) ) { 
    
    $data[] = $row;
}	

    for($i=0;$i<intval($totalRecords);$i++){
        if(!empty($data[$i])){
        if(strtotime($data[$i][2])){
            $data[$i][2] = date('d F Y',strtotime($data[$i][2]));
        }
        array_push($data[$i],'<td>
        <a href="viewTeachSupport.php?ts_id='.$data[$i][5].'" class="view" title="View"><i class="material-icons">&#xE417;</i></a>
        <a href="updateTeachSupport.php?ts_id='.$data[$i][5].'" class="edit" title="Edit"><i class="material-icons">&#xf88d;</i></a>
                    
        <a href="" class="delete" onclick="deleteTeachSupport('.$data[$i][5].')" title="Delete"><i class="material-icons">&#xE872;</i></a>
        </td>');
        /* if($data[$i][6]=="") //means not published (no assigned part)
        {
            array_push($data[$i],'<td>
        <button class="btn btn--radius-2 learn-more" id="btn--publish" onclick="openForm('.$data[$i][5].')" type="submit">Publish</button></td>');
        }else{
            array_push($data[$i],'<td>
            <button class="btn btn--radius-2 closeBtn" id="btn--publish" onclick="unpublishContribution('.$data[$i][5].')" type="submit">Unpublish</button></td>');
            
        } */
        $value = $i+1;
        array_unshift($data[$i] , $value);}
    }
$json_data = array(
        "draw"            => intval( $params['draw'] ),   
        "recordsTotal"    => intval( $totalRecords ),  
        "recordsFiltered" => intval($totalRecords),
        "data"            => $data, // total data array
        );

echo json_encode($json_data);  // send data as json format

?>