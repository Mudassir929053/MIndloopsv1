<?php
require_once("../commonPHP/head.php");
$url_category_id='';
if(isset($_GET['category_id'])){
    $url_category_id = $_GET['category_id'];
}
?>
<?php
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
 
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../assets/community/thumbnails/">
<link rel="stylesheet" href="../../assets/css/parent.css">
<body class="no-image">
<main id="main" class="no-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12 offset-lg-0  p-5 container" style="background: url('../../assets/community/pngfiles/Maskgroup-2.png'); background-repeat: no-repeat; background-position: right; background-size: 34%; ">
                                <img src="../../assets/community/pngfiles/Group299.png" class="img-fluid px-5 ">
                                <p style="text-align: left;" class="px-5">
                                    <?php
                                    $loremText = "Unleash your creative spark us.Join our vibrant community of creators and unlock the full potential of your.Together,let's embark on an extraordinary journey of self-expression,inspiration,and endless artistic  discovery.Embrace the power within you and let your creative spark illuminnate the word";
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
                                <a href="add-article.php?category_id=<?= $_GET['category_id'] ?>&community_id=<?= $_GET['community_id'] ?>" class="btn-sm px-5"><img src="../../assets/community/pngfiles/Group411.png" alt="Video_thumbnail" style="border-radius: 0;" class="btn btn-sm"></a>
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
                    // include("../commonPHP/dbconnect.php");
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
                        echo '<div class="col-8 ">';
                        echo '<h2 class="accordion-header" id="heading' . $count1 . '">';
                        echo '<button class="accordion-button text-capitalize" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $count1 . '" aria-expanded="true" aria-controls="collapse' . $count1 . '">';
                        echo '  ' . $communityRow['community_name'];
                        echo '</button>';
                        echo '</h2>';
                        echo '<div id="collapse' . $count1 . '" class="accordion-collapse collapse" aria-labelledby="heading' . $count1 . '" data-bs-parent="#accordionExample">';
                        echo '<div class="accordion-body">';
                        // Iterate through each subtopic and generate the content of the accordion item
                        $count2 = 1;
                        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                            $categoryName = $categoryRow['cc_name'];
                            $created_at = new DateTime($categoryRow['created_at']);
                            $category_id = $categoryRow['category_id']; // Assign the value of category_id
                            echo '<a href="community-article.php?community_id=' . $community_id1 . '&category_id=' . $category_id . '" class="text-secondary"> ' . $categoryName . '<br></a>';
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
                     
                    // Fetch categories from the 'community_category' table
                    $categoryQuery = "SELECT * FROM `community_category` WHERE community_id = $community_id ";
                    $categoryResult = mysqli_query($conn, $categoryQuery);
                    $count = 1; // Initialize count variable
                    $categoryTabs = ''; // Variable to store the category tabs HTML

                    // Start building the HTML structure
                    $categoryTabs .= '<div>';
                    $categoryTabs .= '<ul class="nav nav-tabs">';

                    // Iterate through each category
                    while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                        $categoryId = $categoryRow['category_id'];
                        $categoryName = $categoryRow['cc_name'];
                        // ($url_category_id==$categoryId?' active ': ($count == 1 ? ' active' : ''))
                        if(!empty($url_category_id)){
                            $tab_status = $url_category_id==$categoryId?' active ':'';
                        }
                        else{
                            $tab_status= ($count == 1 ? ' active' : '');
                        }
                        // Generate the tab with the fetched data
                        if ($count <= 5) {
                            $categoryTabs .= '<li class="nav-item">';
                            $categoryTabs .= '<a class="nav-link text-uppercase fw-bolder' . ($tab_status) . '" id="category-tab-' . $count . '" data-bs-toggle="pill" onclick="addCategoryURL('."'".$categoryId."'".')" href="#category-' . $count . '">' . $categoryName . '</a>';
                            $categoryTabs .= '</li>';
                        }
                        $count++;
                    }

                    $categoryTabs .= '</ul>';
                    $categoryTabs .= '</div>';

                    // Display the select dropdown only if there are more than 5 categories
                    if ($count > 6) {
                        $categoryTabs .= '<div class="">';
                        $categoryTabs .= '<select class="form-select" onchange="handleCategoryChange(this.value)">';
                        $categoryTabs .= '<option value="">More</option>'; // Add a default option for selecting a category
                        mysqli_data_seek($categoryResult, 5); // Reset the result pointer to skip the first five categories
                        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                            $categoryId = $categoryRow['category_id'];
                            $categoryName = $categoryRow['cc_name'];
                            $categoryTabs .= '<option value="' . $categoryId . '">' . $categoryName . '</option>';
                        }
                        $categoryTabs .= '</select>';
                        $categoryTabs .= '</div>';
                    }

                      
                    ?>

                    <!-- Output the category tabs HTML -->
                    <?php echo $categoryTabs; ?>

                    <script>
                        var selectedCategories = []; // Array to store selected category IDs
                        function handleCategoryChange(categoryId) {
                            // Check if the category is already selected
                            if (selectedCategories.includes(categoryId)) {
                                alert('Category already selected!');
                                return;
                            }
                            // Get the selected category name
                            var categoryName = $("select option:selected").text();
                            // Create a new tab for the selected category
                            var newTab = '<li class="nav-item">';
                            newTab += '<a class="" id="category-tab-' + categoryId + '" data-bs-toggle="pill" href="#category-' + categoryId + '"></a>';
                            newTab += '</li>';
                            // Create the corresponding tab content for the selected category
                            var newTabContent = '<div class="mt-5 tab-pane fade text-black" id="category-' + categoryId + '">'; // You can modify the class and styling as needed
                            newTabContent += 'Content for Category ' + categoryId; // Replace this with your actual content
                            newTabContent += '</div>';
                            // Append the new tab and tab content to the respective elements
                            $('.nav-tabs').append(newTab);
                            $('.tab-content').append(newTabContent);
                            // Activate the newly created tab
                            $('#category-tab-' + categoryId).tab('show');
                            $('.nav-tabs').remove(newTab);
                            // Add the selected category ID to the array
                            selectedCategories.push(categoryId);
                        }
                    </script>

                </ul>
                <div class="tab-content">
                    <?php
                  include("../../dbconnect.php");
                  $user = $_SESSION['u_id'];
                  // $categoryId = $_GET['category_id'];
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
                        if(!empty($url_category_id)){
                            $tab_status1 = $url_category_id==$categoryId?' show active ':'';
                        }
                        else{
                            $tab_status1= ($count == 1 ? ' show active' : '');
                        }
                        // Generate the tab content with the fetched articles
                        echo '<div class=" mt-5 tab-pane fade text-black' . ($tab_status1) . '" id="category-' . $count . '">';
                        // Fetch articles belonging to the current category
                        $articleQuery = "SELECT * FROM `community_article` LEFT JOIN tb_users ON tb_users.u_id = community_article.created_by WHERE cc_id = $categoryId ";
                        $articleResult = mysqli_query($conn, $articleQuery);
                        // Check if there are any articles for the current category
                        if (mysqli_num_rows($articleResult) > 0) {
                            // Display the articles in a grid system
                            echo '<div class="row">';
                            while ($articleRow = mysqli_fetch_assoc($articleResult)) {
                                // Display each article in a grid cell
                                $u_name = $articleRow['u_name'];
                                $created_by = $articleRow['created_by'];
                                if (!empty($articleRow['article_thumbnail'])) {
                                    $thumbnailPath =$articleRow['article_thumbnail'];
                                } else {
                                    $thumbnailPath = "default-thumbnail.jpg";
                                }
                                echo '<div class="col-md-4">';
                                echo '<div class="">';
                                echo '<img src="../../assets/community/thumbnails/' . $thumbnailPath . '" class="card-img-top" alt="Article Thumbnail" style="height: 200px; border-radius: 10px;">';
                                echo '<div class="card-body">';
                                echo '<div class="row like-dislike-buttons">';
                                echo '<div class="col-12 d-flex justify-content-between">';
                                echo '<div>';
                                echo '<button class="like-button text-success" onclick="likeForumArticle(\'' . $articleRow['article_id'] . '\',\'like\')"><i class="fa fa-thumbs-up"></i> <span id="a_likes_' . $articleRow['article_id'] . '">' . $articleRow['likes'] . '</span></button>';
                                echo '<button class="dislike-button text-danger" onclick="likeForumArticle(\'' . $articleRow['article_id'] . '\',\'dislike\')"><i class="fa fa-thumbs-down"></i> <span id="a_dislikes_' . $articleRow['article_id'] . '">' . $articleRow['dislikes'] . '</span></button>';
                                echo '</div>';
                                echo '<div class="text-end position-relative">';
                               
                                if ($user == $created_by) {
                                    echo '<div class="dropdown dropup">';
                                    echo '  <button class="btn btn-link" type="button" id="courseDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                    echo '    <i class="bi bi-three-dots-vertical"></i>';
                                    echo '  </button>';
                                    echo '  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="courseDropdown">';
                                    echo '    <a class="dropdown-item" href="edit-article.php?article_id=' . $articleRow['article_id'] . '&category_id=' . $categoryId . '&community_id=' . $community_id . '">';
                                    echo '      <span class="rounded-circle bg-white"><i class="bi bi-pencil-fill" style="color: orange;"></i></span>';
                                    echo '    </a>';
                                    echo '    <a class="dropdown-item" href="delete-article.php?article_id=' . $articleRow['article_id'] . '&category_id=' . $categoryId . '&community_id=' . $community_id . '" onclick="return confirm(\'Are you sure you want to delete this article?\');">';
                                    echo '      <span class="rounded-circle bg-white"><i class="bi bi-trash-fill" style="color: red;"></i></span>';
                                    echo '    </a>';
                                    echo '  </div>';
                                    echo '</div>';
                                }
                                
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="col-3 text-end">';
                                echo '</div>';
                                echo '</div>';

                                echo '<a href="view_comments.php?article_id=' . $articleRow['article_id'] . '&category_id='.$categoryRow['category_id'].'&community_id='.$community_id.'" class="text-black card-text55"><h5 class="card-title text-dark">' . $articleRow['ca_title'] . '</h5></a>';
                                echo '<div class="card-text text-black">' . $u_name . '</div>';
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

    const addCategoryURL = (cat_id) =>{
        // console.log(cat_id);
        var currentPageURL = window.location.href;
        let page_arr = currentPageURL.split('category_id');

        window.location.href = page_arr[0]+'category_id='+cat_id;
// Print the current page URL
// console.log(page_arr);
    }

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>