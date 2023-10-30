<?php 
        
  if(!session_id())
  {
    session_start();
    
    if($_SESSION["userType"]!='1')
    {
      header ('location: ../login_and_register/login.php');
    }
    
  }
  if(!isset($_GET['forum_id'])){
    header('Location: manageForum.php');
}
include '../dbconnect.php';
extract($_GET);
// echo $forum_id;
// exit;
$forum_name ='';
$sql = "SELECT * from forum where forum_id='$forum_id'";
$result = $conn->query($sql);
while($row=$result->fetch_assoc()){
  $forum_name=($row['forum_name']);
}
// echo $forum_name;

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
<!-- 
    <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Forum - <?= $forum_name ?> </h2>

        <br>

        <div class="row gy-4">

        <div class="d-flex justify-content-between">
  <a href="addTopic.php?forum_id=<?=$forum_id?>&forum_name=<?= $forum_name ?>" class="btn btn-warning btn-sm  mx-2"><i class="bi bi-plus-circle"></i> Add Topic</a>
  <a href="manageForum.php" class="btn btn-warning btn-sm "><i class="bi bi-arrow-left"></i> Back</a>
</div>

          <div class="col-lg-12">
            
            <table id="magTbl" class="table datatable table-warning table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">Name</th>
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

  <?php  include("../commonPHP/jsFiles.php"); ?>

  <!-- <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script> -->

  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script>

  var xhr = new XMLHttpRequest();

  xhr.open("get", "./forumQuery.php?forumtopic=yes&forum_id=<?= $forum_id ?>");

  xhr.send();

  xhr.onload = function(){
    // console.log(xhr.responseText)
    // return false;

    var jsonData = JSON.parse(xhr.responseText);
    // console.log(xhr.responseText)
    var tr = document.querySelector("#tbody tr");
    var tbody = document.getElementById("tbody");    
    tbody.removeChild(tr);
    for(var i=0; i<jsonData.length; i++){
      var newtr = document.createElement("tr");
      var tdID = document.createElement("th");
      tdID.setAttribute("scope","row");
      tdID.innerHTML = 1+i;
      newtr.appendChild(tdID);
      var tdTitle = document.createElement("td");
      tdTitle.innerHTML = jsonData[i].ft_name;
      newtr.appendChild(tdTitle);
      var tdDescription = document.createElement("td");
      tdDescription.innerHTML = jsonData[i].ft_description;
      newtr.appendChild(tdDescription); 
      var tdDate = document.createElement("td");
      tdDate.innerHTML = jsonData[i].ft_created_at.substring(0,10);
      newtr.appendChild(tdDate);
      var tdStatus = document.createElement("td");
      tdStatus.innerHTML = jsonData[i].published==1?'Published':'Unpublished';
      newtr.appendChild(tdStatus);
      var tdView = document.createElement("td");
      var aView = document.createElement("a");
      var iView = document.createElement("i");
      iView.classList.add("bi");
      iView.classList.add("bi-eye");
      iView.classList.add("m-2");
      aView.appendChild(iView);
      aView.setAttribute("href","postcomment.php?forumtopic_id=" + jsonData[i].forumtopic_id+"&forum_id="+jsonData[i].forum_id);
      aView.classList.add("actionBtn");
      aView.style.color = "#e31568";
      tdView.appendChild(aView);
      var aEdit = document.createElement("a");
      var iEdit = document.createElement("i");
      iEdit.classList.add("bi");
      iEdit.classList.add("bi-pencil-square");
      iEdit.classList.add("m-2");
      aEdit.appendChild(iEdit);
      aEdit.setAttribute("href","editTopic.php?forumtopic_id=" + jsonData[i].forumtopic_id+"&forum_id="+jsonData[i].forum_id);
      aEdit.classList.add("actionBtn");
      aEdit.style.color = "#e31568";
      tdView.appendChild(aEdit);
      var aDlt = document.createElement("a");
      var iDlt = document.createElement("i");
      iDlt.classList.add("bi");
      iDlt.classList.add("bi-trash");
      aDlt.appendChild(iDlt);
      aDlt.setAttribute("href","deleteforumtopic.php");
      aDlt.setAttribute("onclick","return deleteCategory('" + jsonData[i].forumtopic_id + "','"+jsonData[i].ft_name+"');");
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
 
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script>
   
</script>

<script>

function deleteCategory(forumtopic_id,ft_name){

  var check = confirm("Are you sure to delete " + ft_name + " ?");


  if(!check){
    return false;
  }

    var dltXML = new XMLHttpRequest();

    dltXML.open("get","deleteforumtopic.php?forum_id=" + forumtopic_id);

    dltXML.send();

    dltXML.onload = function(){
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