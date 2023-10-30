<?php
include "../dbconnect.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number
$recordsPerPage = 10; // Number of records to display per page
$offset = ($page - 1) * $recordsPerPage; // Calculate the offset

$sql = "SELECT * FROM tb_tips LIMIT $offset, $recordsPerPage";

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
                "t_id" => $row["t_id"],
                "t_imgPath" => $row["t_imgPath"],
                "t_title" => $row["t_title"],
                "t_audience" => $row["t_audience"],
                "t_rDate" => $row["t_rDate"],
                "t_author" => $row["t_author"],
                "t_desc" => $row["t_desc"],
                "t_filePath" => $row["t_filePath"],
                "t_type" => $row["t_type"]
            );

            $finalData[] = $data;
        }

        if (count($finalData) > 0) {
            $response = array(
                "status" => "success",
                "data" => $finalData
            );
        } else {
            $response = array(
                "status" => "empty",
                "message" => "No records found."
            );
        }

        echo json_encode($response);
    }
} catch (Exception $e) {
    $data = array(
        "status" => "fail",
        "message" => $e->getMessage()
    );
    echo json_encode($data);
}
