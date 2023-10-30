<?php
if (!session_id()) {
    session_start();

    if ($_SESSION["userType"] != '1') {
        header('location: ../login_and_register/login.php');
    }
}

#publisher:"Ali Gençay" chatgpt
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

<main id="main">

    <!-- <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->
    <!-- <div class="py-5"></div> -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <h2 style="text-align: center;">Manage Crossword</h2>


            <br>
            <!-- <div class="row col-lg-6 col-md-lg-3 gy-4 ">
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="cc_name" placeholder=" Categories name">
                        <button type="submit" name="add_crossgame_categories" class="btn btn-warning">Add Categories</button>
                    </div>
                </form>
            </div> -->
            <!-- Button trigger modal -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Category
                </button>
                <!-- <a href="game-crossword.php" class="btn btn-warning "><i class="bi bi-arrow-left"></i> Back</a> -->
            </div>


            <!-- Modal -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form to add question -->
                            <form action="" method="post" enctype="multipart/form-data">
                                <!-- Question input -->
                                <div class="mb-3">
                                    <label for="question_input" class="form-label">Categories Name:</label>
                                    <input type="text" class="form-control" id="question_input" name="cc_name" placeholder="Enter Categories Name" required>
                                </div>

                                <!-- Answer input -->
                                <div class="mb-3">
                                    <label for="answer_input" class="form-label">Categories Picture:</label>
                                    <input type="file" class="form-control" id="answer_input" name="category_image" required>
                                </div>

                                <!-- Submit button -->
                                <div class="d-grid">
                                    <button type="submit" name="add_crossgame_categories" class="btn btn-warning">Add Category</button>
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
                                <th scope="col">Game categories Name</th>
                                <th scope="col">Categories Image</th>
                                <!--  <th scope="col">Level</th> -->
                                <!-- <th scope="col">Subject</th>
                                <th scope="col">Publshed Date</th> -->
                                <th scope="col">Published</th>
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
    xhr.open("get", "read-crossword-categories.php");
    xhr.send();
    xhr.onload = function() {
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
            tdID.innerHTML = currentData.mb_id;
            tdID.innerHTML = i + 1; // set the count value
            newtr.appendChild(tdID);

            var tdTitle = document.createElement("td");
            tdTitle.innerHTML = jsonData[i].cc_title;
            newtr.appendChild(tdTitle);

            var tdImage = document.createElement("td");
            var img = document.createElement("img");
            img.src = jsonData[i].cc_image_url;
            img.width = 100; // example width value
            img.height = 90; // example height value
            tdImage.appendChild(img);
            newtr.appendChild(tdImage);;


            var tdDescription = document.createElement("td");
            var badgeClass = "badge bg-warning"; // default badge class for unpublished categories
            if (jsonData[i].cc_publish == "published") {
                badgeClass = "badge bg-success"; // badge class for published categories
            }
            var badgeHtml = '<span class="' + badgeClass + '">' + jsonData[i].cc_publish + '</span>';
            tdDescription.innerHTML = badgeHtml;
            newtr.appendChild(tdDescription);


            var tdActions = document.createElement("td");

            var aView = document.createElement("a");
            var iView = document.createElement("i");
            iView.classList.add("bi");
            iView.classList.add("bi-eye");
            aView.appendChild(iView);
            aView.setAttribute("href", "game-view-crossword.php?cc_id=" + jsonData[i].mb_id);
            aView.classList.add("actionBtn");
            aView.style.color = "#e31568";
            aView.style.marginRight = "10px"; // add margin to separate from delete button
            tdActions.appendChild(aView);

            var aEdit = document.createElement("a");
            var iEdit = document.createElement("i");
            iEdit.classList.add("bi");
            iEdit.classList.add("bi-pencil-square");
            aEdit.appendChild(iEdit);
            aEdit.classList.add("actionBtn");
            aEdit.style.color = "#e31568";
            aEdit.style.marginRight = "10px"; // add margin to separate from delete button
            aEdit.setAttribute("data-mb-id", jsonData[i].mb_id); // add data-mb-id attribute
            aEdit.setAttribute("category_title", jsonData[i].cc_title); // add data-mb-id attribute
            aEdit.setAttribute("category_publish", jsonData[i].cc_publish); // add data-mb-id attribute

            // Add an event listener to the edit button to open the modal
            aEdit.addEventListener("click", function() {
                var mb_id = this.getAttribute("data-mb-id");
                var category = this.getAttribute("category_title");
                var publish = this.getAttribute("category_publish");
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
                <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="cc_id" value="${mb_id}">
                    <div class="form-group mb-3">
                        <label for="mb_title" class="form-label">Category Name:</label>
                        <input type="text" class="form-control" id="mb_title" name="cc_name" value="${category}" required>
                    </div>
                    <div class="mb-3">
                                    <label for="answer_input" class="form-label">Categories Picture:</label>
                                    <input type="file" class="form-control" id="answer_input" name="category_image" required>
                                </div>
                    <div class="form-group mb-3">
          <label for="mb_status" class="form-label">Mindbooster Status:</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="cc_status" id="mb_status1" value="published" checked>
            <label class="form-check-label" for="mb_status1">
              Publish
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="cc_status" id="mb_status2" value="unpublished">
            <label class="form-check-label" for="mb_status2">
              Unpublish
            </label>
          </div>
        </div>
                    <div class="form-group mb-3">
                        <button type="submit" name="edit_category" class="btn btn-warning">Save Changes</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>`;

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
            aDlt.appendChild(iDlt);
            aDlt.setAttribute("href", "#");
            aDlt.setAttribute("id", "dltBtn_" + currentData);
            aDlt.classList.add("actionBtn");
            aDlt.style.color = "#e31568";
            tdActions.appendChild(aDlt);

            newtr.appendChild(tdActions);

            tbody.appendChild(newtr);
            var deleteButton = document.getElementById("dltBtn_" + currentData);
            // add event listener for delete button
            aDlt.addEventListener("click", (function(mb_id) {
                return function(event) {
                    event.preventDefault();
                    var check = confirm("Are you sure you want to delete the category");
                    if (check) {
                        fetch("delete-crossword-categories.php?mb_id=" + mb_id)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error("Error deleting row");
                                }
                                alert("Deleted successfully.");
                                window.location.replace("game-crossword.php");
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



</body>

</html>