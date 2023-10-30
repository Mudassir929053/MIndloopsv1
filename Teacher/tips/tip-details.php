<?php include("../commonPHP/head.php"); ?>
<?php include("../commonPHP/topNavBarCheck.php"); ?>
<link href="../../assets/css/teacher.css" rel="stylesheet">

<main id="main">
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">
      <a href="view-tips.php" class="btn btn-warning" id="back-button" style="margin-left: 15px;"><i class="bi bi-arrow-left"></i> Return to Tips</a>
      <br>
      <br>
      <br>
     
      <div class="row gy-4 bg-white shadow-sm" id="123">
        <div class="col-lg-12">
          <div class="portfolio-description">
            <h2 id="tTitle" class="text-center"></h2>
            <p id="dateP" class="date-paragraph text-center"></p>
            <img id="tipImage" src="" alt="" class="img-fluid rounded float-left" style="height: 300px; width: 400px;">


            <div id="descP" class="description-paragraph">
              <!-- Article content goes here -->
            </div>
            <br>
            <br>
          </div>
        </div>
        <div class="row">
          <div class="col-12 pb-3">
            <p id="authorP" class="date-paragraph"></p>
            <p id="typeP" class="date-paragraph"></p>
            <div class="text-end mb-2 ">
              <a id="watchVideoLink" class="btn btn-danger" href="#"><i class="bi bi-play-fill"></i> Watch Video</a>
        <a href="#" class="btn btn-sm btn-primary" onclick="printContent()"><i class="bi bi-printer-fill text-warning"></i> Print Article</a>
      </div>
          </div>
        </div>
      </div>
     
      <script>
        function printContent() {
          var content = document.getElementById("123").innerHTML;
          var printWindow = window.open('', '', 'width=600,height=600');
          printWindow.document.open();
          printWindow.document.write('<html><head><title>Print Content</title></head><body>' + content + '</body></html>');
          printWindow.document.close();
          printWindow.print();
        }

        function redirectToVideo() {
          var videoId = jsonData[0].t_video_id;
          window.location.href = "view-videos.php?v_id=" + videoId;
        }


        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const t_id = urlParams.get('t_id');
        var xhr = new XMLHttpRequest();
        xhr.open("get", "./read-single-tip.php?t_id=" + t_id);
        xhr.send();
        xhr.onload = function() {
          var jsonData = JSON.parse(xhr.responseText);
          document.getElementById("tTitle").innerHTML = jsonData[0].t_title;
          document.getElementById("descP").innerHTML = jsonData[0].t_desc;
          document.getElementById("authorP").innerHTML = "<b>Author: </b><small style=\"color:#2ac1dc;\">" + jsonData[0].t_author + "</small>";
          var videoId = jsonData[0].t_video_id;
          var tipImage = document.getElementById("tipImage");
    tipImage.src = "../" + jsonData[0].t_filePath;
          if (videoId) {
            document.getElementById("watchVideoLink").setAttribute("href", "view-videos.php?v_id=" + videoId);
            document.getElementById("watchVideoLink").style.display = "inline";
          } else {
            document.getElementById("watchVideoLink").style.display = "none";
          }

          document.getElementById("dateP").innerHTML = "<b>Date Published: </b><small style=\"color:#2ac1dc;\">" + formatDate(jsonData[0].t_rDate) + "</small>";
          document.getElementById("typeP").innerHTML = "<b>Tip Type: </b><small style=\"color:#2ac1dc;\">" + jsonData[0].t_type + "</small>";
        }

        function formatDate(dateString) {
          const options = {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
          };
          const date = new Date(dateString);
          return date.toLocaleDateString('en-US', options);
        }
      </script>
    </div>
  </section>
  <?php //include("../magazine/magazine-slider.php"); 
  ?>
</main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
</body>

</html>