<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
include("../dbconnect.php");
$data = [];
if (isset($_GET['forumtopic_id'])) {
  extract($_GET);
  $sql = "SELECT * from forum_topic where forumtopic_id ='$forumtopic_id ' and forum_id='$forum_id'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
} else {
  header('Location: ForumTopics.php?forum_id=' . $forum_id);
}
if (count($data) == 0) {
  header('Location: manageForum.php');
}
// var_dump($data);
// exit;
?>
<?php include("../commonPHP/adminNavBar.php"); ?>

<body>
  <main id="main">
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">Update Topic</h2>
        <br>
        <div class="row gy-4">
          <a href="ForumTopics.php?forum_id=<?= $forum_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <div class="col-lg-12">
            <form id="insertLpForm" action="#" onsubmit="return updateforumtopic(this)" method="POST">
              <input type="hidden" name='forumtopic_id' id='forumtopic_id' value="<?= @$data[0]['forumtopic_id'] ?>">
              <div class="form-group">
                <label for="ft_name">forumtopic Name</label>
                <input type="text" class="form-control" id="ft_name" name="ft_name" value="<?= @$data[0]['ft_name'] ?>" placeholder="Enter forumtopic" required>
              </div>
              <br>
              <div class="form-group">
                <label for="ft_desc">Description</label>
                <textarea class="form-control" id="ft_desc" name="ft_desc" placeholder="This is the mindbooster description..." maxlength="1000" required><?= @$data[0]['ft_description'] ?></textarea>
              </div>
              <br>
              <div class="form-group">
                <label for="ft_desc">Status</label>
                <select class="form-control" name="status">
                  <option <?= @$data[0]['published'] == 0 ? 'selected' : '' ?> value="0">Unpublish</option>
                  <option <?= @$data[0]['published'] == 1 ? 'selected' : '' ?> value="1">Publish</option>
                </select>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-warning">Update Forum Topic</button>
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
    function updateforumtopic(obj) {
      console.log(obj);
      let formData = new FormData(obj);
      let url = 'forumQuery.php?updateforumtopic=yes';
      fetch(url, {
        method: 'POST',
        body: formData
      }).then(data => data.text()).then(data => {
        alert(data);
        if (data == 'Updated successfully') {
          window.location.href = 'ForumTopics.php?forum_id=<?= $forum_id ?>';
        }
      });
      return false;
    }
  </script>
</body>

</html>