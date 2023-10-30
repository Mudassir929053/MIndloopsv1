<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mindloop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <style>
        body {
            background: url('../../assets/games/Sudoku/background_image.png') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }
        .btn-bg-easy {
    background-image: url("../../assets/games/Sudoku/easy.png");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    border: none;
  
  }
        .btn-bg-medium {
    background-image: url("../../assets/games/Sudoku/medium.png");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    border: none;
  
  }
        .btn-bg-hard {
    background-image: url("../../assets/games/Sudoku/hard.png");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    border: none;
  
  }
        .btn-bg-newgame {
    background-image: url("../../assets/games/Sudoku/new_game.png");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    border: none;
  
  }
        .btn-bg-resume {
    background-image: url("../../assets/games/Sudoku/resume.png");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    border: none;
  
  }

  .btn-bg-image:focus, 
  .btn-bg-image.active {
    background-color: #fd7e14;
    text-shadow: none;

  }
  
  .btn-bg-image:hover {
    background-color: transparent;
  }
  .btn-no-text {
  color: transparent;
  font-size: 0;
  text-shadow: none;
}

.btn-no-text:hover {
  color: transparent;
  text-shadow: none;
}

    

/* styles for small screens */
        @media (max-width: 576px) {
            .container {
                width: 100%;
                padding: 0;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        /* styles for medium and large screens */
        @media (min-width: 577px) {
            .container {
                max-width: 960px;
            }
        }
    </style>
</head>

<body>
    <div class="bg-image pt-2 text-center shadow-1-strong rounded text-white">
        <nav>
            <div class="nav-container">
                <a href="#" class="nav-logo">
                </a>
                <div class="dark-mode-toggle" id="dark-mode-toggle">
                    <i class="bx bxs-sun"></i>
                    <i class="bx bxs-moon"></i>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-1 col-md-4 col-sm-4 mb-3 mb-md-0">
                    <a class="thumbnail" href="index.php">
                        <img src="../../assets/games/Crossword/Asset 61.png" class="img-fluid rounded" alt="...">
                    </a>
                </div>
                <div class="col-lg-10 col-md-4 col-sm-4 mb-3 mb-md-0">
                    <!-- <a class="thumbnail" href="#">
        <img src="../../assets/games/Sudoku/suduko_logo.png" class="img-fluid rounded mx-auto d-block" alt="...">
      </a> -->
                </div>
                <div class="col-lg-1 col-md-4 col-sm-4 ">
                    <!-- <a class="thumbnail" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <img src="../../assets/games/Crossword/Asset 62.png" class="img-fluid rounded" alt="...">
      </a> -->
                </div>
            </div>
        </div>
        <!-- main -->
        <div class="main my-5 d-sm-none d-md-block">
            <div class="screen">
                <!-- start screen -->
                <div class="start-screen active px-5" id="start-screen">
  <input type="text" placeholder="Your name" maxlength="11" class="input-name" id="input-name">
  <div class="my-5"></div>
  <div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-4 col-sm-12 mb-3">
      <button class="btn btn-warning btn-lg btn-bg-easy btn-no-text" id="btn-easy" onclick="selectLevel('btn-easy')"></button>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
      <button class="btn btn-warning btn-lg btn-bg-medium btn-no-text" id="btn-medium" onclick="selectLevel('btn-medium')"></button>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
      <button class="btn btn-warning btn-lg btn-bg-hard btn-no-text" id="btn-hard" onclick="selectLevel('btn-hard')"></button>
    </div>
  </div>
</div>


  <div class="container py-5">
    <div class="row justify-content-center m-3">
      <span id="btn-continue"></span>
      <!-- <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
      
        <a class="thumbnail" id="btn-continue">
          <img src="../../assets/games/Sudoku/continue.png" class="img-fluid rounded" alt="...">
        </a>
      </div> -->
      <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
        <a class="thumbnail" id="btn-play">
          <img src="../assets/games/sudoku/new_game.png" class="img-fluid rounded" alt="...">
        </a>
      </div>
    </div>
  </div>
</div>


                <!-- end start screen -->
                <!-- game screen -->
                <div class="main-game px-2" id="game-screen">
                <div class="d-none main-game-info ">
                    <div class="main-game-info-box main-game-info-name">
                        <span id="player-name">tuat</span>
                    </div>
                    <div class="main-game-info-box main-game-info-level">
                        <span id="game-level">Easy</span>
                    </div>
                </div>
                    <div class="container mb-5">
                        <div class="row">
                            <div class="main-game-info-box main-game-info-time">
                                <span id="game-time" class="text-white fw-bolder">Time Start</span>
                                <div class="pause-btn" id="btn-pause">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pause-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.25 5C5.56 5 5 5.56 5 6.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C7.5 5.56 6.94 5 6.25 5zm3.5 0c-.69 0-1.25.56-1.25 1.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C11 5.56 10.44 5 9.75 5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="main-sudoku-grid p-3">
                                    <!-- 81 cells -->
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                    <div class="main-grid-cell"></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="numbers">
                                    <div class="number shadow-lg p-2">1</div>
                                    <div class="number shadow-lg p-2">2</div>
                                    <div class="number shadow-lg p-2">3</div>
                                    <div class="number shadow-lg p-2">4</div>
                                    <div class="number shadow-lg p-2">5</div>
                                    <div class="number shadow-lg p-2">6</div>
                                    <div class="number shadow-lg p-2">7</div>
                                    <div class="number shadow-lg p-2">8</div>
                                    <div class="number shadow-lg p-2">9</div>
                                    <div class="number shadow-lg p-2" style="background-color:transparent;"></div>
                                    <div class=" d-flex justify-content-center">
                                        <div class="delete shadow-lg p-2 px-4" id="btn-delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end game screen -->
                <!-- pause screen -->
                <div class="pause-screen bg-warning border border-2 border-white" id="pause-screen">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 col-sm-8 col-10 mb-3">
        <button class="btn btn-warning btn-lg btn-bg-resume btn-no-text" id="btn-resume" onclick="selectLevel('btn-resume')">Resume</button>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-8 col-10 mb-3">
        <button class="btn btn-warning btn-lg btn-bg-newgame btn-no-text" id="btn-new-game" onclick="selectLevel('btn-new-game')">New game</button>
      </div>
    </div>
  </div>
</div>

                <!-- end pause screen -->
                <!-- result screen -->
                <div class="result-screen bg-warning border border-5 rounded p-5" id="result-screen">
                    <div class="congrate">Competed</div>
                    <div class="info">Time</div>
                    <div id="result-time"></div>
                    <!-- <div class="btn" id="btn-new-game-2">New game</div> -->
                    <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
        <a class="thumbnail"  id="btn-new-game-2">
          <img src="../../assets/games/sudoku/new_game.png" class="img-fluid rounded" alt="...">
        </a>
      </div>
                </div>
                <!-- end result screen -->
            </div>
        </div>
    </div>
    <script>
        function selectLevel(selectedLevel) {
            var buttons = document.getElementsByTagName("button");
            for (var i = 0; i < buttons.length; i++) {
                if (buttons[i].id === selectedLevel) {
                    buttons[i].style.backgroundColor = "#fd7e14";
                } else {
                    buttons[i].style.backgroundColor = "#fff";
                }
            }
        }
    </script>
    <script src="static/js/constant.js"></script>
    <script src="static/js/sudoku.js"></script>
    <script src="static/js/app.js"></script>
    <!-- Button trigger modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>