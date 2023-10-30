<?php 
include '../dbconnect.php';
if (isset($_POST['submit'])) {
    $js_id = $_POST['js_id'];
    $js_name = $_POST['js_name'];
        $created = date('Y-m-d H:i:s');
        $updated = date('Y-m-d H:i:s');
    
    
        if ($_FILES['image']['name'] != NULL) {
            $js_image =  str_replace("'", "", date('YmdHis') . $_FILES['image']['name']);
        } else {
            $js_image = "";
        }
        $folder1 = "../assets/jigsawimages/";
        move_uploaded_file($_FILES['image']['tmp_name'], $folder1 . $js_image);
        $query = "INSERT INTO jigsawimage( js_name,js_image, created, updated) 
            VALUES ( '$js_name','$js_image' , '$created' , '$updated') ";
        $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Image successfully added'); window.location.href = 'addjigsawcategory-images.php';</script>";
            exit();
            
        } else {
            echo "<script>alert('error, try again!'); </script> ";
        }
    }
    
    if (isset($_POST['update_category'])) {
        $js_id = $_POST['js_id'];
        $js_name = $_POST['js_name'];
        $updated = date('Y-m-d H:i:s');
    
        $query = "UPDATE jigsawimage SET js_name = '$js_name', updated = '$updated'";
    
        if ($_FILES['image_category']['name'] != '') {
            $js_image = str_replace("'", '', date('YmdHis') . $_FILES['image_category']['name']);
            $folder2 = "../assets/jigsawimages/";
            move_uploaded_file($_FILES['image_category']['tmp_name'], $folder2 . $js_image);
            $query .= ", js_image = '$js_image'";
        }
    
        $query .= " WHERE js_id = '$js_id'";
    
        $run = mysqli_query($conn, $query);
    
        if ($run) {
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('Image is successfully updated.');";
            } else {
                echo "<script>alert('No changes were made to the image.');";
            }
        } else {
            echo "<script>alert('Error: Image could not be updated.');</script>";
        }
    
        echo "location.href = 'addjigsawcategory-images.php';</script>";
        exit();
    }
    
    
    
    
    if (isset($_POST['delete_image'])) {
        $id = $_POST['delete_image'];
        $query = "DELETE FROM jigsawimage WHERE js_id = '$id'";
        $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Image successfully deleted');</script>";
            header("Location: addjigsawcategory-images.php");
            exit();
        } else {
            echo "<script>alert('error, try again!');</script>";
        }
    }
    
    
    
        $conn = mysqli_connect('localhost','root','','db_mindloop');
    
        if ($conn->connect_error) {
              die("Connection failed: " . mysqli_connect_error());
              exit();
          }
        
    
    if (isset($_POST['upload'])) {
        $js_id = $_POST['js_id'];
        $ji_name = $_POST['ji_name'];
            $created = date('Y-m-d H:i:s');
            $updated = date('Y-m-d H:i:s');
        
        
            if ($_FILES['image']['name'] != NULL) {
                $ji_image =  str_replace("'", "", date('YmdHis') . $_FILES['image']['name']);
            } else {
                $ji_image = "";
            }
            $folder1 = "../assets/jigsawimages/";
            move_uploaded_file($_FILES['image']['tmp_name'], $folder1 . $ji_image);
            $query = "INSERT INTO jigsaw_image(ji_js_id, ji_name, ji_image, created, updated) 
            VALUES ('$js_id', '$ji_name', '$ji_image', '$created', '$updated')";
            $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('Image is  successful Inserted.');
                location.href = '$_SERVER[HTTP_REFERER]';</script>";
                exit();
            } else {
                echo "<script>alert('eeerorro is not successful create.');
                location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
        }
    
    
        if (isset($_POST['update'])) {
            $ji_id = $_POST['ji_id'];
            $ji_name = $_POST['ji_name'];
            $updated = date('Y-m-d H:i:s');
            $ji_js_id = $_POST['ji_js_id'];
          
            $query = "UPDATE jigsaw_image SET ji_name = '$ji_name', updated = '$updated'";
          
            if ($_FILES['image']['name'] != NULL) {
              $ji_image =  str_replace("'", "", date('YmdHis') . $_FILES['image']['name']);
              $folder1 = "../assets/jigsawimages/";
              move_uploaded_file($_FILES['image']['tmp_name'], $folder1 . $ji_image);
              $query .= ", ji_image = '$ji_image'";
            }
          
            $query .= " WHERE ji_id = '$ji_id' AND ji_js_id = '$ji_js_id'";
          
            $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
          
            if (mysqli_affected_rows($conn) > 0) {
              echo "<script>alert('Image is successfully updated.');
              location.href = '$_SERVER[HTTP_REFERER]';</script>";
              exit();
            } else {
              echo "<script>alert('Error: Image could not be updated.');
              location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
          }
        
        
        
    
    
        if (isset($_POST['delete_jigsawimage'])) {
            $id = $_POST['delete_jigsawimage'];
            $query = "DELETE FROM jigsaw_image WHERE ji_id = '$id'";
            $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('Image is deieted successful .');
                location.href = '$_SERVER[HTTP_REFERER]';</script>";
                exit();
            } else {
                echo "<script>alert('Image is not deieted successful .');
                location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
        }
//===================================== CROSSWORD CODE START==========================================================
//Add crossword category
if (isset($_POST['add_crossgame_categories'])) {
    $cc_name = mysqli_real_escape_string($conn, $_POST['cc_name']);
    if ($_FILES['category_image']['name'] != NULL) {
		$cc_image = str_replace("'", "", date('YmdHis') . $_FILES['category_image']['name']);
	} else {
		$cc_image = "";
	}
	//Folder for attachment
	$folder1 = "../assets/games/crossword/upload/";
	move_uploaded_file($_FILES['category_image']['tmp_name'], $folder1 . $cc_image);
    $query = "INSERT INTO `crossword_categories`(`cc_name`,`cc_image`)
              VALUES ('$cc_name', '$cc_image')";
    $run = mysqli_query($conn, $query);
    if ($run) {
        echo "<script>alert('Category added successfully');</script>";
        header("Location: game-crossword.php");
        exit();
    } else {
        echo "<script>alert('Error, try again.');</script>";
    }
}
//Update crossword category
if (isset($_POST['edit_category'])) {
    $cc_id = $_POST['cc_id'];
    $cc_name = mysqli_real_escape_string($conn, $_POST['cc_name']);
    $cc_status = $_POST['cc_status'];

    // Check if a new image is uploaded
    if ($_FILES['category_image']['name'] != NULL) {
        $cc_image = str_replace("'", "", date('YmdHis') . $_FILES['category_image']['name']);
        $folder2 = "../assets/games/crossword/upload/";

        // Get existing image path from the database
        $query = "SELECT cc_image FROM crossword_categories WHERE cc_id = '$cc_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $existing_image = $row['cc_image'];
        $existing_image_path = $folder2 . $existing_image;

        // Check if existing image exists in the server
        if (file_exists($existing_image_path)) {
            // Delete existing image
            unlink($existing_image_path);
        }

        // Upload new image
        move_uploaded_file($_FILES['category_image']['tmp_name'], $folder2 . $cc_image);

        // Update category with new image
        $query = "UPDATE crossword_categories SET cc_name = '$cc_name', cc_publish = '$cc_status', cc_image = '$cc_image' WHERE cc_id = '$cc_id'";
    } else {
        // Update category without changing image
        $query = "UPDATE crossword_categories SET cc_name = '$cc_name', cc_publish = '$cc_status' WHERE cc_id = '$cc_id'";
    }

    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Category updated successfully');
        location.href = '$_SERVER[HTTP_REFERER]';</script>";
        exit();
    } else {
        echo "<script>alert('Error, try again.');</script>";
    }
}


//Add clue question -------------------
if (isset($_POST['add_crossgame_clue'])) {
    $cc_clue = $_POST['cc_clue'];
    $cc_answer = $_POST['cc_answer'];
    $cc_direction = $_POST['cc_direction'];
    $cc_row = $_POST['cc_row'];
    $cc_column = $_POST['cc_column'];
    $cc_id = $_POST['cc_id'];
    $query = "INSERT INTO `crossword_clue`( `cc_id`, `direction`, `row`, `column`, `clue`, `answer`) 
    VALUES ('$cc_id','$cc_direction','$cc_row','$cc_column','$cc_clue','$cc_answer')";
    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Clue Added Successfully.');
        location.href = '$_SERVER[HTTP_REFERER]';</script>";
        exit();
    } else {
        echo "<script>alert('error, try again!'); </script> ";
    }
}

//Update clue question -------------------
if (isset($_POST['Update_crossgame_clue'])) {
    $clue_id = $_POST['clue_id'];
    $direction = $_POST['cc_direction'];
    $row = $_POST['cc_row'];
    $column = $_POST['cc_column'];
    $clue = $_POST['cc_clue'];
    $answer = $_POST['cc_answer'];
    $query = "UPDATE crossword_clue SET  direction = '$direction', `row` = '$row', `column` = '$column', clue = '$clue', answer = '$answer' WHERE clue_id = '$clue_id' ";
    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Clue Updated Successfully');
        location.href = '$_SERVER[HTTP_REFERER]';</script>";
        exit();
    } else {
        echo "<script>alert('Error, try again!');</script> ";
    }
}
    //===================================== CROSSWORD CODE END==========================================================
