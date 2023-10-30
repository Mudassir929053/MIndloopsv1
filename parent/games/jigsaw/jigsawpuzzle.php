<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz 2</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="style.css"> -->
  <!-- <link rel="stylesheet" href="https://codepen.io/clementmartin17/pen/254651da9d3f8b04e103aad5645ca919.css"> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Favicons -->
  <link href="../../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
  <link href="../../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->
  <!-- Vendor CSS Files -->
  <link href="../../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/glightbox/css/gallery/glightbox.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/swiper/gallery/swiper-bundle.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tween.js/18.6.4/tween.umd.js"></script>
  <!-- Template Main CSS File -->
  <link href="../../../assets/css/style.css" rel="stylesheet">
  <link href="../../../assets/css/package.css" rel="stylesheet">
  <link href="jigsawpuzzle.css" rel="stylesheet">
<style>
  .body {
  background-image: url("../../../assets/jigsaw_UI/Asset19.png");
  background-size: 100% 100%;
  background-repeat: no-repeat;
  overflow-y: auto;
  background-attachment: fixed;
}
.popup-content {
background-image: url('../../../assets/jigsaw_UI/popup.png');
background-size: contain;
background-repeat: no-repeat;
background-position: center;
padding: 12rem;
border-radius: 5px;
}
</style>
</head>

<body class="body">
  <!-- ======= Header ======= -->
  <div class="flex-contianer p-5">
    <div class="left-btn">
      <a href="jigsawcategory.php" class="">
        <img src="../../../assets/jigsaw_UI/arrow.png">
      </a>
    </div>
    <!-- <div class="right-btn">
      <img src="../../assets/Puzzle/Asset62.png">
    </div> -->
  </div>
  <div id="app" class="app">
    <div class="container-fluid">
      <div class="row">
        <!-- <div class="col-md-3">&nbsp;</div> -->
        <div class="col-md-9">
          <div id="app1"></div>
        </div>
        <div class="col-md-3 position-relative">
          <div class="position-absolute top-50 end-20 translate-middle-y">
            <div class="row ">
              <div class="col-lg-6 ">
                <select class="level-btn btn btn-info  px-4" name="pickimage">
                  <?php
                  $conn = mysqli_connect('localhost', 'root', '', 'db_mindloop');
                  $ji_id = $_GET['id'];
                  if ($conn->connect_error) {
                    die("Connection failed: " . mysqli_connect_error());
                    exit();
                  }
                  $querycn = $conn->query("SELECT * FROM jigsaw_image WHERE ji_id = $ji_id");
                  if (mysqli_num_rows($querycn) > 0) {
                    while ($rows = mysqli_fetch_object($querycn)) {
                  ?>
                      <option value="../../../assets/jigsawimages/<?php echo $rows->ji_image; ?>" selected>
                        <?php echo $rows->ji_name; ?>
                      </option>
                  <?php }
                  } ?>
                </select>
              </div>
              <div class="col-lg-6">
                <select class="level-btn btn btn-info me-2 px-4" name="boardconfig">
                  <option value="3x3" selected>Select Level</option>
                  <option value="4x4">4 x 4</option>
                  <option value="5x5">5 x 5</option>
                  <option value="6x6">6 x 6</option>
                  <option value="7x7">7 x 7</option>
                  <option value="8x8">8 x 8</option>
                  <!-- <option value="7x5">7 x 5</option> -->
                </select>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="butt" style="z-index: 100;" id="controls">
      <div class="container"></div>
    </div>
    <div class="flex-contianer1 text-center" style="margin-bottom: 30px;">
      <button class="level-btn btn btn-danger me-2 px-5" name="shufflepuzzle">Shuffle</button>
      <button class="level-btn btn btn-info me-2 px-5" name="resetpuzzle">Reset</button>
    </div>
  </div>

  </div>
  </div>
  <!-- <div id="myModal" style="display: none;">
  
    <div class="modal-content">
     
      <h3>JIGSAW PUZZLE GAME</h3>
      <div class="button">
       
        <button id="play-again-btn" type="button" class="btn btn-primary button1">OK</button>
      </div>
    </div>
  </div> -->

  <div id="myModal" style="display: none;">
    <div class="pop-content">
      <h3 class="text-center">Congratulation ! <br>You did a great job.</h3>
      <div class="button">
        <!-- <button id="ok-btn">OK</button>  -->
        <button id="play-again-btn" type="button" class="btn btn-info">Play again</button>
        <button id="play-again-btn1" type="button" class="btn btn-primary">Quit</button>
      </div>
    </div>
  </div>

  <div id="popup">
    <div class="popup-content">
      <h3>Complete the picture by <br>putting the pieces together</h3>
      <div class="button-container">
        <!-- <button id="ok-btn">OK</button>  -->
        <button id="ok-btn" type="button" class="btn btn-primary mt-5">OK</button>
      </div>
    </div>
  </div>
  <!-- Modal -->
</body>
<script>
  window.onload = function() {
    var popup = document.getElementById("popup");
    var okBtn = document.getElementById("ok-btn");
    okBtn.onclick = function() {
      popup.style.display = "none";
    }
  }

  const button = document.getElementById('play-again-btn1');
  const button1 = document.getElementById('play-again-btn');

  // Add an event listener to the button that redirects to a different page when clicked
  button.addEventListener('click', () => {
    location.href = "jigsawfirst.php";
  });
  button1.addEventListener('click', () => {
    location.reload();
  });
</script>
<script>

  let firstLoad=true;
  const FPS = 30
  const pickimage = document.querySelector('select[name=pickimage]')
  let IMAGE = pickimage.value
  let image = null
  let ROWS = 3
  let COLS = 3
  let RADIUS = 30
  let OFFSETL = 820
  let OFFSETT = 90
  let board = 2
  let piece = 1
  let bg_image='back1.png';
  const MAX_WIDTH = 500
  const MAX_HEIGHT = 500
  const app = document.querySelector('#app1')
  const canvas = document.createElement('canvas')
  app.appendChild(canvas)
  const ctx = canvas.getContext('2d')
  // UI -- begin
  let isMouseInside = false
  let isPieceMoving = false
  let mousePos = {
    x: 0,
    y: 0
  }
  let initialPos = {
    x: 0,
    y: 0
  }
  const resizeCanvas = () => {
    const {
      width,
      height
    } = app.getBoundingClientRect()
    canvas.width = width * 0.9
    canvas.height = height * 0.9
    if (board) {
      board.resize(canvas.width, canvas.height)
    }
  }
  canvas.addEventListener('pointerenter', (e) => {
    isMouseInside = true
  })
  canvas.addEventListener('pointerleave', (e) => {
    isMouseInside = false
    isPieceMoving = false
    piece = null
  })
  canvas.addEventListener('pointermove', (e) => {
    if (!isPieceMoving && isMouseInside && board) {
      piece = board.pieceByPos(ctx, e.offsetX, e.offsetY)
      board.unhoverPieces()
      if (piece) piece.hover()
    }
    if (isPieceMoving && piece) {
      const canvasRect = canvas.getBoundingClientRect()
      const canvasScaleX = canvas.width / canvasRect.width
      const canvasScaleY = canvas.height / canvasRect.height
      piece.x += (e.offsetX - mousePos.x) * canvasScaleX
      piece.y += (e.offsetY - mousePos.y) * canvasScaleY
    }
    mousePos.x = e.offsetX
    mousePos.y = e.offsetY
  })
  canvas.addEventListener('pointerdown', (e) => {
    if (piece) {
      isPieceMoving = true
      initialPos.x = piece.x
      initialPos.y = piece.y
    }
  })
  canvas.addEventListener('pointerup', (e) => {
    isPieceMoving = false
    if (piece) {
      // is the piece near its place?
      if (piece.isNearToPlace()) {
        let localPiece = piece
        let piecePos = {
          x: localPiece.x,
          y: localPiece.y
        }
        let tween = new TWEEN.Tween(piecePos)
          .to({
            x: 0,
            y: 0
          }, 250)
          .easing(TWEEN.Easing.Quartic.In)
          .onUpdate(() => {
            localPiece.z = 10
            localPiece.x = piecePos.x
            localPiece.y = piecePos.y
          })
          .onComplete(() => {
            localPiece.z = 0;
            if (board.check() && !firstLoad) {
              // Show the modal
              $('#myModal').show();    
              // Handle the play again button click event
              $('#play-again-btn').click(() => {
                // Hide the modal
                // $('#myModal').modal('hide');
                $('#myModal').hide();
                // Reset the board or start a new game
                board.pieces = [];
              });
              // Handle the quit button click event
              $('#quit-btn').click(() => {
                // Hide the modal
                $('#myModal').hide();
                // Quit the game or redirect to a different page
              });
            }
          })
          .start()
      } else {
        // reset the piece to its initial position
        let localPiece = piece
        let piecePos = {
          x: localPiece.x,
          y: localPiece.y
        }
        let tween = new TWEEN.Tween(piecePos)
          .to({
            x: initialPos.x,
            y: initialPos.y
          }, 250)
          .easing(TWEEN.Easing.Quartic.In)
          .onUpdate(() => {
            localPiece.z = 10
            localPiece.x = piecePos.x
            localPiece.y = piecePos.y
          })
          .onComplete(() => {
            localPiece.z = 0
          })
          .start()
      }
    }
    piece = null
  })
  pickimage.addEventListener('change', (e) => {
    IMAGE = e.target.value
    reset()
  })
  let selectedBgImage = '../../../assets/jigsaw_UI/back1.png';

const boardconfig = document.querySelector('select[name=boardconfig]');

boardconfig.addEventListener('change', (e) => {
  const dims = e.target.value.split('x');
  ROWS = dims[0];
  COLS = dims[1];

  if (COLS * ROWS > 5) {
    RADIUS = 15;
  } else if (COLS * ROWS > 12) {
    RADIUS = 20;
  } else if (COLS * ROWS > 8) {
    RADIUS = 25;
  } else {
    RADIUS = 30;
  }

  // Update selectedBgImage based on user selection
  switch (e.target.value) {
    case '3x3':
      selectedBgImage = '../../../assets/jigsaw_UI/back1.png';
      break;
    case '4x4':
      selectedBgImage = '../../../assets/jigsaw_UI/backbg2.png';
      break;
    case '5x5':
      selectedBgImage = '../../../assets/jigsaw_UI/backbg3.png';
      break;
      case '6x6':
      selectedBgImage = '../../../assets/jigsaw_UI/backbg4.png';
      break;
      case '7x7':
      selectedBgImage = '../../../assets/jigsaw_UI/backbg5.png';
      break;
      case '8x8':
      selectedBgImage = '../../../assets/jigsaw_UI/backbg6.png';
      break;
    // Add more cases as needed for other values
    default:
      selectedBgImage = '../../../assets/jigsaw_UI/back7.png';
  }

  reset();
});
  window.addEventListener('resize', () => {
    reset();
  })
  const resetpuzzle = document.querySelector('button[name=resetpuzzle]')
  resetpuzzle.addEventListener('click', (e) => {
    reset();
    firstLoad=true;
  })
  const shufflepuzzle = document.querySelector('button[name=shufflepuzzle]');
  shufflepuzzle.addEventListener('click', (e) => {
    const localPadding = 450;
    const localLeft = -300;
    firstLoad=false;
    const localRight = canvas.width - 1700;
    const localTop = localPadding;
    const localBottom = canvas.height - 400;
    let randomPosition = [];
    let currentPosition = [];
    for (let i = 0; i < board.pieces.length; i++) {
      let piecePos = board.posByIndex(i);
      let localX = piecePos.x * board.pw;
      let localY = piecePos.y * board.ph;
      if (i % 5 == 0) { // put even-indexed pieces on the left
        randomPosition.push({
          x: localLeft - localX + Math.random() * (localLeft - localRight - board.pw),
          // y: localTop - localY + Math.random() * (localBottom - localTop - board.ph)
        });
      } else { // put odd-indexed pieces on the right
        randomPosition.push({
          x: localRight - localX + Math.random() * (localLeft - localRight - board.pw),
          y: localTop - localY + Math.random() * (localBottom - localTop - board.ph)
        });
      }
      currentPosition.push({
        x: 0,
        y: 0
      });
    }
    for (let i = 0; i < board.pieces.length; i++) {
      let piece = board.pieces[i];
      new TWEEN.Tween(currentPosition[i])
        .to(randomPosition[i], 1000)
        .easing(TWEEN.Easing.Quadratic.Out)
        .onUpdate(() => {
          piece.x = currentPosition[i].x;
          piece.y = currentPosition[i].y;
          piece.z = i + 30;
        })
        .onComplete(() => {
          piece.z = 0;
        })
        .start();
    }
  });
  // UI -- end
  let deltaTime = 0
  let fpsDeltaTime = 0
  let fpsDeltaLimit = 1000 / FPS
  const render = (time) => {
    deltaTime = time - deltaTime
    fpsDeltaTime += deltaTime
    if (fpsDeltaTime >= fpsDeltaLimit) {
      TWEEN.update(time)
      if (board) board.render(ctx)
      fpsDeltaTime = 0
    }
    deltaTime = time
    requestAnimationFrame(render)
  }
  // init -- begin
  const reset = () => {
    image = new Image()
    image.src = IMAGE
    image.addEventListener('load', (e) => {
      let ratio = image.width / image.height
      let width = image.width
      let height = image.height
      if (image.width > image.height) {
        width = width > MAX_WIDTH ? MAX_WIDTH : width
        height = width / ratio
      } else {
        height = height > MAX_HEIGHT ? MAX_HEIGHT : height
        width = height * ratio
      }
      // adjust the canvas and image size based on viewport size
      const maxWidth = window.innerWidth * 1.9;
      const maxHeight = window.innerHeight * 1.9;
      if (width > maxWidth) {
        height *= maxWidth / width;
        width = maxWidth;
      }
      if (height > maxHeight) {
        width *= maxHeight / height;
        height = maxHeight;
      }
      image.width = 500;
      image.height = 550;
      canvas.width = app.clientWidth;
      canvas.height = app.clientHeight;
      if (canvas.width < 500) {
        OFFSETL = 20;
      }
      board = new Board(ROWS, COLS, image, OFFSETL, OFFSETT, RADIUS)
    })
  }
  const init = (event) => {
    reset()
    render(0)
  }
  document.addEventListener('DOMContentLoaded', init)
  // init -- end
  // window resize -- begin
  const resize = (event) => {
    const maxWidth = window.innerWidth * 0.8;
    const maxHeight = window.innerHeight * 0.8;
    let ratio = image.width / image.height
    let width = image.width
    let height = image.height
    if (width > maxWidth) {
      height *= maxWidth / width;
      width = maxWidth;
    }
    if (height > maxHeight) {
      width *= maxHeight / height;
      height = maxHeight;
    }
    image.width = width;
    image.height = height;
    canvas.width = app.clientWidth;
    canvas.height = app.clientHeight;
    if (canvas.width < 500) {
      OFFSETL = 20;
    }
    board = new Board(ROWS, COLS, image, OFFSETL, OFFSETT, RADIUS)
  }
  // delay processing of window resize
  let resizeTimeout = null
  window.addEventListener('resize', (e) => {
    clearTimeout(resizeTimeout)
    resizeTimeout = setTimeout(() => {
      resize(e)
    }, 100)
  })
  // window resize -- end
  // classes -- begin
  //
  
  class Piece {
    constructor(bx, by, width, height) {
      this.x = 0
      this.y = 0
      this.z = 0
      this.w = width
      this.h = height
      this.img = null
      this.mask = null
      this.bx = bx
      this.by = by
      this.isHover = false
      this.index = 0
    }
    isNearToPlace() {
      const distance = Math.sqrt(Math.pow(this.x, 2) + Math.pow(this.y, 2))
      if (distance < 50)
        return true
      return false
    }
    getMask() {
      return this.mask(this.x, this.y)
    }
    set image(v) {
      this.img = v
    }
    get image() {
      return this.img
    }
    hover() {
      this.isHover = true
      this.z = 10   
    }
    unhover() {
      this.isHover = false
      this.z = 0
    }
    render(ctx,bg_image) {
      ctx.save()
      let mask = this.getMask()
      ctx.strokeStyle = 'black'
      ctx.lineWidth = 5
      ctx.lineCap = 'round'
      ctx.stroke(mask)
      ctx.clip(mask, 'nonzero')
      ctx.drawImage(this.image,
        this.x + this.bx,
        this.y + this.by,
        this.image.width, this.image.height)
      if (this.isHover) {
        ctx.fillStyle = 'rgba(255, 230, 0, .25)'
        ctx.fill(mask)
      }
      ctx.restore()
    }
  }
  //
  class Board {
    constructor(rows, cols, image, x = 0, y = 0, radius = 20) {
      this.r = rows
      this.c = cols
      this.x = x
      this.y = y
      this.image = image
      this.pw = image.width / cols
      this.ph = image.height / rows
      this.pieces = []
      this.rad = radius
      for (let y = 0; y < this.r; y++) {
        for (let x = 0; x < this.c; x++) {
          let piece = new Piece(this.x, this.y, this.pw, this.ph)
          piece.image = this.image
          piece.index = this.index(x, y)
          piece.mask = this.mask(x, y, this.radius)
          this.pieces.push(piece)
        }
      }
    }
    get piecesByZAsc() {
      return [...this.pieces].sort((a, b) => a.z - b.z)
    }
    get piecesByZDesc() {
      return [...this.pieces].sort((a, b) => b.z - a.z)
    }
    get radius() {
      return this.rad
    }
    set radius(v) {
      this.rad = v
      this.updateMasks()
    }
    index(x, y) {
      return x + y * this.c
    }
    posByIndex(index) {
      return {
        x: index % this.c,
        y: Math.floor(index / this.c)
      }
    }
    check() {
      let counter = 0
      for (let i = 0; i < this.pieces.length; i++) {
        if (this.pieces[i].index != counter ||
          this.pieces[i].x != 0 ||
          this.pieces[i].y != 0) return false
        counter++
      }
      return true
    }
    updateMasks() {
      for (let y = 0; y < this.r; y++) {
        for (let x = 0; x < this.c; x++) {
          this.pieces[this.index(x, y)].mask = this.mask(x, y, this.radius)
        }
      }
    }
    unhoverPieces() {
      for (let i = 0; i < this.pieces.length; i++)
        this.pieces[i].unhover()
    }
    pieceByPos(ctx, x, y) {
      const pieces = this.piecesByZDesc
      for (let i = 0; i < pieces.length; i++)
        if (ctx.isPointInPath(pieces[i].getMask(), x, y, 'nonzero'))
          return pieces[i]
      return null
    }
 
render(ctx) {
  ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);

  // Draw the background image
  const bgImage = new Image();
  bgImage.src = selectedBgImage;
  ctx.drawImage(bgImage, this.x, this.y, this.image.width, this.image.height);

  // Render the pieces
  const pieces = this.piecesByZAsc;
  for (let i = 0; i < pieces.length; i++) {
    pieces[i].render(ctx);
  }
}
mask(x, y, radius) {
  return (px, py) => {
    let m = new Path2D()
    m.moveTo(px + this.x + x * this.pw, py + this.y + y * this.ph)
    // top
    if (y == 0) {
      m.lineTo(px + this.x + (x + 1) * this.pw, py + this.y + y * this.ph)
    } else {
      m.lineTo(px + this.x + (x + .5) * this.pw - radius, py + this.y + y * this.ph)
      m.arc(px + this.x + (x + .5) * this.pw, py + this.y + y * this.ph, radius, Math.PI, 0, true)
      m.lineTo(px + this.x + (x + 1) * this.pw, py + this.y + y * this.ph)
    }
    // right
    if (x == this.c - 1) {
      m.lineTo(px + this.x + (x + 1) * this.pw, py + this.y + (y + 1) * this.ph)
    } else {
      m.lineTo(px + this.x + (x + 1) * this.pw, py + this.y + (y + .5) * this.ph - radius)
      m.arc(px + this.x + (x + 1) * this.pw, py + this.y + (y + .5) * this.ph, radius, -Math.PI / 2, Math.PI / 2, false)
      m.lineTo(px + this.x + (x + 1) * this.pw, py + this.y + (y + 1) * this.ph)
    }
    // bottom
    if (y == this.r - 1) {
      m.lineTo(px + this.x + x * this.pw, py + this.y + (y + 1) * this.ph)
    } else {
      m.lineTo(px + this.x + (x + .5) * this.pw + radius, py + this.y + (y + 1) * this.ph)
      m.arc(px + this.x + (x + .5) * this.pw, py + this.y + (y + 1) * this.ph, radius, 0, Math.PI, false)
      m.lineTo(px + this.x + x * this.pw, py + this.y + (y + 1) * this.ph)
    }
    // left
    if (x == 0) {
      m.lineTo(px + this.x + x * this.pw, py + this.y + y * this.ph)
    } else {
      m.lineTo(px + this.x + x * this.pw, py + this.y + (y + .5) * this.ph + radius)
      m.arc(px + this.x + x * this.pw, py + this.y + (y + .5) * this.ph, radius, Math.PI / 2, -Math.PI / 2, true)
      m.lineTo(px + this.x + x * this.pw, py + this.y + y * this.ph)
    }
    return m
  }
}

  }
  // classes -- end
</script>

</html>