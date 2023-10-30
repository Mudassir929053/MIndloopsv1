<?php
include '../../dbconnect.php';
extract($_GET);
// echo $category;
// exit;
?>

<?php
session_start();
$nahi = $_SESSION['question'];
// var_dump($nahi);
// exit;

// echo "<pre>";
// print_r($nahi);
// echo "</pre>";

?>
<?php
$total = "SELECT * FROM questions WHERE category=$category";


$run = mysqli_query($conn, $total) or die(mysqli_error($conn));
$totalqn = mysqli_num_rows($run);
$time = time();
$_SESSION['start_time'] = $time;
$allowed_time = count($_SESSION['question']) * 5;
$_SESSION['time_up'] = $_SESSION['start_time'] + ($allowed_time * 60);

?>
<html>

<head>
  <title>Quiz</title>

  <style>
    body {
      background-image: url('images/2.png');
      font-family: "Poppins", "Arial", "Helvetica Neue", sans-serif;

    }

    main {

      /* margin-top: 14%; */
      text-align: center;
    }

    input[type="radio"] {
      display: none;



    }

    input[type="radio"]:checked+label {
      position: relative;
      color: #EC2848;
    }

    input[type="radio"]:checked+label::before {
      content: "";
      display: inline-block;
      width: 20px;
      height: 20px;
      background-color: #EC2848;
      border-radius: 50%;
      margin-right: 10px;
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      box-shadow: 0 0 10px #EC2848;
      animation: radio-pulse 0.5s ease-in-out infinite;
    }

    @keyframes radio-pulse {
      0% {
        box-shadow: 0 0 0 0 #EC2848;
      }

      70% {
        box-shadow: 0 0 0 20px rgba(250, 162, 26, 0);
      }

      100% {
        box-shadow: 0 0 0 0 #EC2848;
      }
    }

    label:active {
      color: #333;
    }

    label:active::before {
      animation: none;
      box-shadow: 0 0 10px #333;
    }


    p {
      font-size: 1.5em;
    }

    .form-check-label {
      display: inline-block;
      font-size: 1.5em;
      /* increase font size */
      color: black;
      /* change color to blue */
      text-align: inherit;
      width: 80%;
      background-image: url('images/bg.png');
      background-repeat: no-repeat;
      background-size: 100% 125%;
      padding: 25px;
      /* padding-top: 15px;
      padding-bottom: 15px; */
    }

    /* css example */
    #sp1 {
      content: "\00BB";
      font-size: 1.5em;
      padding: 5px;
      color: black;

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

<body>
  <!-- ======= Header ======= -->
  <!-- End Header -->
  <div class="mt-5">&nbsp</div>
  <div class="mt-5">&nbsp</div>
  <br>
  <main>
    <?php
    if (count($_SESSION['allquestions']) > 0) {
      $n = $_SESSION['allquestions'][0];
      array_push($_SESSION['attemptedq'], $n);

      $q = "Select * from questions where qno=$n ";
      $q1 = mysqli_query($conn, $q);
      $row = mysqli_fetch_array($q1);
      array_shift($_SESSION['allquestions']);
      $question = $row['question'];
      $ans1 = $row['ans1'];
      $ans2 = $row['ans2'];
      $ans3 = $row['ans3'];
      $ans4 = $row['ans4'];
    ?>


      <div class="container">
        <div class="border-secondary mb-3">
          <div class="card-header text-center" style=" background-color:#FAA21A; border-radius:10px; width:fit-content;margin-left:22px; color:aliceblue;font-weight:bold;">QUESTION <?php echo count($_SESSION['attemptedq']); ?> OF <?php echo count($_SESSION['question']); ?></div>
          <div class="card-body" style="background-image: url('images/border_question.png'); background-repeat: no-repeat; background-size: 100% 40%;  padding: 25px;"><br><br>
            <p class="card-text"><?php echo count($_SESSION['attemptedq']); ?>)&nbsp;&nbsp;<?php echo $question; ?></p><br><br><br><br>
            <form method="post" action="process.php?category=<?= $category ?>">
              <div class="form-group">
                <div class="container">

                  <div class="row">
                    <div class="col">
                      <div class="form-check">
                        <input class="form-check-input" id="a" name="choice" type="radio" value="a" required>
                        <label class="form-check-label" for="a">
                          <?php echo $ans1; ?></label>
                      </div>
                    </div><br><br><br><br>
                    <div class="col">
                      <div class="form-check">
                        <input class="form-check-input" id="b" name="choice" type="radio" value="b" required>
                        <label class="form-check-label" for="b"><?php echo $ans2; ?></label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-check">
                        <input class="form-check-input" id="c" name="choice" type="radio" value="c" required>
                        <label class="form-check-label" for="c"><?php echo $ans3; ?></label>
                      </div>
                    </div>
                    
                      <div class="col">
                      <?php if ($ans4 != '') : ?>
                        <div class="form-check">
                          <input class="form-check-input" id="d" name="choice" type="radio" value="d" required>
                          <label class="form-check-label" for="d"><?php echo $ans4; ?></label>
                        </div>
                        <?php endif; ?>
                      </div>
                    
                  </div>
                  <!-- <input type="submit" class="btn btn-primary" value="Submit"> -->
                  <input type="submit" id="shake" class="btn" value="" style="background-image:url('images/next.png');background-size:100% 130%; height: 50px;width: 150px;margin-top: 20px;">
                  <input type="hidden" name="number" value="<?php echo $n; ?>">
                  <!-- <a href="index.php" class="btn btn-secondary">Stop Quiz</a> -->
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>
    <?php } ?>
  </main>

</body>

</html>