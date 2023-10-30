<?php
include '../../dbconnect.php';
// $data = ["name"=>"Sana","company"=>"Intelcode"];

extract($_GET);
// echo $level;
$sql = "SELECT wordsearch_words FROM `tb_wordsearch` WHERE wordsearch_level='$level' and wordsearch_category='$category'";
$result = mysqli_query($conn, $sql);

// exit;

?>

<!doctype html>
<html lang="en">

<head>
  <title>Word Search</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
  <link href="style.css" rel="stylesheet">

  <!-- Favicons -->
  <link href="../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
  <link href="../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../../assets/vendor/glightbox/css/gallery/glightbox.min.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../../assets/vendor/swiper/gallery/swiper-bundle.min.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">
  <link href="../../assets/css/package.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/p5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="code.js"></script>




  <style>
    .button-container {
      display: flex;
      justify-content: center;
    }

    #ok-btn {
      background-color: #fd1364;
      color: white;
      font-weight: bold;
      border: none;
      padding: 10px 35px;
      /* increased button size */
      font-size: 1.8rem;
      /* increased font size */
      border-radius: 20px;
      /* margin: 10px; */
      cursor: pointer;
      box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
      margin-left: 95px;
    }

    #ok-btn:hover {
      transform: scale(1.1);
      background-color: #FCEADE;
      color: #F8A5C2;
    }

    #popup {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      display: flex;
      justify-content: center;
      /* Center the modal horizontally */
      align-items: center;
    }

    .popup-content {
      background-image: url('../../assets/games/wordsearch/Asset27.png');
      background-size: contain;
      /* cover the background image */
      background-repeat: no-repeat;
      /* background-position: center; */
      padding: 10rem;
      /* decreased container size */
      border-radius: 5px;
      /* text-align: center; */
    }

    #myModal {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 10%;
      /* decreased container size */
      border-radius: 30px;

    }

    .button-container {
      display: flex;
      justify-content: space-between;
    }

    .modal1-content {
      background-color: transparent;
      border: none;
      color: black;
      /* position: absolute; */
      /* width: 15%; */
      /* margin-top: 80px;
      margin-right: 60px; */
    }

    .modal1-dialog {
      /* background-color: transparent; */
      background-image: url('../../assets/games/wordsearch/Asset27.png');
      /* Center and add the background image */
      background-size: contain;
      padding: 15rem;
      /* decreased container size */
      border-radius: 30px;
      /* background-color: transparent; */
      border: none;
      background-repeat: no-repeat;
      /* max-width: 800px; */
      /* Set the background color of the modal content to transparent */
      position: absolute;
      left: 550px;
      top: 25px;

    }

    .modal1-footer button {
      background-color: #2e7d32;
      color: white;
      /* Style the button with a green background and white text */
      border-radius: 0;
      /* Remove the button border radius */
    }

    .modal1-footer button:hover {
      background-color: #1b5e20;
      /* Darken the button background color on hover */
    }

    #quit-btn,
    #play-again-btn,
    #quit-btn-lost,
    #play-again-btn-lost {
      background-color: #fd1364;
      color: white;
      font-weight: bold;
      border: none;
margin: 20px;
      /* increased button size */
      font-size: 1.9rem;
      /* increased font size */
      border-radius: 10px;
      /* margin: 10px; */
      cursor: pointer;
      box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
    }

    #quit-btn-lost:hover,
    #play-again-btn-lost:hover, #quit-btn:hover,
    #play-again-btn:hover {
      transform: scale(1.1);
      background-color: #FCEADE;
      color: #F8A5C2;
    }
  </style>



</head>

<body>
  <div class="bg-image pt-5 shadow-1-strong rounded text-white" style="background-image: url('../../assets/games/wordsearch/Asset21.png'); height:100vh; background-size: 100% 100%; background-repeat: no-repeat;">
    <div class="container-fluid">
      <div class="row ">
        <div class="col-lg-6 d-flex justify-content-start">
          <a class="thumbnail" href="index.php">
            <img src="../../assets/games/wordsearch/Asset61.png" class="img-fluid rounded" alt="..."> </a>
        </div>

        <div class="col-lg-6 d-flex justify-content-end">
          <a class="thumbnail" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="../../assets/games/wordsearch/Asset62.png" class="img-fluid rounded" alt="..."> </a>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div id="timer" class="text-center text-dark display-5">00:00</div>
      </div>
    </div>



    <div class="container py-5 font d-flex justify-content-center align-items-center">
      <div id="canvasContainer"><canvas id="canvas" width="100" height="100"></canvas></div>
      <ul id="list"></ul>
    </div>
  </div>


  <!-- Modal -->
  <div id="popup">
    <div class="popup-content">
      <br><br>
      <h3>Search down and forward</h3>
      <h3>to find the hidden words.</h3>
      <div class="button-container"> <button id="ok-btn">OK</button> </div>
    </div>
  </div> <!--END Modal -->





  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="container border border-5 border-danger p-5">
            <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">How to Play</h1>
            <h2 class="mb-4 fw-bold">Instructions</h2>
            <ul class="list-unstyled" style="font-size: small;">
              <li class="mb-3"> <span class="fw-bold me-2">1. </span>Start by clicking on play button.</li>
              <li class="mb-3"> <span class="fw-bold me-2">2. </span>Select your level.</li>
              <li class="mb-3"> <span class="fw-bold me-2">3. </span>Select your Category.</li>
              <li class="mb-3"> <span class="fw-bold me-2">4. </span>Select the complete word in Grid.</li>
              <li> <span class="fw-bold me-2">5. </span>After completing,You will get a popup message to play again and quit</li>
            </ul> <button type="button" class="btn btn-primary " data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>











  <!-- you won modal -->
  <div id="myModal" class="modal1" tabindex="-1" role="dialog" style="display: none">
    <div class="modal1-dialog" role="document">
      <div class="modal1-content">
        <div class="modal1-body">
          <h3>You did great</h3>
          <!-- <h3>to find the hidden words.</h3> -->
        </div>
        <div class="button-container">
          <button id="play-again-btn" type="button">
            Play Again</button>
          <button id="quit-btn" type="button">
            Quit</button>
        </div>
      </div>
    </div>
  </div>


  <!-- you lost modal -->

  <div id="myModallost" class="modal" tabindex="-1" role="dialog" style="display: none">
    <div class="modal1-dialog" role="document">
      <div class="modal1-content">

        <div class="modal1-body">
          <h3>You lost! Play again?</h3>
        </div>
        <div class="button-container">
          <button id="play-again-btn-lost" type="button">Play Again</button>
          <button id="quit-btn-lost" type="button">Quit</button>
        </div>
      </div>
    </div>
  </div>
  <!-- you lost modal -->

  <script>
    window.onload = function() {
      var popup = document.getElementById("popup");
      var okBtn = document.getElementById("ok-btn");
      okBtn.onclick = function() {
        popup.style.display = "none";
      }
    }
  </script>
  <script>
    class Grid {
      constructor(width, height, data) {
        this.width = width;
        this.height = height;
        this.data = data || new Array(width * height).fill("_");
        if (level == 'easy') {

          this.timeLimit = 120; // 5 minutes in seconds

        }

        if (level == 'medium') {
          this.timeLimit = 300; // 5 minutes in seconds


        }
        if (level == 'hard') {

          this.timeLimit = 600; // 5 minutes in seconds

        }
        // Start timer for 5 minutes
        this.timerElement = document.getElementById("timer");
        this.timerId = null;
        this.startTimer();
      }
      //timer
      startTimer() {
        let timeLeft = this.timeLimit;
        this.timerId = setInterval(() => {
          let minutes = Math.floor(timeLeft / 60);
          let seconds = timeLeft % 60;
          this.timerElement.innerText = `${minutes
        .toString()
        .padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
          if (timeLeft <= 0) {
            clearInterval(this.timerId);
            this.timerElement.innerText = "00:00:00";
            const modal = document.getElementById("myModallost");
            const message = document.getElementById("message");
            modal.style.display = "block";
            // message.innerText = "You lost! Better luck next time.";
            const playAgainBtn = document.getElementById("play-again-btn-lost");
            playAgainBtn.onclick = function() {
              location.reload();
            };
            const quitBtn = document.getElementById("quit-btn-lost");
            quitBtn.onclick = function() {
              window.location.href = "index.php";
            };
            const closeBtn = document.querySelector(".close");
            closeBtn.addEventListener("click", () => {
              modal.style.display = "none";
            });
          }

          timeLeft--;
        }, 1000);
      }

      //end of timer
      get length() {
        return this.width * this.height;
      }

      get(x_pos, y) {
        if (y != undefined) return this.data[x_pos + y * this.width];
        else return this.data[x_pos];
      }

      set(value, x_pos, y) {
        if (y != undefined) this.data[x_pos + y * this.width] = value;
        else this.data[x_pos] = value;
      }

      clone() {
        return new Grid(this.width, this.height, this.data.slice());
      }

      finalize() {
        this.data = this.data.map((v) =>
          v == "_" ? String.fromCharCode(Math.floor(Math.random() * 26) + 97) : v
        );
      }

      print() {
        for (let i = 0; i < this.height; i++)
          console.log(
            this.data.slice(i * this.width, (i + 1) * this.width).join(",")
          );
      }
    }
    let level = "<?= $level ?>";


    class PuzzleApp extends App {
      constructor(div, puzzle) {
        super(div);
        this.puzzle = puzzle;
        this.renderList(document.getElementById("list"));
        this.selections = new Array();
        this.loop();
      }

      renderList(parent) {
        let ul = document.createElement("ul");
        ul.style.padding = "20px";
        ul.style.listStyle = "none";
        ul.style.animation = "slideIn 0.5s ease-in-out";
        let words_size = 5;
        if (level == 'medium') {
          words_size = 10;
          ul.style.columnCount = "2"; // set the number of columns here

        }
        if (level == 'hard') {
          words_size = 15;
          ul.style.columnCount = "2"; // set the number of columns here

        }

        let words = this.puzzle.words.slice(); // Copy the array of words
        words.sort(() => Math.random() - 0.5); // Shuffle the array of words randomly
        words = words.slice(0, words_size); // Take the first 5 words from the shuffled array

        words.forEach((word, index) => {
          let li = document.createElement("li");
          let text = document.createTextNode(word);
          li.appendChild(text);
          li.style.marginBottom = "5px";
          li.style.padding = "5px";
          li.style.borderRadius = "15px";
          li.style.fontFamily = "arial";
          li.style.fontSize = "30px";
          li.style.color = "black";
          li.style.textAlign = "center";
          li.style.textShadow = "1px 1px 2px #555";
          ul.appendChild(li);
        });

        parent.appendChild(ul);
      }






      gridSize() {
        let wsize = Math.floor(this.canvas.width / this.puzzle.grid.width);
        let hsize = Math.floor(this.canvas.width / this.puzzle.grid.height);
        return [wsize, hsize];
      }

      clientToGrid(x, y) {
        let [wsize, hsize] = this.gridSize();
        x = Math.floor(x / wsize);
        y = Math.floor(y / hsize);
        return [x, y];
      }

      draw() {
        if (!this.puzzle)
          return;

        this.ctx.clearRect(0, 0, canvas.width, canvas.height);

        let [wsize, hsize] = this.gridSize();

        this.selections.forEach(s => s.draw(this.ctx, wsize, hsize));
        if (this.selection)
          this.selection.draw(this.ctx, wsize, hsize);

        let x = 0;
        let y = 0;

        this.ctx.fillStyle = "white";
        this.ctx.font = (wsize * 0.5) + 'px sans-serif';
        this.ctx.textAlign = "center";
        this.ctx.textBaseline = "middle";

        for (let j = 0; j < this.puzzle.grid.height; j++) {
          for (let i = 0; i < this.puzzle.grid.width; i++) {
            let letter = this.puzzle.grid.get(i, j);
            this.ctx.beginPath();
            this.ctx.arc(x + wsize * 0.5, y + wsize * 0.5, wsize * 0.4, 0, 2 * Math.PI);
            this.ctx.fill();
            this.ctx.fillStyle = "black";
            this.ctx.fillText(letter.toUpperCase(), x + wsize * 0.5, y + wsize * 0.5);

            this.ctx.fillStyle = "white";
            x += wsize;
          }
          x = 0;
          y += wsize;
        }
      }








      touchdown(x, y) {
        [x, y] = this.clientToGrid(x, y);

        this.selection = new Selection(new Vector(x, y));
        this.dirty = true;
      }

      touchmove(x, y) {
        if (!this.selection)
          return;

        [x, y] = this.clientToGrid(x, y);

        this.selection.to(new Vector(x, y));
      }

      touchup(x, y) {
        if (!this.selection)
          return;

        let word = this.puzzle.wordAt(this.selection.position, this.selection.direction, this.selection.length + 1);
        console.log(word);
        if (word) {
          let list = document.getElementById("list");
          let elements = list.getElementsByTagName("li");

          Array.prototype.some.call(elements, li => {
            if (li.innerText == word) {
              li.classList.add("found");
              this.selections.push(this.selection.clone().fill());
              return true;
            }
            return false;
          });

          let allFound = Array.prototype.every.call(elements, li => li.classList.contains("found"));

          if (allFound) {
            const modal = document.getElementById("myModal");
            const playAgainBtn = document.getElementById("play-again-btn");
            const quitBtn = document.getElementById("quit-btn");
            modal.style.display = "block";
            playAgainBtn.addEventListener("click", () => {
              window.location.reload();
            });
            quitBtn.addEventListener("click", () => {
              window.location.href = "index.html";
            });
            const closeBtn = document.querySelector(".close");
            closeBtn.addEventListener("click", () => {
              modal.style.display = "none";
            });
          }
        }

        this.selection = null;
      }
    }






    let app = null;

    document.addEventListener("DOMContentLoaded", function(event) {

      const pick = (array) => array[Math.floor(Math.random() * (array.length))];
      let params = (new URL(document.location)).searchParams;
      let directions = [new Vector(1, 0), new Vector(0, 1)];
      if (params.get("diagonal")) {
        directions.push(new Vector(1, 1));
      }
      if (params.get("backwards")) {
        directions.push(new Vector(-1, 0));
        directions.push(new Vector(0, -1));
        if (params.get("diagonal")) {
          directions.push(new Vector(-1, -1));
        }
      }
      let level = "<?= $level ?>";
      let category = "<?= $category ?>";
      let grid = 10;
      if (level == 'medium') {
        grid = 15;
      }
      if (level == 'hard') {
        grid = 17;
      }
      // Make AJAX call to get list of words from database
      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          // console.log(this.responseText)
          const response = JSON.parse(this.responseText);
          const wordList = response.wordList;
          const puzzle = new Puzzle(grid, grid, wordList, directions);
          puzzle.print();
          app = new PuzzleApp(document.getElementById("canvasContainer"), puzzle);
        }
      };
      xhr.open("GET", "getwordlist.php?level=" + level + "&category=" + category, true);
      xhr.send();
    });
  </script>


</body>

</html>