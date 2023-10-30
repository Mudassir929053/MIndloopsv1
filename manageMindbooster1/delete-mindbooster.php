<?php

include "../dbconnect.php";

$mb_id = $_GET['mb_id'];

if (isset($_GET['confirm']) && $_GET['confirm'] == '1') {
    $sql = "DELETE FROM tb_mindbooster WHERE mb_id = ?";
    
    try {
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $data = array(
                "status" => "fail"
            );
            echo json_encode($data);
        } else {
            mysqli_stmt_bind_param($stmt, "s", $mb_id);
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
} else {
    echo '<script>
            var confirmed = confirm("Are you sure you want to delete this record?");
            if (confirmed) {
                window.location.href = "delete-mindbooster.php?mb_id=' . $mb_id . '&confirm=1";
            } else {
                window.location.href = "manage-mindbooster.php";
            }
          </script>';
    exit; // Add this line to stop executing the remaining PHP code
}

header("Location: manage-mindbooster.php"); // Add this line to redirect to manage-mindbooster.php
exit;

?>
