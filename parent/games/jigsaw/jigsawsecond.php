<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz 2</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="style.css"> -->
  <!-- <link rel="stylesheet" href="https://codepen.io/clementmartin17/pen/254651da9d3f8b04e103aad5645ca919.css"> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Favicons -->
  <link href="../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
  <link href="../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon"> <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> --> <!-- Vendor CSS Files -->
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tween.js/18.6.4/tween.umd.js"></script> <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">
  <link href="../../assets/css/package.css" rel="stylesheet">
  <style>
    .body {
      background-image: url("../../assets/Puzzle/Asset19.png");
      background-size: 100% 100%;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
    .linkingQuestion {
      display: flex;
      font-size: 20px;
      position: relative;
      justify-content: center;
    }
    #dragUL {
      color: #F49E19;
    }
    #dropUL i {
      pointer-events: none;
    }
    #dragUL li div {
      margin-left: 10px;
      float: right;
    }
    #dropUL li div {
      margin-right: 10px;
      float: left;
    }
    i {
      margin-top: 20px;
    }
    li {
      font-size: 30px;
      font-weight: bold;
    }
    #container {
      text-align: center;
    }
    #heading {
      display: block;
      margin-left: 8%;
      margin-right: auto;
      width: 100%;
      padding: 15px;
      transform: translate(-0%, -5%);
      text-align: right;
    }
    body {
      min-height: 100vh;
      font: normal 16px sans-serif;
      padding: 40px 0;
    }
    .container.gallery-container {
      background-color: #fff;
      color: #35373a;
      min-height: 100vh;
      padding: 30px 50px;
    }
    .gallery-container h1 {
      text-align: center;
      margin-top: 50px;
      font-family: 'Droid Sans', sans-serif;
      font-weight: bold;
    }
    .gallery-container p.page-description {
      text-align: center;
      margin: 25px auto;
      font-size: 18px;
      color: #999;
    }
    .tz-gallery {
      padding: 40px;
    }
    /* Override bootstrap column paddings */
    .tz-gallery .row>div {
      padding: 2px;
    }
    .tz-gallery .lightbo img {
      width: 100%;
      border-radius: 0;
      position: relative;
    }
    .tz-gallery .lightbox:before {
      position: absolute;
      top: 50%;
      left: 50%;
      margin-top: -13px;
      margin-left: -13px;
      opacity: 0;
      font-size: 26px;
      font-family: 'Glyphicons Halflings';
      content: '\e003';
      pointer-events: none;
      z-index: 9000;
      transition: 0.4s;
    }
    .tz-gallery .lightbox:after {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      background-color: rgba(46, 132, 206, 0.7);
      content: '';
      transition: 0.4s;
    }
    .baguetteBox-button {
      background-color: transparent !important;
    }
    @media(max-width: 768px) {
      body {
        padding: 0;
      }
    }
    .flex-contianer {
      display: flex;
      justify-content: space-between;
    }
  </style>
</head>
<body class="body">
  <!-- ======= Header ======= -->
  <!-- <div class="flex-container">
   <div class="left-btn">
     <img src="../../assets/Puzzle/Asset61.png" >
   </div>
<div class="right.btn">
  <img src="../../assets/Puzzle/Asset62.png" class="text-center">
</div>
  </div> -->
  <div class="flex-contianer p-5">
    <div class="left-btn">
      <a href="jigsawfirst.php" class="">
        <img src="../../assets/Puzzle/Asset61.png">
      </a>
    </div>
    <!-- <div class="right-btn">
      <img src="../../assets/Puzzle/Asset62.png">
    </div> -->
  </div>
  <div class="container check">
  <div class="tz-gallery">
    <div class="row d-flex justify-content-center">
      <?php
         $conn = mysqli_connect('localhost', 'root', '', 'db_mindloop');
         if (!$conn) {
           die("Connection failed: " . mysqli_connect_error());
         }
        $ji_js_id = $_GET['id'];
        $querycn = $conn->query("SELECT * FROM jigsaw_image WHERE ji_js_id = '$ji_js_id';");

        if (mysqli_num_rows($querycn) > 0) {
            while ($rows = mysqli_fetch_object($querycn)) {
        ?>

<div class="col-md-3 col-sm-6">
  <div class="m-2 shadow-lg p-2">
    <div class="lightbo">
      <a href="jigsaw.php?id=<?php echo $rows->ji_id; ?>">
      <img src="../../assets/jigsawimages/<?php echo $rows->ji_image; ?>" width="800" height="250">
      </a>
    </div>
    <div class="d-flex justify-content-between mt-2">
      <h6 class="text-uppercase fw-bold text-primary"><?php echo $rows->ji_name; ?></h6>
      
    </div>
  </div>
  <div class="popup" id="popup">
   
  </div>
</div>
      <?php
        }
      } else {
        echo "No images found.";
      }
      
        
      ?>
    </div>
  </div>
</div>
 </div>
  </div> <!-- Modal -->
</body>
</html>