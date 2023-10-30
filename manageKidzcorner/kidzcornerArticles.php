<?php
if (!session_id()) {
  session_start();
  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}
if (!isset($_GET['topic_id'])) {
  header('Location: manageTopics.php');
}
include '../dbconnect.php';
extract($_GET);
// echo $community_id;
// exit;
$community_name = '';
$sql = "SELECT * from kidzcreativecorner where topic_id='$topic_id'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
  $topic_name = ($row['topic_name']);
  // $cc_id = $row['category_id'];
}
// echo $cc_id;
// var_dump($_SESSION);
// exit;
?>
<?php include("../commonPHP/adminNavBar.php"); ?>
<main id="main">
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">
      <h2 style="text-align: center;">Posts -> <?= $topic_name ?></h2>
      <br>
      <div class="row gy-4">
        <a href="addArticle.php?topic_id=<?= $topic_id ?>&cc_name=<?= $topic_name ?>" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add Post</a>
        <div class="col-lg-12">
          <table id="magTbl" class="table datatable table-warning table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">Sno</th>
                <th scope="col">Post Name</th>
                <th scope="col">Created By</th>
                <th scope="col">Created Date</th>
                <th scope="col">Status</th>
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
<?php include("../commonPHP/jsFiles.php"); ?>
<script>
  var xhr = new XMLHttpRequest();
  xhr.open("get", "./kidzcornerQuery.php?kidzcornerArticles=yes&topic_id=<?= $topic_id ?>");
  xhr.send();
  xhr.onload = function() {
    // console.log(xhr.responseText)
    // return false;
    var jsonData = JSON.parse(xhr.responseText);
    // console.log(jsonData)
    if (jsonData.length > 0) {
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
        tdTitle.innerHTML = jsonData[i].title;
        newtr.appendChild(tdTitle);
        var createdBy = document.createElement("td");
        createdBy.innerHTML = jsonData[i].owner;
        newtr.appendChild(createdBy);
        var tdDate = document.createElement("td");
        tdDate.innerHTML = jsonData[i].created_at.substring(0, 10);
        newtr.appendChild(tdDate);
        var tdStatus = document.createElement("td");
        tdStatus.innerHTML = jsonData[i].published == 1 ? 'Published' : 'Unpublished';
        newtr.appendChild(tdStatus);
        var tdView = document.createElement("td");
        var aView = document.createElement("a");
        var iView = document.createElement("i");
        iView.classList.add("bi");
        iView.classList.add("bi-eye");
        iView.classList.add("m-2");
        aView.appendChild(iView);
        aView.setAttribute("href", "viewArticles.php?kidzpost_id=" + jsonData[i].kidzpost_id + "&topic_id=" + jsonData[i].topic_id);
        aView.classList.add("actionBtn");
        aView.style.color = "#e31568";
        tdView.appendChild(aView);
        var aEdit = document.createElement("a");
        var iEdit = document.createElement("i");
        iEdit.classList.add("bi");
        iEdit.classList.add("bi-pencil-square");
        iEdit.classList.add("m-2");
        aEdit.appendChild(iEdit);
        aEdit.setAttribute("href", "editarticle.php?kidzpost_id=" + jsonData[i].kidzpost_id + "&topic_id=" + jsonData[i].topic_id);
        aEdit.classList.add("actionBtn");
        aEdit.style.color = "#e31568";
        tdView.appendChild(aEdit);
        var aComment = document.createElement("a");
        var iComment = document.createElement("i");
        iComment.classList.add("bi");
        iComment.classList.add("bi-chat");
        iComment.classList.add("m-2");
        aComment.appendChild(iComment);
        aComment.setAttribute("href", "manageComments.php?kidzpost_id=" + jsonData[i].kidzpost_id + "&topic_id=" + jsonData[i].topic_id);
        aComment.classList.add("actionBtn");
        aComment.style.color = "#e31568";
        tdView.appendChild(aComment);
        var aDlt = document.createElement("a");
        var iDlt = document.createElement("i");
        iDlt.classList.add("bi");
        iDlt.classList.add("bi-trash");
        aDlt.appendChild(iDlt);
        aDlt.setAttribute("href", "kidzcornerArticles.php?topic_id=" + jsonData[i].topic_id);
        aDlt.setAttribute("onclick", "return deleteArticle('" + jsonData[i].kidzpost_id + "','" + jsonData[i].title + "');");
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
  }
</script>
<script>
  function deleteArticle(c_id, c_name) {
    var check = confirm("Are you sure to delete " + c_name + " ?");
    if (!check) {
      return false;
    }
    var dltXML = new XMLHttpRequest();
    dltXML.open("get", "deleteArticle.php?ca_id=" + c_id);
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