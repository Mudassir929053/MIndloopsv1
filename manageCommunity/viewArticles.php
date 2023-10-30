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
$sql = "SELECT A.*, B.u_name as owner from community_article A join tb_users B on A.created_by=B.u_id where article_id = '$ca_id'";
$data = [];
$result = mysqli_query($conn, $sql);
while ($row = $result->fetch_assoc()) {
  $data = $row;
}
// var_dump($data);
// exit;
?>
<?php include("../commonPHP/adminNavBar.php"); ?>

<body>
  <main id="main">
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <!-- <h2 style="text-align: center;">Update Article</h2> -->
        <br>
        <div class="row gy-4">
          <a href="communityArticles.php?cc_id=<?= $cc_id ?>&community_id=<?= $community_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <div class="col-lg-12">
            <div class="container border bg-white shadow-lg">
              <div class="row p-2">
                <div class="">
                  <h2 class="text-center"><?= $data['ca_title'] ?></h2>
                  <div class="article">
                    <?= $data['ca_content'] ?>
                  </div>
                  <div class="details d-flex justify-content-between">
                    <?php if ($data['attachment']) { ?>
                      <p>Attachment: <a class="btn btn-warning btn-sm" href="<?= $data['attachment'] ?>" target="_blank">Click To view</a></p>
                    <?php } ?>
                    <p>Created By: <?= $data['owner'] ?></p>
                    <p><i class="bi text-danger bi-hand-thumbs-up-fill"></i> <?= $data['likes'] ? $data['likes'] : 0 ?> <i class="bi text-secondary bi-hand-thumbs-down-fill"></i> <?= $data['dislikes'] ? $data['dislikes'] : 0 ?></p>
                    <p></p>
                  </div>
                </div>
              </div>
            </div>
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
      console.log(obj);
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