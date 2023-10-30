<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}

?>

<style>
  #editMagForm {
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
    <div id="magazine-hero">
    </div>

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Update a Magazine</h2>

        <br>

        <div class="row gy-4">

          <a href="manage-magazine.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

            <form id="editMagForm" action="edit-magazine-backend.php" method="POST" enctype='multipart/form-data'>
              <div class="form-group">
                <label for="m_id"><b>Magazine ID</b></label>
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
              <!-- <div class="form-group">
                <p style="font-size: 13px; color: #e31568;">*NOTE: The cover image and file is uneditable, you should delete this record and create a new one if you wish to edit the files.</p>
            </div> -->
              <div class="form-group">
                <label for="m_id"><b>Current Cover Image *(.png / .jpg / .jpeg / .avif)</b></label>
                <input type="text" class="form-control-plaintext" id="currImgPath" name="currImgPath" aria-describedby="emailHelp" value="" style="font-size: 13px;" readonly>
              </div>
              <div class="form-group">
                <label for="m_imgPath"><b></b></label><!--New Cover Image *(.png / .jpg / .jpeg)-->
                <input type="file" class="form-control-file" id="m_imgPathNew" name="m_imgPathNew" accept="image/png, image/jpeg, image/jpg ,image/webp, image/avif">
              </div>
              <br>
              <div class="form-group">
                <label for="m_id"><b>Current Magazine File *(.pdf)</b></label>
                <input type="text" class="form-control-plaintext" id="currFilePath" name="currFilePath" aria-describedby="emailHelp" value="" style="font-size: 13px;" readonly>
              </div>
              <div class="form-group">
                <label for="m_filePath"><b></b></label><!--New Magazine File *(.pdf)-->
                <input type="file" class="form-control-file" id="m_filePathNew" name="m_filePathNew" accept="application/pdf">
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-warning">Update Magazine</button>
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
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const m_id = urlParams.get('m_id');

    var xhr = new XMLHttpRequest();

    xhr.open("get", "../magazine/read-single-magazine.php?m_id=" + m_id);

    xhr.send();

    xhr.onload = function() {
      var jsonData = JSON.parse(xhr.responseText);

      document.getElementById("m_id").value = jsonData[0].m_id;

      document.getElementById("m_title").value = jsonData[0].m_title;

      document.getElementById("m_desc").innerHTML = jsonData[0].m_desc;

      document.getElementById("m_edition").value = jsonData[0].m_edition;

      document.getElementById("m_author").value = jsonData[0].m_author;

      document.getElementById("m_pageLimit").value = jsonData[0].m_pageLimit;

      document.getElementById("m_rDate").value = jsonData[0].m_rDate;

      document.getElementById("currImgPath").value = jsonData[0].m_imgPath;

      document.getElementById("currFilePath").value = jsonData[0].m_filePath;

    }


    // var frm = $('#editMagForm');

    // frm.submit(function (e) {

    //     e.preventDefault();

    //     $.ajax({
    //         type: frm.attr('method'),
    //         url: frm.attr('action'),
    //         data: frm.serialize(),
    //         success: function (data) {
    //             alert('Update was successful.');
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