<?php include("../commonPHP/head.php"); ?>

<?php include("../../dbconnect.php"); 

if (!session_id()) {
    session_start();
}
 include("../commonPHP/topNavBarCheck.php"); 
 $mb_id = $_GET['mb_id'];?>
<link rel="stylesheet" href="../../assets/css/parent.css">
<body class="imagebackground">
<div class="container pt-5">
  <div class="row">
    <?php
   
    // SQL query to fetch data from the database
    $query = "SELECT l_id, l_name, l_image, l_lesson_desc, l_created_date FROM tb_lessons WHERE l_mb_id= $mb_id ";
    $result = mysqli_query($conn, $query);

    // Loop through the result set and generate cards dynamically
    while ($row = mysqli_fetch_assoc($result)) {
      $lessonId = $row['l_id'];
      $lessonName = $row['l_name'];
      $lessonImage = $row['l_image'];
      $lessonDate = $row['l_created_date'];
      $lessonDesc = $row['l_lesson_desc'];
      echo ' <div class="col-lg-4 col-md-6 col-sm-12">' ;
      echo '<div class="card shadow p-3 rounded d-flex flex-column" >';
      echo '<img src="../' . $lessonImage . '" class="card-img-top img-thumbnail" alt="' . $lessonName . '">';
      echo '<div class="card-body">';
      echo '<h4 class="card-text text-dark">' .$lessonName. '</h4>';
      echo '<p class="card-text text-secondary">' .date('y-F-d', strtotime($lessonDate)). '</p>';
      echo '<a href="loops-genaral_knowledge-details.php?l_id=' . $row['l_id'] . '&mb_id='.$mb_id.'" class="text-danger d-flex justify-content-end">Read More</a>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }

    // Close the database connection
    ?>
  </div>
</div>
<?php include("../../premium_modal.php"); ?>
</body>
<?php include("../commonPHP/footer.php"); ?>
<?php include("../commonPHP/jsFiles.php"); ?>