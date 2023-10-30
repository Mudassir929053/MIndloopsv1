<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Foundation:wght@500&display=swap" rel="stylesheet">
    <style>
        .crossword {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        @media only screen and (max-width: 767px) {
            .crossword {
                flex-direction: column;
            }
        }

        .crossword-puzzle {
            width: 100%;
        }

        .crossword-clues {
            width: 100%;
            max-width: 400px;
        }
   
    </style>
<style>
    body {
  background: url('../../assets/games/Crossword/Asset 17.png') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}
</style>
</head>
<body>
    <div class="bg-image p-5 text-center shadow-1-strong rounded text-white" >
       <div class="container-fluid">
      <div class="row  align-items-center">
        <div class="col-lg-1 col-md-4 col-sm-4 mb-3 mb-md-0">
          <a class="thumbnail" href="crossword.php">
            <img src="../../assets/games/Crossword/Asset 61.png" class="img-fluid rounded" alt="...">
          </a>
        </div>
        <!-- <div class="col-lg-10 col-md-4 col-sm-4 mb-3 mb-md-0">
          <a class="thumbnail" href="crossword.php">
            <img src="../../assets/games/Crossword/Asset 131.png" class="img-fluid rounded" alt="...">
          </a>
        </div> -->
        <div class="col-lg-1 offset-lg-10 offset-md-4 col-md-4 col-sm-4 ">
          <a class="thumbnail" data-bs-toggle="modal" data-bs-target="#exampleModal123">
            <img src="../../assets/games/Crossword/Asset 62.png" class="img-fluid rounded" alt="...">
          </a>
        </div>
  
      </div>
    </div>
    <?php
    include '../../dbconnect.php';
    $cc_id = $_GET['cc_id'];
    // Retrieve data from "crossword_clue" table
    $sql = "SELECT * FROM `crossword_clue` 
LEFT JOIN crossword_categories ON crossword_clue.cc_id = crossword_categories.cc_id 
WHERE crossword_clue.cc_id = '$cc_id'
";
    $result = mysqli_query($conn, $sql);
    $words = array();
    $count = 1; // initialize count variable
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $word = array(
          "number" => $count,
          "direction" => $row["direction"],
          "row" => $row["row"],
          "column" => $row["column"],
          "clue" => $row["clue"],
          "answer" => $row["answer"],
          "hint" => $row["hint"]
        );
        array_push($words, $word);
        $count++; // increment count variable
      }
    }
    $words_json = json_encode($words);
    ?>
    <script>
      var words = <?php echo $words_json; ?>;
    </script>
   <div class="container-fluid">
        <div class="py-3">&nbsp;</div>
        <div class="row">
         
          <!-- <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
              <h1 class="page-header mb-0">Food and Drink Crossword</h1>
              <button class="btn btn-secondary mt-3 mt-md-0" onclick="history.back()">Back To Game</button>
            </div> -->
            <div class="crossword col-lg-7 ">
    </div>
           <!-- Modal -->
           <div class="modal fade" id="exampleModal123" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container bg-warning text-black border border-5 border-danger  p-5">
                    <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">How to Play</h1>
                        <h2 class="mb-4 fw-bold">Instructions</h2>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-bold me-2">1. </span>Start by clicking on a clue to select it. The clue will be highlighted, and the corresponding squares in the puzzle will also be highlighted.
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">2. </span>Type your answer into the highlighted squares. Use the arrow keys or the tab key to switch between across and down clues.
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">3. </span>If you're not sure about a word, you can use the "Check" button to see if it's correct. Incorrect letters will be highlighted in red.
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">4. </span>Once you've completed the puzzle, click the "Submit" button to see your score and any mistakes you may have made.
                            </li>
                            <li>
                                <span class="fw-bold me-2">5. </span>If you get stuck, you can use the "Reveal Letter" or "Reveal Word" buttons to help you out. But be careful, these will reduce your final score!
                            </li>
                        </ul>
                        <button type="button" class="btn btn-primary " data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="demo.js"></script>
</body>
</html>