<?php
// Assume you have a database connection established
include '../../dbconnect.php';

// Get the coupon code from the POST request
$couponCode = $_POST['couponCode'];

// Query the database to check if the coupon code is valid
// Replace 'coupons' with the actual table name in your database
$query = "SELECT * FROM coupons WHERE code = ? AND expiry_date >= NOW() AND redeemed_count < redemption_limit";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $couponCode);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Coupon code exists and is valid
    $row = $result->fetch_assoc();
    $discount = $row['discount'];

    // Update the redeemed count in the coupons table
    $couponId = $row['coupon_id'];
    $updateQuery = "UPDATE coupons SET redeemed_count = redeemed_count + 1 WHERE coupon_id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param('i', $couponId);
    $updateStmt->execute();

    // Return the discount amount as a JSON response
    $response = array('valid' => true, 'discount' => $discount);
} else {
    // Coupon code is invalid or expired
    $response = array('valid' => false);
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
