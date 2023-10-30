<?php

include '../../dbconnect.php';
extract($_GET);
    // echo $category;
    // echo $level;

    // exit;
    
// Query the database for the list of words
 $sql = "SELECT wordsearch_words FROM tb_wordsearch WHERE wordsearch_category = '$category' and wordsearch_level='$level'"; // Replace 1 with the ID of the row you want to fetch
// exit;
$result = $conn->query($sql);

// Create an empty array to store the words
$wordList = array();

// Loop through the rows and retrieve the words
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $words = explode(',', $row["wordsearch_words"]); // Split the string by comma and return an array of words
        foreach ($words as $word) {
            $wordList[] = strtoupper(trim($word)); // Add each word to the array, trimming any whitespace and converting to uppercase
        }
    }
}

// Return the list of words as a JSON response
$response = array("wordList" => $wordList);
echo json_encode($response);

// Close the database connection
$conn->close();
?>