<?php
include('../dbconnect.php');

$packageID = $_POST['p_id'];
$sql = "DELETE FROM tb_spackages WHERE p_id=?";
$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)){
		echo json_encode("SQL ERROR");
	}else{
		mysqli_stmt_bind_param($stmt, "s", $packageID);
		if (mysqli_stmt_execute($stmt)){
        echo ("<script LANGUAGE='JavaScript'>
					window.alert('Successfully deleted package.');
					window.location.href='managePackage.html';
					</script>");
        }else{
            $data=array(
                "status"=>'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Package does not exist in DB. Therefore, can\'t delete.</div>'
              );
              echo json_encode($data);
              exit();
        }
    }

?>