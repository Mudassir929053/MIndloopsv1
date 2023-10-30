<?php
include "../dbconnect.php";
 $sql = "SELECT d.discount_id, d.title, d.description, d.discount_category, d.logo_image, d.start_date, d.end_date, d.discount_code, d.created_at, COUNT(r.user_id) AS total_redeems
        FROM discounts AS d
        LEFT JOIN redemptions AS r ON d.discount_id = r.discountId
        GROUP BY d.discount_id";
        // exit;
try {
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    } else {
        mysqli_stmt_execute($stmt);
        $result = $stmt->get_result();
        $finalData = array();
        while ($row = $result->fetch_assoc()) {
            $data = array(
                "discount_id" => $row["discount_id"],
                "title" => $row["title"],
                "description" => substr(strip_tags($row["description"]), 0, 100), // Remove HTML tags and limit to 100 characters
                "discount_logo_url" => '../assets/discount_images/' . $row["logo_image"],
                "image" => $row["logo_image"],
                "start_date" => $row["start_date"],
                "end_date" => $row["end_date"],
                "discount_code" => $row["discount_code"],
                "created_at" => $row["created_at"],
                "discount_category" => $row["discount_category"]
            );
            
            array_push($finalData, $data);
        }
        echo json_encode($finalData);
    }
} catch (PDOException $e) {
    $data = array(
        "status" => "fail"
    );
    echo json_encode($data);
}
