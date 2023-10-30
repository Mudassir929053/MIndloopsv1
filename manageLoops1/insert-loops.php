<?php
if (!session_id()) {
  session_start();

  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}

include("../dbconnect.php");
$sql = "SELECT * FROM tb_loopstype";
$result = mysqli_query($conn, $sql);


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

  #insertLpForm {
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
    font-family: Arial;
  }

  /* Style the tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }

  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }
</style>


<body>



  <main id="main">

    <!-- <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Create a Loops</h2>

        <br>

        <div class="row gy-4">

          <a href="manage-loops.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

            <form id="insertLpForm" action="insert-loops-backend.php" method="POST" enctype='multipart/form-data'>
              <div class="form-group">
                <label for="lp_title">Title</label>
                <input type="text" class="form-control" id="lp_title" name="lp_title" placeholder="Enter Title" required>
              </div>
              <br>
              <div class="form-group">
                <label for="lp_desc">Description</label>
                <textarea class="form-control" id="lp_desc" name="lp_desc" placeholder="This is the mindbooster description..." maxlength="1000" required></textarea>
              </div>
              <br>
              <div class="form-group">
                <label for="lp_date">Released Date</label>
                <input type="datetime-local" class="form-control" id="lp_date" name="lp_date" required>
              </div>
              <br>

              <div class="form-group">
                <label for="lp_type">Type</label>
                <select class="form-select" name="lp_type" id="lp_type" required>
                  <option value="" selected disabled>Select a type</option>
                  <?php
                  while ($rows = $result->fetch_assoc()) :;
                  ?>
                    <option value="<?php echo $rows["loops_id"]; ?>">
                      <?php echo $rows["loops_type"]; ?>
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>
              <br>






              <div class="form-group">
                <label for="lp_imgpath">Cover Image *(.png / .jpg / .jpeg)</label>
                <input type="file" class="form-control" id="lp_imgpath" name="lp_imgpath" accept="image/png, image/jpeg, image/jpg">
              </div>
              <br>
              <div class="form-group">
                <label for="lp_filepath">Loops File *(.pdf .doc .docx)</label>
                <input type="file" class="form-control" id="lp_filepath" name="lp_filepath" accept=".pdf, .doc, .docx">
              </div>

              <br>

              <div class="form-group">
                <button type="submit" class="btn btn-warning">Create Loops</button>
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
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it

    $(document).ready(function() {
      document.getElementById("defaultOpen").click();
    });
  </script>

</body>

</html>