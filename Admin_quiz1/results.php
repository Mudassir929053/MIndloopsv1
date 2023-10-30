<?php
session_start();
include '../../dbconnect.php';

// var_dump($_SESSION);
// exit;
if (!isset($_SESSION['score'])) {
  header("location: category.php");
}
$_SESSION['attemptedq'] = [];
// var_dump($_SESSION);
// exit;
?>
<html>

<head>
  <title>Quiz</title>
  <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="style3.css">
		<link rel="stylesheet" type="text/css" href="style1.css"> -->
  <style>
    body {

      font-family: "Poppins", "Arial", "Helvetica Neue", sans-serif;
    }

    #bg {
      background-image: url('images/2.png');
      /* margin-top: 8%; */
      background-size: cover;
      background-attachment: fixed;
      background-repeat: no-repeat;
      /* font-family: "Poppins", "Arial", "Helvetica Neue", sans-serif; */


    }

    main {
      /* position: center; */

      text-align: center;
      /* font-family: "Poppins", "Arial", "Helvetica Neue", sans-serif; */

    }

    .font {

      font-size: 20px;
    }
  </style>

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



</head>

<body id="bg">
  <!-- End Header -->
  <?php
  $score = $_SESSION['score'];

  // $query = "UPDATE users SET score = '$score' ";
  // $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
  ?>
  <main style="background-image: url('images/Instruction.png');background-repeat:no-repeat; background-position: center; height: 800px;">
    <div class="container py-5 font"><br><br><br><br><br><br><br><br><br><br>
      <h2>Congratulations!</h2>
      <p>You have successfully completed the test</p>
      <p>Total points: <?php if (isset($_SESSION['score'])) {
                          echo $_SESSION['score'];
                        }; ?> </p>
      <div class="text-center mt-4">
        <a href="category.php" class="btn"><img src="images/start1.png" height="55px"></a>
        <a href="../home/home.php" class="btn"><img src="images/exit1.png" height="50px"></a>
      </div>
    </div>
</body>

</html>




<?php unset($_SESSION['score']); ?>
<?php unset($_SESSION['time_up']); ?>
<?php unset($_SESSION['start_time']); ?>