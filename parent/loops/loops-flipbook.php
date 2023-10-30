<?php include ("../dbconnect.php");  ?>
<?php include("../commonPHP/head.php"); ?>

<style>
    /* body{
      overflow: hidden;
    } */

    #container{
      margin: 0 auto;
      width: 100%;
      padding: 50px 150px 150px 150px;
    }

    #flipbook{
      overflow: hidden;
      width: 100%;
      height: 100%;
      text-align: center;
    }

    #flipbook .page{
      width: 461px;
      height: 600px;
      background-color: white;
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }

    #flipbook iframe{
      margin: 0 auto;
      padding: 25px 5px 10px 15px;
    }

    #flipbook .page-wrapper{
      -webkit-perspective: 2000px;
      -moz-perspective: 2000px;
      -o-perspective: 2000px;
      perspective: 2000px;
    }

    #flipbook .hard{
      background: darkgrey !important;
      color: #ffffff;
      -webkit-box-shadow: inset 0 0 5px #666666;
      -moz-box-shadow: inset 0 0 5px #666666;
      -o-box-shadow: inset 0 0 5px #666666;
      box-shadow: inset 0 0 5px #666666;
      font-weight: bold; 
    }

    #flipbook .odd{
      background-color: lightgray;
    }

    #flipbook .even{
      background-color: darkgrey;
    }

</style>

  <?php include("../commonPHP/topNavBarCheck.php"); ?>

<?php 

$lp_id = $_GET['lp_id'];

$loops = "SELECT * FROM tb_loops where lp_id = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $loops);

mysqli_stmt_bind_param($stmt, "s", $lp_id);

mysqli_stmt_execute($stmt); 
$loops_result = $stmt->get_result();

?>
  <style>

    body{
      background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
      background-size: 110%;
      background-position: top center;
    }

    #magazine-hero{
      background-image: none;
      height: 150px;
    }

    #imgDiv{
      width: 100%;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
    }
  </style>

  <main id="main">

    <div id="magazine-hero">
    </div>

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <!-- <div class="row gy-4"> -->

          <!-- <div class="col-lg-12"> -->
            <!-- <div class="portfolio-details-slider"> -->
              <div class="align-items-center" id="canvasContainer">

                <a href="loops-details.php" class="btn btn-warning" id="back-button"><i class="bi bi-arrow-left"></i> Return to Loops Overview</a>

                <br>
                <br>

                <!-- <p style="color:red;">Put your mouse over the image to flip the loops.</p> -->

                <br>
                <?php  while ($row = $loops_result->fetch_assoc()) { 
                  $file_name = $row['lp_filepath'];  
                  $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                  if($extension != 'pdf')  { 
                  
                ?>
                <iframe class="responsive-iframe" mozallowfullscreen="true" allow="autoplay; fullscreen"  
                        src="<?php echo $row['lp_filepath'] ?>"
                        style="border:0px #000000 none;" name="Pong: Star Wars Remix" scrolling="no" msallowfullscreen="true" allowfullscreen="true" 
                        webkitallowfullscreen="true" allowtransparency="true" frameborder="0" marginheight="px" marginwidth="320px" height="540px" width="960px" >
                </iframe>
              <?php }else { ?>
                <iframe class="responsive-iframe" mozallowfullscreen="true" allow="autoplay; fullscreen"  
                src="<?php echo $row['lp_filepath'] ?>#toolbar=0"
               scrolling="no" 
                webkitallowfullscreen="true" allowtransparency="true" frameborder="0" marginheight="px" marginwidth="320px" height="540px" width="960px" >
              </iframe>

              <?php }}?>


                <!-- <canvas src="../assets/pdf/Magazine_Full/1_Mindloops_Jun_2021.pdf#toolbar=0" type="application/pdf" style="width:82rem; height:37rem;" oncontextmenu=""></canvas> -->
                <!-- <canvas id="pdfDisplay" width="1160" height="810" ></canvas> -->

                <div id="flipbook">
                  <!-- <div class=""><canvas id="pdfDisplay" width="1160" height="810" ></canvas></div>
                  <div class=""></div>
                  <div> Page 1 </div>
                  <div> Page 2 </div>
                  <div> Page 3 </div>
                  <div> Page 4 </div>
                  <div class="hard"></div>
                  <div class="hard"></div> -->
                </div>


              </div>

            <!-- <div id="navigatePage">
                <a id="prevPage" href="magazine-flipbook.php?pageNum=1" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Previous Page</a>
                <a id="nextPage" href="magazine-flipbook.php?pageNum=3" class="btn btn-secondary">Next Page <i class="bi bi-arrow-right-circle"></i></a>
            </div> -->

            <!-- </div> -->
          <!-- </div> -->

        <!-- </div> -->

      </div>
    </section>


  </main><!-- End #main -->

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="../assets/js/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.15.349/build/pdf.min.js"></script>

<script>

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const pageNum = parseInt(urlParams.get('pageNum'));
    const lp_id = urlParams.get('lp_id');
    var pages;

    document.getElementById("back-button").setAttribute("href","loops-details.php?lp_id=" + lp_id);
    
    var flipbookXHR = new XMLHttpRequest();

    flipbookXHR.open("get","read-single-loops.php?lp_id=" + lp_id);

    flipbookXHR.send();

    flipbookXHR.onload = function(){

        var flipbookJSONdata = JSON.parse(flipbookXHR.responseText);

        // var maxpage = flipbookJSONdata[0].m_pageLimit;
        // const filepath = flipbookJSONdata[0].m_filePath;


        // document.getElementById("prevPage").setAttribute("href","magazine-flipbook.php?pageNum=" + (pageNum - 1) + "&lp_id=" + lp_id); 
        // document.getElementById("nextPage").setAttribute("href","magazine-flipbook.php?pageNum=" + (pageNum + 1) + "&lp_id=" + lp_id);


        if(isSubscribed){
          pdfjsLib.getDocument('../assets/' + filepath).promise.then(doc => {
            // maxpage = doc._pdfInfo.numPages;
            pages = doc._pdfInfo.numPages;
            displayPage(pageNum,doc._pdfInfo.numPages,filepath,isSubscribed);

          });
        }
        else{
          pages = maxpage;
          displayPage(pageNum,maxpage,filepath,isSubscribed);
        }

    }




    function displayPage(pageNum, maxpage, filepath, isSubscribed){

        //console.log(maxpage);

        // if(pageNum === 1){
        //     document.getElementById("prevPage").style.display = "none";
        // }

        // if(pageNum >= maxpage){
        //     document.getElementById("nextPage").style.display = "none";
        // }

        var flipbookDiv = document.getElementById("flipbook");



        for(var i=0; i<maxpage; i++){

              //Create the flipbook html for each page of flipbook
              var pageDiv = document.createElement("div");
              var pageCanvas = document.createElement("canvas");

              pageDiv.classList.add("p" + (i+1).toString());

              if(i % 2 === 0){
                pageDiv.classList.add("even");
              }
              else{
                pageDiv.classList.add("odd");
              }
              
              pageCanvas.setAttribute("width","1160");
              pageCanvas.setAttribute("height","810");
              pageCanvas.setAttribute("id","pdfDisplay" + (i+1));

              pageDiv.appendChild(pageCanvas);
              flipbookDiv.appendChild(pageDiv);
              // $('#flipbook').turn('addPage', pageDiv);

              printToCanvas(i+1, filepath);

        }
        
      }


      function printToCanvas(pageNum, filepath){

        // Target the blank page canvas and print the pdf page.
        pdfjsLib.getDocument('../assets/' + filepath).promise.then(doc => {

        // if(isSubscribed){
          // console.log("This file has " + doc._pdfInfo.numPages + " pages");
          // maxpage = doc._pdfInfo.numPages;
        // }

            doc.getPage(pageNum).then(page => {
                    var pdfDisplay = document.getElementById("pdfDisplay" + pageNum.toString());
                    var context = pdfDisplay.getContext("2d");

                    var viewport = page.getViewport({scale: 1, rotation: 0, dontFlip: false});
                    // pdfDisplay.width = 2000;
                    // pdfDisplay.height = 1000;

                    page.render({
                        canvasContext: context,
                        viewport: viewport,
                    })

                    pdfDisplay.oncontextmenu = function(e) { e.preventDefault(); e.stopPropagation(); }

            });

          

        });

          
        
      }

</script>


  <?php  include("../commonPHP/jsFiles.php"); ?>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

  <!-- <script src="../assets/js/pdf.min.js"></script> -->

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/3/turn.min.js" integrity="sha512-rFun1mEMg3sNDcSjeGP35cLIycsS+og/QtN6WWnoSviHU9ykMLNQp7D1uuG1AzTV2w0VmyFVpszi2QJwiVW6oQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/3/turn.js" integrity="sha512-9ocft8BVEGO4YnjEW4Tkq0+d3Usuax+GF922LJML/Q5ZLmtu9hgBbUZTxKXAkm+hzIHoC3I+vYha66opI9AuSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

  <script src="../assets/vendor/turnjs4/lib/turn.js"></script>
  <!-- <script src="../assets/vendor/turnjs4/extras/jquery.min.1.7.js"></script> -->


<script type="text/javascript">

window.onload = function(){

  $("#flipbook").turn({
		width: 1160,
		height: 810,
    elevation: 50,
		autoCenter: true,
    display: "double",
    pages: pages,
    when: {
      turned: function(event, page, pageObj){
        if(page === pages && !isSubscribed){
          alert("Please subscribe for more.");
          window.location.replace("../index/index.php#Subscribe")
        }
      }
    }
	});
}

</script>

<script>
    // var canvas = document.getElementById("pdfDisplay");

    // canvas.oncontextmenu = function(e) { e.preventDefault(); e.stopPropagation(); }

</script>

</body>

</html>
