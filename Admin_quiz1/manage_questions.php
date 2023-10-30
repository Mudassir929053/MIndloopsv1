
  <?php
  if(isset($_GET['category'])){
    extract($_GET);
  }
  include '../dbconnect.php';
  $sql1 = "SELECT * FROM `tb_quiz_category` where category_id='$category'";
  $cat_result = mysqli_query($conn, $sql1);
  while ($row11 = mysqli_fetch_array($cat_result)) {
    $cat_name = $row11['category_name'];
  }
  // require('../commonPHP/head.php');
  require('../commonPHP/adminNavBar.php');
  ?>


<body>
   
 
  <div class="container">
  
    <div class="row">
    <h1 class="text-center mt-3"> QUIZ Questions on <?= $cat_name ?></h1>
    <div class="d-flex justify-content-between"><a  href="manage_category.php" class="btn btn-warning"><i class="bi bi-arrow-left"></i> Back</a> <a  href="add.php?category=<?= $category ?>" class="btn btn-warning float-right"><i class="bi bi-plus-circle"></i> Add Question</a></div>
      <div class="col-lg-12">
  <table class="data-table" id="quiz">
    <caption class="title">QUIZ questions</caption>
    <thead>
      <tr>
        <th>Q.NO</th>
        <th>Question</th>
        <th>Option1</th>
        <th>Option2</th>
        <th>Option3</th>
        <th>Option4</th>
        <th>Answer </th>
        <th>Action</th>

      </tr>
    </thead>
    <tbody>
      <?php
     
     
        // if(isset($_GET['category'])){
        //     extract($_GET);
        // }
      $query = "SELECT * FROM questions where category='$category' ORDER BY qno DESC";
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
          echo "<td> <a href='editquestion.php?qno=$qno' class='mr-2 text-black'><i class='bi bi-pencil-square'></i> </a> <a href='deletequestion.php?qno=$qno' class='text-black'> <i class='bi bi-trash'></i></a></td>";
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
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script>
        const dataTable = new simpleDatatables.DataTable("#quiz", {
            searchable: true,
            fixedHeight: false,
            sortable: true
        });
    </script>
</body>

</html>