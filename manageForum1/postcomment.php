<?php
// Place this code at the beginning of the PHP file

if (!session_id()) {
  session_start();

  if ($_SESSION["userType"] != '1') {
    header('location: ../login_and_register/login.php');
  }
}

if (!isset($_GET['forumtopic_id'])) {
  header('Location: manageforum.php');
}

include '../dbconnect.php';
extract($_GET);

$community_name = '';
$sql = "SELECT * from forum_topic where forumtopic_id='$forumtopic_id'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
  $ft_name = $row['ft_name'];
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
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">
      <h2 style="text-align: center;">Comments -> <?= $ft_name ?></h2>
      <br>
      <div class="row gy-4">
        <div class="d-flex justify-content-between">
          <a href="ForumTopics.php?forum_id=<?= $forum_id ?>" class="btn btn-warning btn-sm "><i class="bi bi-arrow-left"></i> Back</a>
        </div>
        <div class="col-lg-12">
          <table id="magTbl" class="table datatable table-warning table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">Sno</th>
                <th scope="col">Comment</th>
                <th scope="col">Commented By</th>
                <th scope="col">Likes</th>
                <th scope="col">Dislikes</th>
                <th scope="col">Commented Date</th>
                <th scope="col">Status</th>
                <th scope="col" style="text-align: center;">Actions</th>
              </tr>
            </thead>
            <tbody id="tbody">
              <tr>
                <td scope="row" colspan="10" style="text-align: center;">No comments available on this post</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include("../commonPHP/footer_admin.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script>
  var xhr = new XMLHttpRequest();

  xhr.open("get", "./forumQuery.php?topiccomments=yes&forumtopic_id=<?= $forumtopic_id ?>");

  xhr.send();

  xhr.onload = function() {
    var jsonData = JSON.parse(xhr.responseText);
    if (jsonData.length > 0) {
      var tr = document.querySelector("#tbody tr");
      var tbody = document.getElementById("tbody");
      tbody.removeChild(tr);
      for (var i = 0; i < jsonData.length; i++) {
        var newtr = document.createElement("tr");

        var tdID = document.createElement("th");
        tdID.setAttribute("scope", "row");
        tdID.innerHTML = 1 + i;

        var tdTitle = document.createElement("td");
        tdTitle.innerHTML = jsonData[i].content;
        var tdCommentedby = document.createElement("td");
        tdCommentedby.innerHTML = jsonData[i].u_full_name;

        var tdLikes = document.createElement("td");
        tdLikes.innerHTML = jsonData[i].likes;

        var tdDislikes = document.createElement("td");
        tdDislikes.innerHTML = jsonData[i].dislikes;

        var tdDate = document.createElement("td");
        tdDate.innerHTML = jsonData[i].created_at.substring(0, 10);

        var tdStatus = document.createElement("td");
        var toggleButton = document.createElement("button");

        if (jsonData[i]?.approved == 1) {
          toggleButton.textContent = 'Unapprove';
          toggleButton.classList.add("btn", "btn-sm", "toggle-button", "btn-danger");
        } else if (jsonData[i]?.approved == 0) {
          toggleButton.textContent = 'Approve';
          toggleButton.classList.add("btn", "btn-sm", "toggle-button", "btn-success");
        } else {
          toggleButton.textContent = 'Not Set';
          toggleButton.classList.add("btn", "btn-sm", "toggle-button", "btn-secondary");
        }

        // Add Bootstrap Toolkit classes
        toggleButton.classList.add("btn", "btn-sm", "toggle-button");

        toggleButton.addEventListener("click", (function(commentData, button) {
          return function() {
            var commentId = commentData.comment_id;
            var newStatus = commentData.approved == 1 ? 0 : 1;

            // Send AJAX request to update comment status
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "updateCommentStatus.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
              if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the button text and perform necessary UI changes
                if (newStatus == 1) {
                  button.textContent = 'Approve';
                  button.classList.remove("btn-primary");
                  button.classList.add("btn-danger");
                } else {
                  button.textContent = 'Unapprove';
                  button.classList.remove("btn-danger");
                  button.classList.add("btn-primary");
                }
                window.location.reload()
              }
            };

            xhr.send("commentId=" + commentId + "&newStatus=" + newStatus);
          };
        })(jsonData[i], toggleButton));

        tdStatus.appendChild(toggleButton);



        var tdActions = document.createElement("td");
        var aView = document.createElement("a");
        var iView = document.createElement("i");
        iView.classList.add("bi", "bi-eye", "m-2");
        aView.appendChild(iView);
        aView.setAttribute("href", "viewArticles.php?ca_id=" + jsonData[i].comment_id + "&forumtopic_id=" + jsonData[i].forumtopic_id + "&forum_id=<?= $forum_id ?>");
        aView.classList.add("actionBtn");
        aView.style.color = "#e31568";
        tdActions.appendChild(aView);

        var aDelete = document.createElement("a");
        var iDelete = document.createElement("i");
        iDelete.classList.add("bi", "bi-trash");
        aDelete.appendChild(iDelete);
        aDelete.setAttribute("href", "postcomment.php?forumtopic_id=<?= $forumtopic_id?>&forum_id=<?= $forum_id?>");
        aDelete.setAttribute("onclick", "return deleteComment('" + jsonData[i].comment_id + "')");
        aDelete.setAttribute("id", "dltBtn");
        aDelete.classList.add("actionBtn");
        aDelete.style.color = "#e31568";
        tdActions.appendChild(aDelete);

        newtr.appendChild(tdID);
        newtr.appendChild(tdTitle);
        newtr.appendChild(tdCommentedby);
        newtr.appendChild(tdLikes);
        newtr.appendChild(tdDislikes);
        newtr.appendChild(tdDate);
        newtr.appendChild(tdStatus);
        newtr.appendChild(tdActions);

        tbody.appendChild(newtr);
      }
    }
  }

  $(document).ready(function() {
    $('#magTbl').DataTable();
  });
</script>
<script>
  function deleteComment(comment_id) {
    var check = confirm("Are you sure to delete" );
    if (!check) {
      return false;
    }
    var dltXML = new XMLHttpRequest();
    dltXML.open("get", "deletecomment.php?comment_id=" + comment_id);
    dltXML.send();
    dltXML.onload = function() {
      // alert("Deleted successfully.");
      // window.location.reload();
      alert(this.responseText);
      // return false;
      window.location.reload();
    };
    return false;
  }
</script>