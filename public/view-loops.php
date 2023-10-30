<?php include("../commonPHP/head.php");
//include("../global_modal.php");
?>

<?php
extract($_COOKIE);
include '../dbconnect.php';
// echo $userType;
// exit;
// if (!session_id()) {
//     session_start();
// }
// if ($_SESSION["userType"] != '2' && $_SESSION["userType"] != '3' && $_SESSION["userType"] != '4') {
//     echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
// }
// ?>


<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->


<?php include("../commonPHP/topNavBarCheck.php"); ?>
<style>
     body {
        background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 110%;
        background-position: top center;
        /* background-repeat: no-repeat; */
    }
    .img-fluid1 {
        height: 100%;
        width: 100%;
        border-radius: 10%;
        /* margin-bottom: 5%; */

    }
   
</style>

<body>

    <main id="main">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" style="background-image: url('../assets/loops/img/Loop_Banner.png'); background-size:100%; background-repeat: no-repeat;">
                    <div class="col-md-10">
                        <div class="text-right" style="padding-left: 65%; padding-top: 12%; padding-bottom: 12%;">
                       
                            <h1 class="display-1" style="font-size: 6vw;">LOOPS</h1>
                            <p style="font-size: 2vw;">Do more learn more</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container mt-3 bg-white" >
            <div class="row shadow p-2">
                <div class="col-md-6">
                    <input type="text" id="mysearch" class="form-control" placeholder="Search...">
                </div>
            </div>
        </div> -->
        <?php if($userType=='Teacher'){ 
            
        ?>
               <div class="container" id="talent">
                <div class="row py-4">
                    <!-- <h2 class="text-center">Loop Heading</h2> -->
                    <?php
      $query = "SELECT * FROM `tb_mindbooster`";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($result)) {
        $s_id = $row['mb_id'];
        $subjectName = $row['mb_sub_name'];
        $filename = $row['mb_sub_image'];
        $mb_sub_desc = $row['mb_sub_desc'];
        $mb_sub_released_date = $row['mb_sub_released_date'];
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card"  data-toggle="modal" data-target="#globalModal">
                            <div style="height: 200px; overflow: hidden;" class="">
                                <img src="<?php echo $filename; ?>" class="card-img-top" alt="Subject Image" style="object-fit: cover; height: 100%; width: 100%;">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-black"><?php echo $subjectName; ?></h4>
                                <div class="card-title text-black "><?php echo $mb_sub_desc; ?></div>
                                <div class="card-title text-secondary"><?php echo date('y-F-d', strtotime($mb_sub_released_date)); ?></div>
                                
                                <div class="form-select bg-info mt-auto" onclick="return false">
                                    <option value="">Select Grade</option>
                                    <!-- <option value="1">Level 1</option>
                                    <option value="2">Level 2</option>
                                    <option value="3">Level 3</option>
                                    <option value="4">Level 4</option>
                                    <option value="5">Level 5</option>
                                    <option value="6">Level 6</option> -->
      </div>
                               
                            </div>
                        </div>
         </div>
      <?php
      }
      ?>
               </div>
               </div>
        <?php  
        }
        else if($userType=='Parent'){ 
           
        ?>
             <div class="container-fluid">
                <div class="row">
                    <div class="text-center table-responsive">
                        <div class=" pt-5">
                            <ul class="nav nav-tabs fs-4 d-flex justify-content-center">
                                <li class="nav-item">
                                    <button class="nav-link active text-uppercase fw-bolder" data-bs-toggle="tab" data-bs-target="#category1">Bonding Time</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link text-uppercase fw-bolder" data-bs-toggle="tab" data-bs-target="#category2">Teaching Resources</button>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="category1">
                                <div class=" text-center ">
                                    <div class="container  py-5 px-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" id="search-input1" class="form-control" placeholder="Search...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="container1 py-3 px-5">
                                            <div class="row d-flex justify-content-center">

                                                <?php
                                                $rows_per_page = 6;
                                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                                                $offset = ($current_page - 1) * $rows_per_page;
                                                $type = '1';

                                                $query = "SELECT * FROM `tb_loops` WHERE `lp_type` = '$type' LIMIT $rows_per_page OFFSET $offset";
                                                $result = mysqli_query($conn, $query);

                                                if (mysqli_num_rows($result) > 0) {
                                                    $count = 0;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        if ($count % 3 == 0) {
                                                            echo '<div class="row d-flex justify-content-center col-md-11" id="talent1">';
                                                        }

                                                        echo '<div class="col-md-3" id="talent">';
                                                        echo '<div class="card shadow p-3 rounded  d-flex flex-column" style="height:370px;">';
                                                        echo '<a href="loops-bondingtime-details.php?lp_id=' . $row['lp_id'] . '" class="" data-toggle="modal" data-target="#globalModal">';
                                                        echo '<img src="' . $row['lp_imgpath'] . '" class="card-img-top" style=" object-fit: cover; width: 100%; height: 200px;" />';
                                                        echo '</a>';
                                                        echo '<div class="card-body">';
                                                        echo '<h4 class="card-title text-dark ">' . $row['lp_title'] . '</h4>';
                                                        echo '<span class="text-secondary">' . date('j F Y', strtotime($row['lp_date'])) . '</span>';
                                                        echo '<p class="card-text text-dark">' . $row['lp_desc'] . '</p>';
                                                        echo '<a href="loops-bondingtime-details.php?lp_id=' . $row['lp_id'] . '" class="text-danger d-flex justify-content-end" data-toggle="modal" data-target="#globalModal">Read More</a>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                        echo '</div>';


                                                        $count++;


                                                        if ($count % 3 == 0) {
                                                            echo '</div>';
                                                        }
                                                    }

                                                    if ($count % 3 != 0) {
                                                        echo '</div>';
                                                    }

                                                    $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_loops` WHERE `lp_type` = '$type'"));
                                                    $total_pages = ceil($total_rows / $rows_per_page);

                                                    if ($total_pages > 1) {
                                                        echo '<nav aria-label="Page navigation">';
                                                        echo '<ul class="pagination justify-content-center py-3">';

                                                        if ($current_page > 1) {
                                                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
                                                        }

                                                        for ($i = 1; $i <= $total_pages; $i++) {
                                                            echo '<li class="page-item' . ($i == $current_page ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                                        }

                                                        if ($current_page < $total_pages) {
                                                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
                                                        }

                                                        echo '</ul>';
                                                        echo '</nav>';
                                                    }
                                                }


                                                ?>

                                            </div>


                                            <div class="col-lg-1 col-md-6 bg-white px-4 py-5"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="category2">
                        <div class=" text-center ">
                            <div class="container  py-5 px-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" id="search-input2" class="form-control" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container2 py-3 px-5">
                                    <div class="row d-flex justify-content-center" >
                                        <?php
                                        $type = '2';
                                        $query = "SELECT * FROM `tb_mindbooster`";
                                        $result = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            $count = 0;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $mb_id = $row['mb_id'];
                                                if ($count % 3 == 0) {
                                                    echo '<div class="row d-flex justify-content-center col-md-11" id="talent2" >';
                                                }
                                                echo '<div class="col-md-3 " data-toggle="modal" data-target="#globalModal">';
                                                echo '<div class="card shadow p-3 rounded  d-flex flex-column">';
                                                echo '<img src="' . $row['mb_sub_image'] . '" class="card-img-top" style=" object-fit: cover; width: 100%; height: 200px;" />';
                                                echo '<div class="card-body">';
                                                echo '<h4 class="card-title text-dark">' . $row['mb_sub_name'] . '</h4>';
                                                echo '<span class="text-secondary">' . date('j F Y', strtotime($row['mb_sub_released_date'])) . '</span>';
                                                echo '<p class="card-text text-dark">' . $row['mb_sub_desc'] . '</p>';
                                                echo '<div class="form-select bg-info mt-auto">';
                                                echo '<option value="">Select Grade</option>';
                                                // echo '<option value="1">Level 1</option>';
                                                // echo '<option value="2">Level 2</option>';
                                                // echo '<option value="3">Level 3</option>';
                                                // echo '<option value="4">Level 4</option>';
                                                // echo '<option value="5">Level 5</option>';
                                                // echo '<option value="6">Level 6</option>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                $count++;
                                                if ($count % 3 == 0) {
                                                    echo '</div>';
                                                }
                                            }
                                            if ($count % 4 != 0) {
                                                echo '</div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                     <div class="col-lg-1 col-md-6 bg-white px-4 py-5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                            <div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <!-- Add your subscription details here -->
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ac mauris velit.</p>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        


      
        <?php  
        }
        else{
         ?>
        
        
        <div class="container py-5">
            <ul class="nav nav-tabs fs-4 justify-content-center">
                <li class="nav-item">
                    <button class="nav-link text-uppercase rounded-0 btn-warning active" id="Puzzles-tab" data-bs-toggle="tab" data-bs-target="#puzzles-tab-pane" type="button" role="tab" aria-controls="puzzles-tab" aria-selected="true">puzzles</button>
                </li>
                <li class="nav-item">
                <button class="nav-link text-uppercase rounded-0 btn-warning" id="art-tab" data-bs-toggle="tab" data-bs-target="#art-tab-pane" type="button" role="tab" aria-controls="art-tab" aria-selected="false">Art & Craft</button>
                </li>
                <li class="nav-item">
                <button class="nav-link text-uppercase rounded-0 btn-warning" id="quizzes-tab" data-bs-toggle="tab" data-bs-target="#quizzes-tab-pane" type="button" role="tab" aria-controls="quizzes-tab" aria-selected="false">quizzes</button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="puzzles-tab-pane" role="tabpanel" aria-labelledby="puzzles-tab">
                
                <div class="container">
                    <div class="row">
                        <!-- <div class="py-5">
                            <h1 class="text-center">Puzzles</h1>
                        </div> -->
                        <div class="container py-5">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-4">
                                    <div class="box px-4">
                                        <!-- Box content goes here -->
                                        <a data-toggle="modal" data-target="#globalModal""><img src="../assets/loops/img/crossword.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                                        <div class="py-4 px-4">
                                            <h4>Cross Word</h4>
                                            <p>Puzzle Game</p>
                                            <p>Easy-Medium-Hard</p>
                                        </div>
                                    </div>
                                </div>
                             
                                    <div class="col-md-4">
                                        <div class="box px-4">
                                            <!-- Box content goes here -->
                                            <a data-toggle="modal" data-target="#globalModal"><img src="../assets/loops/img/jigsaw_puzzle.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                                            <div class="py-4 px-4">
                                                <h4>Jigsaw</h4>
                                                <p>Puzzle Game</p>
                                                <p>Easy-Medium-Hard</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box px-4">
                                            <!-- Box content goes here -->
                                            <a data-toggle="modal" data-target="#globalModal"><img src="../assets/loops/img/match_words.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                                            <div class="py-4 px-4">
                                                <h4>match Words</h4>
                                                <p>Puzzle Game</p>
                                                <p>Easy-Medium-Hard</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box px-4">
                                            <!-- Box content goes here -->
                                            <a data-toggle="modal" data-target="#globalModal"><img src="../assets/loops/img/sudoku.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                                            <div class="py-4 px-4">
                                                <h4>Cross Word</h4>
                                                <p>Puzzle Game</p>
                                                <p>Easy-Medium-Hard</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box px-4">
                                            <!-- Box content goes here -->
                                            <a data-toggle="modal" data-target="#globalModal"><img src="../assets/loops/img/word_search.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                                            <div class="py-4 px-4">
                                                <h4>Cross Word</h4>
                                                <p>Puzzle Game</p>
                                                <p>Easy-Medium-Hard</p>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="art-tab-pane" role="tabpanel" aria-labelledby="pills-profile-tab">
        

                <div class="container-fluid" style="background-color:#FFE9AC">
                    <!-- <div class="row">
                        <div class="py-5">
                            <h2 class="text-center">ART & CRAFT</h2>
                        </div>
                    </div> -->
                    <div class="container py-5">
                        <div class="row d-flex justify-content-center">
                            <?php
                            include("../dbconnect.php");
                            $query = "SELECT `lp_id`, `lp_title`, `lp_imgpath`, `lp_filepath`, `lp_desc`, `lp_date`, `lp_type` FROM `tb_loops` WHERE `lp_type` = 1";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $lp_imgpath = $row['lp_imgpath'];
                                    $lp_title = $row['lp_title'];
                                    $lp_desc = $row['lp_desc'];
                            ?>
                                    <div class="col-md-3">
                                        <div class="box px-4">
                                            <!-- Box content goes here -->
                                            <a data-toggle="modal" data-target="#globalModal">
                                                <img src="<?php echo $lp_imgpath; ?>" class="img-fluid1" style="border-radius: 10%;" />
                                            </a>

                                            <div class="py-4 px-4">
                                                <h4><?php echo $lp_title; ?></h4>
                                                <p><?php echo $lp_desc; ?></p>
                                                <p style="color: red;">Read More</p>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "No records found.";
                            }
                            mysqli_close($conn);
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="quizzes-tab-pane" role="tabpanel" aria-labelledby="quizzes-tab">

<div class="container-fluid">
    <div class="row">
        <!-- <div class="py-5">
            <h2 class="text-center">QUIZZES</h2>
        </div> -->
        <div class="container1 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-3">
                    <div class="box px-4">
                        <!-- Box content goes here -->
                        <a data-toggle="modal" data-target="#globalModal"><img src="../assets/loops/img/quiz1.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                        <div class="py-4 px-4">
                            <h4>Test Your Knowledge</h4>
                            <p>Quiz Game</p>
                            <p>Easy</p>
                        </div>
                    </div>
                </div>
             
                    <div class="col-md-3">
                        <div class="box px-4">
                            <!-- Box content goes here -->
                            <a data-toggle="modal" data-target="#globalModal"><img src="../assets/loops/img/quiz2.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                            <div class="py-4 px-4">
                                <h4>Explore Your IQ</h4>
                                <p>Quiz Game</p>
                                <p>Easy</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box px-4">
                            <!-- Box content goes here -->
                            <a data-toggle="modal" data-target="#globalModal"><img src="../assets/loops/img/quiz3.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                            <div class="py-4 px-4">
                                <h4>Challenge Your Mind</h4>
                                <p>Quiz Game</p>
                                <p>Easy</p>
                            </div>
                        </div>
                    </div>
               

            </div>
        </div>
    </div>
</div>
</div>
                                </div>

        </div><!-- End Portfolio Container -->
<?php } ?>
        </div>

        </div>
        </section>



        </div>

        </div>

        </div>
        </section>

    </main><!-- End #main -->

    <?php include("../commonPHP/footer.php"); ?>
    <?php include("../global_modal.php"); ?>
    <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->
   
    <?php include("../commonPHP/jsFiles.php"); ?>

    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
                $(document).ready(function() {
                  $("#mysearch").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#talent div").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                  });
                });
</script>
<script>
    $(document).ready(function() {
        $("#search-input1").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            $(".container1 #talent1 .col-md-3").filter(function() {
                var title = $(this).find(".card-title").text().toLowerCase();
                return title.indexOf(searchText) == -1;
            }).hide();
            $(".container1 #talent1 .col-md-3").filter(function() {
                var title = $(this).find(".card-title").text().toLowerCase();
                return title.indexOf(searchText) != -1;
            }).show();
        });
        $("#search-input2").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            $(".container2 #talent2 .col-md-3").filter(function() {
                var title = $(this).find(".card-title").text().toLowerCase();
                return title.indexOf(searchText) == -1;
            }).hide();
            $(".container2 #talent2 .col-md-3").filter(function() {
                var title = $(this).find(".card-title").text().toLowerCase();
                return title.indexOf(searchText) != -1;
            }).show();
        });
    });
</script>
</body>

</html>