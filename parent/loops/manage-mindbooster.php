<?php include("../commonPHP/head.php"); ?>

<?php include("../commonPHP/topNavBarCheck.php"); ?>
<link href="../../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
  

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
<style>
    .mindbooster-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
    /* .premium {
        filter: blur(5px);
        opacity: 0.6;
    }
    .no-blur {
        backdrop-filter: none;
    } */
    .blur-container {
        position: relative;
    }
    .blur-container:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /*backdrop-filter: blur(4px); /* Adjust the blur value as needed */
    }
    .blur-img1,
    .blur-text {
        filter: blur(5px);
        /* Adjust the blur value as needed */
    }
    .center-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
    }
    .no-click {
  pointer-events: none;
  cursor: default;
  text-decoration: none;
  color: inherit;
}
/* dialog {
  z-index: 10;
  background: steelblue;
  box-shadow: 0px 4px 5px #000;
  border-radius: 8px;
	border:none;
} */
</style>


<main>

 
<div class="container">
    <br>
    <?php
$rows_per_page = 6;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $rows_per_page;
$query = "SELECT * FROM `tb_mindbooster` LIMIT $rows_per_page OFFSET $offset";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    ?>
    <div class="row">
        <?php
        $itemCount = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $itemCount++;
            $isPremium = ($current_page == 1 && $itemCount <= 3) ? 'not-premium' : 'premium blur-text no-click';
            $isPremium1 = ($current_page == 1 && $itemCount <= 3) ? 'not-premium' : 'premium';
            $mb_id = $row['mb_id'];
            $subjectName = $row['mb_sub_name'];
            $filename = $row['mb_sub_image'];
            $mb_sub_desc = $row['mb_sub_desc'];
            $mb_sub_released_date = $row['mb_sub_released_date'];
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <div style="height: 200px; overflow: hidden;" class="<?php echo $isPremium; ?>">
                        <img src="../<?php echo $filename; ?>" class="card-img-top" alt="Subject Image" style="object-fit: cover; height: 100%; width: 100%;">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-black <?php echo $isPremium; ?>"><?php echo $subjectName; ?></h4>
                        <div class="card-title text-black <?php echo $isPremium; ?>"><?php echo $mb_sub_desc; ?></div>
                        <div class="card-title text-secondary <?php echo $isPremium; ?>"><?php echo date('y-F-d', strtotime($mb_sub_released_date)); ?></div>
                        <br>
                        <select class="form-control bg-info mt-auto <?php echo $isPremium; ?>" onchange="window.location.href='lesson.php?mb_id=<?php echo $mb_id; ?>&grade='+this.value">
                            <option value="">Select Grade</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                            <option value="4">Level 4</option>
                            <option value="5">Level 5</option>
                            <option value="6">Level 6</option>
                        </select>
                        <?php if ($isPremium1 === 'premium') { ?>
                            <div class="blur-container">
                                <div class="blur-img">
                                    <button type="button" class="btn text-white btn-sm center-button" style="margin-top: -50%; background-color: #E91E63"data-toggle="modal" data-target="#globalModal">Premium 🔒</button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
<?php }

$total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_mindbooster`"));
$total_pages = ceil($total_rows / $rows_per_page);

if ($total_pages > 1) {
    echo '<nav aria-label="Page navigation">';
    echo '<ul class="pagination justify-content-center py-3">';

    if ($current_page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        echo '<li class="page-item' . ($i == $current_page ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }

    if ($current_page < $total_pages) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
}
?>

<dialog>
  <form>
  <p>Premium content requires payment to access.</p>
          <p>Failure to pay will result in the data being hidden from view.</p>
          <p>Users will not be able to view the full range of content without payment.</p>
          <p>Valuable information or entertainment may be missed out on if payment is not made.</p>
		<br/>
		<br/>
        <div class="d-flex justify-content-center">
    <button formmethod="dialog" type="submit">Cancel</button>
    <button type="submit">Submit</button>
</div>  
</form>
</dialog>
<div class="modal fade" id="globalModal" tabindex="-1" role="dialog" aria-labelledby="globalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="globalModalLabel">Premium Content</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
          <!-- <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        <p>Premium content requires payment to access.</p>
        <p>Failure to pay will result in the data being hidden from view.</p>
        <p>Users will not be able to view the full range of content without payment.</p>
        <p>Valuable information or entertainment may be missed out on if payment is not made.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Pay</button>
      </div>
    </div>
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
<script>
  // Refresh the page on navigation back
  if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
    location.reload();
  }
</script>
<script>
  const dialog = document.querySelector('dialog');
dialog.addEventListener("click", e => {
  const dialogDimensions = dialog.getBoundingClientRect()
  if (
    e.clientX < dialogDimensions.left ||
    e.clientX > dialogDimensions.right ||
    e.clientY < dialogDimensions.top ||
    e.clientY > dialogDimensions.bottom
  ) {
    dialog.close()
  }
});
document.querySelector('#open').addEventListener('click', () => {
	dialog.showModal();
});

</script>
</body>

</html>