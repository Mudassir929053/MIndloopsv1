<?php

// *********************************START of INSERTING New Image and Word in to DB****************************************
   // Include the database connection file
include('../dbconnect.php');
// Check if form is submitted
if(isset($_POST['addword'])) {
// Get form data
$word_name = $_POST['word_name'];
$category = $_POST['category'];
$level = $_POST['level'];
$image_url = '';
$img_category = '';
    // Check if word image is uploaded
    if(isset($_FILES['image'])) {
      $file = $_FILES['image'];
      $file_name = $file['name'];
      $file_tmp = $file['tmp_name'];
      $file_size = $file['size'];
      $file_error = $file['error'];
      $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
      $allowed_ext = array('png', 'jpg', 'jpeg');

      // Check if file extension is allowed
      if(in_array($file_ext, $allowed_ext)) {
          // Generate unique image name
          $image_name = uniqid('', true) . '.' . $file_ext;
          $image_path = 'uploads/' . $image_name;

          // Upload image to server
          if(move_uploaded_file($file_tmp, $image_path)) {
              $image_url = $image_path;
          } else {
              die("Error uploading word image file.");
          }
      } else {
          die("Invalid file extension. Allowed extensions: .png, .jpg, .jpeg");
      }
  } else {
      die("Word image file is required.");
  }

  // Check if category image is uploaded
  if(isset($_FILES['category_image'])) {
      $file = $_FILES['category_image'];
      $file_name = $file['name'];
      $file_tmp = $file['tmp_name'];
      $file_size = $file['size'];
      $file_error = $file['error'];
      $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
      $allowed_ext = array('png', 'jpg', 'jpeg');

      // Check if file extension is allowed
      if(in_array($file_ext, $allowed_ext)) {
          // Generate unique image name
          $img_name = uniqid('', true) . '.' . $file_ext;
          $img_path = 'uploads/' . $img_name;

          // Upload image to server
          if(move_uploaded_file($file_tmp, $img_path)) {
              $img_category = $img_path;
          } else {
              die("Error uploading category image file.");
          }
      } else {
          die("Invalid file extension. Allowed extensions: .png, .jpg, .jpeg");
      }
  } else {
      die("Category image file is required.");
  }

  // Insert data into database using prepared statement to avoid SQL injection attacks
  $stmt = $conn->prepare("INSERT INTO `tb_wordmatch` (`word_name`, `category`, `game_level`, `image_url`, `img_category`) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $word_name, $category, $level, $image_url, $img_category);
  
  if($stmt->execute()) {
  echo '<script>alert("Word-Picture added successfully.")</script>';
  } else {
    echo '<script>alert("Error: ' . $stmt->error . '")</script>';
  }
}

// *********************************END of INSERTING New Image and Word in to DB****************************************

// *********************************START of DELETING Image and Word in to DB****************************************

// Check if the id parameter is passed in the URL
if (isset($_GET["dm_delete_word"])) {
     $dm_delete_word = $_GET["dm_delete_word"];
    //  extract($_GET);
// exit;
    // Delete the record from the database
     $sql = "DELETE FROM tb_wordmatch WHERE id = $dm_delete_word";
//    exit;
    $result = mysqli_query($conn, $sql);

    // Check if the record was deleted successfully
    if ($result) {
        // Redirect to the homepage with a success message
        header ("Location: admin.php?success=Record deleted successfully.");
        exit();
    } else {
        // Redirect to the homepage with an error message
        header("Location: admin.php?error=Failed to delete record.");
        exit();
    }
} 
// *********************************END of DELETING Image and Word in to DB****************************************

// *********************************START of EDIT Image and Word in to DB****************************************

if (isset($_POST['edit_word_picture'])) {
  $id = $_GET['id'];
  $game_level = $_POST['game_level'];
  $category = $_POST['category'];
  $word_name = $_POST['word_name'];

  // Check if a new file has been uploaded for the image
  if ($_FILES['image']['name']) {
      // Upload the new image and get its URL
      $image_name = $_FILES['image']['name'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_url = 'uploads/' . $image_name;
      move_uploaded_file($image_tmp_name, $image_url);

      // Delete the old image if it exists
    //   if ($row['image_url']) {
    //       unlink($row['image_url']);
    //   }
  } else {
      // Use the existing image URL if no new image has been uploaded
    //   $image_url = $row['image_url'];
  }

  // Check if a new file has been uploaded for the category image
  if ($_FILES['category_image']['name']) {
      // Upload the new category image and get its URL
      $category_image_name = $_FILES['category_image']['name'];
      $category_image_tmp_name = $_FILES['category_image']['tmp_name'];
      $category_image_url = 'uploads/' . $category_image_name;
      move_uploaded_file($category_image_tmp_name, $category_image_url);

      // Delete the old category image if it exists
    //   if ($row['img_category']) {
    //       unlink($row['img_category']);
    //   }
  } else {
      // Use the existing category image URL if no new category image has been uploaded
    //   $category_image_url = $row['img_category'];
  }

  // Update the record in the database with the new values
  if (!empty($image_url) && !empty($category_image_url)) {
      // If both image and category image URLs are not empty, update all fields
      $sql = "UPDATE tb_wordmatch SET game_level='$game_level', category='$category', word_name='$word_name', image_url='$image_url', img_category='$category_image_url' WHERE id='$id'";
  } elseif (!empty($image_url)) {
      // If only the image URL is not empty, update image-related fields only
      $sql = "UPDATE tb_wordmatch SET game_level='$game_level', category='$category', word_name='$word_name', image_url='$image_url' WHERE id='$id'";
  } elseif (!empty($category_image_url)) {
      // If only the category image URL is not empty, update category image-related fields only
      $sql = "UPDATE tb_wordmatch SET game_level='$game_level', category='$category', word_name='$word_name', img_category='$category_image_url' WHERE id='$id'";
  } else {
      // If both URLs are empty, update only non-image fields
      $sql = "UPDATE tb_wordmatch SET game_level='$game_level', category='$category', word_name='$word_name' WHERE id='$id'";
  }

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Word-Picture updated successfully.")</script>';
  } else {
    echo '<script>alert("Error updating word: ' . $conn->error . '")</script>';
  }
}

  
// *********************************END of EDIT Image and Word in to DB****************************************
  
?>

