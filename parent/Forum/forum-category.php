<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
?>
<?php 
        
        if(!session_id())
        {
          session_start();
          
          if($_SESSION["userType"]!='1')
          {
            header ('location: ../login_and_register/login.php');
          }
          
        }
        if(!isset($_GET['forum_id'])){
          header('Location: forum.php');
      }
       
      extract($_GET);
      // echo $forum_id;
      // exit;
      $forum_name ='';
      $sql = "SELECT * from forum where forum_id='$forum_id'";
      $result = $conn->query($sql);
      while($row=$result->fetch_assoc()){
        $forum_name=($row['forum_name']);
      }
      // echo $forum_name;
      
      ?>
<main id="main">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <div>
                <h1><a href="#" class="text-danger">Categories</a><a href="forum.php" class="btn btn-warning float-end btn-sm ">Back</a></h1>

                    <!-- <h4 class="text-primary">Cotegories</h4> -->
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
                <h1><a href="#" class="text-danger">categories</a><a href="add topic.php?forum_id=<?=$forum_id?>&forum_name=<?= $forum_name ?>" class="btn btn-warning float-end btn-sm ">Add Topic</a></h1>
                <div class="container-fluid mb-5">
                    <input type="text" id="searchInput" placeholder="Search Category Name">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="align-middle" width="2%">#</th>
                                <th class="align-middle">Forum SubTopic Name</th>
                                <th class="align-middle" width="10%">Action</th>
                                <!-- <th class="align-middle" width="10%">Article Count</th> -->
                            </tr>
                        </thead>
                        <tbody id="communityTable">
                            <?php
                         
                            // Assuming you are using PHP with a MySQL database
                            $forum_id = $_GET['forum_id'];
                            // $forumtopic_id = $_GET['forumtopic_id'];
                            // Include the database connection file
                            include("../../commonPHP/dbconnect.php");
                            // Fetch data from the 'community' table
                            $communityQuery = "SELECT * FROM `forum_topic` where forum_id='$forum_id'";
                            $communityResult = mysqli_query($conn, $communityQuery);
                            $count = 1; // Initialize count variable
                            // Iterate through each community
                            while ($communityRow = mysqli_fetch_assoc($communityResult)) {
                                $communityId = $communityRow['forum_id'];
                                $communityIdd = $communityRow['forumtopic_id'];
                                $communityName = $communityRow['ft_name'];
                                $communityDescription = $communityRow['ft_description'];
                                $created_at = new DateTime($communityRow['ft_created_at']);
                                // Fetch the count of categories for the current community
                                $categoryQuery = "SELECT COUNT(`subforumtopic_id`) AS `comments_count` FROM `forum_postcomment` WHERE `comment_id` = $communityIdd";
                                $categoryResult = mysqli_query($conn, $categoryQuery);
                                $categoryRow = mysqli_fetch_assoc($categoryResult);
                                $categoryCount = $categoryRow['comments_count'];
                                // Generate the table rows with the fetched data
                                echo '<tr>';
                                echo '<td>' . $count . '</td>'; //give serial number 1,2,3 like this 
                                echo '<td><a href="community-article.php?category_id=' . $communityId . '">' . $communityName . '</a>' . '<br>' . $created_at->format('d M Y h:i A') . '</td>';
                                // echo '<td class="align-middle"><a href="community-article.php?category_id=' . $communityId . '"><span class="badge bg-primary rounded-pill">View Community</span></a></td>';
                           
                                echo '<td class="align-middle col-lg-2">';
                                echo '<div class="d-flex">';
                                echo '<a href="forumtopic-comments.php?forumtopic_id=' . $communityIdd . '&forum_id=' . $communityId . '"><i class="bi bi-eye-fill p-2" style="color: blue;"></i></a>';
                                echo '<a href="edittopic.php?forum_id=' . $communityId . '&forumtopic_id=' . $communityIdd . '"><i class="bi bi-pencil-fill p-2" style="color: orange;"></i></a>';
                                echo '<a href="deletetopic.php?forum_id=' . $communityId . '&forumtopic_id=' . $communityIdd . '"><i class="bi bi-trash-fill" style="color: red;"></i></a>';
                                echo '</div>';
                                echo '</td>';
                            
                                
                                echo '</tr>';
                            }
                            // Close the database connection
                              
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