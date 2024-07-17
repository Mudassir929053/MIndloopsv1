<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
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
</style>
<main id="main">
  <!--  
    <div id="magazine-hero">
    </div> -->
  <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">
      <h2 style="text-align: center;">Manage Kidz Corner</h2>
      <br>
      <div class="row gy-4">
        <a href="addTopic.php" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add Topics</a>
        <div class="col-lg-12">
          <table id="magTbl" class="table datatable table-warning table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">Sno</th>
                <th scope="col">Topic Name</th>
                <th scope="col">Description</th>
                <th scope="col">Created Date</th>
                <th scope="col">Status</th>
                <th scope="col" style="text-align: center;">Actions</th>
              </tr>
            </thead>
            <tbody id="tbody">
              <tr>
                <td scope="row" colspan="10" style="text-align: center;">No Records to be shown</td>
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
<?php include("../commonPHP/jsFiles.php"); ?>
<!-- <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script>
  var xhr = new XMLHttpRequest();
  xhr.open("get", "./kidzcornerQuery.php?allTopics=yes");
  xhr.send();
  xhr.onload = function() {
    console.log(xhr.responseText)
    var jsonData = JSON.parse(xhr.responseText);
    // console.log(xhr.responseText)
    // return false;
    //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIVED DATA.
    var tr = document.querySelector("#tbody tr");
    var tbody = document.getElementById("tbody");
    tbody.removeChild(tr);
    for (var i = 0; i < jsonData.length; i++) {
      var newtr = document.createElement("tr");
      var tdID = document.createElement("th");
      tdID.setAttribute("scope", "row");
      tdID.innerHTML = 1 + i;
      newtr.appendChild(tdID);
      var tdTitle = document.createElement("td");
      tdTitle.innerHTML = jsonData[i].topic_name;
      newtr.appendChild(tdTitle);
      var tdDescription = document.createElement("td");
      tdDescription.innerHTML = jsonData[i].description;
      newtr.appendChild(tdDescription);
      var tdDate = document.createElement("td");
      tdDate.innerHTML = jsonData[i].created_at.substring(0, 10);
      newtr.appendChild(tdDate);
      var tdStatus = document.createElement("td");
      tdStatus.innerHTML = jsonData[i].published == 1 ? 'Published' : 'Unpublished';
      newtr.appendChild(tdStatus);
      var tdView = document.createElement("td");
      // var aView = document.createElement("a");
      var aView = document.createElement("a");
      var iView = document.createElement("i");
      iView.classList.add("bi");
      iView.classList.add("bi-eye");
      iView.classList.add("m-2");
      aView.appendChild(iView);
      aView.setAttribute("href", "kidzcornerArticles.php?topic_id=" + jsonData[i].topic_id);
      aView.classList.add("actionBtn");
      aView.style.color = "#e31568";
      tdView.appendChild(aView);
      var aEdit = document.createElement("a");
      var iEdit = document.createElement("i");
      iEdit.classList.add("bi");
      iEdit.classList.add("bi-pencil-square");
      iEdit.classList.add("m-2");
      aEdit.appendChild(iEdit);
      aEdit.setAttribute("href", "editTopic.php?topic_id=" + jsonData[i].topic_id);
      aEdit.classList.add("actionBtn");
      aEdit.style.color = "#e31568";
      tdView.appendChild(aEdit);
      var aDlt = document.createElement("a");
      var iDlt = document.createElement("i");
      iDlt.classList.add("bi");
      iDlt.classList.add("bi-trash");
      aDlt.appendChild(iDlt);
      aDlt.setAttribute("href", "kidzcornerArticles.php");
      aDlt.setAttribute("onclick", "return deleteTopic('" + jsonData[i].topic_id + "','" + jsonData[i].topic_name + "');");
      aDlt.setAttribute("id", "dltBtn");
      aDlt.classList.add("actionBtn");
      aDlt.style.color = "#e31568";
      tdView.appendChild(aDlt);
      newtr.appendChild(tdView);
      tbody.appendChild(newtr);
    }
    $(document).ready(function() {
      $('#magTbl').DataTable();
    });
  }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script>
</script>
<script>
  function deleteTopic(topic_id, c_name) {
    var check = confirm("Are you sure to delete " + c_name + " ?");
    if (!check) {
      return false;
    }
    var dltXML = new XMLHttpRequest();
    dltXML.open("get", "deleteTopic.php?topic_id=" + topic_id);
    dltXML.send();
    dltXML.onload = function() {  
      // alert("Deleted successfully.");
      // window.location.reload();
     alert(this.responseText);
      // return true;
      window.location.reload();
    };
    return false;
  }
</script>
</body>

</html>
