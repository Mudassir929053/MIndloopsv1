<?php
include "../dbconnect.php";

header('Content-Type: application/json');

 $mb_id = $_GET['clue_id'];
// exit;
$sql = "DELETE FROM crossword_clue WHERE clue_id = ?";
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

if (mysqli_affected_rows($conn) > 0) {
  $response = array(
      'message' => 'Deleted successfully.',
      'redirect' => $_SERVER['HTTP_REFERER']
  );
  echo json_encode($response);
  exit();
} else {
  $response = array(
      'message' => 'Error deleting row.',
      'redirect' => ''
  );
  echo json_encode($response);
  exit();
}


?>
