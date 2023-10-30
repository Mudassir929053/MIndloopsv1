<?php      
if(!session_id())
    {
        session_start();
  if($_SESSION["userType"]!='1')
  {
    header ('location: ../login_and_register/login.php');
  }    }
  include '../dbconnect.php';
  // var_dump($_GET);
  // exit;
  extract($_GET);
  
  $sql = "SELECT * FROM `tb_videos` WHERE v_id='$v_id'";
  $result = mysqli_query($conn,$sql);
  $data=[];
while($row = mysqli_fetch_array($result)){
  $data = $row;
}

// var_dump($data);
// exit;

  ?>



  <?php include("../commonPHP/adminNavBar.php"); ?>

  <style>

    body{
      background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
      background-size: 110%;
      background-position: top center;
    }

    #magazine-hero{
      background-image: none;
      height: 150px;
    }

    #imgDiv{
      width: 100%;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
    }
  </style>

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

    <!-- <div id="magazine-hero">
    </div> -->


    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">View Video</h2>

        <br>

        <div class="row gy-4">

          <a href="manage-video.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
        </div>

            <div class="container py-4 shadow-lg mt-3">
              <div class="row">
                <div class="col-lg-5 offset-lg-1">
                <div class="ratio ratio-16x9">
  <iframe src="<?= $data['v_path'] ?>" title="YouTube video" allowfullscreen></iframe>
</div>
                
                </div>
                <div class="col-lg-6 px-5">
                  <p><b>Title:</b> <span><?= $data['v_title'] ?></span></p>
                  <p><b>Description:</b> <span><?= $data['v_desc'] ?></span></p>

                  <p><b>Release Date:</b> <span><?= $data['v_rDate'] ?></span></p>
                  <p><b>Audience:</b> <span><?= $data['v_audience'] ?></span></p>
                  <p><b>Type:</b> <span><?= $data['v_type'] ?></span></p>


                </div>
              </div>
            </div>
<!-- 
          <div class="col-lg-12" id="imgDiv">
            <img id="tipImg" src="" alt="" height="350" width="280">
          </div> -->

          

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include("../commonPHP/footer_admin.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php  include("../commonPHP/jsFiles.php"); ?>


<script>

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const t_id = urlParams.get('t_id');

  var xhr = new XMLHttpRequest();

  xhr.open("get", "../tips/read-single-tip.php?t_id=" + t_id);

  xhr.send();

  xhr.onload = function(){
    var jsonData = JSON.parse(xhr.responseText);

    //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIVED DATA.

    var tr = document.querySelector("#tbody tr");

    var tbody = document.getElementById("tbody");

    tbody.removeChild(tr);

    console.log(jsonData[0].m_title);


    // for id
    var trID = document.createElement("tr");

    var thID = document.createElement("th");
    thID.setAttribute("scope","row");
    thID.innerHTML = "Tip ID";
    trID.appendChild(thID);

    var tdID = document.createElement("td");
    tdID.innerHTML = jsonData[0].t_id;
    trID.appendChild(tdID);
    tbody.appendChild(trID);


    // for title
    var trTitle = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Tip Title";
    trTitle.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].t_title;
    trTitle.appendChild(tdTitle);
    tbody.appendChild(trTitle);


    // for Audience
    var trAudience = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Tip Audience";
    trAudience.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].t_audience;
    trAudience.appendChild(tdTitle);
    tbody.appendChild(trAudience);


    // for Date
    var trDate = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Date Published (YYYY-MM-DD)";
    trDate.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].t_rDate.substring(0,10);
    trDate.appendChild(tdTitle);
    tbody.appendChild(trDate);
    

    // for Author
    var trAuthor = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Author";
    trAuthor.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].t_author;
    trAuthor.appendChild(tdTitle);
    tbody.appendChild(trAuthor);


    // for Type
    var trType = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Tip Type";
    trType.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].t_type;
    trType.appendChild(tdTitle);
    tbody.appendChild(trType);

        
    // for Description
    var trDesc = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Description";
    trDesc.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].t_desc;
    trDesc.appendChild(tdTitle);
    tbody.appendChild(trDesc);


    // for Image Path
    // var trImgPath = document.createElement("tr");

    // var thTitle = document.createElement("th");
    // thTitle.setAttribute("scope","row");
    // thTitle.innerHTML = "Image Path";
    // trImgPath.appendChild(thTitle);

    // var tdTitle = document.createElement("td");
    // tdTitle.innerHTML = jsonData[0].t_imgPath;
    // trImgPath.appendChild(tdTitle);
    // tbody.appendChild(trImgPath);


    // for File Path
    var trFilePath = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Image Path";         // This is Actually File Path because it is NOT NULL in the db, Image Path is nullable.
    trFilePath.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].t_filePath;
    trFilePath.appendChild(tdTitle);
    tbody.appendChild(trFilePath);


    // Set the image
    document.getElementById("tipImg").setAttribute("src",jsonData[0].t_filePath);

  }

</script>


</body>

</html>