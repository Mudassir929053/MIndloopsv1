<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
include("../commonPHP/adminNavBar.php");
include("function.php");
$sql = "SELECT * FROM tb_subjects";
$result = mysqli_query($conn, $sql);
?>

<body>
  <main id="main">
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">Create a Word Search</h2>
        <br>
        <div class="row gy-4">
          <a href="manage-wordsearch.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <div class="col-lg-12">
            <form id="insertLpForm" action="" method="POST" enctype='multipart/form-data'>
              <div class="form-group">
                <label for="level">Level</label>
                <select class="form-select" name="level" id="level" onchange="clearForm()" required>
                  <option value="" selected disabled>Select Level</option>
                  <option value=easy>Easy</option>
                  <option value=medium>Medium</option>
                  <option value=hard>Hard</option>
                </select>
              </div>
              <br>
              <div class="form-group">
                <label for="theme">Category</label>
                <input type="text" class="form-control" id="theme" name="theme" onchange="getWords(this.value)" placeholder="Enter Theme" required>
              </div>
              <br>
              <div class="form-group">
                <label for="words">Words</label>
                <textarea class="form-control" id="words" name="words" placeholder="Enter the Words with comma separated" maxlength="1000" required></textarea>
              </div>
              <br>
              <div class="form-group">
                <label for="addimage">Insert Image</label>
                <input type="file" class="form-control" accept="image/png,image/jpeg" id="addimage" name="addimage" onchange="previewImage(this)" required>
                <img id="preview-image" src="#" alt="Preview Image" style="display: none; max-width: 300px; margin-top: 10px;">
              </div>
              <br>
              <br>
              <div class="form-group">
                <button type="submit" id="addword" name="addword" class="btn btn-warning">Create New Words</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <?php include("../commonPHP/footer_admin.php"); ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php include("../commonPHP/jsFiles.php"); ?>
  <script>
    //preview image
    function previewImage(input) {
      var preview = document.getElementById('preview-image');
      preview.style.display = 'block';
      var reader = new FileReader();
      reader.onload = function() {
        preview.src = reader.result;
      }
      if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
      }
    }
    document.getElementById('addimage').addEventListener('change', previewImage);
    const getWords = (category) => {
      // console.log(category)
      if (category == '') {
        return false;
      }
      let level = document.getElementById('level');
      // console.log(level.value);
      if (level.value == '') {
        alert('Please Select Level first');
        level.focus();
        return false;
      }
      let url = "getwordslist.php?level=" + level.value + "&category=" + category;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          // console.log(data)
          // let [words, imagePath] = data.split("|");
          document.getElementById('words').value = data['wordsearch_words'];
          document.getElementById('preview-image').src = '../assets/magazine/admin_magazine/' + data['wordsearch_image'];
          document.getElementById('preview-image').style.display = 'block';
          if (data['wordsearch_image']) {
            document.getElementById('addimage').required = false;
          }
        });
    }

    function clearForm() {
      document.getElementById('theme').value = '';
      document.getElementById('words').value = ''
    }
  </script>
</body>

</html>