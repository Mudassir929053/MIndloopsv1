<?php
include('../dbconnect.php');

$ID = $_POST['id'];
$sql = "DELETE FROM tb_contributes WHERE c_id=?";
$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)){
		echo json_encode("SQL ERROR");
	}else{
		mysqli_stmt_bind_param($stmt, "s", $ID);
		if (mysqli_stmt_execute($stmt)){
        echo ("<script LANGUAGE='JavaScript'>
					window.alert('Successfully deleted contribution.');
					window.location.href='manageContribute.php';
					</script>");
        }else{
            $data=array(
                "status"=>'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Contribution does not exist in DB. Therefore, can\'t delete.</div>'
              );
              echo json_encode($data);
              exit();
        }
    }

?>