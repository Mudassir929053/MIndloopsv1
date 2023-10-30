<?php

include "../dbconnect.php";

$l_id = $_GET['l_id'];
$mb_id = $_GET['mb_id'];


    $sql = "DELETE FROM tb_lessons WHERE l_id = ?";
    
    try {
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $data = array(
                "status" => "fail"
            );
            echo json_encode($data);
        } else {
            mysqli_stmt_bind_param($stmt, "s", $l_id);
            mysqli_stmt_execute($stmt);

            $affectedRows = mysqli_stmt_affected_rows($stmt);
            if ($affectedRows > 0) {
                $data = array(
                    "status" => "success"
                );
            } else {
                $data = array(
                    "status" => "fail"
                );
            }

            echo json_encode($data);
        }
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }


header("Location: view-gk-mindbooster.php?mb_id=" . $mb_id);
exit;

?>
