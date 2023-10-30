<?php
if (!session_id()) {
    session_start();

    if ($_SESSION["userType"] != '1') {
        header('location: ../login_and_register/login.php');
    }
}


?>



<?php
include 'all-game-function.php';
include("../commonPHP/adminNavBar.php"); ?>

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
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->

<main id="main">

    <div id="magazine-hero">
    </div>

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <h2 style="text-align: center;">Manage Crossword Clues</h2>

<!-- Button to Open the Modal -->


<!-- The Modal -->
<?php
$cc_id = $_GET['cc_id'];
?>
            <br>
         
<!-- Button trigger modal -->
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
<button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="getQuestions(<?php echo $id; ?>)">
  Add Clue
</button>
<a href="game-crossword.php" class="btn btn-warning "><i class="bi bi-arrow-left"></i> Back</a>
</div>


<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Clue</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form to add question -->
        <form action="" method="post">
          <!-- Question input -->
          <div class="mb-3">
            <label for="question_input" class="form-label">Clue:</label>
            <input type="text" class="form-control" id="question_input" name="cc_clue" placeholder="Enter clue" required>
          </div>
          <input type="hidden" name="cc_id" value="<?= $_GET['cc_id']; ?>">
          <!-- Answer input -->
          <div class="mb-3">
            <label for="answer_input" class="form-label">Answer:</label>
            <input type="text" class="form-control" id="answer_input" name="cc_answer" placeholder="Enter answer" required>
          </div>
          <!-- Direction select -->
          <div class="mb-3">
            <label for="direction_select" class="form-label">Direction:</label>
            <select class="form-select" id="direction_select" name="cc_direction" required>
              <option value="" selected disabled>Select direction</option>
              <option value="across">Across</option>
              <option value="down">Down</option>
            </select>
          </div>
          <!-- Row and column inputs -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="row_input" class="form-label">Row:</label>
              <input type="number" class="form-control" id="row_input" name="cc_row" placeholder="Enter row number" min="1" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="column_input" class="form-label">Column:</label>
              <input type="number" class="form-control" id="column_input" name="cc_column" placeholder="Enter column number" min="1" required>
            </div>
          </div>
          <!-- Submit button -->
          <div class="d-grid">
            <button type="submit" name="add_crossgame_clue" class="btn btn-warning">Add Clue</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

            <br><br>
            <div class="row gy-4">

                <!-- <a href="insert-mindbooster.php" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add a Crossword Game</a> -->

                <div class="col-lg-12">

                    <table id="mbTbl" class="table datatable table-warning table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Clue</th>
                                <!-- <th scope="col">Publshed</th> -->
                                <th scope="col">Answer</th>
                                <th scope="col">Direction</th>
                                <th scope="col">Row</th>
                                <th scope="col">column</th>
                                <th scope="col" colspan="3" style="text-align: center;">Actions</th>
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

<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>

<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script>
    var xhr = new XMLHttpRequest();
    xhr.open("get", "read-crossword-question.php?id=<?= $_GET['cc_id']; ?>");
    xhr.send();
    xhr.onload = function() {
        // console.log(xhr.responseText);
        // return false
        var jsonData = JSON.parse(xhr.responseText);
        //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIEVED DATA.
        var tbody = document.getElementById("tbody");
        tbody.innerHTML = ""; // clear the table body

        for (var i = 0; i < jsonData.length; i++) {
            var currentData = jsonData[i];
            // create table row and cells
            var newtr = document.createElement("tr");
            var tdID = document.createElement("th");
            tdID.setAttribute("scope", "row");
            tdID.innerHTML = currentData.clue_id;
            tdID.innerHTML = i + 1; // set the count value
            newtr.appendChild(tdID);

            var tdTitle = document.createElement("td");
            tdTitle.innerHTML = jsonData[i].cc_clue;
            newtr.appendChild(tdTitle);
            var tdTitle = document.createElement("td");
            tdTitle.innerHTML = jsonData[i].cc_answer;
            newtr.appendChild(tdTitle);

            var tdDescription = document.createElement("td");
            tdDescription.innerHTML = jsonData[i].cc_direction;
            newtr.appendChild(tdDescription);

            var tdDescription = document.createElement("td");
            tdDescription.innerHTML = jsonData[i].cc_row;
            newtr.appendChild(tdDescription);
            var tdDescription = document.createElement("td");
            tdDescription.innerHTML = jsonData[i].cc_column;
            newtr.appendChild(tdDescription);
          

            var tdActions = document.createElement("td");

            // var aView = document.createElement("a");
            // var iView = document.createElement("i");
            // iView.classList.add("bi");
            // iView.classList.add("bi-eye");
            // aView.appendChild(iView);
            // aView.setAttribute("href", "view-mindbooster.php?clue_id=" + jsonData[i].clue_id);
            // aView.classList.add("actionBtn");
            // aView.style.color = "#e31568";
            // aView.style.marginRight = "10px"; // add margin to separate from delete button
            // tdActions.appendChild(aView);

           
            var aEdit = document.createElement("a");
var iEdit = document.createElement("i");
iEdit.classList.add("bi");
iEdit.classList.add("bi-pencil-square");
aEdit.appendChild(iEdit);
aEdit.classList.add("actionBtn");
aEdit.style.color = "#e31568";
aEdit.style.marginRight = "10px"; // add margin to separate from delete button
aEdit.setAttribute("data-mb-id", jsonData[i].clue_id); // add data-mb-id attribute
aEdit.setAttribute("data-cc-clue", jsonData[i].cc_clue); // add data-mb-id attribute
aEdit.setAttribute("data-cc-answer", jsonData[i].cc_answer); // add data-mb-id attribute
aEdit.setAttribute("data-cc-column", jsonData[i].cc_column); // add data-mb-id attribute
aEdit.setAttribute("data-cc-direction", jsonData[i].cc_direction); // add data-mb-id attribute
aEdit.setAttribute("data-cc-row", jsonData[i].cc_row); // add data-mb-id attribute

// Add an event listener to the edit button to open the modal
aEdit.addEventListener("click", function() {
    var mb_id = this.getAttribute("data-mb-id");
    var cc_clue = this.getAttribute("data-cc-clue");
    var cc_answer = this.getAttribute("data-cc-answer");
    var cc_direction = this.getAttribute("data-cc-direction");
    var cc_row = this.getAttribute("data-cc-row");
    var cc_column = this.getAttribute("data-cc-column");
    var modal = document.createElement("div");
    modal.classList.add("modal");
    modal.classList.add("fade");
    modal.setAttribute("tabindex", "-1");
    modal.setAttribute("aria-labelledby", "editModalLabel");
    modal.setAttribute("aria-hidden", "true");

    // Add the modal content
    modal.innerHTML = `
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Update Clue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
        <!-- Form to add question -->
        <form action="" method="post">
          <!-- Question input -->
          <div class="mb-3">
            <label for="question_input" class="form-label">Clue:</label>
            <input type="text" class="form-control" id="question_input" name="cc_clue" value="${cc_clue}" placeholder="${cc_clue}" required>
          </div>
          <input type="hidden" name="clue_id" value="${mb_id}">
          <!-- Answer input -->
          <div class="mb-3">
            <label for="answer_input" class="form-label">Answer:</label>
            <input type="text" class="form-control" id="answer_input" name="cc_answer" value="${cc_answer}" placeholder="Enter answer" required>
          </div>
          <!-- Direction select -->
          <div class="mb-3">
            <label for="direction_select" class="form-label">Direction:</label>
            <select class="form-select" id="direction_select" name="cc_direction" required>
              <option value="" selected disabled>Select direction</option>
              <option value="across" ${cc_direction === "across" ? "selected" : ""}>Across</option>
              <option value="down" ${cc_direction === "down" ? "selected" : ""}>Down</option>
            </select>
          </div>
          <!-- Row and column inputs -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="row_input" class="form-label">Row:</label>
              <input type="number" class="form-control" id="row_input" name="cc_row" value="${cc_row}" placeholder="Enter row number" min="1" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="column_input" class="form-label">Column:</label>
              <input type="number" class="form-control" id="column_input" name="cc_column" value="${cc_column}" placeholder="Enter column number" min="1" required>
            </div>
          </div>
          <!-- Submit button -->
          <div class="d-grid">
            <button type="submit" name="Update_crossgame_clue" class="btn btn-warning">Update Clue</button>
          </div>
        </form>
      </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    `;

    document.body.appendChild(modal);

    // Show the modal
    var editModal = new bootstrap.Modal(modal);
    editModal.show();
});

tdActions.appendChild(aEdit);


var aDlt = document.createElement("a");
            var iDlt = document.createElement("i");
            iDlt.classList.add("bi");
            iDlt.classList.add("bi-trash");
            iDlt.setAttribute("id", jsonData[i].clue_id);

            aDlt.appendChild(iDlt);
            aDlt.setAttribute("href", "#");
            aDlt.setAttribute("id", "dltBtn_" +jsonData[i].clue_id);
           
            aDlt.classList.add("actionBtn");
            aDlt.style.color = "#e31568";
            tdActions.appendChild(aDlt);

            newtr.appendChild(tdActions);

            tbody.appendChild(newtr);
            var deleteButton = document.getElementById("dltBtn_" +jsonData[i].clue_id);
            // add event listener for delete button
            aDlt.addEventListener("click", (function() {
                return function(event) {
                    event.preventDefault();
                    console.log(event.target.id)
                    var check = confirm("Are you sure you want to delete the Clue");
                    if (check) {
                        fetch("delete-crossword-clue.php?clue_id=" + event.target.id)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error("Error deleting row");
                                }
                                // console.log(response)
                                alert("Deleted successfully.");
                                window.location.replace("game-view-crossword.php?cc_id=<?= $_GET['cc_id']; ?>");
                            })
                            .catch(error => {
                                console.error(error);
                                alert("Error deleting row");
                            });
                    }
                }
            })(currentData.mb_id));
        }

        const dataTable = new simpleDatatables.DataTable("#mbTbl", {
            searchable: true,
            fixedHeight: false,
            sortable: true
        });

    }
    </script>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>