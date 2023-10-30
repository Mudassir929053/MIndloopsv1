<?php

@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '600');

include '../dbconnect.php';

$l_name = $_POST['l_name'];
$l_level = $_POST['l_level'];
$mb_id = $_POST['mb_id'];
$l_lesson_plan = $_FILES['l_lesson_plan']['name'];
$l_classroom_activity = $_FILES['l_classroom_activity']['name'];
$l_worksheet = $_FILES['l_worksheet']['name'];
$l_exercise = $_FILES['l_exercise']['name'];
$l_supplementary_note = $_FILES['l_supplementary_note']['name'];
$l_quiz = $_FILES['l_quiz']['name'];
$l_lesson_desc = $_POST['l_lesson_desc'];
$l_released_date = $_POST['l_released_date'];
$l_image = $_FILES['l_image']['name'];

$target_dir = "../assets/mindbooster/lessons/";
$lessonPlanTargetFile = '';
$classroomActivityTargetFile = '';
$worksheetTargetFile = '';
$exerciseTargetFile = '';
$supplementaryNoteTargetFile = '';
$quizTargetFile = '';
$l_imageTargetFile = '';

$lessonPlanFileType = '';
$classroomActivityFileType = '';
$worksheetFileType = '';
$exerciseFileType = '';
$supplementaryNoteFileType = '';
$quizFileType = '';
$l_imageFileType = '';

// Process Lesson Plan file
if (!empty($_FILES['l_lesson_plan']['name'])) {
    $lessonPlanTargetFile = $target_dir . basename($_FILES['l_lesson_plan']['name']);
    $lessonPlanFileType = strtolower(pathinfo($lessonPlanTargetFile, PATHINFO_EXTENSION));
}

// Process Classroom Activity file
if (!empty($_FILES['l_classroom_activity']['name'])) {
    $classroomActivityTargetFile = $target_dir . basename($_FILES['l_classroom_activity']['name']);
    $classroomActivityFileType = strtolower(pathinfo($classroomActivityTargetFile, PATHINFO_EXTENSION));
}

// Process Worksheet file
if (!empty($_FILES['l_worksheet']['name'])) {
    $worksheetTargetFile = $target_dir . basename($_FILES['l_worksheet']['name']);
    $worksheetFileType = strtolower(pathinfo($worksheetTargetFile, PATHINFO_EXTENSION));
}

// Process Exercise file
if (!empty($_FILES['l_exercise']['name'])) {
    $exerciseTargetFile = $target_dir . basename($_FILES['l_exercise']['name']);
    $exerciseFileType = strtolower(pathinfo($exerciseTargetFile, PATHINFO_EXTENSION));
}

// Process Supplementary Note file
if (!empty($_FILES['l_supplementary_note']['name'])) {
    $supplementaryNoteTargetFile = $target_dir . basename($_FILES['l_supplementary_note']['name']);
    $supplementaryNoteFileType = strtolower(pathinfo($supplementaryNoteTargetFile, PATHINFO_EXTENSION));
}

// Process Quiz file
if (!empty($_FILES['l_quiz']['name'])) {
    $quizTargetFile = $target_dir . basename($_FILES['l_quiz']['name']);
    $quizFileType = strtolower(pathinfo($quizTargetFile, PATHINFO_EXTENSION));
}

// Process Lesson Image file
if (!empty($_FILES['l_image']['name'])) {
    $l_imageTargetFile = $target_dir . basename($_FILES['l_image']['name']);
    $l_imageFileType = strtolower(pathinfo($l_imageTargetFile, PATHINFO_EXTENSION));
}

$validExtensions = [
    'doc', 'docx', 'pdf', 'pptx', 'ppt', 'odp', 'key', 'jpeg', 'jpg', 'png', 'gif', 'svg+xml'
];
// Check if file formats are valid
if (
    (empty($_FILES['l_lesson_plan']['name']) || in_array($lessonPlanFileType, ['doc', 'docx'])) &&
    (empty($_FILES['l_classroom_activity']['name']) || $classroomActivityFileType == "pdf") &&
    (empty($_FILES['l_worksheet']['name']) || $worksheetFileType == "pdf") &&
    (empty($_FILES['l_exercise']['name']) || $exerciseFileType == "pdf") &&
    (empty($_FILES['l_supplementary_note']['name']) || in_array($supplementaryNoteFileType, ['pptx', 'ppt', 'odp', 'key', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-powerpoint', 'application/vnd.oasis.opendocument.presentation', 'application/x-iwork-keynote-sffkey'])) &&
    (empty($_FILES['l_quiz']['name']) || $quizFileType == "pdf") &&
    (empty($_FILES['l_image']['name']) || in_array($l_imageFileType, ['jpeg', 'jpg', 'png', 'gif', 'svg+xml']))
) {
    // Move uploaded files to the target directory
    if (
        (empty($_FILES['l_lesson_plan']['name']) || move_uploaded_file($_FILES['l_lesson_plan']['tmp_name'], $lessonPlanTargetFile)) &&
        (empty($_FILES['l_classroom_activity']['name']) || move_uploaded_file($_FILES['l_classroom_activity']['tmp_name'], $classroomActivityTargetFile)) &&
        (empty($_FILES['l_worksheet']['name']) || move_uploaded_file($_FILES['l_worksheet']['tmp_name'], $worksheetTargetFile)) &&
        (empty($_FILES['l_exercise']['name']) || move_uploaded_file($_FILES['l_exercise']['tmp_name'], $exerciseTargetFile)) &&
        (empty($_FILES['l_supplementary_note']['name']) || move_uploaded_file($_FILES['l_supplementary_note']['tmp_name'], $supplementaryNoteTargetFile)) &&
        (empty($_FILES['l_quiz']['name']) || move_uploaded_file($_FILES['l_quiz']['tmp_name'], $quizTargetFile)) &&
        (empty($_FILES['l_image']['name']) || move_uploaded_file($_FILES['l_image']['tmp_name'], $l_imageTargetFile))
    ) {
        // Insert the data into the database
        $sql = "INSERT INTO tb_lessons (l_name, l_mb_id, l_level, l_lesson_plan, l_classroom_activity, l_lesson_desc, l_worksheet, l_supplementary_note, l_quiz, l_released_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssssss", $l_name, $mb_id, $l_level, $lessonPlanTargetFile, $classroomActivityTargetFile, $l_lesson_desc, $worksheetTargetFile, $supplementaryNoteTargetFile, $quizTargetFile, $l_released_date);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                header("Location: view-mindbooster.php?mb_id=$mb_id");
                exit();
            } else {
                echo "SQL ERROR: " . mysqli_error($conn);
            }
        } else {
            echo "SQL ERROR: " . mysqli_error($conn);
        }
    } else {
        echo "Error moving uploaded files.";
    }
} else {
    echo "Invalid file format. Only PDF, PPTX, PPT, ODP, KEY, JPEG, JPG, PNG, GIF, SVG files are allowed.";
}
