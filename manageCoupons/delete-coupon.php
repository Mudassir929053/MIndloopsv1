<?php
include "../dbconnect.php";

header('Content-Type: application/json');

$discount_id = $_GET['coupon_id'];
$sql = "DELETE FROM `coupons` WHERE coupon_id = ?";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
  mysqli_stmt_bind_param($stmt, "i", $discount_id);
  mysqli_stmt_execute($stmt);
  $data = array("status" => "success");
  echo json_encode($data);
} else {
  $data = array("status" => "fail");
  echo json_encode($data);
}
?>
