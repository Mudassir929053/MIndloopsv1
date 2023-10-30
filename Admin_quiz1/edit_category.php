<?php 
session_start();
// @include ("../mindloops/dbconnect.php");
include '../dbconnect.php';
if (isset($_GET['id'])) {
	$qno = mysqli_real_escape_string($conn , $_GET['id']);
	if (is_numeric($qno)) {
		$query = "SELECT * FROM tb_quiz_category WHERE category_id = '$qno' ";
		$run = mysqli_query($conn, $query) or die(mysqli_error($conn));
		if (mysqli_num_rows($run) > 0) {
			while ($row = mysqli_fetch_array($run)) {
				 $id = $row['category_id'];
                 $category_name = $row['category_name'];
                 $category_image = $row['category_images'];
                //  $ans2 = $row['ans2'];
                //  $ans3 = $row['ans3'];
                //  $ans4 = $row['ans4'];
                //  $correct_answer = $row['correct_answer'];
			}
		}
		else {
			echo "<script> alert('error');
			window.location.href = 'allquestions.php'; </script>" ;
		}
	}
	else {
		header("location: allquestions.php");
	}
}

?>
<?php 
if(isset($_POST['update_category'])) {
	extract($_POST);
    // var_dump($_SESSION);
    extract($_SESSION);
    $user = explode('@',$email);
    // var_dump($user);

    $created_by = $user[0];

    // exit;
       
        
    
        if ($_FILES['addimage']['name'] != NULL) {
            $addimage = str_replace("'", "", date('YmdHis') . $_FILES['addimage']['name']);
            $sql1 = "update `tb_quiz_category` set category_name='$theme',category_images='$addimage' where category_id='$qno'";
        } else {
            $addimage = "";
            $sql1 = "update `tb_quiz_category` set category_name='$theme' where category_id='$qno'";
        }
        $folder1 = "../assets/quiz/";
        move_uploaded_file($_FILES['addimage']['tmp_name'], $folder1 . $addimage);
    
        
        
            // If the theme does not exist, insert a new row
           
            $result = $conn->query($sql1);
    // exit;
            // Check if the query was successful
            if ($result) {
                echo "<script>
                    location.href='manage_category.php';</script>";
            } else {
                echo "<script>alert('Something went wrong.');
                    location.href = '$_SERVER[HTTP_REFERER]';</script>";
            }
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Category Edit</title>
		

		<?php
  // require('../commonPHP/head.php');
  require('../commonPHP/adminNavBar.php');
  ?>

	</head>

	<body>
	<body>
			

		<main id="main">
        <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Edit Category</h2>

        <br>

        <div class="row gy-4">

          <a href="manage_category.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

            <form id="insertword" action="" method="POST" enctype='multipart/form-data'>
             
              <br>
              <div class="form-group">
                <label for="theme">Category</label>
                <input type="text" class="form-control" id="theme" name="theme" value="<?= $category_name ?>" placeholder="Enter Theme" required>
              </div>
              <br>
              
              <br>
              <div class="form-group">
                <label for="addimage">Select Image</label>
                <input type="file" class="form-control" accept="image/png,image/jpeg" id="addimage" name="addimage" onchange="previewImage(this)">

                <img id="preview-image" src="../assets/quiz/<?= $category_image ?>" alt="Preview Image" style=" max-width: 300px; margin-top: 10px;">
              </div>
              <br>
              <br>
              <div class="form-group">
                <button type="submit" id="add_category" name="update_category" class="btn btn-warning">update Category</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
              </div>
            </form>

          </div>

        </div>

      </div>
    </section>
		</main>

		

	</body>
</html>
