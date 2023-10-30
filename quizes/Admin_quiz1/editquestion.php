<?php
include '../../dbconnect.php';
    
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
    

	$query = "UPDATE questions SET question = '$question' , ans1 = '$choice1' , ans2= '$choice2' , ans3 = '$choice3' , ans4 = '$choice4' , correct_answer = '$correct_answer' WHERE qno = '$qno' ";
	
	$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	
	if (mysqli_affected_rows($conn) > 0 ) {
		echo "<script>alert('Question successfully updated');
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
		<title>Quiz Edit</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="style1.css">

		<?php
  // require('../../commonPHP/head.php');
  require('../../commonPHP/adminNavBar_quiz.php');
  ?>

	</head>

	<body>
	<body>
			<div class="box">
				<!-- <a href="adminhome.php" class="start">Home</a> -->
				<a href="add.php" class="start">Add Question</a>
				<a href="allquestions.php" class="start">All Questions</a>
				<!-- <a href="exit.php" class="start">Logout</a> -->
				
			</div>

		<main>
			<div class="container">
				<h2>Edit a question...</h2>
				<form method="post" action="">

					<p>
						<label><span class="label danger">Question</span></label>
						<input type="text" name="question"  value="<?php echo $question; ?>">
					</p>
					<p>
						<label><span class="label info">Option-1</span></label>
						<input type="text" name="choice1" value="<?php echo $ans1; ?>">
					</p>
					<p>
						<label><span class="label info">Option-2</span></label>
						<input type="text" name="choice2" value="<?php echo $ans2; ?>">
					</p>
					<p>
						<label><span class="label info">Option-3</span></label>
						<input type="text" name="choice3"  value="<?php echo $ans3; ?>">
					</p>
					<p>
						<label><span class="label info">Option-4</span></label>
						<input type="text" name="choice4" value="<?php echo $ans4; ?>">
					</p>
					<p>
						<label id="answer"><span class="label success">Answer</span></label>
						<select name="answer" id="select">
                        <option value="a">Option-1 </option>
                        <option value="b">Option-2</option>
                        <option value="c">Option-3</option>
                        <option value="d">Option-4</option>
                    </select>
					</p>
					<p>
						
						<input type="submit" name="submit" value="Submit" style="display: inline-block;
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
