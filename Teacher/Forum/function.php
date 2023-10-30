<?php
session_start();
// $user_id = $_SESSION['u_id'];
include '../../dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted data
    $content = $_POST['content'];
    $user_id = $_SESSION['u_id'];
    $forumtopic_id = $_POST['forumtopic_id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO `forum_postcomment` (`subforumtopic_id`, `content`, `created_by`) VALUES (?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param("iss", $forumtopic_id, $content, $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        extract($_GET);
        // Comment inserted successfully
        echo "Comment submitted successfully";
        header("Location: forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id");
    } else {
        // Failed to insert comment
        echo "<script>alert('Failed to submit comment');</script>";
        header("Location: forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id");
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
