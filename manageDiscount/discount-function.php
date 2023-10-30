<?php
include '../dbconnect.php';
if (isset($_POST['add_discount'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $discount_code = mysqli_real_escape_string($conn, $_POST['discount_code']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $discount_category = mysqli_real_escape_string($conn, $_POST['discount_category']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $created = date('Y-m-d H:i:s');
    $updated = date('Y-m-d H:i:s');
    
    if ($_FILES['discount_image']['name'] != NULL) {
        $discount_image = str_replace("'", "", date('YmdHis') . $_FILES['discount_image']['name']);
    } else {
        $discount_image = "";
    }
    
    $folder = "../assets/discount_images/";
    move_uploaded_file($_FILES['discount_image']['tmp_name'], $folder . $discount_image);
    
    $query = "INSERT INTO discounts (title, discount_code, discount_category, description, start_date, end_date, logo_image, created_at, updated_at)
              VALUES ('$title', '$discount_code', '$discount_category', '$description', '$start_date', '$end_date', '$discount_image', '$created', '$updated')";
              
    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Discount successfully added');</script>";
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Error, try again!');</script>";
    }
    
    // Close the database connection
    mysqli_close($conn);
}



if (isset($_POST['update_discount'])) {
    $discount_id = mysqli_real_escape_string($conn, $_POST['discount_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $discount_code = mysqli_real_escape_string($conn, $_POST['discount_code']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $discount_category = mysqli_real_escape_string($conn, $_POST['discount_category']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $updated = date('Y-m-d H:i:s');
    
    // Check if a new discount image is uploaded
    if ($_FILES['discount_image']['name'] != NULL) {
        $discount_image = str_replace("'", "", date('YmdHis') . $_FILES['discount_image']['name']);
        $folder = "../assets/discount_images/";
        move_uploaded_file($_FILES['discount_image']['tmp_name'], $folder . $discount_image);
        
        // Update the discount with the new image
        $query = "UPDATE discounts SET title = '$title', discount_code = '$discount_code', description = '$description',discount_category = '$discount_category', start_date = '$start_date', end_date = '$end_date', logo_image = '$discount_image', updated_at = '$updated' WHERE discount_id = '$discount_id'";
    } else {
        // Update the discount without changing the image
        $query = "UPDATE discounts SET title = '$title', discount_code = '$discount_code', description = '$description',discount_category = '$discount_category', start_date = '$start_date', end_date = '$end_date', updated_at = '$updated' WHERE discount_id = '$discount_id'";
    }
    
    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Discount successfully updated');</script>";
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Error, try again!');</script>";
    }
    
    // Close the database connection
    mysqli_close($conn);
}
