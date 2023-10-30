<?php #include "../commonPHP/head.php";?>
  <?php include "../commonPHP/topNavBarCheck.php";?>

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


    @media (max-width: 768px) {
      body{
        width: 120%;
      }

      #backBtn{
        width: 40%;
        margin-left: 10px;
      }
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

    <div id="magazine-hero">
    </div>


    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">View Video</h2>

        <br>

        <div class="row gy-4">

          <a id="backBtn" href="view-videos.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>


          <div class="col-lg-12" id="imgDiv">
            <iframe id="vidDisplay" width="720" height="480" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

  <?php include "../commonPHP/footer.php";?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include "../commonPHP/jsFiles.php";?>


<script>

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const v_id = urlParams.get('v_id');

  var xhr = new XMLHttpRequest();

  xhr.open("get", "../videos/read-single-video.php?v_id=" + v_id);

  xhr.send();

  xhr.onload = function(){
    var jsonData = JSON.parse(xhr.responseText);

    //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIVED DATA.

    var tr = document.querySelector("#tbody tr");

    var tbody = document.getElementById("tbody");

    tbody.removeChild(tr);

    // console.log(jsonData[0].v_title);


    // for id
    // var trID = document.createElement("tr");

    // var thID = document.createElement("th");
    // thID.setAttribute("scope","row");
    // thID.innerHTML = "Video ID";
    // trID.appendChild(thID);

    // var tdID = document.createElement("td");
    // tdID.innerHTML = jsonData[0].v_id;
    // trID.appendChild(tdID);
    // tbody.appendChild(trID);


    // for title
    var trTitle = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Video Title";
    trTitle.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].v_title;
    trTitle.appendChild(tdTitle);
    tbody.appendChild(trTitle);


    // for Audience
    var trAudience = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Video Audience";
    trAudience.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].v_audience;
    trAudience.appendChild(tdTitle);
    tbody.appendChild(trAudience);


    // for Date
    var trDate = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Date Published (YYYY-MM-DD)";
    trDate.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].v_rDate.substring(0,10);
    trDate.appendChild(tdTitle);
    tbody.appendChild(trDate);


    // for Audience
    // var trAuthor = document.createElement("tr");

    // var thTitle = document.createElement("th");
    // thTitle.setAttribute("scope","row");
    // thTitle.innerHTML = "Audience";
    // trAuthor.appendChild(thTitle);

    // var tdTitle = document.createElement("td");
    // tdTitle.innerHTML = jsonData[0].v_audience;
    // trAuthor.appendChild(tdTitle);
    // tbody.appendChild(trAuthor);


    // for Type
    var trType = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Video Type";
    trType.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].v_type;
    trType.appendChild(tdTitle);
    tbody.appendChild(trType);


    // for Description
    var trDesc = document.createElement("tr");

    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Description";
    trDesc.appendChild(thTitle);

    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].v_desc;
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
    // var trFilePath = document.createElement("tr");

    // var thTitle = document.createElement("th");
    // thTitle.setAttribute("scope","row");
    // thTitle.innerHTML = "Video URL";
    // trFilePath.appendChild(thTitle);

    // var tdTitle = document.createElement("td");
    // tdTitle.innerHTML = jsonData[0].v_path;
    // trFilePath.appendChild(tdTitle);
    // tbody.appendChild(trFilePath);


    // Set the video
    document.getElementById("vidDisplay").setAttribute("src", "https://www.youtube.com/embed/" + jsonData[0].v_path.slice(-11));

  }

</script>


</body>

</html>