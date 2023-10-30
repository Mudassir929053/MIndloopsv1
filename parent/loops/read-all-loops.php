<?php

if(!session_id())
  {
    session_start();
    
  }

include "../dbconnect.php";

if($_SESSION["userType"]=='2') // teacher
{
    $sql = "select * from tb_loops where lp_type in ('LPT8','LPT9')";
}
else if($_SESSION["userType"]=='3') // student
{
    $sql = "select * from tb_loops where lp_type in ('LPT1','LPT2','LPT3')";
}
else if($_SESSION["userType"]=='4') // parent
{
    $sql = "select * from tb_loops where lp_type in ('LPT4','LPT5','LPT6','LPT7')";
}
else if($_SESSION["userType"]=='1') // admin
{
    $sql = "SELECT * FROM tb_loops";
}


try{
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_execute($stmt); 
        $result = $stmt->get_result();
        $finalData = array();

        while($row = $result->fetch_assoc()){    
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

        echo json_encode($finalData);
    }
}
catch(PDOException $e){
    $data = array(
        "status" => "fail"
    );
    echo json_encode($data);
}


?>
