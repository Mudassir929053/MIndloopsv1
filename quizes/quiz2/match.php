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

  <script src="code.js"></script>
  <!-- Template Main CSS File -->
  <!-- <link href="../../assets/css/style.css" rel="stylesheet"> -->
  <!-- <link href="../../assets/css/package.css" rel="stylesheet"> -->
  <style>
    .body {
      background-image: url("images/5.png");
      /* background-size: 14.14px 14.14px; */
      background-size: 100% 100%;
      background-repeat: no-repeat;
      /* margin-top: 16%; */

      background-attachment: fixed;
    }

    .linkingQuestion {
      display: flex;
      font-size: 20px;
      /* font-family : 'Century Gothic,CenturyGothic,AppleGothic,sans-serif'; */
      position: relative;
      justify-content: center;
      /* position: fixed; */

    }

    .dragElement {
      z-index: 2;
      display: inline;
      cursor: grab;
    }

    .dropElement {
      cursor: pointer;
    }

    ul {
      list-style: none;
    }

    ul li {
      margin-bottom: 5px;
    }

    canvas {
      z-index: -1;
      position: absolute;
      width: 100%;
      height: 100%;
    }

    .canvasWrapper {
      z-index: -1;
      position: relative;
      width: 200px;
      margin: 20px -9px
    }

    #dropUL {
      padding-left: 0px;
      color: #F49E19;

    }

    #dragUL {
      /* padding-left:0px; */
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

  
    #score {
      background-image: url('images/bg.png');
      background-size: 100% 130%;
      height: 45px;
      width: 100% 100%;
      margin-top: 18px 20px;
      background-repeat: no-repeat;

    }

    #heading {
      /* display: block; */
      /* margin-left: 3%;
      margin-right: auto; */
      width: 70%;
      /* margin-top: -6%; */
      /* padding-bottom: 20px;    */
      padding: 15px;
      transform: translate(-0%, -5%);
      text-align: right;
    }

    li>img {
      width: 80%
    }

    i.fa-circle {
      display: block;
      font-size: 2vw;
    }

    @media (max-width: 600px) {
      i.fa-circle {
        font-size: 4vw;
      }
    }


    .btn,
    h1 {
      display: inline-block;
      align-items: center;

    }

    #score {
      color: black;
    }
    #loading{
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, .8);
      z-index: 100000;
    }
    #loading {
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 2rem;
    }
  </style>


</head>

<body class="greenTheme q-c-dark-secondary body">
  <div id="loading" class="text-center">
    <span>Loading...</span>
  </div>
  <div class="container-fluid">
  <div class="row justify-content-start align-items-center">
    <div class="col-lg-2 col-md-4 col-sm-6 mb-md-0">
      <a class="thumbnail" href="../../loops/view-loops.php">
        <img src="../../assets/games/wordsearch/Asset61.png" class="img-fluid rounded" alt="...">
      </a>
    </div>
     <div id="heading" class="text-center">
      <img src="images/match_heading.png" class="img-fluid">
      <h1 class="text-center">
        <div id="score" class="badge">Score: 0</div>
      </h1>
    </div>
  </div>
</div>

  <div class="container">
    <div id="dragQuestion" class="linkingQuestion mt-5">
      <ul id="dragUL">
        <li><img id="ind" src="images/india.png" height="70px">
          <div id="1-draggable" class="dragElement" draggable="true"><i class="far fa-circle "></i></div>
        </li>
        <li><img src="images/Malaysia.png" height="70px">
          <div id="2-draggable" class="dragElement" draggable="true"><i class="far fa-circle "></i></div>
        </li>
        <li><img src="images/Bangladesh.png" height="70px">
          <div id="3-draggable" class="dragElement" draggable="true"><i class="far fa-circle "></i></div>
        </li>
        <li><img src="images/Pakistan.png" height="70px">
          <div id="4-draggable" class="dragElement" draggable="true"><i class="far fa-circle "></i></div>
        </li>
        <li><img src="images/Nepal.png" height="70px">
          <div id="5-draggable" class="dragElement" draggable="true"><i class="far fa-circle "></i></div>
        </li>
      </ul>
      <div class="canvasWrapper">
        <canvas id="canvas"></canvas>
        <canvas id="canvasTemp"></canvas>
      </div>
      <ul id="dropUL">
        <li>
          <div id="2-dropzone" onclick="clearPath(event)" class="dragElement dropElement"> <i class="far fa-circle"></i> </div><img src="images/kathmandu.png" height="70px">
        </li>
        <li>
          <div id="4-dropzone" onclick="clearPath(event)" class="dragElement dropElement"> <i class="far fa-circle "></i> </div><img src="images/islamabad.png" height="70px">
        </li>
        <li>
          <div id="5-dropzone" onclick="clearPath(event)" class="dragElement dropElement"> <i class="far fa-circle"></i> </div><img src="images/kuala.png" height="70px">
        </li>
        <li>
          <div id="7-dropzone" onclick="clearPath(event)" class="dragElement dropElement"> <i class="far fa-circle "></i> </div><img src="images/delhi.png" height="70px">
        </li>
        <li>
          <div id="11-dropzone" onclick="clearPath(event)" class="dragElement dropElement"> <i class="far fa-circle "></i> </div><img src="images/dhaka.png" height="70px">
        </li>

      </ul>
    </div>

    <div id="container">
      <button class="btn" id="btn1" onClick="Correction()"><img src="images/submit.png" height="50px"></button>

      <!-- <a class="btn" href="match.php" style="margin-top: 10px;"><img src="reset.png" height="60px"></a> -->
    </div>
  </div>
 
<script>
  $(document).ready(function(){
    $("#loading").hide();
  })
</script>
</body>

</html>