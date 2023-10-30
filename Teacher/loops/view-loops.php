<?php include("../commonPHP/head.php"); ?>

<?php include("../commonPHP/topNavBarCheck.php"); ?>


<style>
  body {
    background-image: url('../../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
    background-size: 110%;
    background-position: top center;
  }


  .textAll {
    padding-top: 2%;
  }
</style>

<main>

 
<div class="container">
    <br>
    <?php
    $query = "SELECT * FROM `tb_mindbooster`";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
    ?>
    <div class="row">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $mb_id = $row['mb_id'];
            $subjectName = $row['mb_sub_name'];
            $mb_sub_desc = $row['mb_sub_desc'];
            $mb_sub_released_date = $row['mb_sub_released_date'];
            $filename = $row['mb_sub_image'];
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card h-100">
                            <div style="height: 200px; overflow: hidden;" class="">
                                <img src="../<?php echo $filename; ?>" class="card-img-top" alt="Subject Image" style="object-fit: cover; height: 100%; width: 100%;">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-black"><?php echo $subjectName; ?></h4>
                                <div class="card-title text-black"><?php echo $mb_sub_desc; ?></div>
                                <div class="card-title text-secondary"><?php echo date('y-F-d', strtotime($mb_sub_released_date)); ?></div>
                                <br>
                                <?php   $sub_name = strtoupper($row['mb_sub_name']);
                                                // $sub_name = "GENERAL KNOWLEDGE";
                                                if ($sub_name == "GENERAL KNOWLEDGE") { 
                                                  echo '<a href="view_general_knowledge.php?mb_id='.$mb_id.'" class="btn btn-warning d-flex justify-content-center">Read More</a>';
                                              }
                                              else{

                                                ?>
                                <select class="form-select bg-info mt-auto" onchange="window.location.href='lesson.php?mb_id=<?php echo $mb_id; ?>&grade='+this.value">
                                    <option value="">Select Grade</option>
                                    <option value="1">Grade 1</option>
                                    <option value="2">Grade 2</option>
                                    <option value="3">Grade 3</option>
                                    <option value="4">Grade 4</option>
                                    <option value="5">Grade 5</option>
                                    <option value="6">Grade 6</option>
                                </select>
                               <?php } ?>
                               
                            </div>
                        </div>
            </div>
            <?php
        }
        echo '</div>';
    }
    ?>
</div>

</div>



</main><!-- End #main -->

<?php include("../commonPHP/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include("../commonPHP/jsFiles.php"); ?>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/teachsupport.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.15.349/build/pdf.min.js"></script>
<!-- <script src="../assets/js/pdf.min.js"></script> -->

<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
<script src="../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
<script src="../assets/vendor/aos-portfolio/aos.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>