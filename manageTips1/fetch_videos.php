<?php
// Assuming you have already established a database connection
// $conn is the variable representing the database connection

if (isset($_GET['audience'])) {
    $selectedAudience = $_GET['audience'];
    
    // Fetch data from the database based on the selected audience
    $query = "SELECT `v_id`, `v_title` FROM `tb_videos` WHERE v_audience = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "s", $selectedAudience);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Get the result
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result) {
            $videos = array();
            while ($video = mysqli_fetch_assoc($result)) {
                $videos[] = $video;
            }
            echo json_encode($videos);
        } else {
            // Handle the case when the query result is empty
            echo "No videos found.";
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the case when the statement preparation fails
        echo "Statement preparation failed: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

// Close the database connection
mysqli_close($conn);
?>
