<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Match Picture-Word</title>

  <!-- Favicons -->
  <link href="../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
  <link href="../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/gallery/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/gallery/swiper-bundle.min.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/package.css" rel="stylesheet">

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/p5.min.js"></script> -->
  <!-- <script src="main.js"></script> -->


  <!-- <link rel="stylesheet" href="style1.css"> -->
  <style>
    body {
      background-image: url(../assets/games/match_words/images/bg1.png);
      background-size: 100% 100%;
      background-repeat: no-repeat;
      background-attachment: fixed;
      /* line-height: 0.5; */
      padding: 0;
    }

    .level-btn:hover {
      transform: scale(1.1);
      transition: all 0.3s ease-in-out;
    }

    .levels {
      display: flex;
      justify-content: space-between;
      margin-top: 15%;
    }

    a>img {
      width: 7%;
    }
  </style>
</head>

<body class="bg">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <img src="../assets/games/match_words/images/select_level.png" alt="..." class="img-fluid mx-auto d-block" style="border-bottom-left-radius: 50px;border-bottom-right-radius: 50px;">
      </div>
      <div class="col-md-6">
        <a href="main.php">
          <img src="../assets/games/match_words/images/backbtn.png" alt="..." class="img-fluid float-left" style="position: absolute; top: 10px; left: 25px;">
        </a>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <div class="levels">
          <button class="btn level-btn" data-level="easy"><img src="../assets/games/match_words/images/easy.png" alt="..." class="img-fluid mx-auto d-block"></button>
          <button class="btn level-btn" data-level="medium"><img src="../assets/games/match_words/images/medium.png" alt="..." class="img-fluid mx-auto d-block"></button>
          <button class="btn level-btn" data-level="hard"><img src="../assets/games/match_words/images/hard.png" alt="..." class="img-fluid mx-auto d-block"></button>
        </div>
      </div>
    </div>
  </div>
  <script>
    const easyBtn = document.querySelector('[data-level="easy"]');
    const mediumBtn = document.querySelector('[data-level="medium"]');
    const hardBtn = document.querySelector('[data-level="hard"]');

    easyBtn.addEventListener('click', () => {
      window.location.href = 'category.php?level=Easy';
    });

    mediumBtn.addEventListener('click', () => {
      window.location.href = 'category.php?level=Medium';
    });

    hardBtn.addEventListener('click', () => {
      window.location.href = 'category.php?level=Hard';
    });
  </script>
</body>

</html>