<?php
if (!session_id()) {
  session_start();

  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}

include("../dbconnect.php");
$sql = "SELECT * FROM tb_subjects";
$result = mysqli_query($conn, $sql);

$parano = 2;
?>
<?php
if (isset($_GET['mb_id'])) {
  $mb_id = $_GET['mb_id'];
}
?>
<?php include("../commonPHP/adminNavBar.php"); ?>
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

  #insertMbForm,
  #insertLessonForm {
    width: 100%;
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

  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  .file-upload {
    position: relative;
    display: inline-block;
    overflow: hidden;
  }

  .file-upload input[type="file"] {
    font-size: 100px;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
  }

  .file-upload-label {
    display: inline-block;
    padding: 8px 15px;
    background-color: #f0f0f0;
    color: #333;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
  }

  .file-upload-label:hover {
    background-color: #e0e0e0;
  }

  .file-upload-value {
    display: inline-block;
    margin-left: 10px;
    color: #777;
  }
</style>
<link rel="stylesheet" href="../assets/css/summernote.css">

<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<body>
  <main>



    <div class="container">
      <h2 class="mt-5" style="text-align: center;">Create a General Knowledge Article</h2>
      <br>
      <div class="row gy-4">
        <div class="col-lg-12">
          <a href="view-gk-mindbooster.php?mb_id=<?php echo $mb_id; ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
        </div>
        <div class="col-lg-12">
          <form id="insertLessonForm" action="insert-gk-backend.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="l_name">Article Name</label>
              <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter Article Name" required>
              <input type="hidden" id="mb_id" name="mb_id" value="<?php echo $mb_id; ?>">

            </div>
           
            <br>
            <div class="form-group">
              <label for="summernote">Article Description</label>
              <textarea class="form-control" id="summernote" name="l_lesson_desc" placeholder="Enter Article Description" required></textarea>
            </div>
           

            <div class="form-group">
              <label for="l_image">Article Thubmnail</label>
              <input type="file" class="form-control-file" id="l_image" name="l_image" accept="image/jpeg, image/png, image/gif, image/svg+xml">
            </div>

            <br>
            <div class="form-group">
              <label for="l_released_date">Released Date</label>
              <input type="datetime-local" class="form-control" id="l_released_date" name="l_released_date">
            </div>
            <br>
            <div class="form-group">
              <button type="submit" class="btn btn-warning">Create Article</button>
              <button type="reset" class="btn btn-secondary">Clear</button>
            </div>
          </form>
        </div>
      </div>
    </div>




  </main><!-- End #main -->

  <?php include("../commonPHP/footer_admin.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include("../commonPHP/jsFiles.php"); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
  // document.getElementById("t_id").value = (Math.floor(Math.random() * 90000) + 10000);
  $(document).ready(function() {
    $('#summernote').summernote({
      spellCheck: false,
    fontNames: ['Arial', 'Helvetica', 'Times New Roman', 'Courier New', 'Tommysoft'],
    fontSizeUnits: ['px', 'pt'],
    lang: ['en-US', 'es'],
    toolbar: [
      ['style', ['fontname', 'fontsize']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['font', ['bold', 'underline', 'clear']],
  ['table', ['table']],
  ['insert', ['link', 'picture', 'video']],
  ['view', ['fullscreen', 'codeview', 'help']],
      ['lang', ['en-US', 'es']],
    ]
  });
  });
</script>
</body>

</html>