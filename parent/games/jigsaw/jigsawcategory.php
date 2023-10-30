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
  <link href="../../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
  <link href="../../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon"> <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> --> <!-- Vendor CSS Files -->
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tween.js/18.6.4/tween.umd.js"></script> <!-- Template Main CSS File -->
  <link href="../../../assets/css/style.css" rel="stylesheet">
  <link href="../../../assets/css/package.css" rel="stylesheet">
  <link href="jigsawcategory.css" rel="stylesheet">
<style>
  .body {
  background-image: url("../../../assets/jigsaw_UI/Asset19.png");
  background-size: 100% 100%;
  background-repeat: no-repeat;
  background-attachment: fixed;
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
      <a href="./" class="">
        <img src="../../../assets/jigsaw_UI/arrow.png">
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
      
      $querycn = "SELECT * FROM jigsawimage";
      $result = mysqli_query($conn, $querycn);
      
      if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
      ?>
        <div class="col-md-3 col-sm-6">
          <div class="">
            <div class="lightbo mb-5 px-3">
              <a href="jigsawpuzzle-images.php?id=<?php echo $rows['js_id']; ?>">
                <img src="../../../assets/jigsawimages/<?php echo $rows['js_image']; ?>" width="800" height="250">
              </a>
            </div>
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