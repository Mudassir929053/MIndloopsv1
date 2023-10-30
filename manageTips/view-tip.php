<?php      
if(!session_id())
    {
        session_start();
  if($_SESSION["userType"]!='1')
  {
    header ('location: ../login_and_register/login.php');
  }    }

  ?>



  <?php include("../commonPHP/adminNavBar.php"); ?>
 
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <main id="main">
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">View Tip</h2>

        <br>

        <div class="row gy-4">

          <a href="manage-tip.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>


          <div class="col-lg-12" id="imgDiv">
            <img id="tipImg" src="" alt="" height="350" width="280">
          </div>

          <div class="col-lg-12">
            
            <table id="magTbl" class="table table-warning table-borderless table-striped table-hover">
                <thead>
                    <!-- <tr>
                        <th scope="col">Field</th>
                        <th scope="col">Details</th>
                    </tr> -->
                </thead>

                <tbody id="tbody">
                    <tr>
                        <td scope="row" colspan="2" style="text-align: center;">No Records to be shown</td>
                    </tr>
                </tbody>
            </table>

          </div>

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

  xhr.open("get", "./read-single-tip.php?t_id=" + t_id);

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


    // for Video
    var trvideo = document.createElement("tr");

    var thvideo = document.createElement("th");
    thvideo.setAttribute("scope","row");
    thvideo.innerHTML = "Tip Video Id";
    trvideo.appendChild(thvideo);

    var tdvideo = document.createElement("td");
    tdvideo.innerHTML = jsonData[0].t_video;
    trvideo.appendChild(tdvideo);
    tbody.appendChild(trvideo);


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