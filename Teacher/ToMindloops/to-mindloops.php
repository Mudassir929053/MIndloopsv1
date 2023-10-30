<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
?>
<main id="main">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <div>
                    <h1 class="text-danger">To Mindloops</h1>
                    <p>
                        Welcome to the Mindloops community forums. Get support from the community, share ideas, and meet others in a community of your preferred language below. (Note: You’ll need to become a member of the community in order to post in the forums.)
                    </p>
                    <p>
                        Before posting any support-related questions, particularly the frequently asked questions, to make sure your question isn't already answered there.
                    </p>
                    <p class="text-warning">
                        Want to help?
                    </p>
                    <ul>
                        <li>If you see an unanswered question for which you know the answer, then answer it!</li>
                        <li>Give feedback by rating posts as useful. (Ratings are also used to determine particularly helpful members.)</li>
                        <li>Transfer useful content from forum discussions, such as frequently asked questions and answers, or ideas/suggestions of ways of using a particular feature, to our documentation.</li>
                        <li>If you discover a bug or have a suggestion for a new feature, report it to us.</li>
                    </ul>
                    <br>
                </div>
                <div class="container-fluid mb-5">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search To Mindloops Name">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th class="align-middle" width="2%">#</th>
                                <th class="align-middle">Community Name</th>
                                <th class="align-middle">Community Created Date</th>
                                <th class="align-middle">Total Category</th>
                                <th class="align-middle" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="communityTable">
                            <?php
                            // Assuming you are using PHP with a MySQL database
                            // Include the database connection file
                            include("../../dbconnect.php");
                            // Fetch data from the 'community' table
                            $communityQuery = "SELECT * FROM `to_mindloops_topics`";
                            $communityResult = mysqli_query($conn, $communityQuery);
                            // Iterate through each community
                            $count = 1; // Initialize count variable
                            while ($communityRow = mysqli_fetch_assoc($communityResult)) {
                                $communityId = $communityRow['to_mindloops_topic_id'];
                                $communityName = $communityRow['topic_name'];
                                $communityDescription = $communityRow['description'];
                                $created_at = new DateTime($communityRow['created_at']);
                                // Fetch the count of categories for the current community
                                $categoryQuery = "SELECT COUNT(`topic_id`) AS `category_count` FROM `to_mindloops_articles` WHERE `topic_id` = $communityId";
                                $categoryResult = mysqli_query($conn, $categoryQuery);
                                $categoryRow = mysqli_fetch_assoc($categoryResult);
                                $categoryCount = $categoryRow['category_count'];
                                // Generate the table rows with the fetched data
                                echo '<tr>';
                                echo '<td>' . $count . '</td>'; // Display the count
                                echo '<td><a href="to-mindloops-article.php?to_mindloops_id=' . $communityId . '">' . $communityName . '</a></td>';
                                echo '<td>' . $created_at->format('d M Y h:i A') . '</td>';
                                echo '<td class="align-middle"><span class="badge bg-danger rounded-pill">' . $categoryCount . '</span></td>';
                                echo '<td class="align-middle"><a href="to-mindloops-article.php?to_mindloops_id=' . $communityId . '"><span class="badge bg-primary rounded-pill">View Articles</span></a></td>';
                                echo '</tr>';
                                $count++; // Increment the count
                            }
                            // Close the database connection
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    // Live Search functionality
                    const searchInput = document.getElementById('searchInput');
                    const communityTable = document.getElementById('communityTable');
                    searchInput.addEventListener('keyup', (event) => {
                        const searchText = event.target.value.toLowerCase();
                        const rows = communityTable.getElementsByTagName('tr');
                        for (let row of rows) {
                            const communityName = row.getElementsByTagName('td')[1].textContent.toLowerCase();
                            const communityDescription = row.getElementsByTagName('td')[2].textContent.toLowerCase();
                            if (communityName.includes(searchText) || communityDescription.includes(searchText)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        }
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