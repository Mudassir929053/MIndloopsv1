<?php
 

if (!session_id()) {
  session_start();
}
if ($_SESSION["userType"] != '4') {
  echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
  // header("../login_and_register/login.php");
}
include("../../dbconnect.php");
$sql = "SELECT * FROM tb_loopstype";
$result = mysqli_query($conn, $sql);
if (isset($_GET['topic_id'])) {
  extract($_GET);
} else {
  header('Location: manageCommunity.php');
}
$user_id = $_SESSION['u_id'];


date_default_timezone_set("Asia/Kuala_Lumpur");
$user_id = $_SESSION['u_id'];
extract($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle image upload
    if (isset($_FILES['c_thumbnail']) && $_FILES['c_thumbnail']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['c_thumbnail']['tmp_name'];
        $fileName = $_FILES['c_thumbnail']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Generate a unique file name
        $newFileName = uniqid() . '.' . $fileExtension;

        // Set the destination path for the uploaded file
        $destPath = '../../assets/forum/article_thumbnail/' . $newFileName;

        // Move the uploaded file to the destination path
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $sql = "INSERT INTO forum_topic (forum_id, ft_name, ft_description, article_thumbnail, created_by) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "isssi", $forum_id, $c_name, $c_desc, $newFileName, $user_id);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                header("Location: forum-articles.php?forum_id=$forum_id");
                exit;
            } else {
                echo "SQL ERROR: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to move the uploaded file.";
        }
    } else {
        echo "Error in the uploaded file.";
    }
} else {
    echo "Invalid request method.";
}
?>
