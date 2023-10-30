<?php
// your-backend-url.php

include '../../dbconnect.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the user ID and discount ID from the form data
    $userId = $_POST['userid'];
    $discountId = $_POST['discount_id'];

    // Perform any necessary validation on the data

    // Prepare the SQL statement
    $sql = "INSERT INTO redemptions (user_id, discountId, redeemed_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    // Bind the parameters and execute the statement
    $stmt->bind_param("ss", $userId, $discountId);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        
        echo json_encode($response);
    } else {
        // Return an error response, if needed
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}

