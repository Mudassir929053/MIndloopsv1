<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>MindLoops-QUIZ</title>
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
    <a style="position:sticky;" href="add.php" class="start">Add Question</a>
    <a href="allquestions.php" class="start">All Questions</a>

    <!-- <a href="players.php" class="start">Players</a> -->
    <!-- <a href="exit.php" class="start">Logout</a> -->
    
  </div>
  
  
  <h1> All QUIZ Questions</h1>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
  <table class="data-table" id="quiz">
    <caption class="title">All QUIZ questions</caption>
    <thead>
      <tr>
        <th>Q.NO</th>
        <th>Question</th>
        <th>Option1</th>
        <th>Option2</th>
        <th>Option3</th>
        <th>Option4</th>
        <th>Correct Answer </th>
        <th>Edit</th>
        <th>Delete</th>

      </tr>
    </thead>
    <tbody>
      <?php
include '../../dbconnect.php';
      

      $query = "SELECT * FROM questions ORDER BY qno DESC";
      $select_questions = mysqli_query($conn, $query) or die(mysqli_error($conn));
      if (mysqli_num_rows($select_questions) > 0) {
        $counter = 1;
        while ($row = mysqli_fetch_array($select_questions)) {
          $qno = $row['qno'];
          $question = $row['question'];
          $option1 = $row['ans1'];
          $option2 = $row['ans2'];
          $option3 = $row['ans3'];
          $option4 = $row['ans4'];
          $Answer = $row['correct_answer'];
          echo "<tr>";
          echo "<td>" . $counter . "</td>";
          echo "<td>$question</td>";
          echo "<td>$option1</td>";
          echo "<td>$option2</td>";
          echo "<td>$option3</td>";
          echo "<td>$option4</td>";
          echo "<td>$Answer</td>";
          echo "<td> <a href='editquestion.php?qno=$qno'> <span> Edit </span> </a></td>";
          echo "<td> <a href='deletequestion.php?qno=$qno'><span> Delete </span></a></td>";
          echo "</tr>";
          $counter++;
        }
      }
      ?>

    </tbody>

  </table>
  </div>
    </div>
  </div>
</body>

</html>