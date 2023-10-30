<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz 2</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous"> <!-- <link rel="stylesheet" href="style.css"> --> <!-- <link rel="stylesheet" href="https://codepen.io/clementmartin17/pen/254651da9d3f8b04e103aad5645ca919.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- Favicons -->
    <link href="../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
    <link href="../../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon"> <!-- Google Fonts --> <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> --> <!-- Vendor CSS Files -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tween.js/18.6.4/tween.umd.js"></script> <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">
    <link href="../../assets/css/package.css" rel="stylesheet">
    <link href="jigsawindex.css" rel="stylesheet">
    <style>
        body {
            background: url('../../assets/jigsaw_UI/Asset18.png') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }
    </style>
</head>

<body class="greenTheme q-c-dark-secondary body">
    <div class="flex-contianer p-5">
        <div class="left-btn"> <a href="../../loops/view-loops.php" class=""> <img src="../../assets/jigsaw_UI/arrow.png"> </a> </div>
        <div class="right-btn"> <a class="thumbnail" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="../../assets/jigsaw_UI/instruction.png"></a> </div>
        <!-- <div class="right-btn"> <a class="thumbnail" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="../../assets/Puzzle/Asset62.png"></a> </div> <div class="class">     <a class="thumbnail" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img id="img1" src="../assets/games/match_words/images/questionbtn.png" class="img-fluid rounded" alt="..."> </a> </div> -->
    </div> <!-- ======= Header ======= -->
    <div class="container pt-1">
        <div class="row">
            <div class="col-md-12 p-5">
                <div class="thumbnail">
                    <div class="hover01 text-center"> <a href="" target="">
                            <figure class="swing"> <img src="../../assets/jigsaw_UI/Asset92.png" alt="" style="width:60%; height:100%">
                        </a></figure>
                    </div>


                </div>
            </div>
            <div class="col-md-12 p-5 text-center sticky-center"> <a href="jigsawcategory.php" target=""> <img src="../../assets/jigsaw_UI/Asset88.png" class="img-fluid" alt=""> </a> </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container border border-5  p-5"> <!-- <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">How to Play</h1> -->
                        <h2 class="mb-4 fw-bold">Instructions for playing</h2>
                        <ul class="list-unstyled">
                            <li class="mb-3"> <span class=" me-2">1. </span>To begin, clicking the play button. </li>
                            <li class="mb-3"> <span class="me-2">2.Then select the category images you want to play. </span> </li>
                            <li class="mb-3"> <span class="me-2">3. </span>Choose the images for the puzzle game based on your interests. </li>
                            <li class="mb-3"> <span class="me-2">4. </span>Put the puzzle pieces together to complete the picture. </li>
                            <li class="mb-3"> <span class="me-2">4. </span>Then choose the puzzle level you want to play. </li>
                            <li> <span class="me-2">5. </span>Once you completed the Game , you can play again or Quit the game. </li>
                        </ul> <button type="button" class="btn btn-primary " data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="code.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script>
    const startBtn = document.querySelector('[data-level="start"]');
    const exitBtn = document.querySelector('[data-level="exit"]');
    startBtn.addEventListener('click', () => {
        window.location.href = 'jigsawfirst.php';
    });
    exitBtn.addEventListener('click', () => {
        window.location.href = '../home/home.php';
    });
</script>

</html>