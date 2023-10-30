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
include 'coupon-function.php';
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
            <h2 style="text-align: center;">Manage Coupons</h2>
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
                    Add Coupons
                </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Coupon</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="code_input" class="form-label">Coupon Code:</label>
                                            <input type="text" class="form-control" id="code_input" name="Coupon_code" placeholder="Enter Coupon Code Like: SPECIAL20" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="discount_input" class="form-label">Discount Percentage:</label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="discount" placeholder="20%" aria-label="20%" aria-describedby="basic-addon2">
                                            <span class="input-group-text" id="basic-addon2">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="code_input2" class="form-label">Total Redeemption Limit:</label>
                                            <input type="number" class="form-control" id="code_input2" name="redemption_limit" placeholder="Like: 100 Users" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="end_date_input" class="form-label">End Date:</label>
                                            <input type="datetime-local" class="form-control" id="end_date_input" name="end_date" required>
                                        </div>

                                    </div>
                                </div>
                                <!-- Submit button -->
                                <div class="text-center">
                                    <button type="submit" name="add_Coupon" class="btn btn-warning btn-sm">Add Coupon</button>
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
                                <th scope="col">#</th>
                                <th scope="col">COUPON CODE</th>
                                <th scope="col">DISCOUNT PERCENTAGE</th>
                                <th scope="col">REDEMPTION LIMIT</th>
                                <th scope="col">REDEMMED COUNT</th>
                                <th scope="col">EXPIRE DATE</th>
                                <th scope="col" colspan="3" style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr>
                                <td scope="row" colspan="10" style="text-align: center;">No Coupons currently available.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "read-coupons.php");
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
            // Uncomment the next line if you want to set the content of tdID with currentData.coupon_id
            // tdID.textContent = currentData.coupon_id;
            tdID.textContent = i + 1;
            newRow.appendChild(tdID);
            var tdCode = document.createElement("td");
            tdCode.textContent = currentData.code;
            newRow.appendChild(tdCode);
            var tdDiscount = document.createElement("td");
            tdDiscount.textContent = currentData.discount;
            newRow.appendChild(tdDiscount);
            var tdRedemptionLimit = document.createElement("td");
            tdRedemptionLimit.textContent = currentData.redemption_limit;
            newRow.appendChild(tdRedemptionLimit);
            var tdRedeemedCount = document.createElement("td");
            tdRedeemedCount.textContent = currentData.redeemed_count;
            newRow.appendChild(tdRedeemedCount);
            var tdExpireDate = document.createElement("td");
            var expireDate = new Date(currentData.expire_date);
            var options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric'
            };
            tdExpireDate.textContent = expireDate.toLocaleDateString('en-US', options);
            newRow.appendChild(tdExpireDate);

            var tdActions = document.createElement("td");
            tdActions.setAttribute("colspan", "3");
            tdActions.style.textAlign = "center";
           
            var editLink = document.createElement("a");
            editLink.href = "#";
            editLink.innerHTML = '<i class="bi bi-pencil-square"></i>';
            editLink.style.color = "#e31568";
            editLink.style.marginRight = "10px";
            editLink.setAttribute("data-mb-id", currentData.coupon_id);
            editLink.setAttribute("discount_code", currentData.code);
            editLink.setAttribute("discount_redemption_limit", currentData.redemption_limit);
            editLink.setAttribute("discount_start_date", currentData.start_date);
            editLink.setAttribute("discount_end_date", currentData.expire_date);
            editLink.setAttribute("discount_discount_code", currentData.discount);
            editLink.addEventListener("click", function(event) {
                event.preventDefault();
                var discountId = this.getAttribute("data-mb-id");
                var discountcode = this.getAttribute("discount_code");
                var discountredemption_limit = this.getAttribute("discount_redemption_limit");
                var discountStart_date = this.getAttribute("discount_start_date");
                var discountEnd_date = this.getAttribute("discount_end_date");
                var discountDiscount_code = this.getAttribute("discount_discount_code");
                // Create the modal element
                var modal = document.createElement("div");
                modal.classList.add("modal");
                modal.classList.add("fade");
                modal.setAttribute("tabindex", "-1");
                modal.setAttribute("aria-labelledby", "editModalLabel"+discountId);
                modal.setAttribute("aria-hidden", "true");
                // Add the modal content
                
                modal.innerHTML = `
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel${discountId}">Edit Coupon</h5>
                    <button type="button" class="btn-close" onclick="hideModal('editModalLabel${discountId}')" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                               <div class="row">
                                    <div class="col">
                                    <!-- Discount Title input -->
                                <div class="mb-3">
                                    <label for="title_input" class="form-label">Coupon Code:</label>
                                    <input type="text" class="form-control" id="title_input" name="couponcode" placeholder="Enter Discount Title" value="${discountcode}" required>
                                    <input type="hidden" class="form-control" id="discount_input" name="coupon_id" placeholder="Enter Discount Title" value="${discountId}" required>
                                </div>
                                    </div>
                                   
                                    <div class="col">
                                        <label for="discount_input" class="form-label">Discount Percentage:</label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="discount" placeholder="20%" aria-label="20%"  value="${discountDiscount_code}" aria-describedby="basic-addon2">
                                            <span class="input-group-text" id="basic-addon2">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <!-- Discount Code input -->
                                <div class="mb-3">
                                    <label for="code_input" class="form-label">Total Redeemption Limit:</label>
                                    <input type="text" class="form-control" id="code_input" name="redemption_limit" placeholder="Enter Discount Code" value="${discountredemption_limit}" required>
                                </div>
                                    </div>
                                    <div class="col">
                                        <!-- Discount End Date input -->
                                        <div class="mb-3">
                                            <label for="end_date_input" class="form-label">Expire Date:</label>
                                            <input type="datetime-local" class="form-control" id="end_date_input" name="expire_date" value="${discountEnd_date}" required>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="text-center">
                                    <button type="submit" name="update_Coupon" class="btn btn-warning btn-sm">Update Coupon</button>
                                </div>
                            </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="hideModal('editModalLabel${discountId}')">Close</button>
                </div>
            </div>
        </div>`;
                // Append the modal to the document body
                document.body.appendChild(modal);
                // Show the modal
                var bootstrapModal = new bootstrap.Modal(modal);
                bootstrapModal.show();
                $('#description_editor_edit' + discountId).summernote({
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
                    var content = $('#description_editor_edit' + discountId).summernote('code');
                    $('#description_editor_edit' + discountId).val(content);
                });
            });
            tdActions.appendChild(editLink);
            var deleteLink = document.createElement("a");
            deleteLink.href = "#";
            deleteLink.innerHTML = '<i class="bi bi-trash"></i>';
            deleteLink.id = "dltBtn_" + currentData.coupon_id;
            deleteLink.style.color = "#e31568";
            tdActions.appendChild(deleteLink);
            newRow.appendChild(tdActions);
            tbody.appendChild(newRow);
            var deleteButton = document.getElementById("dltBtn_" + currentData.coupon_id);
            // Add event listener for delete button
            deleteButton.addEventListener("click", (function(discountId) {
                return function(event) {
                    event.preventDefault();
                    var check = confirm("Are you sure you want to delete the Coupon?");
                    if (check) {
                        fetch("delete-coupon.php?coupon_id=" + discountId)
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
            })(currentData.coupon_id));
        }
        const dataTable = new simpleDatatables.DataTable("#mbTbl", {
            searchable: true,
            fixedHeight: false,
            sortable: true
        });
    };
    const hideModal = (id)=>{
        // console.log(`${"#"+id}`);
        // $(`${"#"+id}`).modal('hide');
        window.location.reload();
        
    }
    // Initialize Summernote editor in edit mode
</script>
<?php include("../commonPHP/footer_admin.php"); ?>
</body>

</html>