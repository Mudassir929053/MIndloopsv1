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
include 'discount-function.php';
include("../commonPHP/adminNavBar.php"); ?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
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
            <h2 style="text-align: center;">Manage Discount</h2>
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
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Discount
                </button>
                <!-- <a href="game-crossword.php" class="btn btn-warning "><i class="bi bi-arrow-left"></i> Back</a> -->
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Discount</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form to add discount -->
                            <form action="" method="post" enctype="multipart/form-data">
                                <!-- Discount Title input -->
                                <div class="mb-3">
                                    <label for="title_input" class="form-label">Discount Title:</label>
                                    <input type="text" class="form-control" id="title_input" name="title" placeholder="Enter Discount Title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="discount_category" class="form-label">Discount Category</label>
                                    <select class="form-control" id="discount_category" name="discount_category" required>
                                        <option value="">Select a Category</option>
                                        <option value="Fashion">Fashion</option>
                                        <option value="Home">Home</option>
                                        <option value="Health">Health</option>
                                        <option value="Technology">Technology</option>
                                        <option value="Travel">Travel</option>
                                        <option value="Food">Food</option>
                                        <option value="Beauty">Beauty</option>
                                        <option value="Sports">Sports</option>
                                        <option value="Entertainment">Entertainment</option>
                                        <option value="Books">Books</option>
                                    </select>
                                </div>


                                <!-- Discount Image input -->
                                <div class="mb-3">
                                    <label for="image_input" class="form-label">Discount Image:</label>
                                    <input type="file" class="form-control" id="image_input" name="discount_image" required>
                                </div>
                                <!-- Discount Type input -->
                                <!-- <div class="mb-3">
                                    <label for="type_input" class="form-label">Discount Type:</label>
                                    <select class="form-select" id="type_input" name="discount_type" required>
                                        <option value="">Select Discount Type</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed_amount">Fixed Amount</option>
                                    </select>
                                </div> -->
                                <!-- Discount Code input -->
                                <div class="mb-3">
                                    <label for="code_input" class="form-label">Discount Code:</label>
                                    <input type="text" class="form-control" id="code_input" name="discount_code" placeholder="Enter Discount Code" required>
                                </div>
                                <!-- Discount Description input -->
                                <div class="mb-3">
                                    <label for="description_editor" class="form-label">Discount Description:</label>
                                    <!-- <div id="description_editor"></div> -->
                                    <textarea class="form-control" id="description_editor" name="description" style="position: absolute; left: -9999px;" required></textarea>
                                </div>
                                <!-- <div id="summernote"></div> -->
                                <div class="row">
                                    <div class="col">
                                        <!-- Discount Start Date input -->
                                        <div class="mb-3">
                                            <label for="start_date_input" class="form-label">Start Date:</label>
                                            <input type="date" class="form-control" id="start_date_input" name="start_date" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Discount End Date input -->
                                        <div class="mb-3">
                                            <label for="end_date_input" class="form-label">End Date:</label>
                                            <input type="date" class="form-control" id="end_date_input" name="end_date" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- Submit button -->
                                <div class="d-grid">
                                    <button type="submit" name="add_discount" class="btn btn-warning btn-sm">Add Discount</button>
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
                                <th scope="col">Logo</th>
                                <th scope="col">Discount Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Discount Code</th>
                                <th scope="col">Description</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col" colspan="3" style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr>
                                <td scope="row" colspan="10" style="text-align: center;">No discounts currently available.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End #main -->
<script>
    $('#description_editor').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
    $('form').on('submit', function() {
        var content = $('#description_editor').summernote('code');
        $('#description_editor').val(content);
    });
</script>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>

<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "read-discounts.php");
    xhr.send();
    xhr.onload = function() {
        // console.log(xhr.responseText)
        var jsonData = JSON.parse(xhr.responseText);
        // START TO MANIPULATE THE DOM TO PUT IN THE RETRIEVED DATA.
        var tbody = document.getElementById("tbody");
        tbody.innerHTML = ""; // clear the table body
        for (var i = 0; i < jsonData.length; i++) {
            var currentData = jsonData[i];
            // Create table row and cells
            var newRow = document.createElement("tr");
            var tdID = document.createElement("th");
            tdID.setAttribute("scope", "row");
            // tdID.textContent = currentData.discount_id;
            tdID.textContent = i + 1;
            // tdID.innerHTML =  // set the count value
            newRow.appendChild(tdID);
            var tdImage = document.createElement("td");
            var img = document.createElement("img");
            img.src = currentData.discount_logo_url;
            img.width = 100;
            img.height = 90;
            tdImage.appendChild(img);
            newRow.appendChild(tdImage);
            var tdTitle = document.createElement("td");
            tdTitle.textContent = currentData.title;
            newRow.appendChild(tdTitle);
            var tdTotalCategory = document.createElement("td");
            tdTotalCategory.textContent = currentData.discount_category;
            newRow.appendChild(tdTotalCategory);
            var tdCode = document.createElement("td");
            tdCode.textContent = currentData.discount_code;
            newRow.appendChild(tdCode);
            var tdDescription = document.createElement("td");
            tdDescription.textContent = currentData.description;
            newRow.appendChild(tdDescription);
            var tdStartDate = document.createElement("td");
            var startDate = new Date(currentData.start_date);
            var options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            tdStartDate.textContent = startDate.toLocaleDateString('en-US', options);
            newRow.appendChild(tdStartDate);
            var tdEndDate = document.createElement("td");
            var endDate = new Date(currentData.end_date);
            var options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            tdEndDate.textContent = endDate.toLocaleDateString('en-US', options);
            newRow.appendChild(tdEndDate);
            var tdActions = document.createElement("td");
            tdActions.setAttribute("colspan", "3");
            tdActions.style.textAlign = "center";
            var viewLink = document.createElement("a");
            viewLink.href = "view-discount.php?discount_id=" + currentData.discount_id;
            viewLink.innerHTML = '<i class="bi bi-eye"></i>';
            viewLink.style.color = "#e31568";
            viewLink.style.marginRight = "10px";
            tdActions.appendChild(viewLink);
            var editLink = document.createElement("a");
            editLink.href = "#";
            editLink.innerHTML = '<i class="bi bi-pencil-square"></i>';
            editLink.style.color = "#e31568";
            editLink.style.marginRight = "10px";
            editLink.setAttribute("data-mb-id", currentData.discount_id);
            editLink.setAttribute("discount_title", currentData.title);
            editLink.setAttribute("discount_category", currentData.discount_category);
            editLink.setAttribute("discount_image", currentData.image);
            editLink.setAttribute("discount_description", currentData.description);
            editLink.setAttribute("discount_start_date", currentData.start_date);
            editLink.setAttribute("discount_end_date", currentData.end_date);
            editLink.setAttribute("data-toggle", "modal");
            editLink.setAttribute("data-target", "#exampleModalLong");
            editLink.setAttribute("discount_discount_code", currentData.discount_code);
            editLink.setAttribute("onclick", "fillForm(this)");
            editLink.addEventListener("click", function(event) {
                event.preventDefault();
                var discountId = this.getAttribute("data-mb-id");
                var discountTitle = this.getAttribute("discount_title");
                var discountCategory = this.getAttribute("discount_category");
                var discountImage = this.getAttribute("discount_image");
                var discountDescription = this.getAttribute("discount_description");
                var discountStart_date = this.getAttribute("discount_start_date");
                var discountEnd_date = this.getAttribute("discount_end_date");
                var discountDiscount_code = this.getAttribute("discount_discount_code");
            });
            tdActions.appendChild(editLink);
            var deleteLink = document.createElement("a");
            deleteLink.href = "#";
            deleteLink.innerHTML = '<i class="bi bi-trash"></i>';
            deleteLink.id = "dltBtn_" + currentData.discount_id;
            deleteLink.style.color = "#e31568";
            tdActions.appendChild(deleteLink);
            newRow.appendChild(tdActions);
            tbody.appendChild(newRow);
            var deleteButton = document.getElementById("dltBtn_" + currentData.discount_id);
            // Add event listener for delete button
            deleteButton.addEventListener("click", (function(discountId) {
                return function(event) {
                    event.preventDefault();
                    var check = confirm("Are you sure you want to delete the Discount?");
                    if (check) {
                        fetch("delete-discount.php?discount_id=" + discountId)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error("Error deleting row");
                                }
                                alert("Deleted successfully.");
                                window.location.replace("index.php");
                            })
                            .catch(error => {
                                console.error(error);
                                alert("Error deleting row");
                            });
                    }
                };
            })(currentData.discount_id));
        }
        const dataTable = new simpleDatatables.DataTable("#mbTbl", {
            searchable: true,
            fixedHeight: false,
            sortable: true
        });
    };
    function fillForm(obj){
        // console.log(obj)
        let formUpdate = document.getElementById('update_discount');
        // console.log(formUpdate);
        formUpdate.title.value = obj.getAttribute('discount_title');
        formUpdate.discount_category.value = obj.getAttribute('discount_category').toLowerCase();
        formUpdate.discount_code.value = obj.getAttribute('discount_discount_code');
        formUpdate.description.value = obj.getAttribute('discount_description');
        formUpdate.start_date.value = obj.getAttribute('discount_start_date');
        formUpdate.end_date.value = obj.getAttribute('discount_end_date');
        // formUpdate.discount_image.value = obj.getAttribute('discount_image');
        formUpdate.discount_id.value = obj.getAttribute('data-mb-id');
        // console.log(obj.getAttribute('data-mb-id'))

        // formUpdate.description.summernote();
        $('#description_editor_edit').summernote({
            minHeight: 100
        });
    }   // Initialize Summernote editor in edit mode
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Discount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post" id="update_discount" enctype="multipart/form-data">
                                <!-- Discount Title input -->
                                <div class="mb-3">
                                    <label for="title_input" class="form-label">Discount Title:</label>
                                    <input type="text" class="form-control" id="title_input" name="title" placeholder="Enter Discount Title" value="" required>
                                    <input type="hidden" class="form-control" id="discount_input" name="discount_id" placeholder="Enter Discount Title" value="">
                                </div>
                                <div class="mb-3">
                            <label for="discount_category" class="form-label">Discount Category</label>
                            <select class="form-control" id="discount_category" name="discount_category" required>
                                <option value="">Select a Category</option>
                                <option value="fashion" >Fashion</option>
                                <option value="home" >Home</option>
                                <option value="health" >Health</option>
                                <option value="technology" >Technology</option>
                                <option value="travel" >Travel</option>
                                <option value="food" >Food</option>
                                <option value="beauty" >Beauty</option>
                                <option value="sports" >Sports</option>
                                <option value="entertainment" >Entertainment</option>
                                <option value="books" >Books</option>
                                <!-- <option value="lifestyle" >Lifestyle</option> -->
                            </select>
                        </div>

                                <!-- Discount Image input -->
                                <div class="mb-3">
                                    <label for="image_input" class="form-label">Discount Image:</label>
                                    <input type="file" class="form-control" id="image_input" name="discount_image" value="">
                                </div>
                                <!-- Discount Code input -->
                                <div class="mb-3">
                                    <label for="code_input" class="form-label">Discount Code:</label>
                                    <input type="text" class="form-control" id="code_input" name="discount_code" placeholder="Enter Discount Code" value="" required>
                                </div>
                                <!-- Discount Description input -->
                                <div class="mb-3">
                                    <label for="code_input" class="form-label">Discount Description:</label>
                                    <textarea class="form-control" id="description_editor_edit" name="description" placeholder="Enter Discount Code" required></textarea>
                                </div>
                                <!--<div class="mb-3" id="description_editor_edit">aaa</div> -->
                                <div class="row">
                                    <div class="col">
                                        <!-- Discount Start Date input -->
                                        <div class="mb-3">
                                            <label for="start_date_input" class="form-label">Start Date:</label>
                                            <input type="date" class="form-control" id="start_date_input" name="start_date" value="${discountStart_date}" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Discount End Date input -->
                                        <div class="mb-3">
                                            <label for="end_date_input" class="form-label">End Date:</label>
                                            <input type="date" class="form-control" id="end_date_input" name="end_date" value="${discountEnd_date}" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- Submit button -->
                                <div class="d-grid">
                                    <button type="submit" name="update_discount" class="btn btn-warning">Update Discount</button>
                                </div>
                            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<?php include("../commonPHP/footer_admin.php"); ?>
</body>

</html>