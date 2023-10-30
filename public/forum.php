<?php

require_once("../commonPHP/head.php");
include("../commonPHP/topNavBarCheck.php");
include '../global_modal.php';
// include("_discover.php");

// include("_discover.php");
?>
<main id="main">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <div>
                    <h1 class="text-danger">Forum</h1>
                    <p>
                        Welcome to the Mindloops forum forums. Get support from the forum, share ideas, and meet others in a forum of your preferred language below. (Note: You’ll need to become a member of the forum in order to post in the forums.)
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
                <div class="row">
  <div class="col-md-11">
    <input type="text" class="form-control" id="searchInput" placeholder="Search forum Name">
  </div>
  <div class="col-md-1">
    <h1>
      <a href="#" class="text-danger"></a>
      <a data-toggle="modal" data-target="#globalModal" class="btn btn-warning float-end btn-sm">Add Forum</a>
    </h1>
  </div>
</div>
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th class="align-middle" width="2%">#</th>
                                <th class="align-middle">Forum Name</th>
                                <th class="align-middle">Forum Created Date</th>
                                <th class="align-middle">Forum Category</th>
                                <th class="align-middle" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="forumTable">
                            <?php
                            // Assuming you are using PHP with a MySQL database
                            // Include the database connection file
                            include("../dbconnect.php");
                            // Fetch data from the 'forum' table
                            $forumQuery = "SELECT * FROM `forum` WHERE published = 1  AND forum_for='Adults'";
                            $forumResult = mysqli_query($conn, $forumQuery);
                            // Iterate through each forum
                            $count = 1; // Initialize count variable
                            while ($forumRow = mysqli_fetch_assoc($forumResult)) {
                                $forumId = $forumRow['forum_id'];
                                $forumName = $forumRow['forum_name'];
                                $forumDescription = $forumRow['forum_description'];
                                $created_at = new DateTime($forumRow['created_at']);
                                // Fetch the count of categories for the current forum
                                $categoryQuery = "SELECT COUNT(`forum_id`) AS `forum_count` FROM `forum_topic` WHERE `forum_id` = $forumId";
                                $categoryResult = mysqli_query($conn, $categoryQuery);
                                $categoryRow = mysqli_fetch_assoc($categoryResult);
                                $categoryCount = $categoryRow['forum_count'];
                                // Generate the table rows with the fetched data
                                echo '<tr>';
                                echo '<td>' . $count . '</td>'; // Display the count
                                echo '<td>' . $forumName . '</td>';
                                echo '<td>' . $created_at->format('d M Y h:i A') . '</td>';
                                echo '<td class="align-middle"><span class="badge bg-danger rounded-pill">' . $categoryCount . '</span></td>';
                                echo '<td class="align-middle">';
                                echo '<a href="forum-articles.php?forum_id=' . $forumId . '"><i class="bi bi-eye-fill p-2" style="color: blue;"></i></a>';
                                echo '<a data-toggle="modal" data-target="#globalModal"><i class="bi bi-pencil-fill p-2" style="color: orange;"></i></a>';
                                echo '<a data-toggle="modal" data-target="#globalModal"><i class="bi bi-trash-fill" style="color: red;"></i></a>';
                                echo '</td>';
                            
                                


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
                    const forumTable = document.getElementById('forumTable');
                    searchInput.addEventListener('keyup', (event) => {
                        const searchText = event.target.value.toLowerCase();
                        const rows = forumTable.getElementsByTagName('tr');
                        for (let row of rows) {
                            const forumName = row.getElementsByTagName('td')[1].textContent.toLowerCase();
                            const forumDescription = row.getElementsByTagName('td')[2].textContent.toLowerCase();
                            if (forumName.includes(searchText) || forumDescription.includes(searchText)) {
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>