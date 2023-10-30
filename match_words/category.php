<?php
include '../dbconnect.php';
extract($_GET);
// echo $level;
$sql = "SELECT category, MIN(img_category) AS img_category
FROM tb_wordmatch
WHERE game_level = '$level'
GROUP BY category
";
$result = mysqli_query($conn, $sql);
// while($row = mysqli_fe)
// exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Picture-Word</title>

    <!-- Favicons -->
    <link href="../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="icon">
    <link href="../assets/img/MindLOOPS_Resouces/mindloops_icon_192x192.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/gallery/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/gallery/swiper-bundle.min.css" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/package.css" rel="stylesheet">

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/p5.min.js"></script> -->
    <!-- <script src="main.js"></script> -->


    <!-- <link rel="stylesheet" href="style1.css"> -->
    <style>
        body {
            background-image: url(../assets/games/match_words/images/bg3.png);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
            line-height: 0.5;
        }

        h1,
        h2 {
            font-size: 3rem;
            text-align: center;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: #fd1364;
        }

        .back-btn {
            position: absolute;
            left: 10%;

        }
        .category-btn:hover{
            transform: scale(1.1);
            transition: all 0.3s ease;
        }
        a>img {
      width: 7%;
    }
    img{
      width: 80%;
    }
    
    </style>


</head>

<body class="bg">
    
<div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <img src="../assets/games/match_words/images/select_category.png" alt="..." class="img-fluid mx-auto d-block" style="border-bottom-left-radius: 50px;border-bottom-right-radius: 50px;">
      </div>
      <div class="col-md-6">
        <a href="index.php">
          <img src="../assets/games/match_words/images/backbtn.png" alt="..." class="img-fluid float-left back-btn" style="position: absolute; top: 10px; left: 25px;">
        </a>
      </div>
    </div>
  </div>
    <div class="container py-5"> 
        <div class="row py-5">
            <div class="col-12 text-center py-5">
                <?php
                while ($row = mysqli_fetch_assoc($result)) :
                    // echo $row['category'];
                    // echo "<br>";
                ?>
                    <button class="btn category-btn" onclick="playGames(this)" data-level="<?= $row['category'] ?>">
                    <?php if ($row['category']) { ?>
                  <img src="<?php echo $row['img_category']; ?>" width="200">
                  <br><br>
                <?php } ?></button>
                <?php
                endwhile;
                ?>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.back-btn').addEventListener('click', function() {
            window.history.back();
        });

        const playGames = (obj) => {
            // console.log(obj)
            let level = "<?= $level ?>";
            // console.log(level);
            let category = obj.getAttribute("data-level");
            // console.log(category);

            let url = "play.php?level=" + level + "&category=" + category;
            // console.log(url);
            window.location.href = url;
        }
    </script>
</body>

</html>