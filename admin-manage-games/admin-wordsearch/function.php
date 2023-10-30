<?php
include '../../dbconnect.php';

// Check if the form has been submitted
if (isset($_POST['addword'])) {
    $theme = $_POST['theme'];
    $level = $_POST['level'];
    $words = $_POST['words'];
    // var_dump($_POST);
    // exit;
    // Concatenate the words with a separator character
    // $words_string = implode(',', explode("\n", $words));

    // Check if the theme already exists in the database
    $sql = "SELECT * FROM tb_wordsearch WHERE wordsearch_category = '$theme' AND wordsearch_level = '$level'";
    $result = $conn->query($sql);

    if ($_FILES['addimage']['name'] != NULL) {
        $addimage = str_replace("'", "", date('YmdHis') . $_FILES['addimage']['name']);
    } else {
        $addimage = "";
    }
    $folder1 = "../../assets/games/wordsearch/upload/";
    move_uploaded_file($_FILES['addimage']['tmp_name'], $folder1 . $addimage);

    if ($addimage) {
        $update_img = ",wordsearch_image = '$addimage'";
    } else {
        $update_img = '';
    }

    $words_array = explode(",", $words);
    $words_array = array_map('trim', $words_array);
    $words_array = array_filter($words_array);
    $words_array = array_unique($words_array);

    if (count($words_array) < count(explode(",", $words))) {
        // There are duplicates in the words list
        echo "<script>alert('Duplicate words found in the word list. Please remove the duplicates and try again.');
              location.href = '$_SERVER[HTTP_REFERER]';</script>";
        exit;
    } else {
        $words = implode(",", $words_array);
    }

    if ($result->num_rows > 0) {
        $sqlupdate = "UPDATE tb_wordsearch SET
        wordsearch_category = '$theme',
        wordsearch_level = '$level',
        wordsearch_words = '$words'
        $update_img
        WHERE wordsearch_category = '$theme' AND wordsearch_level = '$level'";
        $result1 = $conn->query($sqlupdate);
        // Check if the query was successful
        if ($result1) {
            echo "<script>
        location.href='index.php';</script>";
        } else {
            echo "<script>alert('Something went wrong update.');
        location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else {
        // If the theme does not exist, insert a new row
        $sql1 = "INSERT INTO tb_wordsearch (wordsearch_category, wordsearch_level, wordsearch_words,wordsearch_image)
            VALUES ('$theme', '$level', '$words','$addimage')";
        $result = $conn->query($sql1);

        // Check if the query was successful
        if ($result) {
            echo "<script>
                location.href=index.php';</script>";
        } else {
            echo "<script>alert('Something went wrong.');
                location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    }
}




// ********************************UPDATE WORD*******************************//



// Check if the form has been submitted
if (isset($_POST['updateword'])) {
    // Get the form data
    $id = $_GET['id'];
    $theme = $_POST['theme'];
    $level = $_POST['level'];
    $words = $_POST['words'];
    $words_array = explode("\n", $words);
    $words_string1 = implode(',', $words_array);



    if ($_FILES['updateimage']['name'] != NULL) {
        $updateimage = str_replace("'", "", date('YmdHis') . $_FILES['updateimage']['name']);
    } else {
        $updateimage = "";
    }
    $folder1 = "../../assets/games/wordsearch/upload/";
    move_uploaded_file($_FILES['updateimage']['tmp_name'], $folder1 . $updateimage);

    if ($updateimage) {
        $update_img1 = ",wordsearch_image = '$updateimage'";
    } else {
        $update_img1 = '';
    }



    $words_array = explode(",", $words);
    $words_array = array_map('trim', $words_array);
    $words_array = array_filter($words_array);
    $words_array = array_unique($words_array);

    if (count($words_array) < count(explode(",", $words))) {
        // There are duplicates in the words list
        echo "<script>alert('Duplicate words found in the word list. Please remove the duplicates and try again.');
              location.href = '$_SERVER[HTTP_REFERER]';</script>";
        exit;
    } else {
        $words = implode(",", $words_array);
    }

    // Check if the updated words contain any duplicates
    if (count($words_array) !== count(array_unique($words_array))) {
        echo "<script>alert('Duplicate words are not allowed.');</script>";
    } else {
        // Prepare the SQL query to check if the theme already exists in the same level
        $sql = "SELECT * FROM tb_wordsearch WHERE wordsearch_category = '$theme' AND wordsearch_level = '$level' AND wordsearch_id != $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // If the theme already exists in the same level, display a message
            echo "<script>alert('The word search with this theme already exists in the same level. Please choose a different theme or update the theme.');
                location.href = 'index.php';</script>";
        } else {
            // Prepare the SQL query to update the row
            $sql = "UPDATE tb_wordsearch SET
                    wordsearch_category = '$theme',
                    wordsearch_level = '$level',
                    wordsearch_words = '$words_string1'
                    $update_img1
                   
                    WHERE wordsearch_id = $id";
            $result = $conn->query($sql);
            if ($result) {
                // Redirect to the manage-wordsearch page
                echo "<script>location.href='index.php';</script>";
            } else {
                echo "<script>alert('Something went wrong.');
                      location.href = '$_SERVER[HTTP_REFERER]';</script>";
                exit();
            }
        }
    }
}
//*********************************DELETE WORD*****************************************************/


if (isset($_GET["dm_delete_word"])) {
    // Get the wordsearch ID from the URL parameter
    $id = $_GET["dm_delete_word"];

    // Prepare the SQL query
    $sql = "DELETE FROM tb_wordsearch WHERE wordsearch_id = $id";

    // Execute the SQL query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Redirect to the manage-wordsearch page
        header("Location: index.php");
        exit();
    } else {
        // Display an error message
        echo "Failed to delete the record.";
    }
}
