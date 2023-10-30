<?php

@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '600');

include '../dbconnect.php';

$m_id = (int)$_POST['m_id'];
$m_title = $_POST['m_title'];
$m_desc = $_POST['m_desc'];
// $m_imgPath = "pdf/Cover_Pages/" . $_POST['m_imgPath'];
$m_rDate = $_POST['m_rDate'];
// $m_filePath = "pdf/Magazine_Full/" . $_POST['m_filePath'];
$m_edition = $_POST['m_edition'];
$m_author = $_POST['m_author'];
$m_pageLimit = (int)$_POST['m_pageLimit'];
$dateTime = (string) date('Y-m-d_H-i-s');

// echo $m_id;
// echo $m_title;
// echo $m_desc;
// echo $m_rDate;
// echo $m_edition;
// echo $m_author;
// echo $m_pageLimit;

// STORE PDF FILE IN FOLDER [ERROR: FILE IS NOT BEING STORED]
// if(isset($_FILES['']['name']))
// {
//     $cpath="assets/";
//     $file_parts = pathinfo($_FILES["file"]["name"]);
//     $file_path = 'assets'.time().'.'.$file_parts['extension'];
//     move_uploaded_file($_FILES["file"]["tmp_name"], $cpath.$file_path);
//     $cv2 = $file_path;
// }


if (isset($_FILES['m_imgPath'])) {

	if (($_FILES['m_imgPath']['type'] == "image/png") ||  ($_FILES['m_imgPath']['type'] == "image/jpg") || ($_FILES['m_imgPath']['type'] == "image/jpeg") ||  ($_FILES['m_imgPath']['type'] == "image/webp") || ($_FILES['m_imgPath']['type'] == "image/avif")) {


		if (!is_dir("../assets/magazine/Cover_Pages/" . $dateTime . "/")) {
			// chdir("../assets/magazine/Cover_Pages/");
			// echo "<br />".getcwd()."<br />";
			mkdir("../assets/magazine/Cover_Pages/" . $dateTime . "/");
		}

		$source_file1 = $_FILES['m_imgPath']['tmp_name'];
		$dest_file1 = "../assets/magazine/Cover_Pages/" . $dateTime . "/" . $_FILES['m_imgPath']['name'];

		if (file_exists($dest_file1)) {
			unlink($dest_file1);
			$m_imgPath = $dest_file1;
		} else {
			$m_imgPath = $dest_file1;
		}
	} else {
		echo ("<script LANGUAGE='JavaScript'> window.alert('Magazine is not in PDF format.');</script>");
	}
}


if (isset($_FILES['m_filePath'])) {

	if ($_FILES['m_filePath']['type'] == "application/pdf") {

		if (!is_dir("../assets/magazine/Magazine_Full/" . $dateTime . "/")) {
			mkdir("../assets/magazine/Magazine_Full/" . $dateTime . "/");
		}

		$source_file2 = $_FILES['m_filePath']['tmp_name'];
		$dest_file2 = "../assets/magazine/Magazine_Full/" . $dateTime . "/" . $_FILES['m_filePath']['name'];

		if (file_exists($dest_file2)) {

			unlink($dest_file2);
			$m_filePath = $dest_file2;
		} else {
			$m_filePath = $dest_file2;
		}
	} else {
		echo ("<script LANGUAGE='JavaScript'> window.alert('Magazine is not in PDF format.');</script>");
	}
}






$sql = "INSERT INTO tb_magazines (m_id, m_imgPath, m_title, m_edition, m_rDate, 
m_author, m_desc, m_filePath, m_pageLimit) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
	echo json_encode("SQL ERROR");
} else {

	mysqli_stmt_bind_param($stmt, "isssssssi", $m_id, $m_imgPath, $m_title, $m_edition, $m_rDate, $m_author, $m_desc, $m_filePath, $m_pageLimit);

	if (mysqli_stmt_execute($stmt)) {

		move_uploaded_file($source_file1, $dest_file1)
			or die("Error!!");
		move_uploaded_file($source_file2, $dest_file2)
			or die("Error!!");

		mysqli_stmt_close($stmt);

		//header("Location: manage-magazine.php");

		echo "<script> window.location.replace('manage-magazine.php'); </script>";
	} else {
		echo json_encode("SQL ERROR:" + mysqli_error($conn));
		echo json_encode("Fail");
	}
}
