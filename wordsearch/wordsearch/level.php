<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mindloop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="bg-image pt-5 shadow-1-strong rounded text-white" style="background-image: url('../../assets/games/wordsearch/Asset20.png'); height:100vh; background-size: 100% 100%; background-repeat: no-repeat;">
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


        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="levels d-flex flex-column align-items-center mt-5 pt-5">
                        <button class="btn level-btn" data-level="easy"><img src="../../assets/games/wordsearch/easy.png" alt="..." class="img-fluid mx-auto d-block"></button>
                        <button class="btn level-btn" data-level="medium"><img src="../../assets/games/wordsearch/medium.png" alt="..." class="img-fluid mx-auto d-block"></button>
                        <button class="btn level-btn" data-level="hard"><img src="../../assets/games/wordsearch/hard.png" alt="..." class="img-fluid mx-auto d-block"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        const easyBtn = document.querySelector('[data-level="easy"]');
        const mediumBtn = document.querySelector('[data-level="medium"]');
        const hardBtn = document.querySelector('[data-level="hard"]');

        easyBtn.addEventListener('click', () => {
            window.location.href = 'category.php?level=easy';
        });

        mediumBtn.addEventListener('click', () => {
            window.location.href = 'category.php?level=medium';
        });

        hardBtn.addEventListener('click', () => {
            window.location.href = 'category.php?level=hard';
        });
    </script>
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
</body>

</html>