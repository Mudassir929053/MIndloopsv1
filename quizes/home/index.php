<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QUIZ</title>
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
  <style>
    html {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
    }

    body {

      background-image: url('images/1.png');
      background-size: 100% 100%;
      width: 100%;
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-position: center center;

    }





    .hover01 img {
      -webkit-transform: scale(1);
      transform: scale(1);
      -webkit-transition: .3s ease-in-out;
      transition: .3s ease-in-out;
    }

    .hover01:hover img {
      -webkit-transform: scale(1.3);
      transform: scale(1.3);
    }

    .swing {
      animation: swing ease-in-out 1s infinite alternate;
      transform-origin: center -20px;
      float: left;
      /* box-shadow: 5px 5px 10px rgba(0,0,0,0.5); */
    }

    .swing:after {
      content: '';
      position: absolute;
      width: 20px;
      height: 20px;
      /* border: 1px solid #999; */
      top: -10px;
      left: 50%;
      z-index: 0;
      border-bottom: none;
      border-right: none;
      transform: rotate(45deg);
    }

    /* nail */
    .swing:before {
      content: '';
      position: absolute;
      width: 5px;
      height: 5px;
      top: -14px;
      left: 54%;
      z-index: 5;
      border-radius: 50% 50%;
      /* background: #000; */
    }

    @keyframes swing {
      0% {
        transform: rotate(20deg);
      }

      100% {
        transform: rotate(-20deg);
      }
    }

    .rains {
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 100%;
      overflow: hidden;
      /* height:180%; */
    }

    .rains span {
      position: absolute;
      width: 4.5px;
      height: 100px;
      background: #FFF;
      opacity: 0.4;
    }




    .rains span:nth-child(1) {
      left: 5%;
      top: -190px;
      bottom: 15%;
      animation: rain-anim 10s infinite;
    }

    .rains span:nth-child(2) {
      left: 10%;
      top: -180px;
      bottom: 15%;
      animation: rain-anim 11s infinite;
    }

    .rains span:nth-child(3) {
      left: 15%;
      top: -170px;
      bottom: 15%;
      animation: rain-anim 8s infinite;
    }

    .rains span:nth-child(4) {
      left: 20%;
      top: -160px;
      bottom: 15%;
      animation: rain-anim 12s infinite;
    }

    .rains span:nth-child(5) {
      left: 25%;
      top: -150px;
      bottom: 15%;
      animation: rain-anim 10s infinite;
    }

    .rains span:nth-child(6) {
      left: 30%;
      top: -150px;
      bottom: 15%;
      animation: rain-anim 11s infinite;
    }

    .rains span:nth-child(7) {
      left: 35%;
      top: -160px;
      bottom: 15%;
      animation: rain-anim 13s infinite;
    }

    .rains span:nth-child(8) {
      left: 40%;
      top: -170px;
      bottom: 15%;
      animation: rain-anim 7s infinite;
    }

    .rains span:nth-child(9) {
      left: 45%;
      top: -180px;
      bottom: 15%;
      animation: rain-anim 9s infinite;
    }

    .rains span:nth-child(10) {
      left: 50%;
      top: -190px;
      bottom: 15%;
      animation: rain-anim 11s infinite;
    }

    .rains span:nth-child(11) {
      left: 55%;
      top: -190px;
      bottom: 15%;
      animation: rain-anim 10s infinite;
    }

    .rains span:nth-child(12) {
      left: 60%;
      top: -180px;
      bottom: 15%;
      animation: rain-anim 6s infinite;
    }

    .rains span:nth-child(13) {
      left: 65%;
      top: -170px;
      bottom: 15%;
      animation: rain-anim 14s infinite;
    }

    .rains span:nth-child(14) {
      left: 70%;
      top: -160px;
      bottom: 15%;
      animation: rain-anim 12s infinite;
    }

    .rains span:nth-child(15) {
      left: 75%;
      top: -150px;
      bottom: 15%;
      animation: rain-anim 10s infinite;
    }

    .rains span:nth-child(16) {
      left: 80%;
      top: -150px;
      bottom: 15%;
      animation: rain-anim 14s infinite;
    }

    .rains span:nth-child(17) {
      left: 85%;
      top: -160px;
      bottom: 15%;
      animation: rain-anim 8s infinite;
    }

    .rains span:nth-child(18) {
      left: 90%;
      top: -170px;
      bottom: 15%;
      animation: rain-anim 9s infinite;
    }

    .rains span:nth-child(19) {
      left: 95%;
      top: -180px;
      bottom: 15%;
      animation: rain-anim 11s infinite;
    }

    .rains span:nth-child(20) {
      left: 100%;
      top: -190px;
      bottom: 15%;
      animation: rain-anim9 13s infinite;
    }




    @keyframes rain-anim {

      0% {
        transform: translate(0px, 0px);
      }

      4% {
        transform: translate(0px, 600px);
      }

      5% {
        transform: translate(200px, 0px);
      }

      9% {
        transform: translate(200px, 600px);
      }

      10% {
        transform: translate(-100px, 0px);
      }

      14% {
        transform: translate(-100px, 600px);
      }

      15% {
        transform: translate(-200px, 0px);
      }

      19% {
        transform: translate(-200px, 600px);
      }

      20% {
        transform: translate(100px, 0px);
      }

      24% {
        transform: translate(100px, 600px);
      }

      25% {
        transform: translate(-150px, 0px);
      }

      29% {
        transform: translate(-150px, 600px);
      }

      30% {
        transform: translate(-80px, 0px);
      }

      34% {
        transform: translate(-80px, 600px);
      }

      35% {
        transform: translate(150px, 0px);
      }

      39% {
        transform: translate(150px, 600px);
      }

      40% {
        transform: translate(-60px, 0px);
      }

      44% {
        transform: translate(-60px, 600px);
      }

      45% {
        transform: translate(90px, 0px);
      }

      49% {
        transform: translate(90px, 600px);
      }

      50% {
        transform: translate(60px, 0px);
      }

      54% {
        transform: translate(60px, 600px);
      }

      55% {
        transform: translate(-60px, 0px);
      }

      59% {
        transform: translate(-60px, 600px);
      }

      60% {
        transform: translate(-40px, 0px);
      }

      64% {
        transform: translate(-40px, 600px);
      }

      65% {
        transform: translate(40px, 0px);
      }

      69% {
        transform: translate(40px, 600px);
      }

      70% {
        transform: translate(-20px, 0px);
      }

      74% {
        transform: translate(-20px, 600px);
      }

      75% {
        transform: translate(-110px, 0px);
      }

      79% {
        transform: translate(-110px, 600px);
      }

      80% {
        transform: translate(20px, 0px);
      }

      84% {
        transform: translate(20px, 600px);
      }

      85% {
        transform: translate(-20px, 0px);
      }

      89% {
        transform: translate(-20px, 600px);
      }

      90% {
        transform: translate(50px, 0px);
      }

      99% {
        transform: translate(50px, 600px);
      }

      100% {
        transform: translate(0px, 0px);
      }

    }
  </style>
</head>

<body>
  <!-- ======= Header ======= -->
  <!-- End Header -->
  <div class="rains">

    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>

    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>

    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>

    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>


    <div class="container-fluid">
    <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-6 d-flex justify-content-start">
                    <a class="thumbnail" href="../../loops/view-loops.php">
                        <img src="../../assets/games/wordsearch/Asset61.png" class="img-fluid rounded" alt="..."> </a>
                </div>
            </div>
        </div>
      <h1><img src="images/SelectLevel.png" alt="" style="width:65%; height:65%;display: block; margin-left: auto; margin-right: auto;"></h1>
      <div class="row">
        <div class="col-md-4">
          <div class="thumbnail">
            <div class="hover01">

              <a href="../quiz1/category.php" target="">
                <figure class="swing">
                  <img src="images/Level_1.png" alt="" style="width:100%; height:100%">

              </a></figure>
            </div>
          </div>
        </div>
        <div class="col-md-4 pt-5">
          <div class="thumbnail">
            <div class="hover01">
              <a href="../quiz2/match.php" target="">
                <figure class="swing">
                  <img src="images/Level_2.png" alt="" style="width:88%; height:100%">

              </a></figure>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="thumbnail">
            <div class="hover01">
              <a href="../quiz3/index.html" target="">
                <figure class="swing">
                  <img src="images/Level_3.png" alt="" style="width:82%; height:80%">

              </a></figure>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>