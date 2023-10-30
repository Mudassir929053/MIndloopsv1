<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
include("../dbconnect.php");
if (isset($_GET['cc_id'])) {
  extract($_GET);
} else {
  header('Location: manageCommunity.php');
}
$sql = "SELECT * FROM community_article where article_id = '$ca_id'";
$data = [];
$result = mysqli_query($conn, $sql);
while ($row = $result->fetch_assoc()) {
  $data = $row;
}
?>
<?php include("../commonPHP/adminNavBar.php"); ?>
<body>
  <main id="main">
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">Update Article</h2>
        <br>
        <div class="row gy-4">
          <a href="communityArticles.php?cc_id=<?= $cc_id ?>&community_id=<?= $community_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <div class="col-lg-12">
            <form id="insertLpForm" action="#" onsubmit="return updateArticle(this)" method="POST" enctype='multipart/form-data'>
              <div class="form-group">
                <label for="c_name">Article Title</label>
                <input type="text" class="form-control" id="ca_name" name="ca_name" value="<?= $data['ca_title'] ?>" placeholder="Enter Title" required>
                <input type="hidden" class="form-control" id="ca_id" name="ca_id" value="<?= $data['article_id'] ?>">
                <input type="hidden" class="form-control" id="cc_id" name="cc_id" value="<?= $cc_id ?>">
                <input type="hidden" class="form-control" id="community_id" name="community_id" value="<?= $community_id ?>">
              </div>
              <br>
              <div class="form-group">
                <label for="c_desc">Article Description</label>
                <textarea class="form-control" id="summernote" name="ca_desc" placeholder="Enter Community description..." maxlength="1000" required>
                <?= $data['ca_content'] ?>
                </textarea>
              </div>
              <br>
              <div class="form-group">
                <label for="c_desc">Status</label>
                <select class="form-control" name="status">
                  <option <?= @$data['published'] == 0 ? 'selected' : '' ?> value="0">Unpublish</option>
                  <option <?= @$data['published'] == 1 ? 'selected' : '' ?> value="1">Publish</option>
                </select>
              </div>
              <br>
              <div class="form-group">
                <label for="m_filePath">Upload File *(jpg,png,gif,jpeg,pdf)</label>
                <input type="file" class="form-control-file" id="m_filePath" name="m_filePath">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-warning">Update Article </button>
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
    // document.getElementById("t_id").value = (Math.floor(Math.random() * 90000) + 10000);
    $(document).ready(function() {
      $('#summernote').summernote({
        minHeight: 200
      });
    });
    function updateArticle(obj) {
      // console.log(obj);
      let formData = new FormData(obj);
      let url = 'communityQuery.php?updateArticle=yes';
      fetch(url, {
        method: 'POST',
        body: formData
      }).then(data => data.text()).then(data => {
        console.log(data);
        // exit;
        // return false;
        alert(data);
        if (data == 'Updated successfully') {
          window.location.href = 'communityArticles.php?cc_id=<?= $cc_id ?>&community_id=<?= $community_id ?>';
        }
      });
      return false;
    }
  </script>
</body>
</html>