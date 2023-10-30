
<?php
include '../../dbconnect.php';
if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '2') {
    echo "<script> window.location.replace('../../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
date_default_timezone_set("Asia/Kuala_Lumpur");
extract($_POST);

$dest_file1 = '';

if (isset($_FILES['m_filePath']) && $_FILES['m_filePath']['name'] != '') {
    if (($_FILES['m_filePath']['type'] == "image/png") || ($_FILES['m_filePath']['type'] == "image/jpg") || ($_FILES['m_filePath']['type'] == "image/jpeg") || ($_FILES['m_filePath']['type'] == "application/pdf")) {
        if (!is_dir("../assets/tomindloops/tomindloops_attachment/")) {
            // mkdir("../../assets/tomindloops/tomindloops_attachment/");
        }
        $source_file1 = $_FILES['m_filePath']['tmp_name'];
        $dest_file1 = "../../assets/tomindloops/tomindloops_attachment/" . time() . $_FILES['m_filePath']['name'];
        if (file_exists($dest_file1)) {
            unlink($dest_file1);
            $m_filePath = $dest_file1;
        } else {
            $m_filePath = $dest_file1;
        }
        move_uploaded_file($source_file1, $dest_file1);
    }
}

if ($conn) {
    $user_id = $_SESSION['u_id'];
    $sql = "INSERT INTO kidzpost(topic_id,title,content,created_by,attachment) VALUES (?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "issss", $topic_id, $ca_name, $ca_desc, $user_id, $dest_file1);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        echo "<script>
                alert('Article submitted successfully');
                window.location.href = 'forum_details.php?forum_id=" . $topic_id . "';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Failed to submit data');
                window.location.href = 'forum_details.php?forum_id=" . $topic_id . "';
              </script>";
        exit();
    }
} else {
    echo ("SQL ERROR:" . mysqli_error($con));
    // echo ("Fail");
}
