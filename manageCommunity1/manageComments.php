<?php      
  if(!session_id())
  {
    session_start();
    
    if($_SESSION["userType"]!='1')
    {
      header ('location: ../login_and_register/login.php');
    }
    
  }
extract($_GET);
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

        <h2 style="text-align: center;">Manage Comments</h2>

        <br>

        <div class="row gy-4">

          <a href="communityArticles.php?cc_id=<?= $cc_id ?>&community_id=<?= $community_id ?>" class="btn btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">
            
            <table id="magTbl" class="table datatable table-warning table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Likes</th>
                        <th scope="col">Dislikes</th>
                        <th scope="col">Actions</th>
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

  xhr.open("get", "./communityQuery.php?allComments_community_articles=yes&artcile_id=<?= $ca_id ?>");

  xhr.send();

  xhr.onload = function(){
    console.log(xhr.responseText)

    var jsonData = JSON.parse(xhr.responseText);
    // console.log(xhr.responseText)
    // return false;
    //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIVED DATA.

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
      tdTitle.innerHTML = jsonData[i].comment_content;
      newtr.appendChild(tdTitle);

      var tdDescription = document.createElement("td");
      tdDescription.innerHTML = jsonData[i].created_by;
      newtr.appendChild(tdDescription); 

      var tdDate = document.createElement("td");
      tdDate.innerHTML = jsonData[i].created_at.substring(0,10);
      newtr.appendChild(tdDate);

      var tdStatus = document.createElement("td");
      tdStatus.innerHTML = jsonData[i].approved==1?'Published':'Unpublished';
      newtr.appendChild(tdStatus);

      var likes = document.createElement("td");
      likes.innerHTML = jsonData[i].likes?jsonData[i].likes:0;
      newtr.appendChild(likes); 

      var dislikes = document.createElement("td");
      dislikes.innerHTML = jsonData[i].dislikes?jsonData[i].dislikes:0;
      newtr.appendChild(dislikes); 
      
      var tdView = document.createElement("td");

      // var aView = document.createElement("a");
      var aView = document.createElement("a");
      var iView = document.createElement("i");
      iView.classList.add("bi");
      iView.classList.add("bi-pencil-square");
      iView.classList.add("m-2");
      aView.appendChild(iView);
      aView.setAttribute("href","viewComment.php?comment_id=" + jsonData[i].comment_id+"&ca_id="+jsonData[i].article_id);
      aView.classList.add("actionBtn");
      aView.style.color = "#e31568";
      tdView.appendChild(aView);

      var aDlt = document.createElement("a");
      var iDlt = document.createElement("i");
      iDlt.classList.add("bi");
      iDlt.classList.add("bi-trash");
      aDlt.appendChild(iDlt);
      aDlt.setAttribute("href","manageCommunity.php");
      aDlt.setAttribute("onclick","return deleteComment('" + jsonData[i].comment_id + "');");
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
function deleteComment(c_id){
  var check = confirm("Are you sure to delete comment?");
  if(!check){
    return false;
  }
    var dltXML = new XMLHttpRequest();
    dltXML.open("get","deleteComment.php?comment_id=" + c_id);
    dltXML.send();
    dltXML.onload = function(){
        alert(this.responseText);
        window.location.reload();
    }; 
    return false;
  }
</script>
</body>
</html>