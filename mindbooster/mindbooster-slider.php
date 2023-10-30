<?php 
  // $conn = mysqli_connect('localhost','root','','db_mindloop');
  include '../dbconnect.php';

  $mb_year = "select distinct(year(mb_rDate)) from tb_mindbooster where mb_subject = ?";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $mb_year);

  mysqli_stmt_bind_param($stmt, "s", $sj_id);

  mysqli_stmt_execute($stmt); 
  $mb_year_result = $stmt->get_result();





?>


<section id="gallery" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2 class="section-title">Mind Booster</h2>

          <!-- <p>Check <span>Our Gallery</span></p> -->
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center" id="mainContainer">
            <?php 
            
            while ($row2 = $latest_result->fetch_assoc()) {
            ?>
            <div class="swiper-slide"><a href="../mindbooster/mindbooster.php"><img src="<?php echo $row["mb_filePath"]; ?>" class="img-fluid" alt="" height="300px"></a></div>

            <?php 
            }

            ?>
            
            <!-- <div class="swiper-slide"><a href="../magazine/magazine-description.php"><img src="../assets/pdf/Cover_Pages/Front_Cover_June_2022.jpg" class="img-fluid" alt="" height="300px"></a></div>
            <div class="swiper-slide"><a href="../magazine/magazine-description.php"><img src="../assets/pdf/Cover_Pages/Front_Cover_ML_Mac_2022.jpg" class="img-fluid" alt="" height="300px"></a></div>
            <div class="swiper-slide"><a href="../magazine/magazine-description.php"><img src="../assets/pdf/Cover_Pages/Front_Cover_ML_April_2022.jpg" class="img-fluid" alt="" height="300px"></a></div>
            <div class="swiper-slide"><a href="../magazine/magazine-description.php"><img src="../assets/pdf/Cover_Pages/Front_Cover_ML_June_2021.jpg" class="img-fluid" alt="" height="300px"></a></div>
            <div class="swiper-slide"><a href="../magazine/magazine-description.php"><img src="../assets/pdf/Cover_Pages/Front_Cover_ML_May_2022.jpg" class="img-fluid" alt="" height="300px"></a></div>
            <div class="swiper-slide"><a href="../magazine/magazine-description.php"><img src="../assets/pdf/Cover_Pages/Front_Cover_ML_Okt_2021.jpg" class="img-fluid" alt="" height="300px"></a></div> -->
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
</section>

<script>

  var xhr2 = new XMLHttpRequest();

  xhr2.open("get", "../magazine/read-all-magazine.php");

  xhr2.send();

  xhr2.onload = function(){
    var jsonData = JSON.parse(xhr2.responseText);

    //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIVED DATA.

    var mainContainer = document.getElementById("mainContainer");

    for(var i=0; i<jsonData.length; i++){

      var swiperSlideDiv = document.createElement("div");
      swiperSlideDiv.classList.add("swiper-slide");


      var alink = document.createElement("a");
      alink.setAttribute("href","../magazine/magazine-description.php?m_id=" + jsonData[i].m_id);

      var image = document.createElement("img");
      image.setAttribute("src","../assets/" + jsonData[i].m_imgPath);
      image.classList.add("img-fluid");
      image.setAttribute("height","300px");
      image.setAttribute("data-gallery","images-gallery");

      alink.appendChild(image);

      swiperSlideDiv.appendChild(alink);

      mainContainer.appendChild(swiperSlideDiv);

    }
    

  }

</script>