<?php
// require('../../commonPHP/head.php');
include 'all-game-function.php';
require('../commonPHP/adminNavBar.php');
?><!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/8c651dbec7.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="stylepuzzleopen.css">
</head><body>
  <main>
    <div class="popup">
      <div class="popup-content">
        <h2 class="text-center mb-4">Add an Image</h2>
        <form method="post" action="" enctype="multipart/form-data">
          <div class="form-group">
            <label for="image" class="bold">Question Image:</label>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" accept="image/*" name="image">
                <!-- <label class="custom-file-label" for="image">Choose file</label> -->
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="text" class="bold">Image Name:</label>
            <input type="text" class="form-control" id="text" name="js_name" placeholder="Enter image description">
          </div>
          <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
        <button id="closeButton">&times;</button>
      </div>
    </div>    
    <div class="container   rounded-lg ">
      <h1 class="text-center mb-4 text-dark">Jigsaw Puzzle Images</h1>      <!-- <p class="page-description text-center mb-4">Fluid Layout With Overlay Effect</p> -->
      <button id="myButton">Add Image</button>
      <div class="tz-gallery">        <div class="row">
          <?php
          $querycn = $conn->query("SELECT * FROM jigsawimage;");          
          if (mysqli_num_rows($querycn) > 0) {
            while ($rows = mysqli_fetch_object($querycn)) {
          ?>              <div class="col-md-3 col-sm-6">
                <div class="m-2 shadow-lg p-2">
                  <div class="lightbo">
                    <a href="addjigsawpuzzle-images.php?id=<?php echo $rows->js_id ?>">
                      <img src="../assets/jigsawimages/<?php echo $rows->js_image; ?>" width="800" height="250">
                    </a>
                  </div>
                  <div class="d-flex justify-content-between mt-2">
                    <h6 class="text-uppercase fw-bold text-primary"><?php echo $rows->js_name; ?></h6>
                    <form method="POST" action="">
                      <button class="btn btn-danger" name="delete_image" value="<?php echo $rows->js_id; ?>" onclick="return confirm('Are you sure you want to delete this image?')"><i class="fa-solid fa-trash"></i></i></button>
                    </form>
                  </div>
                </div>
              </div>
             
          <?php
            }
          }
          ?>        
          </div>      
        </div>
    </div>
  </main>
  <?php include("../commonPHP/footer.php"); ?>  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>  <?php include("../commonPHP/jsFiles.php"); ?></body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
  baguetteBox.run('.tz-gallery');
</script>
<script>
  var popup = document.querySelector('.popup');
  var closeButton = document.querySelector('#closeButton');
  var myButton = document.querySelector('#myButton');  myButton.addEventListener('click', function() {
    popup.style.display = 'block';
  });  closeButton.addEventListener('click', function() {
    popup.style.display = 'none';
  });
</script>
</html>