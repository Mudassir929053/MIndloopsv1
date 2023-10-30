<?php      
    if(!session_id())
    {
        session_start();
    }
    if($_SESSION["userType"]!='1')
    {
        header ('location: ../login_and_register/login.php');
    }
    include("../commonPHP/adminNavBar.php");

    include('../dbconnect.php');

    $sql = "SELECT * FROM tb_discovers";
    $result= mysqli_query($conn,$sql); 
    if(!$result)
        echo $conn->error;
?>

<main id="main">

    <!-- <div id="magazine-hero"></div> -->

    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <h2 style="text-align: center;">Manage Discovers</h2>
            <br>
            <div class="row gy-4">
                <a href="insert.php" class="btn btn-warning col-lg-2"><i class="bi bi-plus-circle"></i> Add a New Discover Image</a>
                <div class="col-lg-12">
                    <table id="magTbl" class="table datatable table-warning table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image Path</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id = "tbody">
                            <?php
                                if(mysqli_num_rows($result) == 0)
                                {
                                    echo "<tr>";
                                        echo '<td scope="row" colspan="5" style="text-align: center;">No Records to be shown</td>';
                                    echo "</tr>";
                                }else
                                {
                                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                    {
                                        echo "<tr>";
                                            echo "<td>";
                                                echo $row['cd_id'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $row['cd_title'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $row['cd_desc'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $row['cd_imgPath'];
                                            echo "</td>";
                                            echo "<td style='align-content:center'>";
                                            echo '<a href="edit.php?cd_id='.$row["cd_id"].'" class="actionBtn" style="color: rgb(227, 21, 104);"><i class="bi bi-pencil-square"></i></a>';
                                            echo "&nbsp";
                            ?>
                                                <a href="delete.php?cd_id=<?php echo $row['cd_id'];?>" onclick="return confirm('Are you sure you want to delete this Discover record?')" class="actionBtn" style="color: rgb(227, 21, 104);"><i class="bi bi-trash"></i></a>
                                                &nbsp;
                                                </td>
                            <?php
                                        echo "</tr>";
                                    }
                                }
                            ?>
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
<!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
 -->
 
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
    $('#magTbl').DataTable();
});
</script>
</body>

</html>