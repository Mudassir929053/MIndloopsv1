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
  <main id="main">
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">View Magazine</h2>
        <br>
        <div class="row gy-4">
          <a href="manage-magazine.php" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>
          <br>
          <br>
          <div class="col-lg-12" id="imgDivMagazine">
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
  const m_id = urlParams.get('m_id');
  var xhr = new XMLHttpRequest();
  xhr.open("get", "../magazine/read-single-magazine.php?m_id=" + m_id);
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
    thID.innerHTML = "Magazine ID";
    trID.appendChild(thID);
    var tdID = document.createElement("td");
    tdID.innerHTML = jsonData[0].m_id;
    trID.appendChild(tdID);
    tbody.appendChild(trID);
    // for title
    var trTitle = document.createElement("tr");
    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Magazine Title";
    trTitle.appendChild(thTitle);
    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].m_title;
    trTitle.appendChild(tdTitle);
    tbody.appendChild(trTitle);
    // for Edition
    var trEdition = document.createElement("tr");
    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Magazine Edition";
    trEdition.appendChild(thTitle);
    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].m_edition;
    trEdition.appendChild(tdTitle);
    tbody.appendChild(trEdition);
    // for Date
    var trDate = document.createElement("tr");
    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Date Published (YYYY-MM-DD)";
    trDate.appendChild(thTitle);
    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].m_rDate.substring(0,10);
    trDate.appendChild(tdTitle);
    tbody.appendChild(trDate);
    // for Author
    var trAuthor = document.createElement("tr");
    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Author";
    trAuthor.appendChild(thTitle);
    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].m_author;
    trAuthor.appendChild(tdTitle);
    tbody.appendChild(trAuthor);
    // for Description
    var trDesc = document.createElement("tr");
    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Description";
    trDesc.appendChild(thTitle);
    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].m_desc;
    trDesc.appendChild(tdTitle);
    tbody.appendChild(trDesc);
    // for Image Path
    var trImgPath = document.createElement("tr");
    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Image Path";
    trImgPath.appendChild(thTitle);
    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].m_imgPath;
    trImgPath.appendChild(tdTitle);
    tbody.appendChild(trImgPath);
    // for File Path
    var trFilePath = document.createElement("tr");
    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "File Path";
    trFilePath.appendChild(thTitle);
    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].m_filePath;
    trFilePath.appendChild(tdTitle);
    tbody.appendChild(trFilePath);
    // for Page Limit
    var trPageLimit = document.createElement("tr");
    var thTitle = document.createElement("th");
    thTitle.setAttribute("scope","row");
    thTitle.innerHTML = "Page Limit (For Free Users)";
    trPageLimit.appendChild(thTitle);
    var tdTitle = document.createElement("td");
    tdTitle.innerHTML = jsonData[0].m_pageLimit;
    trPageLimit.appendChild(tdTitle);
    tbody.appendChild(trPageLimit);
    // Set the image
    document.getElementById("tipImg").setAttribute("src",jsonData[0].m_imgPath);
  }
</script>
</body>
</html>