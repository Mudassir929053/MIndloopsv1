<?php
// your-backend-url.php

include '../../dbconnect.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the user ID and discount ID from the form data
    $userId = $_POST['userid'];
    $discountId = $_POST['discount_id'];

    // Perform any necessary validation on the data

    // Check if the combination of user ID and discount ID already exists in the table
    $checkSql = "SELECT COUNT(*) FROM redemptions WHERE user_id = ? AND discountId = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ss", $userId, $discountId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $rowCount = $checkResult->fetch_assoc()['COUNT(*)'];

    if ($rowCount > 0) {
        // Combination of user ID and discount ID already exists, return an error response or handle as needed
    } else {
        // Prepare the SQL statement
        $insertSql = "INSERT INTO redemptions (user_id, discountId, redeemed_at) VALUES (?, ?, NOW())";
        $insertStmt = $conn->prepare($insertSql);

        // Bind the parameters and execute the statement
        $insertStmt->bind_param("ss", $userId, $discountId);
        $insertStmt->execute();

        // Check if the insertion was successful
        if ($insertStmt->affected_rows > 0) {
            // Generate a random discount code or retrieve it from the database
            // Replace this with your code to generate or retrieve the discount code

            // Return the discount code as the response
            echo json_encode($response);
        } else {
            // Return an error response, if needed
        }

        // Close the statement
        $insertStmt->close();
    }

    // Close the check statement and the database connection
    $checkStmt->close();
    $conn->close();
}
?>
