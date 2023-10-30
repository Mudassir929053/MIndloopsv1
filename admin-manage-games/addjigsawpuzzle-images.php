<?php
// require('../../commonPHP/head.php');
include 'all-game-function.php';
require('../commonPHP/adminNavBar.php');
?>
<!DOCTYPE html>
<html><head>
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
            <input type="hidden" value="<?= $_GET['id'] ?>" name="js_id">
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" accept="image/*" name="image">
                <!-- <label class="custom-file-label" for="image">Choose file</label> -->
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="text" class="bold">Image Name:</label>
            <input type="text" class="form-control" id="text" name="ji_name" placeholder="Enter image description">
          </div>
          <input type="submit" name="upload" value="Submit" class="btn btn-primary">
        </form>
        <button id="closeButton">&times;</button>
      </div>
    </div>
    <div class="container p-3 mb-5 rounded-lg ">
      <h1 class="text-center mb-4 text-dark">Jigsaw Puzzle Images</h1>
      <p class="page-description text-center mb-4">Fluid Layout With Overlay Effect</p>
      <a href="addjigsawcategory-images.php"><button class="btn btn-warning p-3">Go Back</button></a>
      <button id="myButton">Add Image</button>
      <div class="tz-gallery">
        <div class="row">
          <?php
          $ji_js_id = $_GET['id'];
          $querycn = $conn->query("SELECT * FROM jigsaw_image WHERE ji_js_id = '$ji_js_id';");
          if (mysqli_num_rows($querycn) > 0) {
            while ($rows = mysqli_fetch_object($querycn)) {
          ?> <div class="col-md-3 col-sm-6">
                <div class="m-2 shadow-lg p-2">
                  <div class="lightbo">
                    <img src="../assets/jigsawimages/<?php echo $rows->ji_image; ?>" width="800" height="250">
                  </div>
                  <div class="d-flex justify-content-between mt-2">
                    <h6 class="text-uppercase fw-bold text-primary"><?php echo $rows->ji_name; ?></h6>
                    <form method="POST" action="">
                      <input type="hidden" name="ji_id" value="<?php echo $rows->ji_id ?>">
                      <input type="hidden" name="ji_js_id" value="<?php echo $rows->ji_js_id ?>">
                      <button class="btn btn-danger" name="delete_jigsawimage" value="<?php echo $rows->ji_id; ?>" onclick="return confirm('Are you sure you want to delete this image?')"><i class="fa-solid fa-trash"></i></button>

                      <button class="btn btn-success" type="button" name="update" value="<?php echo $rows->ji_id; ?>" onclick="openPopup('<?php echo $rows->ji_id; ?>','<?php echo $rows->ji_js_id; ?>','<?php echo $rows->ji_image; ?>','<?php echo $rows->ji_name; ?>')"><i class="fa-solid fa-edit"></i></button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="popupl" id="popupl">
                <div class="popupl-content col-lg-5">
                  <h2 class="text-center mb-4">Update Image</h2>
                  <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="image" class="bold">Question Image:</label>
                      <div class="input-group mb-3">
                        <div class="custom-file">
                          <img src="" id="pop_img" style="max-height: 150px;" />
                          <input type="file" class="custom-file-input" value="<?php echo $rows->ji_image ?>" id="image" accept="image/*" name="image">
                          <input type="hidden" id="ji_id" name="ji_id" value="<?php echo $rows->ji_id ?>">
                          <input type="hidden" id="ji_js_id" name="ji_js_id" value="<?php echo $rows->ji_js_id ?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="bold">Image Name:</label>
                      <input type="text" class="form-control" id="jigsaw_name" name="ji_name" value="<?php echo $rows->ji_name ?>" placeholder="Enter image description">
                    </div>
                    <!-- <input type="text" id="ji_id" name="ji_id" value="<?php echo $rows->ji_id ?>"> --> <input type="submit" name="update" value="Submit" class="btn btn-primary">
                  </form>
                  <span class="popupl-close text-dark" onclick="closePopup()">X</span>
                </div>
              </div> <?php
                    }
                  }
                      ?>
          <!-- <button onclick="openPopup()">Open Popup</button> -->
        </div>
      </div>
  </main>
  <?php include("../commonPHP/footer.php"); ?><a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php include("../commonPHP/jsFiles.php"); ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
  function showDeleteAlert() {
    // Show the alert message
    alert("Are you sure you want to delete this image?");
  }
</script>
<script>
  baguetteBox.run('.tz-gallery');
</script>
<script>
  var popup = document.querySelector('.popup');
  var closeButton = document.querySelector('#closeButton');
  var myButton = document.querySelector('#myButton');
  myButton.addEventListener('click', function() {
    popup.style.display = 'block';
  });
  closeButton.addEventListener('click', function() {
    popup.style.display = 'none';
  });  function openPopup(x, y, img, name) {
    // Set the value of the hidden input field to the ji_id value
    document.getElementById("ji_id").value = x;
    document.getElementById("ji_js_id").value = y;
    document.getElementById("pop_img").src = '../assets/jigsawimages/' + img;
    document.getElementById("jigsaw_name").src = img;
    document.getElementById("jigsaw_name").value = name;
    // Display the popup window
    document.getElementById("popupl").style.display = "block";
  }  function closePopup() {
    // Hide the popup window
    document.getElementById("popupl").style.display = "none";
  }
</script>
</html>