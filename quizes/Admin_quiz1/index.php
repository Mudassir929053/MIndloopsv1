<?php

include '../../dbconnect.php';
extract($_GET);
// echo $category;

?>

<?php
session_start();
if (isset($_SESSION['id'])) {
  header("location: .php");
}

$query = "SELECT qno FROM questions WHERE category=$category";
$run = mysqli_query($conn, $query) or die(mysqli_error($conn));
$total = mysqli_num_rows($run);
$row = mysqli_fetch_all($run);
// var_dump($row);
// exit;
$array = [];
shuffle($row);
foreach ($row as $a) {
  array_push($array, $a[0]);
}
// echo json_encode($array);
// exit;
// echo "<pre>";
// print_r($array);
// echo "</pre>";
$_SESSION['question'] = $_SESSION['allquestions'] = $array;
// print_r($row);
// $qno = $row['qno'];
// $qno++;
$_SESSION['attemptedq'] = [];

?>

<html>

<head>
  <title>Quiz</title>

  <style>
    body {
      /* margin-top: 8%; */
      background-image: url('images/2.png');
      background-size: cover;
      background-attachment: fixed;
      background-repeat: no-repeat;

      /* Make the background image responsive */
      background-position: center;
      background-size: cover;
      font-family: "Poppins", "Arial", "Helvetica Neue", sans-serif;

    }

    /* Add a breakpoint at 980px */
    @media screen and (max-width: 980px) {
      body {
        /* Change the background image to a smaller file at smaller screen sizes */
        background-image: url('images/2-small.png');
      }
    }



    main {
      /* position: center; */

      text-align: center;
    }

    li {
      list-style: none;
    }

    .font {
      font-size: 19px;
    }

    @-webkit-keyframes spaceboots {

      0% {
        -webkit-transform: translate(2px, 1px) rotate(0deg);
      }

      10% {
        -webkit-transform: translate(-1px, -2px) rotate(-1deg);
      }

      20% {
        -webkit-transform: translate(-3px, 0px) rotate(1deg);
      }

      30% {
        -webkit-transform: translate(0px, 2px) rotate(0deg);
      }

      40% {
        -webkit-transform: translate(1px, -1px) rotate(1deg);
      }

      50% {
        -webkit-transform: translate(-1px, 2px) rotate(-1deg);
      }

      60% {
        -webkit-transform: translate(-3px, 1px) rotate(0deg);
      }

      70% {
        -webkit-transform: translate(2px, 1px) rotate(-1deg);
      }

      80% {
        -webkit-transform: translate(-1px, -1px) rotate(1deg);
      }

      90% {
        -webkit-transform: translate(2px, 2px) rotate(0deg);
      }

      100% {
        -webkit-transform: translate(1px, -2px) rotate(-1deg);
      }

    }

    #shake {

      -webkit-animation-name: spaceboots;

      -webkit-animation-duration: 0.8s;

      -webkit-transform-origin: 50% 50%;

      -webkit-animation-iteration-count: infinite;

      -webkit-animation-timing-function: linear;

    }
  </style>


  <!-- Favicons -->
  <link href="../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
  <link href="../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon">


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

</head>

<body id="bg">
  <!-- ======= Header ======= -->

  <!-- End Header -->
  <main style="background-image: url('images/Instruction.png');background-repeat:no-repeat; background-position: center 200px; height: 800px;">
    <div class="container py-5 font"><br><br><br><br><br><br><br><br><br><br><br>
      <b>
        <p class="text-center mb-2">This is just a simple quiz game to test your knowledge!</p>
      </b>
      <ul class="list-unstyled">
        <li><strong>Number of questions: </strong><?php echo $total; ?></li>
        <li><strong>Type: </strong>Multiple Choice</li>
        <li><strong>Estimated time for each question: </strong><?php echo $total * 1 * 60; ?> seconds</li>
        <li><strong>Score: </strong> &nbsp; +1 point for each correct answer</li>
      </ul>
      <div class="text-center mt-4">
        <a href="question.php?category=<?php echo $category; ?>" class="btn" onclick="playGames(this)" data-level="<?= $category;  ?>"><img id="shake" src="images/start1.png" height="55px"></a>
        <a href="../home/home.php" class="btn"><img src="images/exit1.png" height="50px"></a>
      </div>
    </div>
  </main>
</body>

</html>
<?php unset($_SESSION['score']); ?>
<script>
  const playGames = (obj) => {
    let category = obj.getAttribute("data-level");

    let url = "question.php?category=" + category;
    // console.log(url);
    // console.log(url);
    window.location.href = url;
  }
</script>