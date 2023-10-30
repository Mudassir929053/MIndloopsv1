<?php
include '../dbconnect.php';

extract($_GET);

$sql = "SELECT * FROM tb_wordsearch WHERE wordsearch_category = '$category' and wordsearch_level='$level'";
$result = $conn->query($sql);

while($row = mysqli_fetch_assoc($result)){
    // $words = $row['wordsearch_words'];
    // $imagePath = "../assets/magazine/admin_magazine/" . $row['wordsearch_image'];
    // echo $words . "|" . $imagePath;
    echo json_encode($row);
}
