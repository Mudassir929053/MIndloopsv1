<?php      
  if(!session_id())
  {
    session_start();
    if($_SESSION["userType"]!='1')
    {
      header ('location: ../login_and_register/login.php');
    }
  }
?>
  <?php include("../commonPHP/adminNavBar.php"); ?>
  <main id="main">
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <h2 style="text-align: center;">Manage Loops</h2>
        <br>
        <div class="row gy-4">
          <a href="insert-loops.php" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add a New Loops</a>
          <div class="col-lg-12">
            <table id="magTbl" class="table datatable table-warning table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date Uploaded</th>
                        <th scope="col">Type</th>
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
  <?php  include("../commonPHP/jsFiles.php"); ?>
<script>
  var xhr = new XMLHttpRequest();
  xhr.open("get", "../loops/read-all-loops.php");
  xhr.send();
  xhr.onload = function(){
    console.log(xhr.responseText)
    var jsonData = JSON.parse(xhr.responseText);
    // console.log(xhr.responseText)
    //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIVED DATA.
    var tr = document.querySelector("#tbody tr");
    var tbody = document.getElementById("tbody");
    tbody.removeChild(tr);
    for(var i=0; i<jsonData.length; i++){
      var newtr = document.createElement("tr");
      var tdID = document.createElement("th");
      tdID.setAttribute("scope","row");
      tdID.innerHTML = jsonData[i].lp_id;
      newtr.appendChild(tdID);
      var tdTitle = document.createElement("td");
      tdTitle.innerHTML = jsonData[i].lp_title;
      newtr.appendChild(tdTitle);
      var tdDescription = document.createElement("td");
      tdDescription.innerHTML = jsonData[i].lp_desc;
      newtr.appendChild(tdDescription);
      var tdDate = document.createElement("td");
      tdDate.innerHTML = jsonData[i].lp_date.substring(0,10);
      newtr.appendChild(tdDate);
      var tdType = document.createElement("td");
      tdType.innerHTML = jsonData[i].lp_type; 
      newtr.appendChild(tdType);
      var tdView = document.createElement("td");
      var aView = document.createElement("a");
      var iView = document.createElement("i");
      iView.classList.add("bi");
      iView.classList.add("bi-eye");
      aView.appendChild(iView);
      aView.setAttribute("href","view-loops.php?lp_id=" + jsonData[i].lp_id);
      aView.classList.add("actionBtn");
      aView.style.color = "#e31568";
      tdView.appendChild(aView);
      var aEdit = document.createElement("a");
      var iEdit = document.createElement("i");
      iEdit.classList.add("bi");
      iEdit.classList.add("bi-pencil-square");
      iEdit.classList.add("m-2");
      aEdit.appendChild(iEdit);
      aEdit.setAttribute("href","edit-loops.php?lp_id=" + jsonData[i].lp_id);
      aEdit.classList.add("actionBtn");
      aEdit.style.color = "#e31568";
      tdView.appendChild(aEdit);
      var aDlt = document.createElement("a");
      var iDlt = document.createElement("i");
      iDlt.classList.add("bi");
      iDlt.classList.add("bi-trash");
      aDlt.appendChild(iDlt);
      aDlt.setAttribute("href","manage-loops.php");
      aDlt.setAttribute("onclick","return deleteLoops('" + jsonData[i].lp_id + "');");
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
function deleteLoops(lp_id){
  var check = confirm("Are you sure to delete the loops with ID = " + lp_id + " ?");
  if(check){
    var dltXML = new XMLHttpRequest();
    dltXML.open("get","delete-loops.php?lp_id=" + lp_id);
    dltXML.send();
    dltXML.onload = function(){
        alert("Deleted successfully.");
        window.location.replace("manage-loops.php");
    };
  }
  else{
    window.location.replace("manage-loops.php");
  }
  }
</script>
</body>
</html>