<!doctype html>
<html lang="en">

<head>
  <title>Word Search</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
  <link href="style.css" rel="stylesheet">

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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/p5.min.js"></script>
  <script src="code.js"></script>

</head>

<body class="bg">
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div id="welcome">
      <h3>Welcome To</h3>
      <a href="../../index/index.php"><img src="../../assets/img/MindLOOPS_Resouces/Asset_10.png" alt="MindLoops"
          height="80px" width="380px"></a>
    </div>
    <div class="container d-flex align-items-center" id="navDiv">

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li class="dropdown"><a href="../../index.php"><span>Home</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="../../index/index.php#gallery">Magazine</a></li>
            </ul>
          <li class="dropdown"><a href="#"><span>Mind Booster</span> <i class="bi bi-chevron-down"></i></a>
          <li><a href="../../loops/view-loops.php">Loops</a></li>
          <li><a href="../../tips/view-tips.php">Tips</a></li>
          <li><a href="../../videos/view-videos.php">Videos</a></li>
          <li class="dropdown"><a href=""><span>Games
              </span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <!-- <li><a href="#">Puzzels</a></li> -->
              <li><a href="../home/home.php">Quizes</a></li>
              <li><a href="home.php">Puzzle</a></li>
            </ul>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <div class="header-social-links d-flex">
        <a id="loginLink" href="../../login_and_register/logout.php">Logout <i class="bi bi-box-arrow-in-left"></i></a>
        <a href="#" id="navToggle"><i class="bi bi-list"></i></a>
      </div>

    </div>
  </header><!-- End Header -->

  <div class="mt-5">&nbsp</div>
  <div class="mt-5">&nbsp</div>
  <br>
  <h1>Word Search Game</h1>
    
  <div id="level-selection">
  <h2>Select level:</h2>
  <button id="easy-btn" onclick="window.location.href='category.php?level=easy'">Easy</button>
  <button id="medium-btn" onclick="window.location.href='category.php?level=medium'">Medium</button>
  <button id="hard-btn" onclick="window.location.href='category.php?level=hard'">Hard</button>
</div>


    
  </body>

</html>