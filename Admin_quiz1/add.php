<?php
    include '../dbconnect.php';
	if($_GET['category']){
		extract($_GET);
	}
if(isset($_POST['submit'])) {
	$question =htmlentities(mysqli_real_escape_string($conn , $_POST['question']));
	$choice1 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice1']));
	$choice2 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice2']));
	$choice3 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice3']));
	$choice4 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice4']));
	$correct_answer = mysqli_real_escape_string($conn , $_POST['answer']);


    $checkqsn = "SELECT * FROM questions";
	$runcheck = mysqli_query($conn , $checkqsn) or die(mysqli_error($conn));
	$qno = mysqli_num_rows($runcheck) + 1;

	$query = "INSERT INTO questions( question , ans1, ans2, ans3, ans4, correct_answer,category) 
	VALUES ( '$question' , '$choice1' , '$choice2' , '$choice3' , '$choice4' , '$correct_answer','$category') " ;
	$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0 ) {
		echo "<script>alert('Question successfully added'); </script> " ;
	}
	else {
		"<script>alert('error, try again!'); </script> " ;
	}
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>INTELCODE-QUIZ</title>
		<!-- <link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="style1.css"> -->
		<?php
  // require('../commonPHP/head.php');
  require('../commonPHP/adminNavBar.php');
  ?>
			
	</head>

	<body>
			
		<main>
		<div class="container">
		<a href="manage_category.php" class="btn btn-warning mt-2">BACK</a>
			<h2 class="text-center mt-2">Add a question...</h2>
			<form method="post" action="">

				<p>
					<label><span class="label danger">Question</span></label>
					<input type="text" class="form-control" name="question" placeholder="Please Enter your Question" required="">
				</p>
				<p>
					<label><span class="label info">Option-1</span></label>
					<input type="text" class="form-control" name="choice1" placeholder="Please Enter Option-1" required="">
				</p>
				<p>
					<label class="form-label"><span class="label info">Option-2</span></label>
					<input type="text" class="form-control" name="choice2" placeholder="Please Enter Option-2" required="">
				</p>
				<p>
					<label class="form-label"><span class="label info">Option-3</span></label>
					<input type="text" class="form-control" name="choice3" placeholder="Please Enter Option-3" required="">
				</p>
				<p>
					<label class="form-label"><span class="label info">Option-4</span></label>
					<input type="text" class="form-control" name="choice4" placeholder="Please Enter Option-4" required="">
				</p>
				<p>
					<label id="answer" class="form-label"><span class="label success">Answer</span></label>
					<select name="answer" class="form-select" id="select">
						<option value="a">Option-1</option>
						<option value="b">Option-2</option>
						<option value="c">Option-3</option>
						<option value="d">Option-4</option>
					</select>
				</p>
				<p>

					<input type="submit" name="submit" value="Submit" class="btn btn-warning">
				</p>
			</form>
		</div>
	</main>



</body>

</html>
