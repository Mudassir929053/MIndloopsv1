<?php
require_once("../commonPHP/head.php");
?>
<?php
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
 
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
    .icon-large {
        font-size: 20px;
        /* Adjust the font size as needed */
    }

    .like-button,
    .dislike-button {
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        z-index: 1;
        border-top: 1px solid #ccc;
        padding-top: 10px;
        margin-top: 10px;
    }

    .dropdown.open .dropdown-content {
        display: block;
    }

    .accordion-button,
    .accordion-button:focus {
        background-image: none !important;
        background-color: white;
        box-shadow: none;
    }

    .accordion-button:not(.collapsed)::after,
    .accordion-button:not(.collapsed) {
        background-image: none;
        background-color: white;
        color: black;
        box-shadow: none;
    }

    .dropdown-item {
        display: block;
        width: 50%;
        padding: 0;
        border-radius: 52%;
        clear: both;
        font-weight: 400;
        color: #212529;
        text-align: inherit;
        text-decoration: none;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
    }

    .dropdown-menu {
        background-color: transparent;
        min-width: 20px;
        border: none;
        top: auto;
        bottom: 100%;
    }

    .rounded-circle {
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        text-align: center;
        line-height: 30px;
    }

    .custom-dropdown-button {
        background-color: transparent;
        border: none;
        padding: 0;
    }
</style>
<main id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12 offset-lg-0  p-5 container" style="background: url('../../assets/community/pngfiles/Mask group-2.png'); background-repeat: no-repeat; background-position: right; background-size: 35%; ">
                                <img src="../../assets/community/pngfiles/Group 299.png" class="img-fluid px-5">
                                <p style="text-align: left;" class="px-5">
                                    <?php
                                    $loremText = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia vitae libero necessitatibus illo, velit tenetur repudiandae? Libero quas placeat natus, dicta nemo nesciunt inventore reprehenderit eligendi. Unde, at? Nemo, distinctio!";
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
                                <a href="add-article.php?category_id=<?= $_GET['category_id'] ?>&community_id=<?= $_GET['community_id'] ?>" class="btn-sm px-5"><img src="../../assets/community/pngfiles/Group 411.png" alt="Video_thumbnail" style="border-radius: 0;" class="btn btn-sm"></a>
                            </div>
                            <!-- <div class="col-md-6 d-flex align-items-center justify-content-end p-0 m-0">
                <img src="../../assets/png files/Mask group-2.png" alt="Video_thumbnail" width="55%" height="100%" style="border-radius: 0;background-repeat:no-repeat;">
            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 px-5">
                <div class="accordion" id="accordionExample">
                    <?php
                    // Assuming you are using PHP with a MySQL database
                    // Include the database connection file
                    include("../commonPHP/dbconnect.php");
                    $community_id = $_GET['community_id'];
                    // Fetch data from the 'community' table
                    $communityQuery = "SELECT * FROM `community`";
                    $communityResult = mysqli_query($conn, $communityQuery);
                    // Iterate through each community and generate the accordion items
                    $count1 = 1;
                    while ($communityRow = mysqli_fetch_assoc($communityResult)) {
                        $community_id1 = $communityRow['community_id'];
                        $categoryQuery = "SELECT * FROM `community_category` WHERE `community_id` = $community_id1";
                        $categoryResult = mysqli_query($conn, $categoryQuery);
                        // Start building the HTML structure for each accordion item
                        echo '<div class="col-8">';
                        echo '<h2 class="accordion-header" id="heading' . $count1 . '">';
                        echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $count1 . '" aria-expanded="true" aria-controls="collapse' . $count1 . '">';
                        echo '' . $communityRow['community_name'];
                        echo '</button>';
                        echo '</h2>';
                        echo '<div id="collapse' . $count1 . '" class="accordion-collapse collapse" aria-labelledby="heading' . $count1 . '" data-bs-parent="#accordionExample">';
                        echo '<div class="accordion-body ">';
                        // Iterate through each subtopic and generate the content of the accordion item
                        $count2 = 1;
                        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                            $categoryName = $categoryRow['cc_name'];
                            $category_id = $categoryRow['category_id'];
                            $created_at = new DateTime($categoryRow['created_at']);
                            echo '<a href="community-category-article.php?community_id=' . $community_id . '&category_id=' . $category_id . '" class="text-secondary">' . $categoryName . '<br></a>';
                        }
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        $count1++;
                    }
                    // Close the database connection
                      
                    ?>
                </div>
            </div>
            <div class="col-md-8">
                <ul class="nav nav-tabs justify-content-center" id="categoryTabs">
                    <?php
                     
                    $categoryId = $_GET['category_id'];
                    // Fetch categories from the 'community_category' table
                    $categoryQuery = "SELECT * FROM `community_category` WHERE category_id = $categoryId ";
                    $categoryResult = mysqli_query($conn, $categoryQuery);
                    $count = 1; // Initialize count variable
                    // Start building the HTML structure
                    echo '<div>';
                    echo '<ul class="nav nav-tabs">';
                    // Iterate through each category
                    while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                        $categoryId = $categoryRow['category_id'];
                        $categoryName = $categoryRow['cc_name'];
                        // Generate the tab with the fetched data
                        if ($count <= 2) {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link text-uppercase fw-bolder' . ($count == 1 ? ' active' : '') . '" id="category-tab-' . $count . '" data-bs-toggle="pill" href="#category-' . $count . '">' . $categoryName . '</a>';
                            echo '</li>';
                        }
                        $count++;
                    }
                    echo '</ul>';
                    echo '</div>';
                    // Display the select dropdown

                      
                    ?>

                </ul>
                <div class="tab-content">
                    <?php
                    include("../../dbconnect.php");
                    $user = $_SESSION['u_id'];
                    $categoryId = $_GET['category_id'];
                    $articleQuery1 = "SELECT * FROM `community_article` WHERE cc_id = $categoryId";
                    $articleResult1 = mysqli_query($conn, $articleQuery1);
                    if (mysqli_num_rows($articleResult1) > 0) {
                        while ($articleRow1 = mysqli_fetch_assoc($articleResult1)) {
                            $article_id = $articleRow1['article_id'];
                        }
                    }
                    // Re-fetch the categories for populating the tab content
                    $categoryResult = mysqli_query($conn, $categoryQuery);
                    $count = 1; // Reset count variable
                    // Iterate through each category
                    while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                        $categoryId = $categoryRow['category_id'];
                        // Generate the tab content with the fetched articles
                        echo '<div class=" mt-5 tab-pane fade text-black' . ($count == 1 ? ' show active' : '') . '" id="category-' . $count . '">';
                        // Fetch articles belonging to the current category
                        $articleQuery = "SELECT * FROM community_article LEFT JOIN tb_users ON tb_users.u_id = community_article.created_by WHERE cc_id = $categoryId ";

                        $articleResult = mysqli_query($conn, $articleQuery);
                        // Check if there are any articles for the current category
                        if (mysqli_num_rows($articleResult) > 0) {
                            // Display the articles in a grid system
                            echo '<div class="row">';
                            while ($articleRow = mysqli_fetch_assoc($articleResult)) {
                                // Display each article in a grid cell
                                $user_name = $articleRow['u_name'];
                                echo '<div class="col-md-4">';
                                echo '<div class="">';
                                echo '<img src="../../assets/community/thumbnails/' . $articleRow['article_thumbnail'] . '" class="card-img-top" alt="Article Thumbnail" style="height: 200px; border-radius: 10px;height:300px;">';
                                echo '<div class="card-body">';
                                echo '<div class="row like-dislike-buttons">';
                                echo '<div class="col-12 d-flex justify-content-between">';
                                echo '  <div>';
                                echo '    <button class="like-button text-success" onclick="likeForumArticle(\'' . $articleRow['article_id'] . '\',\'like\')"><i class="fa fa-thumbs-up"></i> <span id="a_likes_' . $articleRow['article_id'] . '">' . $articleRow['likes'] . '</span></button>';
                                echo '    <button class="dislike-button text-danger" onclick="likeForumArticle(\'' . $articleRow['article_id'] . '\',\'dislike\')"><i class="fa fa-thumbs-down"></i> <span id="a_dislikes_' . $articleRow['article_id'] . '">' . $articleRow['dislikes'] . '</span></button>';
                                echo '</div>';
                                
                                echo '<div class="text-end position-relative">';
                                if ($articleRow['created_by'] == $user) {
                                    // Display update and delete buttons for comments created by the current user
                        
                                echo '  <div class="dropdown dropup">';
                                echo '    <button class="btn btn-link " type="button" id="courseDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                echo '      <i class="bi bi-three-dots-vertical"></i>';
                                echo '    </button>';
                                echo '    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="courseDropdown">';
                                echo '<a class="dropdown-item" href="edit-category-article.php?article_id=' . $articleRow['article_id'] . '&category_id=' . $categoryId . '&community_id=' . $community_id . '">';
                                echo '<span class="rounded-circle bg-white"><i class="bi bi-pencil-fill" style="color: orange;"></i></span>';
                                echo '</a>';
                                echo '<a class="dropdown-item" href="delete-article.php?article_id=' . $articleRow['article_id'] . '" onclick="return confirm(\'Are you sure you want to delete article?\');">';
                                echo '<span class="rounded-circle bg-white"><i class="bi bi-trash-fill" style="color: red;"></i></span>';
                                echo '</a>';
                                echo '    </div>';
                                echo '  </div>';

                            }else{
                                echo '    <button class="btn btn-link " type="button" id="courseDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>';
                                echo '      <i class="bi bi-three-dots-vertical"></i>';
                                echo '    </button>';
                            }
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="col-3 text-end">';
                                echo '</div>';
                                echo '</div>';
                                echo '<a href="view-article.php?article_id=' . $articleRow['article_id'] . '" class="text-black"><h5 class="card-title text-dark">' . $articleRow['ca_title'] . '</h5></a>';
                                echo '<div class="card-text text-black">' . $user_name . '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            echo '</div>'; // Close the row div
                        } else {
                            // Display a message if no articles found for the category
                            echo '<p>No articles found for this category.</p>';
                        }
                        echo '</div>'; // Close the tab pane div
                        $count++;
                    }
                    // ...
                    ?>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
</body>
<script>
    const likeForumArticle = (id, action) => {
        let url = 'likeDislikeQuery.php?likeForumArticle=yes&article_id=' + id + '&action=' + action;
        fetch(url).then(data => data.text()).then(data => {
            let arr_likes = data.split('#');
            let like_id = 'a_likes_' + id;
            let dislike_id = 'a_dislikes_' + id;
            document.getElementById(like_id).innerHTML = arr_likes[0];
            document.getElementById(dislike_id).innerHTML = arr_likes[1];
        });
    }
    const likeForumComment = (c_id, action, obj) => {
        let url = 'likeDislikeQuery.php?likeForumComment=yes&comment_id=' + c_id + '&action=' + action;
        fetch(url).then(data => data.text()).then(data => {
            let arr_likes = data.split('#');
            obj.parentNode.childNodes[1].childNodes[1].textContent = arr_likes[0];
            obj.parentNode.childNodes[3].childNodes[1].textContent = arr_likes[1];
        });
    }
</script>
<script>
    // Add an event listener to handle the click event on the dropdown
    $('.dropdown').on('click', function(e) {
        e.stopPropagation(); // Prevent the click event from bubbling up to the document
        // Toggle the open class on the dropdown to show/hide the dropdown content
        $(this).toggleClass('open');
    });
    // Add a click event listener on the document to hide the dropdown content when clicking outside the dropdown
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown').removeClass('open');
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>