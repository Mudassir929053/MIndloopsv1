<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mindloop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {
            background: url('../../assets/games/crossword/Asset 17.png') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }
    </style>
</head>

<body>
    <div class="bg-image p-5 text-center shadow-1-strong rounded text-white">
        <div class="container-fluid">
            <div class="row  align-items-center">
                <div class="col-lg-1 col-md-4 col-sm-4 mb-3 mb-md-0">
                    <a class="thumbnail" href="../../loops/view-loops.php">
                        <img src="../../assets/games/Crossword/Asset 61.png" class="img-fluid rounded" alt="...">
                    </a>
                </div>
                <div class="col-lg-10 col-md-4 col-sm-4 mb-3 mb-md-0">
                    <a class="thumbnail" href="#">
                        <img src="../../assets/games/Crossword/Asset 91.png" class="img-fluid rounded mx-auto d-block" alt="...">
                    </a>
                </div>
                <div class="col-lg-1 col-md-4 col-sm-4 ">
                    <a class="thumbnail" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="../../assets/games/Crossword/Asset 62.png" class="img-fluid rounded" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <div class="container-fluid pt-5">
            <a class="thumbnail" href="crossword.php">
                <img src="../../assets/games/Crossword/Asset 88.png" alt="">
            </a>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container bg-warning border border-5 border-danger  p-5">
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
    </div>
    <!-- Button trigger modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>