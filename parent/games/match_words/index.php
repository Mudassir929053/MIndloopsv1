<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Match Picture-Word</title>

  <!-- Favicons -->
  <link href="../../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
  <link href="../../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link href="../../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/glightbox/css/gallery/glightbox.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/swiper/gallery/swiper-bundle.min.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">
  <link href="../../assets/css/package.css" rel="stylesheet">

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/p5.min.js"></script> -->
  <!-- <script src="main.js"></script> -->
  <!-- <link rel="stylesheet" href="style1.css"> -->
  <style>
    .bg {
      background-image: url(../../../assets/games/match_words/images/bg1.png);
      background-size: 100% 100%;
      background-repeat: no-repeat;
      background-attachment: fixed;
      /* line-height: 0.5; */
      height: 100vh;
      margin: 0;
      padding: 0;
    }

    .flex-container {
      display: flex;
      justify-content: space-between;
    }

    #img1 {
      width: 100%;
      height: 50%;
    }
  </style>
</head>

<body class="">
  <div class="container-fluid bg d-flex justify-content-center">
    <div class="row  ">
      <div class="flex-container p-5">
        <div class="class">
          <a href="../index.php"> <img id="img1" src="../../../assets/games/match_words/images/backbtn.png" alt="..."> </a>
        </div>
        <div class="class">
          <a class="thumbnail" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img id="img1" src="../../../assets/games/match_words/images/questionbtn.png" class="img-fluid rounded" alt="..."> </a>
        </div>
      </div>
      <div class="col-md-12 text-center">
        <a href="" target="">
          <img src="../../../assets/games/match_words/images/matchlogo.png" alt="" class="img-fluid" style="max-height: 200px;">
        </a>
      </div>
      <div class="col-md-12 p-5 text-center sticky-center"> <a href="level.php" target=""> <img src="../../../assets/games/match_words/images/playbtn.png" style="max-height: 200px;" class="img-fluid" alt=""> </a> </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="container border border-5  p-5">
            <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">How to Play</h1>
            <h2 class="mb-4 fw-bold">Instructions</h2>
            <ul class="list-unstyled">
              <li class="mb-3">
                <span class="fw-bold me-2">1. </span>Start by clicking on a play button.

              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">2. </span>Then select the level you need to play.

              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">3. </span>Select the category according to your interest.

              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">4. </span>Drag the images and drop into the word which they are matching.

              </li>
              <li>
                <span class="fw-bold me-2">5. </span>Once you completed the Game , you can play again or Quit the game.

              </li>
            </ul>
            <button type="button" class="btn btn-primary " data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--END Modal -->
  <!-- Button trigger modal -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>