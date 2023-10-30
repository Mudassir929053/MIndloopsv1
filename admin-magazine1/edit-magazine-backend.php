<?php

@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '600');

include '../dbconnect.php';

$m_id = (int)$_POST['m_id'];
$m_title = $_POST['m_title'];
$m_desc = $_POST['m_desc'];
// $m_imgPath = "pdf/Cover_Pages/" . $_POST['m_imgPathNew'];
$m_rDate = $_POST['m_rDate'];
// $m_filePath = "pdf/Magazine_Full/" . $_POST['m_filePathNew'];
$m_edition = $_POST['m_edition'];
$m_author = $_POST['m_author'];
$m_pageLimit = (int)$_POST['m_pageLimit'];
$currImgPath = $_POST['currImgPath'];
$currFilePath = $_POST['currFilePath'];
$dateTime = (string) date('Y-m-d_H-i-s');


if (isset($_FILES['m_imgPathNew'])) {

	if (($_FILES['cd_imgPathNew']['type'] == "image/png") ||  ($_FILES['cd_imgPathNew']['type'] == "image/jpg") || ($_FILES['cd_imgPathNew']['type'] == "image/jpeg") ||  ($_FILES['cd_imgPathNew']['type'] == "image/webp") || ($_FILES['cd_imgPathNew']['type'] == "image/avif")) {


		if (!is_dir("../assets/magazine/Cover_Pages/" . $dateTime . "/")) {
			mkdir("../assets/magazine/Cover_Pages/" . $dateTime . "/");
		}

		$source_file1 = $_FILES['m_imgPathNew']['tmp_name'];
		$dest_file1 = "../assets/magazine/Cover_Pages/" . $dateTime . "/" . $_FILES['m_imgPathNew']['name'];

		if (file_exists($dest_file1)) {
			unlink($dest_file1);
			$m_imgPath = $dest_file1;
		} else {
			$m_imgPath = $dest_file1;
		}

		move_uploaded_file($source_file1, $dest_file1)
			or die("Error!!");

		gc_collect_cycles();
		unlink($currImgPath);

		$imgPathFolder = substr($currImgPath, 0, 50);
		rmdir($imgPathFolder);
	} else {
		// echo ("<script LANGUAGE='JavaScript'> window.alert('Image is not in jpg/jpeg/png format.');</script>");
		$m_imgPath = $currImgPath;
	}
} else {
	$m_imgPath = $currImgPath;
}


if (isset($_FILES['m_filePathNew'])) {

	if ($_FILES['m_filePathNew']['type'] == "application/pdf") {

		if (!is_dir("../assets/magazine/Magazine_Full/" . $dateTime . "/")) {
			mkdir("../assets/magazine/Magazine_Full/" . $dateTime . "/");
		}

		$source_file2 = $_FILES['m_filePathNew']['tmp_name'];
		$dest_file2 = "../assets/magazine/Magazine_Full/" . $dateTime . "/" . $_FILES['m_filePathNew']['name'];

		if (file_exists($dest_file2)) {

			unlink($dest_file2);
			$m_filePath = $dest_file2;
		} else {
			$m_filePath = $dest_file2;
		}

		move_uploaded_file($source_file2, $dest_file2)
			or die("Error!!");

		gc_collect_cycles();
		unlink($currFilePath);

		$filePathFolder = substr($currFilePath, 0, 52);
		rmdir($filePathFolder);
	} else {
		// echo ("<script LANGUAGE='JavaScript'> window.alert('Magazine is not in PDF format.');</script>");
		$m_filePath = $currFilePath;
	}
} else {
	$m_filePath = $currFilePath;
}




$sql = "UPDATE tb_magazines SET m_title = ?, m_edition = ?, m_rDate = ?, 
m_author = ?, m_desc = ?, m_pageLimit = ?, m_filePath = ?, m_imgPath = ? WHERE m_id = ?;";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
	echo json_encode("SQL ERROR");
} else {

	mysqli_stmt_bind_param($stmt, "sssssissi", $m_title, $m_edition, $m_rDate, $m_author, $m_desc, $m_pageLimit, $m_filePath, $m_imgPath, $m_id);

	mysqli_stmt_execute($stmt);

	echo "<script> alert('Updated Successfully!'); </script>";

	echo "<script> window.location.replace('manage-magazine.php'); </script>";
}
