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
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Create a Word Search</h2>

        <br>

        <div class="row gy-4">

          <a href="index.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

            <form id="insertword" action="" method="POST" enctype='multipart/form-data'>
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

  <?php include("../../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include("../../commonPHP/jsFiles.php"); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
          document.getElementById('preview-image').src = '../../assets/games/wordsearch/upload/' + data['wordsearch_image'];
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