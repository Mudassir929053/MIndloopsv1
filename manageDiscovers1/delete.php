<?php
    if(!session_id())
    {
        session_start();
    }

    include ('../dbconnect.php');

    if(isset($_GET['cd_id']))
    {
        $cd_id = $_GET['cd_id'];
    }

    $sql1 = "SELECT * FROM tb_discovers
            WHERE cd_id = ".$cd_id.";";
      $result1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($result1);
      
      $sql = "DELETE FROM tb_discovers
               WHERE cd_id = '".$cd_id."';";
      $result = mysqli_query($conn, $sql);
    
    if($result)
    {
        unlink($row1['cd_imgPath']);
        header('Location: manage.php');
    }

?>