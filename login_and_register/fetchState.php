<?php
include "../dbconnect.php";

if(isset($_POST["postcode"]))
{
    
    $postcode = $_POST["postcode"];
    $sql = "SELECT * FROM tb_cities c ,tb_states s WHERE $postcode BETWEEN c.ct_lPoscode AND c.ct_uPoscode AND $postcode BETWEEN s.st_lPoscode AND s.st_uPoscode";
    //$sql = "SELECT * FROM tb_cities c ,tb_states s WHERE 11910 BETWEEN c.ct_lPoscode AND c.ct_uPoscode AND 11910 BETWEEN s.st_lPoscode AND s.st_uPoscode";

    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result))
    {
    // $data["ct_id"] = $row["ct_id"];
    // $data["ct_name"] = $row["ct_name"];
    // $data["st_id"] = $row["st_id"];
    // $data["st_name"] = $row["st_name"];
        echo "<option value=".$row["st_id"]." selected>".$row["st_name"]."</option>";
    }

    echo json_encode($data);
        
        
}else{

    echo 'Nothing TT';
}


?>