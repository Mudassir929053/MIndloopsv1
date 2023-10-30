<?php include("../commonPHP/head.php"); ?>
<?php include("../commonPHP/topNavBarCheck.php"); ?>

<style>
  body {
    background-image: url('../../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
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
<main id="main">
  <div id="magazine-hero">
  </div>
  <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">
      <a href="view-loops.php" class="btn btn-warning" id="back-button" style="margin-left: 15px;"><i class="bi bi-arrow-left"></i> Return to Loops</a>
      <a href="manage-mindbooster.php"  class="btn btn-primary">View Subjects</a>
      <!-- data-toggle="modal" data-target="#globalModal" -->
      <br>
      <br>    
      <br>
      <div class="class"></div>
      
<div id="printable-content">
  <div class="row gy-4">
    <div class="col-lg-4">
      <div class="portfolio-details-slider">
        <div class="align-items-center">
          <div class="">
            <img id="lp_imgpath" src="" alt="" style="height:400px;">
          </div>
        </div>
      </div>
    </div>
    <div class="card col-lg-6">
    <div class="col-lg-12">
      <div class="portfolio-description">
        <h2 class="text-black" id="lp_title"></h2>
        <p id="lp_desc" class="description-paragraph text-black"></p>
        <p id="lp_date" class="description-paragraph text-secondary"></p>
      </div>
    </div>
  </div>
</div>
</div>
<div class="d-flex justify-content-center py-5">
  <button id="print-button" onclick="printContent()" class="btn btn-primary" style="width: 150px;">Download</button>
</div>


</main><!-- End #main -->



<script>
  function printContent() {
    var contentToPrint = document.getElementById("printable-content").innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = contentToPrint;
    window.print();
    document.body.innerHTML = originalContent;
    location.reload(); // Reload the page to restore the original content
  }
  var description = document.getElementById("lp_desc");
  var words = description.textContent.trim().split(" ");
  var lines = [];
  var currentLine = [];
  for (var i = 0; i < words.length; i++) {
    currentLine.push(words[i]);
    if (currentLine.length === 20 || i === words.length - 1) {
      lines.push(currentLine.join(" "));
      currentLine = [];
    }
  }
  description.textContent = lines.join("\n");
</script>

      <!-- <a id="viewMoreBtn" href="loops-flipbook.php?pageNum=1" class="btn btn-warning">Download</a> -->
    </div>
  </section>
 
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../../commonPHP/jsFiles.php"); ?>
<script>
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const lp_id = urlParams.get('lp_id');
  var xhr = new XMLHttpRequest();
  xhr.open("get", "read-single-loops.php?lp_id=" + lp_id);
  xhr.send();
  xhr.onload = function() {
    var jsonData = JSON.parse(xhr.responseText);
    document.getElementById("lp_imgpath").setAttribute("src", "../" + jsonData[0].lp_imgpath);
    document.getElementById("lp_title").innerHTML = jsonData[0].lp_title;
    document.getElementById("lp_desc").innerHTML = jsonData[0].lp_desc;
    var date = new Date(jsonData[0].lp_date);
var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var month = monthNames[date.getMonth()];

document.getElementById("lp_date").innerHTML = date.getFullYear() + '-' + month + '-    ' + date.getDate();

    document.getElementById("viewMoreBtn").setAttribute("href", "loops-flipbook.php?pageNum=1&lp_id=" + lp_id);
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>