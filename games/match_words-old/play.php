<?php
include '../../dbconnect.php';
// $data = ["name"=>"Sana","company"=>"Intelcode"];

extract($_GET);
// echo $level;
if ($level === 'Easy') {
  $limit = 3;
} elseif ($level === 'Medium') {
  $limit = 5;
} elseif ($level === 'Hard') {
  $limit = 14;
} else {
  // Default limit
  $limit = 3;
}

$sql = "SELECT image_url, word_name FROM `tb_wordmatch` WHERE game_level='$level' and category='$category' LIMIT $limit";
$result = mysqli_query($conn, $sql);

// $sql = "SELECT image_url,word_name FROM `tb_wordmatch` WHERE game_level='$level' and category='$category'";
// $result = mysqli_query($conn, $sql);

// exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Match Picture-Word</title>
  <!-- Favicons -->
  <link href="../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
  <link href="../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../../assets/vendor/glightbox/css/gallery/glightbox.min.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../../assets/vendor/swiper/gallery/swiper-bundle.min.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">
  <link href="../../assets/css/package.css" rel="stylesheet">


  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/p5.min.js"></script> -->
  <?php
  if ($level == 'Easy') {
    $cssLink = '../../assets/games/match_words/css/easy.css';
  } else if ($level == 'Medium') {
    $cssLink = '../../assets/games/match_words/css/medium.css';
  } else if ($level == 'Hard') {
    $cssLink = '../../assets/games/match_words/css/hard.css';
  }

  // Output CSS link tag
  echo "<link rel='stylesheet' href='$cssLink'>";
  ?>

</head>

<body class="bg">

  <div class="container-fluid p-3">
    <div class="row  ">
      <div class="flex-container">
        <div class="class">
          <a href="level.php"> <img id="img1" src="../../assets/games/match_words/images/backbtn.png" alt="..."> </a>
        </div>
        <div class="class">
          <a class="thumbnail" data-bs-toggle="modal" data-bs-target="#myModal1"><img id="img1" src="../../assets/games/match_words/images/questionbtn.png" alt="..."> </a>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <?php
    ?>
    <div class="row">
      <div class="col-12">
        <section class="draggable-elements">
          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="draggable" id="<?= $row['word_name'] ?>" draggable="true" style="background-image:url(<?= $row['image_url'] ?>)"></div>
          <?php endwhile; ?>
        </section>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <section class="droppable-elements">
          <?php mysqli_data_seek($result, 0); // Reset the result pointer to the beginning 
          ?>
          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="droppable" id="<?= $row['id'] ?>" data-draggable-id="<?= $row['word_name'] ?>"><span><?= $row['word_name'] ?></span></div>
          <?php endwhile; ?>
        </section>
      </div>
    </div>
  </div>
  <script src="main.js"></script>
  <!-- Modal -->
  <div id="myModal" class="modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h3>Congratulations!</h3>
          <h3>You did a great job.</h3>
        </div>
        <div class="button-container">
          <button id="play-again-btn" type="button" class="btn btn-primary">Play Again</button>
          <button id="quit-btn" type="button" class="btn btn-secondary">Quit</button>
        </div>
      </div>
    </div>
  </div>


  <!--END Modal -->
  <div id="myModal1" class="modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          Drag the images and drop <br><br>into the word which they<br><br> are matching.
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div id="popup">
    <div class="popup-content">
      <h3 id="tag">Match the picture with its words</h3><br>
      <div class="button-container">
        <br>
        <button id="ok-btn">OK</button>
      </div>
    </div>
  </div>

  <!--END Modal -->

  <script>
    window.onload = function() {
      var popup = document.getElementById("popup");
      var okBtn = document.getElementById("ok-btn");
      okBtn.onclick = function() {
        popup.style.display = "none";
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!-- <script>
    document.querySelector('.level-btn').addEventListener('click', function() {
      window.history.back();
    });
  </script> -->

</body>

</html>