<?php 
@include ("../mindloops/dbconnect.php");
?>
    <?php
    // define("HOST", 'localhost');
    // define("USER", 'root');
    // define("PASSWORD", '');
    // define("DATABASE", 'db_mindloop');

    $conn = mysqli_connect('localhost','root','','db_mindloop');

    if ($conn->connect_error) {
		  die("Connection failed: " . mysqli_connect_error());
		  exit();
	  }
    
?>
<?php 
if (isset($_GET['qno'])) {
	$qno = mysqli_real_escape_string($conn , $_GET['qno']);
	if (is_numeric($qno)) {
		$query = "SELECT * FROM questions WHERE qno = '$qno' ";
		$run = mysqli_query($conn, $query) or die(mysqli_error($conn));
		if (mysqli_num_rows($run) > 0) {
			while ($row = mysqli_fetch_array($run)) {
				 $qno = $row['qno'];
                 $question = $row['question'];
                 $ans1 = $row['ans1'];
                 $ans2 = $row['ans2'];
                 $ans3 = $row['ans3'];
                 $ans4 = $row['ans4'];
                 $correct_answer = $row['correct_answer'];
			}
		}
		else {
			echo "<script> alert('error');
			window.location.href = 'manage_category.php'; </script>" ;
		}
	}
	else {
		header("location: manage_category.php");
	}
}

?>
<?php 
if(isset($_POST['submit'])) {
	$question =htmlentities(mysqli_real_escape_string($conn , $_POST['question']));
	$choice1 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice1']));
	$choice2 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice2']));
	$choice3 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice3']));
	$choice4 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice4']));
	$correct_answer = mysqli_real_escape_string($conn , $_POST['answer']);
    

	// $query = "UPDATE questions SET question = '$question' , ans1 = '$choice1' , ans2= '$choice2' , ans3 = '$choice3' , ans4 = '$choice4' , correct_answer = '$correct_answer' WHERE qno = '$qno' ";
	$query = "Delete from questions WHERE qno = '$qno' ";
	$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	
	if (mysqli_affected_rows($conn) > 0 ) {
		echo "<script>alert('Question successfully Deleted');
		window.location.href= 'manage_category.php'; </script> " ;
	}
	else {
		"<script>alert('error, try again!'); </script> " ;
	}
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Quiz Delete</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="style1.css">

    <?php
  // require('../../commonPHP/head.php');
  require('../../commonPHP/adminNavBar_quiz.php');
  ?>
	</head>

	<body>
		
			<div class="box">
			<!-- <a href="adminhome.php" class="start">Home</a> -->
			<a href="add.php" class="start">Add Question</a>
			<a href="allquestions.php" class="start">All Questions</a>
				<!-- <a href="exit.php" class="start">Logout</a> -->
				
			</div>


		<main>
			<div class="container">
				<h2>Confirm To delete</h2>
				<form method="post" action="">	
						
						<input type="submit" name="submit" value="Delete" style="display: inline-block;
																				color: #000000;
																				background: #99CC00;
																				border-left: 7px #272726 solid;
																				padding:6px 25px;margin-top: 3%;">
					</p>
				</form>
			</div>
		</main>
	</body>
</html>
