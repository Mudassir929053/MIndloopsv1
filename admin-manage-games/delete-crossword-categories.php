<?php
include "../dbconnect.php";

header('Content-Type: application/json');

$mb_id = $_GET['mb_id'];

$sql = "DELETE FROM crossword_categories WHERE cc_id = ?";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
  mysqli_stmt_bind_param($stmt, "i", $mb_id);
  mysqli_stmt_execute($stmt);
  $data = array("status" => "success");
  echo json_encode($data);
} else {
  $data = array("status" => "fail");
  echo json_encode($data);
}
?>
