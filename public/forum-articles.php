<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarCheck.php");
include("../dbconnect.php");
// include("_discover.php");
include '../global_modal.php';




$forumID = $_GET['forum_id'];

// $current_user_id = $_SESSION['u_id'];
extract($_GET);
?>

<style>
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: black;
        background-size: contain;
        border-radius: 50%;
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .carousel-control-prev-icon i,
    .carousel-control-next-icon i {
        color: #077bef;
        font-size: 1.5rem;
    }

    .btn-rounded {
        border-radius: 20px;
        border: 2px solid;
    }

    .btn-pink {
        border-color: #fa1478;
    }

    .btn-sky-blue {
        border-color: skyblue;
    }

    .btn-yellow {
        border-color: yellow;
    }

    .circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: lightgrey;
        float: left;
        margin-right: 10px;
    }

    .custom-dropdown {
        border: none;
    }

    .dropdown-menu {
        min-width: 0px;
        background-color: rgba(255, 255, 255, 0.1);
        padding: 0% !important;
    }

    .dropdown-item {
        padding: 0.25rem;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .dropdown-item:hover {
        background-color: none;
    }

    .btn:focus {
        outline: none;
        box-shadow: none;
        border: none;
        background-color: transparent;
    }

    .forum-topics-list {
        list-style: none;
        padding: 0;
    }

    .forum-topic {
        position: relative;
        padding-left: 20px;
    }

    .pink::before {
        background-color: #fa1478;
    }

    .skyblue::before {
        background-color: skyblue;
    }

    .yellow::before {
        background-color: yellow;
    }

    .forum-topic::before {
        content: "";
        position: absolute;
        top: 6px;
        left: 0;
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .forum-topics-list {
        list-style: none;
        padding: 0;
    }

    .forum-topic {
        position: relative;
        padding-left: 20px;
        margin-bottom: 10px;
        /* Add space after each list item */
    }


    .forum-topics-list li a {
        color: black;
        text-decoration: none;
        line-height: 1.2;
        /* Adjust the line-height value as needed */
    }

    .forum-topics-list li a:hover {
        color: red;
        text-decoration: underline;
    }

    .pink::before {
        background-color: #fa1478;
    }

    .skyblue::before {
        background-color: skyblue;
    }

    .yellow::before {
        background-color: yellow;
    }

    .forum-topic::before {
        content: "";
        position: absolute;
        top: 6px;
        left: 0;
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .forum-name {
        color: red;
    }

    .hover-image:hover {
        /* Add your hover effect styles here */
        opacity: 0.8;
        /* Additional styles such as transitions, transformations, etc. */


    }

    .hover-link:hover {
        /* Add your hover effect styles here */
        text-decoration: underline;

        /* Additional styles such as color, background, etc. */
    }

    .hover-link1 {
        /* Add your default styles here */
        margin: 10px;
        /* Additional styles such as color, background, etc. */
    }

    .hover-link1:hover {
        /* Add your hover effect styles here */
        background-color: #edd8a4;
        margin: 8px;

        /* Additional styles such as color, background, etc. */
    }
</style>

<main id="main">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-6 px-5 p-5 container">
                <img src="../assets/png files/Group 299-1.png" class="img-fluid">
                <p style="text-align: left;">
                    <?php
                    $loremText = "Share thought, discuss and explore together.";
                    // Split the text into an array of words
                    $words = explode(" ", $loremText);
                    // Define the desired number of words per line
                    $wordsPerLine = 12;
                    // Iterate through the words and add line breaks accordingly
                    $lineCount = 0;
                    foreach ($words as $word) {
                        echo $word . " ";
                        $lineCount++;
                        if ($lineCount % $wordsPerLine === 0) {
                            echo "<br>";
                        }
                    }
                    ?>
                </p>
                <a data-toggle="modal" data-target="#globalModal" class="btn-sm">
                    <img src="../assets/png files/Group 412.png" alt="Video_thumbnail" style="border-radius: 0;" class="btn btn-sm hover-image">
                </a>

            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end p-0 m-0" data-toggle="modal" data-target="#globalModal">
                <img src="../assets/png files/Mask group-3.png" alt="Video_thumbnail" width="55%" height="100%" style="border-radius: 0;background-repeat:no-repeat;">
            </div>
        </div>

    </div>



    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $forumQuery = "SELECT * FROM `forum` WHERE published = 1 AND forum_for='adults'";
            $result = mysqli_query($conn, $forumQuery);

            $forumData = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $forumData[] = $row;
            }

            $totalForums = count($forumData);
            $carouselItems = ceil($totalForums / 3);

            $active = true;
            $forumIndex = 0;

            for ($i = 0; $i < $carouselItems; $i++) {
            ?>
                <div class="carousel-item <?php echo ($active ? 'active' : ''); ?>">
                    <div class="button-group d-flex justify-content-center">
                        <?php
                        for ($j = 0; $j < 3; $j++) {
                            if ($forumIndex < $totalForums) {
                                $forum = $forumData[$forumIndex];
                                $forumName = $forum['forum_name'];
                                $forumId = $forum['forum_id'];
                                $buttonClasses = array('btn', 'btn-rounded');

                                // Assign different colors to each button
                                if ($j === 0) {
                                    $buttonClasses[] = 'btn-pink';
                                } elseif ($j === 1) {
                                    $buttonClasses[] = 'btn-sky-blue';
                                } elseif ($j === 2) {
                                    $buttonClasses[] = 'btn-yellow';
                                }
                        ?>
                                <a href="forum-articles.php?forum_id=<?php echo $forumId; ?>" class="<?php echo implode(' ', $buttonClasses); ?> p-2 mx-2 mx-md-5 hover-link1" style="width: 250px;"><?php echo $forumName; ?></a>

                        <?php
                                $forumIndex++;
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php
                $active = false;
            }
            ?>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true">
                <img src="../assets/png files/Group 403.png" alt="Previous">
            </span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true">
                <img src="../assets/png files/Group 324.png" alt="Next">
            </span>
            <span class="visually-hidden">Next</span>
        </a>


    </div>



    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <input type="text" id="search-input" class="form-control" placeholder="Search...">
            </div>
        </div>
    </div>




    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-1">&nbsp;</div>

            <div class="col-md-9">
                <?php
                $forumQuery = "SELECT * FROM `forum` WHERE published = 1 AND forum_for='adults' AND forum_id='$forumID'";
                $result123 = mysqli_query($conn, $forumQuery);
                $row = mysqli_fetch_assoc($result123);
                $forum_name = $row['forum_name'];

                ?>

                <div class="container-fluid mb-3">

                    <h4 class="forum-name"><?php echo $forum_name; ?></h4>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-2 p-5 order-1">
                            <!-- Add any content you want for the first column -->
                        </div>
                        <div class="col-md-10 sana">
                            <div class="container-fluid">

                                <?php
                                $query = "SELECT ft.ft_name,ft.created_by,ft.ft_description,ft.forum_id,ft.forumtopic_id,ft.ft_created_at, COUNT(fp.subforumtopic_id) AS comment_count 
                                    FROM forum_topic ft
                                    LEFT JOIN forum f ON f.forum_id=ft.forum_id
                                    LEFT JOIN forum_postcomment fp ON ft.forumtopic_id = fp.subforumtopic_id
                                    WHERE ft.forum_id = '$forumID'
                                    GROUP BY ft.forumtopic_id
                                    ORDER BY ft.ft_created_at DESC
                                    LIMIT 4";

                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $ftName = $row['ft_name'];
                                        $ftDescription = $row['ft_description'];
                                        $ftDate = $row['ft_created_at'];
                                        $commentCount = $row['comment_count'];
                                        $ftDescriptionShort = '';

                                        // Remove image tags and extract only text (first 5 words) from description
                                        $cleanDescription = strip_tags($ftDescription); // Remove HTML tags
                                        $words = str_word_count($cleanDescription, 1); // Split text into words
                                        $textWords = array_slice($words, 0, 5); // Get the first 5 words
                                        $ftDescriptionShort = implode(' ', $textWords); // Join the words back into a string

                                        $forumId = $row['forum_id'];
                                        $forumtopic_id = $row['forumtopic_id'];
                                        $created_by = $row['created_by'];
                                ?>
                                        <div class="card mb-3 border-0 shadow rounded">
                                            <div class="card-body p-0">
                                                <div class="row">
                                                    <div class="col-md-1 col-12 d-none d-md-flex justify-content-start align-items-center">
                                                        <div class="circle"></div>
                                                    </div>


                                                    <div class="col-md-10">
                                                        <h5 class="card-title text-dark">
                                                            <a href="forum_topics.php?forum_id=<?php echo $forumId; ?>&forumtopic_id=<?php echo $forumtopic_id; ?>" class="text-dark hover-link"><?php echo $ftName; ?></a>
                                                        </h5>
                                                        <p class="card-text text-muted small"><?php echo $ftDate; ?></p>
                                                        <p class="card-text text-dark small"><?php echo $ftDescriptionShort; ?>...</p>
                                                    </div>
                                                   
                                                        <div class="col-md-1 text-end">
                                                            <div class="dropdown dropdown-menu-right">
                                                                <button class="btn btn-link text-dark" type="button" data-toggle="modal" data-target="#globalModal" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bi bi-three-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu custom-dropdown" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="editarticle.php?forum_id=<?php echo $forumID; ?>&forumtopic_id=<?php echo $forumtopic_id; ?>"><i class="bi bi-pencil-square text-warning rounded-circle shadow p-1" style="background: none;"></i></a>
                                                                    <a class="dropdown-item" href="#" onclick="confirmDelete('<?php echo $forumID; ?>', '<?php echo $forumtopic_id; ?>')"><i class="bi bi-trash text-danger rounded-circle shadow p-1" style="background: none;"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 text-end">
                                                        <a href="#" class="card-link small"><i class="bi bi-chat-dots-fill"></i>Comments (<?php echo $commentCount; ?>)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "No results found.";
                                }

                                // Remember to close the database connection when you're done

                                ?>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <h5>OTHER RELATED SUB TOPICS</h5>
                <ul class="forum-topics-list">
                    <?php
                    // Query to fetch the four latest forum topics
                    $query1 = "SELECT ft_name
                    FROM forum_topic
                    ORDER BY ft_created_at DESC
                    LIMIT 4";

                    $result1 = mysqli_query($conn, $query1);

                    // Check if any forum topics were found
                    if (mysqli_num_rows($result1) > 0) {
                        // Create an array to store the forum topic names
                        $latestForumTopics = array();

                        // Fetch the forum topic names and add them to the array
                        while ($row = mysqli_fetch_assoc($result1)) {
                            $latestForumTopics[] = $row['ft_name'];
                        }

                        // Query to fetch the remaining forum topics
                        $query2 = "SELECT *
                            FROM forum_topic
                            WHERE forum_id != 5
                            LIMIT 10";

                        $result2 = mysqli_query($conn, $query2);

                        // Check if any other forum topics were found
                        if (mysqli_num_rows($result2) > 0) {
                            // Output the list of remaining forum topics
                            echo "<ul class='forum-topics-list'>";
                            $colors = array('pink', 'skyblue', 'yellow');
                            $colorIndex = 0;
                            while ($row = mysqli_fetch_assoc($result2)) {
                                $forum_topic_name = $row['ft_name'];
                                $colorClass = $colors[$colorIndex % count($colors)];
                                $forumtopic_id = $row['forumtopic_id']; // Assuming you have the forumtopic_id column in your query result
                                $forumID = $row['forum_id']; // Assuming you have the forumtopic_id column in your query result
                                echo "<li class='forum-topic $colorClass'><a href='forum_topics.php?forumtopic_id=$forumtopic_id&forum_id=$forumID' style='color: black;'>$forum_topic_name</a></li>";
                                $colorIndex++;
                            }
                            echo "</ul>";
                        } else {
                            echo "<p>No other forum topics found.</p>";
                        }
                    } else {
                        echo "<p>No forum topics found.</p>";
                    }

                    // Remember to close the database connection when you're done
                    ?>

                </ul>
            </div>




        </div>
    </div>
    <script>
        function confirmDelete(forumId, topicId) {
            if (confirm('Are you sure you want to delete this topic?')) {
                // User confirmed, proceed with delete action
                window.location.href = 'deletetopic.php?forum_id=' + forumId + '&forumtopic_id=' + topicId;
            } else {
                // User canceled, do nothing
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
<script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
<script src="../../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
<script src="../../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/vendor/aos-portfolio/aos.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<!-- Jquery JS-->
<script src="../../assets/vendor/jquery/jquery.min.js"></script>
<!-- <script src="../assets/js/manageTeachSupport.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
<script>
    $(document).ready(function() {
        $("#search-input").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            $(".col-md-10 .card").filter(function() {
                var title = $(this).find(".card-title a").text().toLowerCase();
                return title.indexOf(searchText) == -1;
            }).hide();
            $(".col-md-10 .card").filter(function() {
                var title = $(this).find(".card-title a").text().toLowerCase();
                return title.indexOf(searchText) != -1;
            }).show();
        });
    });
</script>

</html>