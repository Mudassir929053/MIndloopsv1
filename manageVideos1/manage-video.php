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

    <!-- <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Manage Videos</h2>

        <br>

        <div class="row gy-4">

          <a href="insert-video.php" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add a New Video</a>

          <div class="col-lg-12">
            
            <table id="magTbl" class="table datatable table-warning table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Release Date (YYYY-MM-DD)</th>
                        <th scope="col">Audience</th>
                        <th scope="col">Type</th>
                        <th scope="col" style="text-align: center;">Actions</th>
                    </tr>
                </thead>

                <tbody id="tbody">
                    <tr>
                        <td scope="row" colspan="6" style="text-align: center;">No Records to be shown</td>
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

  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script>

  var xhr = new XMLHttpRequest();

  xhr.open("get", "../videos/read-all-videos.php");

  xhr.send();

  xhr.onload = function(){
    console.log(xhr.responseText);
    var jsonData = JSON.parse(xhr.responseText);

    //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIVED DATA.

    var tr = document.querySelector("#tbody tr");

    var tbody = document.getElementById("tbody");
    
    tbody.removeChild(tr);

    for(var i=0; i<jsonData.length; i++){

      var newtr = document.createElement("tr");

      var tdID = document.createElement("th");
      tdID.setAttribute("scope","row");
      tdID.innerHTML = jsonData[i].v_id;
      newtr.appendChild(tdID);

      var tdTitle = document.createElement("td");
      tdTitle.innerHTML = jsonData[i].v_title;
      newtr.appendChild(tdTitle);


      var tdRDate = document.createElement("td");
      tdRDate.innerHTML = jsonData[i].v_rDate.substring(0,10);
      newtr.appendChild(tdRDate);

      // var tdAuthor = document.createElement("td");
      // tdAuthor.innerHTML = jsonData[i].t_author;
      // newtr.appendChild(tdAuthor);

      var tdAudience = document.createElement("td");
      tdAudience.innerHTML = jsonData[i].v_audience;
      newtr.appendChild(tdAudience);

      var tdType = document.createElement("td");
      tdType.innerHTML = jsonData[i].v_type;
      newtr.appendChild(tdType);

      var tdView = document.createElement("td");
      var aView = document.createElement("a");
      var iView = document.createElement("i");
      iView.classList.add("bi");
      iView.classList.add("bi-eye");
      aView.appendChild(iView);
      aView.setAttribute("href","view-video.php?v_id=" + jsonData[i].v_id);
      aView.classList.add("actionBtn");
      aView.style.color = "#e31568";
      tdView.appendChild(aView);
      var aEdit = document.createElement("a");
      var iEdit = document.createElement("i");
      iEdit.classList.add("bi");
      iEdit.classList.add("bi-pencil-square");
      iEdit.classList.add("m-2");

      aEdit.appendChild(iEdit);
      aEdit.setAttribute("href","edit-video.php?v_id=" + jsonData[i].v_id);
      aEdit.classList.add("actionBtn");
      aEdit.style.color = "#e31568";
      tdView.appendChild(aEdit);
      
      var aDlt = document.createElement("a");
      var iDlt = document.createElement("i");
      iDlt.classList.add("bi");
      iDlt.classList.add("bi-trash");
      aDlt.appendChild(iDlt);
      aDlt.setAttribute("href","manage-video.php");
      aDlt.setAttribute("onclick","return deleteVideo('" + jsonData[i].v_id + "');");
      aDlt.setAttribute("id","dltBtn");
      aDlt.classList.add("actionBtn");
      aDlt.style.color = "#e31568";
      tdView.appendChild(aDlt);
      newtr.appendChild(tdView);
      tbody.appendChild(newtr);

    }

    $(document).ready(function () {
    $('#magTbl').DataTable();
});

  }

</script>


<script>

// document.getElementById("dltBtn").addEventListener("click",function(event){
//   event.preventDefault();

//   deleteMagazine(document.getElementById("dltBtn").getAttribute("href"));
// });

function deleteVideo(v_id){

  var check = confirm("Are you sure to delete the video with ID = " + v_id + " ?");


  if(check){

    var dltXML = new XMLHttpRequest();

    dltXML.open("get","delete-video.php?v_id=" + v_id);

    dltXML.send();

    dltXML.onload = function(){
        alert("Deleted successfully.");

        window.location.replace("manage-video.php");
    };
  }
  else{
    window.location.replace("manage-video.php");
  }



  }

</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script>
   
</script>
</body>

</html>