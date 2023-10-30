<?php

include "../dbconnect.php";

$mbid= $_GET['id'];
$sql = "SELECT * FROM `crossword_clue` 
LEFT JOIN crossword_categories on crossword_clue.cc_id = crossword_categories.cc_id 
WHERE crossword_clue.cc_id = '$mbid'";
// exit;

try{
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);

    }else{

        mysqli_stmt_execute($stmt); 
        $result = $stmt->get_result();
        $finalData = array();

        while($row = $result->fetch_assoc()){    
            $data = array(
                "clue_id" => $row["clue_id"],
                "cc_clue" => $row["clue"],
                "cc_answer" => $row["answer"],
                "cc_hint" => $row["hint"],
                "cc_direction" => $row["direction"],
                "cc_row" => $row["row"],
                "cc_column" => $row["column"],


            );
            
            array_push($finalData, $data);
        }

        echo json_encode($finalData);
    }
}
catch(PDOException $e){
    $data = array(
        "status" => "fail"
    );
    echo json_encode($data);
}


?>