<?php
require_once("../commonPHP/head.php");
?>
<?php
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");

$to_mindloops_id = $_GET['to_mindloops_id'];
?>
<style>
    .icon-large {
        font-size: 20px;
        /* Adjust the font size as needed */
    }

    .card-img-top {
        height: 150px;
        /* Adjust the height as per your requirements */
        width: 100%;
        /* Set the width to 100% to fill the container */
        object-fit: cover;
        /* Ensure the image fills the container */
        object-position: center;
        /* Center the image within the container */
        border-radius: 8px;
        /* Apply border-radius for rectangle shape */
    }

    .card-fixed-height {
        height: 100%;
        /* Adjust the desired height here */
    }
</style>
<main id="main">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <div>
                    <h1><a href="#" class="text-danger">Articles</a><a href="to-mindloops.php" class="btn btn-warning float-end btn-sm">Back</a></h1>
                    <p>Welcome to the Mindloops community forums. Here you can read articles, leave comments, and engage with the content you find interesting. Join the discussion and connect with others who share your interests.</p>
                    <p>Feel free to leave your thoughts and feedback on the articles you read. Engage with the community by liking and commenting on the articles that resonate with you. We value your participation and look forward to hearing your perspectives.</p>
                </div>
                <div class="my-5">

                    <a href="add-article.php?to_mindloops_id=<?= $to_mindloops_id ?>" class="btn btn-warning float-end btn-sm">Add Article</a>
                </div>

                <div class="container-fluid my-5">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search articles">
                        </div>
                    </div>
                    <div class="row">
                        <?php
                       $user = $_SESSION['u_id'];
                        // Get search query from the form submission
                        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

                        // Set the number of articles per page and current page number
                        $articlesPerPage = 12;
                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                        // Calculate the offset for pagination
                        $offset = ($currentPage - 1) * $articlesPerPage;

                        // Fetch data from the 'community' table with search filter and pagination
                        $to_mindloops_id = isset($_GET['to_mindloops_id']) ? $_GET['to_mindloops_id'] : '';
                        $user = $_SESSION['u_id'];
                        $categoryQuery = "SELECT * FROM `to_mindloops_articles` LEFT JOIN tb_users ON tb_users.u_id = to_mindloops_articles.created_by WHERE topic_id = '$to_mindloops_id' AND created_by = '$user'";

                        // Apply search filter if provided
                        if (!empty($searchQuery)) {
                            $categoryQuery .= " AND (article_title LIKE '%$searchQuery%' OR article_content LIKE '%$searchQuery%')";
                        }

                        // Apply pagination
                        $categoryQuery .= " LIMIT $articlesPerPage OFFSET $offset";

                        $communityResult = mysqli_query($conn, $categoryQuery);

                        // Iterate through each community
                        while ($communityRow = mysqli_fetch_assoc($communityResult)) {
                            $communityId = $communityRow['article_id'];
                            $communityName = $communityRow['article_title'];
                            $communityDescription = $communityRow['article_content'];
                            $articleCreatedBy = $communityRow['created_by'];
                            $article_thumbnail = $communityRow['article_thumbnail'];
                            $u_name = $communityRow['u_name'];
                            $createdAt = new DateTime($communityRow['created_at']);
                        ?>
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card card-fixed-height shadow-sm">
                                    <a href="view-article.php?article_id=<?= $communityId ?>">
                                        <div class="row g-0">
                                            <div class="col-4">
                                                <a href="view-article.php?article_id=<?= $communityId ?>">
                                                    <?php if ($article_thumbnail === NULL) { ?>
                                                        <img src="https://media.istockphoto.com/id/1147544809/vector/no-thumbnail-image-vector-graphic.jpg?s=170667a&w=0&k=20&c=v9QBkaN6fXxy1b-wsTQ6QhHUVGLo8JMMxhUBcWzOH0A=" class="card-img-top" alt="Article Image">
                                                    <?php } else { ?>
                                                        <img src="../../assets/tomindloops/tomindloops_attachment/<?= $article_thumbnail ?>" class="card-img-top" alt="Article Image">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body">
                                                    <span class="card-text text-danger">
                                                        <a href="view-article.php?article_id=<?= $communityId ?>" class="text-secondary"><?= $createdAt->format('d M Y h:i A') ?></a>
                                                    </span>
                                                    <h5 class="card-title text-black">
                                                        <a href="view-article.php?article_id=<?= $communityId ?>" class="text-black"><?= $communityName ?></a>
                                                    </h5>
                                                    <p class="card-text text-black">
                                                        <a href="view-article.php?article_id=<?= $communityId ?>" class="text-danger"><?= $u_name ?></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        <?php
                        }

                        // Calculate the total number of articles for pagination
                        $totalArticlesQuery = "SELECT COUNT(*) AS total FROM `to_mindloops_articles` LEFT JOIN tb_users ON tb_users.u_id = to_mindloops_articles.created_by WHERE topic_id = '$to_mindloops_id' AND created_by = '$user'";

                        // Apply search filter if provided
                        if (!empty($searchQuery)) {
                            $totalArticlesQuery .= " AND (article_title LIKE '%$searchQuery%' OR article_content LIKE '%$searchQuery%')";
                        }

                        $totalArticlesResult = mysqli_query($conn, $totalArticlesQuery);
                        $totalArticlesRow = mysqli_fetch_assoc($totalArticlesResult);
                        $totalArticles = $totalArticlesRow['total'];

                        // Calculate the total number of pages
                        $totalPages = ceil($totalArticles / $articlesPerPage);
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="pagination justify-content-center">
                                <?php
                                // Display pagination links
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    $activeClass = ($i == $currentPage) ? 'active' : '';
                                ?>
                                    <li class="page-item <?= $activeClass ?>">
                                        <a class="page-link" href="?to_mindloops_id=<?= $to_mindloops_id ?>&search=<?= $searchQuery ?>&page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <script>
                    // Get the search input element
                    var searchInput = document.getElementById('searchInput');

                    // Get the current URL and create a URL object
                    var currentURL = new URL(window.location.href);

                    // Get the value of the 'to_mindloops_id' parameter from the current URL
                    var toMindloopsId = currentURL.searchParams.get('to_mindloops_id');

                    // Add an event listener to the search input element
                    searchInput.addEventListener('input', function() {
                        // Get the search query value
                        var searchQuery = searchInput.value;
                        // Update the URL parameters with the new search query
                        currentURL.searchParams.set('search', searchQuery);

                        // Reload the page with the updated URL
                        if(searchQuery.length>=3)
                        window.location.href = currentURL.toString();
                    });
                </script>




            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>
    </div>
</main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
</body>

</html>