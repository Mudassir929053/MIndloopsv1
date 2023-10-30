<?php include("../commonPHP/head.php"); ?>

<?php

if (!session_id()) {
    session_start();
}
if ($_SESSION["userType"] != '2' && $_SESSION["userType"] != '3' && $_SESSION["userType"] != '4') {
    echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
    // header("../login_and_register/login.php");
}
include("../dbconnect.php");
// Get the user ID of the logged-in user (you need to implement this based on your authentication mechanism)
$userID = $_SESSION['u_id'];
$isPremiumUser = true;

// Retrieve the user's subscription end date from the database
$query = "SELECT *  FROM tb_users A LEFT JOIN subscription S on A.u_parent_user_id=S.subscriber_id  WHERE subscriber_id = (select u_parent_user_id from tb_users where u_id=$userID)";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error executing query: " . mysqli_error($conn);
    // Handle the error appropriately
} else {
    while ($user = mysqli_fetch_assoc($result)) {
        $subscriptionEndDate = $user['s_end_date'];

        // Compare the subscription end date with the current date
        $currentDate = date('Y-m-d');
        $isPremiumUser = ($subscriptionEndDate >= $currentDate);
    }
}
?>

<link rel="stylesheet" href="../assets/css/style.css">
<link href="../assets/vendor/aos-portfolio/aos.css" rel="stylesheet">
<link href="../assets/vendor/glightbox-portfolio/css/glightbox.min.css" rel="stylesheet">
<link href="../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-***" crossorigin="anonymous" />
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->


<?php include("../commonPHP/topNavBarCheck.php"); ?>

<link rel="stylesheet" href="../assets/css/student.css">

<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 py-md-5" style="background-image: url('../assets/loops/img/Loop_Banner.png'); background-size:100%;background-repeat: no-repeat;">
                <div class="col-md-10">
                    <div class="text-right" style="padding-left: 65%; padding-top: 8%;">
                        <h1 class="display-1" style="font-size: 6vw;">LOOPS</h1>
                        <p style="font-size: 2vw;">Do more learn more</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                    <a href="../games/crossword/index.php"><img src="../assets/loops/img/crossword.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                                    <div class="py-4 px-4">
                                        <h4>Cross Word</h4>
                                        <p>Puzzle Game</p>
                                        <p>Easy-Medium-Hard</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (!$isPremiumUser) {
                            ?>
                                <div class="col-md-4">
                                    <div class="box px-4">
                                        <!-- Box content goes here -->
                                        <div class="position-relative">
                                            <img src="../assets/loops/img/jigsaw_puzzle.png" class="img-fluid1" style="border-radius: 10%; filter: blur(5px);" />
                                            <button type="button" class="btn btn-primary position-absolute top-50 start-50 translate-middle" data-bs-toggle="modal" data-bs-target="#premiumModal" style="background-color: #E91E63;">Premium 🔒</button>
                                        </div>
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
                                        <!-- Box content goes here -->
                                        <div class="position-relative">
                                            <img src="../assets/loops/img/match_words.png" class="img-fluid1" style="border-radius: 10%; filter: blur(5px);" />
                                            <button type="button" class="btn btn-primary position-absolute top-50 start-50 translate-middle" data-bs-toggle="modal" data-bs-target="#premiumModal" style="background-color: #E91E63;">Premium 🔒</button>
                                        </div>
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
                                        <div class="position-relative">
                                            <img src="../assets/loops/img/sudoku.png" class="img-fluid1" style="border-radius: 10%;filter: blur(5px);" />
                                            <button type="button" class="btn btn-primary position-absolute top-50 start-50 translate-middle" data-bs-toggle="modal" data-bs-target="#premiumModal" style="background-color: #E91E63;">Premium 🔒</button>
                                        </div>
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
                                        <div class="position-relative">
                                            <img src="../assets/loops/img/word_search.png" class="img-fluid1" style="border-radius: 10%;filter: blur(5px);" />
                                            <button type="button" class="btn btn-primary position-absolute top-50 start-50 translate-middle" data-bs-toggle="modal" data-bs-target="#premiumModal" style="background-color: #E91E63;">Premium 🔒</button>
                                        </div>
                                        <div class="py-4 px-4">
                                            <h4>Cross Word</h4>
                                            <p>Puzzle Game</p>
                                            <p>Easy-Medium-Hard</p>
                                        </div>
                                    </div>
                                </div>
                            <?php } else {
                            ?>
                                <div class="col-md-4">
                                    <div class="box px-4">
                                        <!-- Box content goes here -->
                                        <a href="../games/jigsaw/index.php"><img src="../assets/loops/img/jigsaw_puzzle.png" class="img-fluid1" style="border-radius: 10%;" /></a>
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
                                        <a href="../games/match_words/index.php"><img src="../assets/loops/img/match_words.png" class="img-fluid1" style="border-radius: 10%;" /></a>
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
                                        <a href="../games/suduko/index.php"><img src="../assets/loops/img/sudoku.png" class="img-fluid1" style="border-radius: 10%;" /></a>
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
                                        <a href="../games/wordsearch/index.php"><img src="../assets/loops/img/word_search.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                                        <div class="py-4 px-4">
                                            <h4>Cross Word</h4>
                                            <p>Puzzle Game</p>
                                            <p>Easy-Medium-Hard</p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- <div class="tab-content" id="pills-tabContent"> -->
        <div class="tab-pane fade" id="art-tab-pane" role="tabpanel" aria-labelledby="pills-profile-tab">
            <?php
            if (!$isPremiumUser) {
            ?>
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
                            $firstBox = true; // Flag to track the first box
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $lp_imgpath = $row['lp_imgpath'];
                                    $lp_title = $row['lp_title'];
                                    $lp_desc = $row['lp_desc'];
                            ?>
                                    <div class="col-md-3">
                                        <div class="box px-4">
                                            <!-- Box content goes here -->
                                            <?php if ($firstBox || $isPremiumUser) { ?>
                                                <a href="view-loops-details.php?lp_id=<?php echo $row['lp_id']; ?>">
                                                    <img src="<?php echo $lp_imgpath; ?>" class="img-fluid1" style="border-radius: 10%;" />
                                                </a>
                                            <?php } else { ?>
                                                <div class="position-relative">
                                                    <img src="<?php echo $lp_imgpath; ?>" class="img-fluid1" style="border-radius: 10%; filter: blur(5px);" />
                                                    <button type="button" class="btn btn-primary position-absolute top-50 start-50 translate-middle" data-bs-toggle="modal" data-bs-target="#premiumModal" style="background-color: #E91E63;">Premium 🔒</button>
                                                </div>
                                            <?php } ?>

                                            <div class="py-4 px-4">
                                                <h4><?php echo $lp_title; ?></h4>
                                                <p><?php echo $lp_desc; ?></p>
                                                <?php if ($firstBox) { ?>
                                                    <!-- <p style="color: red;">Read More</p> -->
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    $firstBox = false; // Set the flag to false after displaying the first box
                                }
                            } else {
                                echo "No records found.";
                            }
                            mysqli_close($conn);
                            ?>
                        </div>
                    </div>
                </div>
            <?php } else { ?>

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
                                            <a href="view-loops-details.php?lp_id=<?php echo $row['lp_id']; ?>">
                                                <img src="<?php echo $lp_imgpath; ?>" class="img-fluid1" style="border-radius: 10%;" />
                                            </a>

                                            <div class="py-4 px-4">
                                                <h4><?php echo $lp_title; ?></h4>
                                                <p><?php echo $lp_desc; ?></p>
                                                <!-- <p style="color: red;">Read More</p> -->
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

            <?php } ?>
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
                                    <a href="../quizes/quiz1/category.php"><img src="../assets/loops/img/quiz1.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                                    <div class="py-4 px-4">
                                        <h4>Test Your Knowledge</h4>
                                        <p>Quiz Game</p>
                                        <p>Easy</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (!$isPremiumUser) {
                            ?>
                                <div class="col-md-3">
                                    <div class="box px-4">
                                        <!-- Box content goes here -->
                                        <div class="position-relative">
                                            <img src="../assets/loops/img/quiz2.png" class="img-fluid1" style="border-radius: 10%;filter: blur(5px);" />
                                            <button type="button" class="btn btn-primary position-absolute top-50 start-50 translate-middle" data-bs-toggle="modal" data-bs-target="#premiumModal" style="background-color: #E91E63;">Premium 🔒</button>
                                        </div>
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
                                        <div class="position-relative">
                                            <img src="../assets/loops/img/quiz3.png" class="img-fluid1" style="border-radius: 10%;filter: blur(5px);" />
                                            <button type="button" class="btn btn-primary position-absolute top-50 start-50 translate-middle" data-bs-toggle="modal" data-bs-target="#premiumModal" style="background-color: #E91E63;">Premium 🔒</button>
                                        </div>
                                        <div class="py-4 px-4">
                                            <h4>Challenge Your Mind</h4>
                                            <p>Quiz Game</p>
                                            <p>Easy</p>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-3">
                                    <div class="box px-4">
                                        <!-- Box content goes here -->
                                        <a href="../quizes/quiz2/match.php"><img src="../assets/loops/img/quiz2.png" class="img-fluid1" style="border-radius: 10%;" /></a>
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
                                        <a href="../quizes/quiz3/index.html"><img src="../assets/loops/img/quiz3.png" class="img-fluid1" style="border-radius: 10%;" /></a>
                                        <div class="py-4 px-4">
                                            <h4>Challenge Your Mind</h4>
                                            <p>Quiz Game</p>
                                            <p>Easy</p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include("../commonPHP/footer.php"); ?>

    <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->



    <script>
        var userType;

        var userTypeXHR = new XMLHttpRequest();

        userTypeXHR.open('get', '../commonPHP/check-usertype.php');

        userTypeXHR.send();

        userTypeXHR.onload = function() {

            var userTypeData = JSON.parse(userTypeXHR.responseText);

            userType = userTypeData["userType"];

            var ulFilters = document.getElementById("portfolio-flters");

            if (userTypeData["userType"] === "Teacher") {

                var liReadToGoLessons = document.createElement("li");
                liReadToGoLessons.innerHTML = "Read To Go Lessons";
                liReadToGoLessons.setAttribute("data-filter", ".filter-readToGoLessons");
                ulFilters.appendChild(liReadToGoLessons);

                var liRecources = document.createElement("li");
                liRecources.innerHTML = "Recources";
                liRecources.setAttribute("data-filter", ".filter-resources");
                ulFilters.appendChild(liRecources);


            } else if (userTypeData["userType"] === "Parent") {


                var liTeachingResources = document.createElement("li");
                liTeachingResources.innerHTML = "Teaching Resources";
                liTeachingResources.setAttribute("data-filter", ".filter-teachingResources");
                ulFilters.appendChild(liTeachingResources);

                var liActivities = document.createElement("li");
                liActivities.innerHTML = "Activities";
                liActivities.setAttribute("data-filter", ".filter-activities");
                ulFilters.appendChild(liActivities);

                var liSkills = document.createElement("li");
                liSkills.innerHTML = "Skills";
                liSkills.setAttribute("data-filter", ".filter-skills");
                ulFilters.appendChild(liSkills);

                var liFamilyGames = document.createElement("li");
                liFamilyGames.innerHTML = "Family Games";
                liFamilyGames.setAttribute("data-filter", ".filter-familyGames");
                ulFilters.appendChild(liFamilyGames);


            } else if (userTypeData["userType"] === "Student") {


                // var liPuzzles = document.createElement("li");
                // liPuzzles.innerHTML = "Puzzles";
                // liPuzzles.setAttribute("data-filter",".filter-puzzles");
                // ulFilters.appendChild(liPuzzles);

                // var liArtsCrafts = document.createElement("li");
                // liArtsCrafts.innerHTML = "Arts & Craft";
                // liArtsCrafts.setAttribute("data-filter",".filter-artsCrafts");
                // ulFilters.appendChild(liArtsCrafts);

                // var liQuizzes = document.createElement("li");
                // liQuizzes.innerHTML = "Quizzes";
                // liQuizzes.setAttribute("data-filter",".filter-quizzes");
                // ulFilters.appendChild(liQuizzes);


            }

        }
    </script>


    <script>
        var allLoopsXHR = new XMLHttpRequest();

        allLoopsXHR.open('get', '../loops/read-all-loops.php');

        allLoopsXHR.send();

        allLoopsXHR.onload = function() {

            var wrapTarget = document.getElementById("wrapTarget");
            var jsonLoopsData = JSON.parse(allLoopsXHR.responseText);

            for (var i = 0; i < jsonLoopsData.length; i++) {

                // if(userType === jsonLoopsData[i].t_audience){


                var portfolioItemDiv = document.createElement("div");
                portfolioItemDiv.classList.add("col-xl-4");
                portfolioItemDiv.classList.add("col-md-6");
                portfolioItemDiv.classList.add("portfolio-item");

                var filterClass;

                switch (jsonLoopsData[i].lp_type) {
                    case "LPT1":
                        filterClass = "filter-puzzles";
                        break;
                    case "LPT2":
                        filterClass = "filter-artsCrafts";
                        break;
                    case "LPT3":
                        filterClass = "filter-quizzes";
                        break;
                    case "LPT4":
                        filterClass = "filter-teachingResources";
                        break;
                    case "LPT5":
                        filterClass = "filter-activities";
                        break;
                    case "LPT6":
                        filterClass = "filter-skills";
                        break;
                    case "LPT7":
                        filterClass = "filter-familyGames";
                        break;
                    case "LPT8":
                        filterClass = "filter-readToGoLessons";
                        break;
                    case "LPT9":
                        filterClass = "filter-resources";
                        break;
                    default:
                        filterClass = "";
                }

                portfolioItemDiv.classList.add(filterClass);




                var portfolioWrapDiv = document.createElement("div");
                portfolioWrapDiv.classList.add("portfolio-wrap");


                var aImg = document.createElement("a");
                aImg.setAttribute("href", jsonLoopsData[i].lp_imgpath);
                aImg.setAttribute("target", "_blank");
                aImg.setAttribute("data-gallery", "portfolio-gallery-app");
                // aImg.classList.add("glightbox");


                var img = document.createElement("img");
                img.setAttribute("src", jsonLoopsData[i].lp_imgpath);
                img.classList.add("img-fluid");

                aImg.appendChild(img);
                portfolioWrapDiv.appendChild(aImg);


                var portfolioInfoDiv = document.createElement("div");
                portfolioInfoDiv.classList.add("portfolio-info");

                var h4Title = document.createElement("h4");

                var aTitle = document.createElement("a");
                aTitle.innerHTML = jsonLoopsData[i].lp_title;
                aTitle.setAttribute("href", "./loops-details.php?lp_id=" + jsonLoopsData[i].lp_id);
                aTitle.setAttribute("title", "More Details");


                h4Title.appendChild(aTitle);
                portfolioInfoDiv.appendChild(h4Title);


                var pDesc = document.createElement("p");
                pDesc.innerHTML = jsonLoopsData[i].lp_desc;

                portfolioInfoDiv.appendChild(pDesc);
                portfolioWrapDiv.appendChild(portfolioInfoDiv);
                portfolioItemDiv.appendChild(portfolioWrapDiv);
                wrapTarget.appendChild(portfolioItemDiv);

                // }

            }

        }
    </script>


    <?php include("../commonPHP/jsFiles.php"); ?>
    <?php include("../premium_modal.php"); ?>
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
    <script src="../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/aos-portfolio/aos.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <!-- <script src="../assets/js/main.js"></script> -->


</body>

</html>