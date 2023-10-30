<?php

include '../dbconnect.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
extract($_POST);
if ($conn) {
    $sql = "INSERT INTO community(community_name,community_description) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $c_name, $c_desc);
    if (mysqli_stmt_execute($stmt)) {


        mysqli_stmt_close($stmt);

        header("Location: manageCommunity.php");
    } else {
        echo ("SQL ERROR:" . mysqli_error($conn));
        echo ("Fail");
    }
}
