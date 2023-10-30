<?php      
if(!session_id())
{
    session_start();
    if($_SESSION["userType"] != '1')
    {
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
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <h2 style="text-align: center;">Manage Magazines</h2>
            <br>
            <div class="row gy-4">
                <a href="insert-magazine.php" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add a New Magazine</a>
                <div class="col-lg-12">
                    <table id="magTbl" class="table datatable table-warning table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Edition</th>
                                <th scope="col">Release Date (YYYY-MM-DD)</th>
                                <th scope="col">Author</th>
                                <th scope="col">Page Limit</th>
                                <th scope="col" style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr>
                                <td colspan="7" style="text-align: center;">No Records to be shown</td>
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        var xhr = new XMLHttpRequest();
        xhr.open("get", "../magazine/read-all-magazine.php");
        xhr.send();

        xhr.onload = function() {
            // console.log(this.responseText)
            var jsonData = JSON.parse(xhr.responseText);
            var tbody = document.getElementById("tbody");
            tbody.innerHTML = ""; // Clear existing table rows

            if (jsonData.length > 0) {
                for (var i = 0; i < jsonData.length; i++) {
                    var newtr = document.createElement("tr");

                    var tdID = document.createElement("td");
                    tdID.innerHTML = jsonData[i].m_id;
                    newtr.appendChild(tdID);

                    var tdTitle = document.createElement("td");
                    tdTitle.innerHTML = jsonData[i].m_title;
                    newtr.appendChild(tdTitle);

                    var tdEdition = document.createElement("td");
                    tdEdition.innerHTML = jsonData[i].m_edition;
                    newtr.appendChild(tdEdition);

                    var tdRDate = document.createElement("td");
                    tdRDate.innerHTML = jsonData[i].m_rDate.substring(0, 10);
                    newtr.appendChild(tdRDate);

                    var tdAuthor = document.createElement("td");
                    tdAuthor.innerHTML = jsonData[i].m_author;
                    newtr.appendChild(tdAuthor);

                    var tdPageLimit = document.createElement("td");
                    tdPageLimit.innerHTML = jsonData[i].m_pageLimit;
                    newtr.appendChild(tdPageLimit);

                    var tdActions = document.createElement("td");
                    tdActions.style.textAlign = "center";

                    var aView = document.createElement("a");
                    aView.setAttribute("href", "view-magazine.php?m_id=" + jsonData[i].m_id);
                    aView.classList.add("actionBtn");
                    aView.style.color = "#e31568";
                    aView.innerHTML = "<i class='bi bi-eye'></i>";
                    tdActions.appendChild(aView);

                    var aEdit = document.createElement("a");
                    aEdit.setAttribute("href", "edit-magazine.php?m_id=" + jsonData[i].m_id);
                    aEdit.classList.add("actionBtn");
                    aEdit.style.color = "#e31568";
                    aEdit.innerHTML = "<i class='bi bi-pencil-square m-2'></i>";
                    tdActions.appendChild(aEdit);

                    var aDelete = document.createElement("a");
                    aDelete.setAttribute("href", "manage-magazine.php");
                    aDelete.setAttribute("onclick", "return deleteMagazine('" + jsonData[i].m_id + "');");
                    aDelete.setAttribute("id", "dltBtn");
                    aDelete.classList.add("actionBtn");
                    aDelete.style.color = "#e31568";
                    aDelete.innerHTML = "<i class='bi bi-trash'></i>";
                    tdActions.appendChild(aDelete);

                    newtr.appendChild(tdActions);

                    tbody.appendChild(newtr);
                }
            } else {
                var tr = document.createElement("tr");
                var td = document.createElement("td");
                td.setAttribute("colspan", "7");
                td.style.textAlign = "center";
                td.innerHTML = "No Records to be shown";
                tr.appendChild(td);
                tbody.appendChild(tr);
            }

           $('#magTbl').DataTable({
               order: [[3, "desc"]] 
            });
        };
    });

    function deleteMagazine(m_id) {
        var check = confirm("Are you sure to delete the magazine with ID = " + m_id + " ?");
        if (check) {
            var dltXML = new XMLHttpRequest();
            dltXML.open("get", "delete-magazine.php?m_id=" + m_id);
            dltXML.send();
            dltXML.onload = function() {
                alert("Deleted successfully.");
                window.location.replace("manage-magazine.php");
            };
        } else {
            window.location.replace("manage-magazine.php");
        }
    }
</script>

</body>
</html>
