<?php
include '../dbconnect.php';

if (isset($_POST['edit_lesson'])) {
    $l_id = $_POST['l_id'];
    $l_name = $_POST['l_name'];
    $l_level = $_POST['l_level'];
    $l_lesson_desc = $_POST['l_lesson_desc'];
    $l_released_date = $_POST['l_released_date'];

    $l_lesson_plan = null;
    $l_worksheet = null;
    $l_exercise = null;
    $l_supplementary_note = null;
    $l_quiz = null;
    $l_image = null;
    $l_classroom_activity = null;

    // Check if a new lesson image is uploaded
    if (!empty($_FILES['l_image']['name'])) {
        $upload_dir = "../assets/mindbooster/lessons/";
        $file_name = basename($_FILES['l_image']['name']);
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['l_image']['tmp_name'], $file_path)) {
            $l_image = $file_path;
        } else {
            echo "<script>alert('Failed to upload the lesson image.');</script>";
        }
    } else {
        // Retrieve the previous lesson image file path
        $sql = "SELECT l_image FROM tb_lessons WHERE l_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $previous_image);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $l_image = $previous_image;
    }

    // Check if a new lesson plan file is uploaded
    if (!empty($_FILES['l_lesson_plan']['name'])) {
        if ($_FILES['l_lesson_plan']['type'] == "application/pdf") {
            $upload_dir = "../assets/mindbooster/lessons/";
            $file_name = basename($_FILES['l_lesson_plan']['name']);
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['l_lesson_plan']['tmp_name'], $file_path)) {
                $l_lesson_plan = $file_path;
            } else {
                echo "<script>alert('Failed to upload the lesson plan file.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file format for the lesson plan. Only PDF files are allowed.');</script>";
        }
    } else {
        // Retrieve the previous lesson plan file path
        $sql = "SELECT l_lesson_plan FROM tb_lessons WHERE l_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $previous_lesson_plan);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $l_lesson_plan = $previous_lesson_plan;
    }

    // Check if a new worksheet file is uploaded
    if (!empty($_FILES['l_worksheet']['name'])) {
        if ($_FILES['l_worksheet']['type'] == "application/pdf") {
            $upload_dir = "../assets/mindbooster/lessons/";
            $file_name = basename($_FILES['l_worksheet']['name']);
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['l_worksheet']['tmp_name'], $file_path)) {
                $l_worksheet = $file_path;
            } else {
                echo "<script>alert('Failed to upload the worksheet file.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file format for the worksheet. Only PDF files are allowed.');</script>";
        }
    } else {
        // Retrieve the previous worksheet file path
        $sql = "SELECT l_worksheet FROM tb_lessons WHERE l_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $previous_worksheet);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $l_worksheet = $previous_worksheet;
    }

    // Check if a new exercise file is uploaded
    if (!empty($_FILES['l_exercise']['name'])) {
        if ($_FILES['l_exercise']['type'] == "application/pdf") {
            $upload_dir = "../assets/mindbooster/lessons/";
            $file_name = basename($_FILES['l_exercise']['name']);
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['l_exercise']['tmp_name'], $file_path)) {
                $l_exercise = $file_path;
            } else {
                echo "<script>alert('Failed to upload the exercise file.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file format for the exercise. Only PDF files are allowed.');</script>";
        }
    } else {
        // Retrieve the previous exercise file path
        $sql = "SELECT l_exercise FROM tb_lessons WHERE l_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $previous_exercise);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $l_exercise = $previous_exercise;
    }

    // Check if a new supplementary notes file is uploaded
    if (!empty($_FILES['l_supplementary_note']['name'])) {
        $allowed_types = array("application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/vnd.ms-powerpoint");

        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($file_info, $_FILES['l_supplementary_note']['tmp_name']);
        finfo_close($file_info);

        if (in_array($file_type, $allowed_types)) {
            $upload_dir = "../assets/mindbooster/lessons/";
            $file_name = basename($_FILES['l_supplementary_note']['name']);
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['l_supplementary_note']['tmp_name'], $file_path)) {
                $l_supplementary_note = $file_path;
            } else {
                echo "<script>alert('Failed to upload the supplementary notes file.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file format for the supplementary notes. Only PPT and PPTX files are allowed.');</script>";
        }
    } else {
        // Retrieve the previous supplementary notes file path
        $sql = "SELECT l_supplementary_note FROM tb_lessons WHERE l_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $previous_supplementary_note);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $l_supplementary_note = $previous_supplementary_note;
    }

    // Check if a new quiz file is uploaded
    if (!empty($_FILES['l_quiz']['name'])) {
        if ($_FILES['l_quiz']['type'] == "application/pdf") {
            $upload_dir = "../assets/mindbooster/lessons/";
            $file_name = basename($_FILES['l_quiz']['name']);
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['l_quiz']['tmp_name'], $file_path)) {
                $l_quiz = $file_path;
            } else {
                echo "<script>alert('Failed to upload the quiz file.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file format for the quiz. Only PDF files are allowed.');</script>";
        }
    } else {
        // Retrieve the previous quiz file path
        $sql = "SELECT l_quiz FROM tb_lessons WHERE l_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $previous_quiz);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $l_quiz = $previous_quiz;
    }

    $sql = "UPDATE tb_lessons SET l_name = ?, l_level = ?, l_lesson_desc = ?, l_lesson_plan = ?, l_worksheet = ?, l_exercise = ?, l_supplementary_note = ?, l_quiz = ?, l_image = ?, l_released_date = ? WHERE l_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssssssi", $l_name, $l_level, $l_lesson_desc, $l_lesson_plan, $l_worksheet, $l_exercise, $l_supplementary_note, $l_quiz, $l_image, $l_released_date, $l_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Lesson updated successfully.');</script>";
            echo "<script>window.location.href = 'manage-mindbooster.php';</script>";
        } else {
            echo "<script>alert('Failed to update Lesson.');</script>";
        }
    } else {
        echo "<script>alert('Failed to prepare the statement.');</script>";
    }
    mysqli_stmt_close($stmt);
}
?>
