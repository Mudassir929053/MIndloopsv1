<?php
include '../dbconnect.php';
if (isset($_POST['add_Coupon'])) {
    // $title = mysqli_real_escape_string($conn, $_POST['title']);
    $coupon_code = mysqli_real_escape_string($conn, $_POST['Coupon_code']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $redemption_limit = mysqli_real_escape_string($conn, $_POST['redemption_limit']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $created = date('Y-m-d H:i:s');
    // $updated = date('Y-m-d H:i:s');
    
    
    $query = "INSERT INTO coupons (code, created_date, expiry_date, discount,redemption_limit)
              VALUES ('$coupon_code', '$created','$end_date', '$discount', '$redemption_limit')";
              
    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Coupon successfully added');</script>";
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Error, try again!');</script>";
    }
    
    // Close the database connection
    mysqli_close($conn);
}



if (isset($_POST['update_Coupon'])) {
    $coupon_id = mysqli_real_escape_string($conn, $_POST['coupon_id']);
    $couponcode = mysqli_real_escape_string($conn, $_POST['couponcode']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $redemption_limit = mysqli_real_escape_string($conn, $_POST['redemption_limit']);
    $expire_date = mysqli_real_escape_string($conn, $_POST['expire_date']);
    $updated = date('Y-m-d H:i:s');
    
    $query = "UPDATE coupons SET code = '$couponcode', discount = '$discount',redemption_limit = '$redemption_limit', expiry_date = '$expire_date' WHERE coupon_id = '$coupon_id'";
        
    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Coupon successfully updated');</script>";
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Error, try again!');</script>";
    }
    
    // Close the database connection
    mysqli_close($conn);
}
