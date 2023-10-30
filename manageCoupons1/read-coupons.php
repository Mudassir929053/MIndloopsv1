<?php
include "../dbconnect.php";
 $sql = "SELECT * FROM `coupons`";
        // exit; 
try {
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $data = array(
            "status" => "fail"
        );
         json_encode($data);
    } else {
        mysqli_stmt_execute($stmt);
        $result = $stmt->get_result();
        $finalData = array();
        while ($row = $result->fetch_assoc()) {
            $data = array(
                "coupon_id" => $row["coupon_id"],
                "code" => $row["code"],
                "discount" => $row["discount"],
                "redemption_limit" => $row["redemption_limit"],
                "redeemed_count" => $row["redeemed_count"],
                "created_at" => $row["created_date"],
                "expire_date" => $row["expiry_date"]
            );
            
            array_push($finalData, $data);
        }
        echo json_encode($finalData);
    }
} catch (PDOException $e) {
    $data = array(
        "status" => "fail"
    );
     json_encode($data);
}
