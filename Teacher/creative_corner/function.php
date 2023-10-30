<?php
session_start();
$user_id = $_SESSION['u_id'];
include '../../dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted data
    $content = $_POST['content'];
    $forumtopic_id = $_POST['forumtopic_id'];
    $forum_id = $_POST['forumid'];

    // Check if a file was uploaded
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $attachment_name = $_FILES['attachment']['name'];
        $attachment_tmp = $_FILES['attachment']['tmp_name'];

        // Generate a unique file name
        $unique_filename = uniqid() . '_' . $attachment_name;

        $attachment_path = '../../assets/kidzcorner/attachment/' . $unique_filename;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($attachment_tmp, $attachment_path)) {
            // File moved successfully, insert the comment and attachment into the database
            $stmt = $conn->prepare("INSERT INTO `kiszspostcomment` (`kidzpost_id`, `content`, `attachment`, `created_by`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $forumtopic_id, $content, $unique_filename, $user_id);

            if ($stmt->execute()) {
                // Comment and attachment inserted successfully
                echo "<script>
                        alert('Comment and attachment submitted successfully. Once approved, it will be visible in the comment section.');
                        window.location.href = 'forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id';
                      </script>";
                exit();
            } else {
                // Failed to insert comment and attachment
                echo "<script>
                        alert('Failed to submit comment and attachment');
                        window.location.href = 'forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id';
                      </script>";
                exit();
            }

            $stmt->close();
        } else {
            // Failed to move the uploaded file
            echo "<script>
                    alert('Failed to move the attachment file');
                    window.location.href = 'forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id';
                  </script>";
            exit();
        }
    } else {
        // No file uploaded, insert the comment without attachment
        $stmt = $conn->prepare("INSERT INTO `kiszspostcomment` (`kidzpost_id`, `content`, `created_by`) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $forumtopic_id, $content, $user_id);

        if ($stmt->execute()) {
            // Comment inserted successfully
            echo "<script>
                    alert('Comment submitted successfully');
                    window.location.href = 'forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id';
                  </script>";
            exit();
        } else {
            // Failed to insert comment
            echo "<script>
                    alert('Failed to submit comment');
                    window.location.href = 'forum_topics.php?forum_id=$forum_id&forumtopic_id=$forumtopic_id';
                  </script>";
            exit();
        }

        $stmt->close();
    }
}

$conn->close();
?>
