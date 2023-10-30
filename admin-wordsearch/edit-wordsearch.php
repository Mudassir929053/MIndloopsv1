<?php
if (!session_id()) {
  session_start();

  if ($_SESSION["userType"] != '1') {
    header('location: ../../login_and_register/login.php');
  }
}

include("../../dbconnect.php");
include("function.php");
$sql = "SELECT * FROM tb_subjects";
$result = mysqli_query($conn, $sql);


?>
<?php include("../../commonPHP/adminNavBar.php"); ?>
<style>
  body {
    background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
    background-size: 110%;
    background-position: top center;
  }

  #magazine-hero {
    background-image: none;
    height: 150px;
  }

  #imgDiv {
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
  }

  #insertMbForm {
    width: 60%;
    margin-left: auto;
    margin-right: auto;
    padding: 15px;
    background-color: azure;
    border: solid 1px rgba(255, 255, 0, 0);
    border-radius: 30px;
  }

  #m_id {
    background-color: transparent;
    border: 0px;
    outline: none;
  }

  #m_id:focus {
    background-color: transparent;
    border: 0px;
    outline: none;
  }
</style>


<body>


  <main id="main">

    <div id="magazine-hero">
    </div>

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
      <br>
<br>
<br>
<br>
        <h2 style="text-align: center;">Create a Word Search</h2>

        <br>

        <div class="row gy-4">

          <a href="index.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

            <?php
            // Retrieve the record to update
            $id = $_GET['id']; // Assuming you have the ID of the record in the URL parameter
            $sql = $conn->query("SELECT * FROM tb_wordsearch WHERE wordsearch_id = '$id'");
            $row = $sql->fetch_assoc();

            // Populate the form fields with the retrieved values
            $theme = $row['wordsearch_category'];
            $level = $row['wordsearch_level'];
            $words = $row['wordsearch_words'];
            $image = $row['wordsearch_image'];

            ?>



            <form id="updateword" action="" method="POST" enctype='multipart/form-data'>
              <div class="form-group">
                <label for="level">Level</label>
                <select class="form-select" name="level" id="level" required>
                  <option <?php echo ($level == 'easy') ? 'selected' : ''; ?> value="easy">Easy</option>
                  <option <?php echo ($level == 'medium') ? 'selected' : ''; ?> value="medium">Medium</option>
                  <option <?php echo ($level == 'hard') ? 'selected' : ''; ?> value="hard">Hard</option>
                </select>
              </div>
              <br>
              <div class="form-group">
                <label for="theme">Theme</label>
                <input type="text" class="form-control" id="theme" name="theme" placeholder="Enter Theme" value="<?php echo $theme; ?>" required>
              </div>
              <br>
              <div class="form-group">
                <label for="words">Words</label>
                <textarea class="form-control" id="words" name="words" placeholder="Enter the Words" maxlength="1000" required><?php echo $words; ?></textarea>
              </div>
              <br>
              <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="updateimage" name="updateimage" onchange="previewImage();">
                <br>
                <p>New Image</p>

                <img id="preview" src="" alt="" style="max-width: 200px; display: none;">
              </div>

              <div class="form-group">
                <label for="image_preview">Current Image:</label><br>
                <?php if ($image) { ?>
                  <img src="../../assets/games/wordsearch/upload/<?php echo $image; ?>" id="image_preview" style="max-width: 200px; max-height: 200px;">
                <?php } else { ?>
                  <p>No image found.</p>
                <?php } ?>
              </div>


              <br>
              <br>
              <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Include the ID of the record as a hidden field -->
                <button type="submit" id="updateword" name="updateword" class="btn btn-warning">Update Words</button>
              </div>
            </form>

          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include("../../commonPHP/footer_admin.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include("../../commonPHP/jsFiles.php"); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    function previewImage() {
      // Get the file input element
      var input = document.getElementById('updateimage');

      // Make sure a file was selected
      if (input.files && input.files[0]) {
        // Create a new FileReader object
        var reader = new FileReader();

        // Set the callback function for when the file is loaded
        reader.onload = function(e) {
          // Get the preview element and show the image
          var preview = document.getElementById('preview');
          preview.src = e.target.result;
          preview.style.display = 'block';
        };

        // Read the image file as a data URL
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>

</html>