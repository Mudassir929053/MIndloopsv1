<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}

?>
<style>
  #insertMagForm {
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
</style>

<body>

  <?php include("../commonPHP/adminNavBar.php"); ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <!-- <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Portfolio Details</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li><a href="portfolio.html">Portfolio</a></li>
            <li>Portfolio Details</li>
          </ol>
        </div>

      </div>
    </section> -->
    <!-- End Breadcrumbs -->

    <div id="magazine-hero">
    </div>

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Create a Magazine</h2>

        <br>

        <div class="row gy-4">

          <a href="manage-magazine.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

            <form id="insertMagForm" action="insert-magazine-backend.php" method="POST" enctype='multipart/form-data'>
              <div class="form-group">
                <label for="m_id"><b>Magazine ID (Auto Generated)</b></label>
                <input type="text" class="form-control-plaintext" id="m_id" name="m_id" aria-describedby="emailHelp" value="" readonly>
              </div>
              <br>
              <div class="form-group">
                <label for="m_title">Title</label>
                <input type="text" class="form-control" id="m_title" name="m_title" placeholder="Kembali Ke Sekolah" required>
              </div>
              <br>
              <div class="form-group">
                <label for="m_edition">Edition</label>
                <input type="text" class="form-control" id="m_edition" name="m_edition" placeholder="Hero" required>
              </div>
              <br>
              <div class="form-group">
                <label for="m_rDate">Release Date</label>
                <input type="datetime-local" class="form-control" id="m_rDate" name="m_rDate" required>
              </div>
              <br>
              <div class="form-group">
                <label for="m_author">Author</label>
                <input type="text" class="form-control" id="m_author" name="m_author" placeholder="MindLoops" required>
              </div>
              <br>
              <div class="form-group">
                <label for="m_desc">Description (less than 1000 characters.)</label>
                <textarea class="form-control" id="m_desc" name="m_desc" placeholder="This is the magazine description..." maxlength="1000" required></textarea>
              </div>
              <br>
              <div class="form-group">
                <label for="m_pageLimit">Page Limit</label>
                <input type="number" class="form-control" id="m_pageLimit" name="m_pageLimit" min="0" value="0" required>
              </div>
              <br>
              <div class="form-group">
                <label for="m_imgPath">Cover Image *(.avif)</label>
                <input type="file" class="form-control-file" id="m_imgPath" name="m_imgPath" accept="image/png, image/jpeg, image/jpg ,image/webp, image/avif" required>
              </div>
              <br>
              <div class="form-group">
                <label for="m_filePath">Magazine File *(.pdf)</label>
                <input type="file" class="form-control-file" id="m_filePath" name="m_filePath" accept="application/pdf" required>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-warning">Create Magazine</button>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    document.getElementById("m_id").value = (Math.floor(Math.random() * 90000) + 10000);



    // var frm = $('#insertMagForm');


    // $('input[name=city]').val();

    // frm.submit(function (e) {

    //     e.preventDefault();

    //     $.ajax({
    //         type: frm.attr('method'),
    //         url: frm.attr('action'),
    //         data: frm.serialize(),
    //         success: function (data) {
    //             alert('Submission was successful.');
    //             window.location.replace("manage-magazine.php");
    //         },
    //         error: function (data) {
    //             console.log('An error occurred.');
    //             console.log(data);
    //         },
    //     });
    // });
  </script>


</body>

</html>