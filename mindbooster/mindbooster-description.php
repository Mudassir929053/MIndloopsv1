<?php include("../commonPHP/head.php"); ?>


  <?php include("../commonPHP/topNavBarCheck.php"); ?>

  <?php 
    if(isset($_GET['mb_id'])){
      $mb_id = $_GET['mb_id'];
    }

  $conn = mysqli_connect('localhost','root','','db_mindloop');

    $latest = "select * from tb_mindbooster join tb_subjects on tb_mindbooster.mb_subject = tb_subjects.sj_id where mb_id = ?";
    $latest_stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($latest_stmt, $latest);

    mysqli_stmt_bind_param($latest_stmt, "s",$mb_id);

    mysqli_stmt_execute($latest_stmt); 
    $latest_result = $latest_stmt->get_result();
    

?>



  <main id="main" style="background: url(../assets/img/MindLOOPS_Resouces/Asset_4.jpg); background-size: cover">

    <!-- ======= Breadcrumbs ======= -->
    <!-- <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Portfolio Details</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li><a href="portfolio.html">Portfolio</a></li>
            <li>Portfolio Details</li>
          </ol>
        </div>
      </div>
    </section> -->
    <!-- End Breadcrumbs -->


    <!-- <img id="magazine-img" src="" alt="" class="col-lg-12"> -->
<?php while ($row = $latest_result->fetch_assoc()) { 
  // var_dump($row);
  ?>
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
      <h2 class="section-title"><?php echo $row["mb_title"]; ?></h2>
      <?php $desc_array = json_decode($row['mb_desc']); 
      // var_dump($desc_array);
      if($desc_array){
      ?>

        <div class="row gy-4">
          <?php for($i=0;$i<count($desc_array);$i++){ 
            if($i%2==0){
            ?>
          <div class="col-lg-4">
            <div class="portfolio-details-slider">
              <div class="align-items-center">

                <div class="">
                  <img id="mImg" src="<?php echo $desc_array[$i]->image; ?>" alt="">
                </div>

              </div>
              <!-- <div class="swiper-pagination"></div> -->
            </div>
          </div>

          <div class="col-lg-8">
            <div class="portfolio-description">
              <!-- <h2 id="mTitle"><?php //echo $row['mb_title']; ?></h2> -->
              <p id="descP" class="description-paragraph">
              <?php echo ($desc_array[$i]->paragraph); ?>
              </p>
              <!-- <a id="viewMoreBtn" href="magazine-flipbook.php?pageNum=1" class="btn btn-warning">View More</a> -->
              <br>
              <br>

             
            </div>
          </div>
          <?php }
          else{?>
            <div class="col-lg-8">
            <div class="portfolio-description">
              <!-- <h2 id="mTitle"><?php //echo $row['mb_title']; ?></h2> -->
              <p id="descP" class="description-paragraph">
              <?php echo ($desc_array[$i]->paragraph); ?>
              </p>
              <!-- <a id="viewMoreBtn" href="magazine-flipbook.php?pageNum=1" class="btn btn-warning">View More</a> -->
              <br>
              <br>

             
            </div>
          </div>
          <div class="col-lg-4">
            <div class="portfolio-details-slider">
              <div class="align-items-center">

                <div class="">
                  <img id="mImg" src="<?php echo $desc_array[$i]->image; ?>" alt="">
                </div>

              </div>
              <!-- <div class="swiper-pagination"></div> -->
            </div>
          </div>
          <?php
          }
        }
          ?>
        <div class="col-12">
             <p class="date-paragraph">Level : <?php echo $row['mb_level']; ?></p>
              <p class="date-paragraph">Subject : <?php echo $row['sj_name']; ?></p>
              <p class="date-paragraph">Released Date : <?php echo $row['mb_rDate']; ?></p>
              <p class="date-paragraph">Year : <?php echo $row['mb_year']; ?></p>
        </div>
      
        </div>

      </div>
    </section>
    <?php }  
    else{
      ?>
      <div class="row">
    <div class="col-lg-4">
            <div class="portfolio-details-slider">
              <div class="align-items-center">

                <div class="">
                  <img id="mImg" src="<?php echo $row['mb_filePath']; ?>" alt="">
                </div>

              </div>
              <!-- <div class="swiper-pagination"></div> -->
            </div>
          </div>

          <div class="col-lg-8">
            <div class="portfolio-description">
              <!-- <h2 id="mTitle"><?php //echo $row['mb_title']; ?></h2> -->
              <p id="descP" class="description-paragraph">
              <?php echo $row['mb_desc']; ?>
              </p>
              <!-- <a id="viewMoreBtn" href="magazine-flipbook.php?pageNum=1" class="btn btn-warning">View More</a> -->
              <br>
              <br>

              <p class="date-paragraph">Level : <?php echo $row['mb_level']; ?></p>
              <p class="date-paragraph">Subject : <?php echo $row['sj_name']; ?></p>
              <p class="date-paragraph">Released Date : <?php echo $row['mb_rDate']; ?></p>
              <p class="date-paragraph">Year : <?php echo $row['mb_year']; ?></p>
            </div>
          </div>
          </div>
      
      <?php
    }

      }

      $slider = "select * from tb_mindbooster  where mb_subject = ?";
      $slider_stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($slider_stmt, $slider);
    
      mysqli_stmt_bind_param($slider_stmt, "s", $sj_id);
      mysqli_stmt_execute($slider_stmt); 
      $counter = 0;
      $slider_result = $slider_stmt->get_result();
      // mysqli_stmt_store_result($slider_stmt);

    ?>

    <section id="gallery" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
        <?php 
            $counter = 0;

            if($slider_stmt->num_rows > 1 ) {
        ?>       
          <?php 
            $mb_year = "select distinct(mb_year) as year from tb_mindbooster where mb_subject = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $mb_year);
          
            mysqli_stmt_bind_param($stmt, "s", $sj_id);
            mysqli_stmt_execute($stmt); 
            $mb_year_result = $stmt->get_result();

          
            
          ?>
          <div class="row">
                  <div class="col-md-4 mb-2">
                    <br>
                  </div>
                  <div class="col-md-4 mb-2">
                  <br>
                  </div>
                  <div class="col-md-4 mb-2">
                  <select class="form-select" id="select_year" required>
                    <?php
                        while ($row2 = mysqli_fetch_array($mb_year_result,MYSQLI_ASSOC)):;
                    ?>
                        <option value="<?php echo $row2["year"];?>">
                          <?php echo $row2["year"]; ?>
                        </option>
                    <?php
                        endwhile;
                    ?>
                  </select>
                  </div>
           </div>
          

        <h2 class="section-title">Mind Booster</h2>
          <!-- <p>Check <span>Our Gallery</span></p> -->
        </div>
        

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center" id="mainContainer">
            
            <?php 

            while ($slider_row = $slider_result->fetch_assoc()) {
              // echo $slider_row["mb_filePath"];
            ?>
            <div class="swiper-slide"><a href="../mindbooster/mindbooster.php?sj_id=<?php echo $sj_id; ?>&mb_id=<?php echo $slider_row["mb_id"]; ?>"><img src="<?php echo $slider_row["mb_filePath"]; ?>" class="img-fluid" alt="" height="300px"></a></div>

                <?php 
            }}else 

            ?>
            
      
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
</section>

