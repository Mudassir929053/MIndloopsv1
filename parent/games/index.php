<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
?>



<main id="main">


    <div class="container-fluid">
        <div class="row">
            <img src="../../assets/games/Game Banner 2.png" class="img-fluid" alt="" style="width: 100%; padding: 0">
        </div>
    </div>



    <div class="container-fluid">
        <div class="row">
            <div class="bg">

                <div class="container-fluid">

                    <div class="row">
                        <div class="py-5">
                            <h2 class="text-center">WHAT'S NEW</h2>
                        </div>
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-3">
                                    <div class="box px-4">
                                        <!-- Box content goes here -->
                                        <a href="crossword/index.php"><img src="../../assets/games/_A&C.png" class="img-fluid" /></a>
                                        <h4>Crossword</h4>
                                        <p>Puzzle Game</p>
                                        <!-- <p>Difficulty</p> -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box px-4">
                                        <!-- Box content goes here -->
                                        <a href="suduko"><img src="../../assets/games/_Puzzles.png" class="img-fluid" /></a>
                                        <h4>Sudoku</h4>
                                        <p>Puzzle Game</p>
                                        <!-- <p>Difficulty</p> -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box px-4">
                                        <!-- Box content goes here -->
                                        <a href="wordsearch/"><img src="../../assets/games/_Quizzes.png" class="img-fluid" /></a>
                                        <h4>Wordsearch</h4>
                                        <p>Puzzle Game</p>
                                        <!-- <p>Difficulty</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="container-fluid">
                    <div class="row">
                        <div class="py-5">
                            <h2 class="text-center">MORE TO PLAY</h2>
                        </div>
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-3">
                                    <div class="box px-4">
                                        <!-- Box content goes here -->
                                        <a href="jigsaw/"><img src="../../assets/games/_A&C.png" class="img-fluid" /></a>
                                        <h4>Jigsaw</h4>
                                        <p>Puzzle Game</p>
                                        <!-- <p>Difficulty</p> -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box px-4">
                                        <!-- Box content goes here -->
                                        <a href="./match_words/"><img src="../../assets/games/_Puzzles.png" class="img-fluid" /></a>
                                        <h4>Match Words</h4>
                                        <p>Puzzle Game</p>
                                        <!-- <p>Difficulty</p> -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box px-4">
                                        <!-- Box content goes here -->
                                        <a href="#"><img src="../../assets/games/_Quizzes.png" class="img-fluid" /></a>
                                        <h4>Game Name</h4>
                                        <p>Puzzle Game</p>
                                        <!-- <p>Difficulty</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


</main><!-- End #main -->

<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>

</body>

</html>