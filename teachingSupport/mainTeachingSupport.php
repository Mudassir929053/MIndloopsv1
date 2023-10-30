<?php include("../commonPHP/head.php"); ?>

<?php 
  
    if(!session_id())
    {
        session_start();
    }
    if($_SESSION["userType"]!='2' && $_SESSION["userType"]!='3' && $_SESSION["userType"]!='4')
    {
        echo "<script> window.location.replace('../login_and_register/login.php'); </script>";
        // header("../login_and_register/login.php");
    }
?>

  <link rel="stylesheet" href="../assets/css/style.css" ></link>
  <link rel="stylesheet" href="../assets/css/teachSupport.css" ></link>
 <link href="../assets/vendor/swiper-portfolio/swiper-bundle.min.css" rel="stylesheet">
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<!-- Vendor CSS-->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>


  <?php include("../commonPHP/topNavBarCheck.php"); ?>

  <main id="main">

    <section id="portfolio-details" class="portfolio-details teachSupport">
      <div class="container">

        <h2 style="text-align: center;">Teaching Support</h2>
<input id="forTab" style="display:none"></input>
        <br>

        <div class="row gy-4">

          <a href="../index/index.php" class="btn btn-warning col-lg-2"><i class="bi bi-arrow-left"></i> Back to Home Page</a>

          <div class="col-lg-12"> 
          <section id="portfolio" class="portfolio sections-bg">
            <div class="container" data-aos="fade-up">
                 <!-- <ul class="portfolio-flters" id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-pedagogy">Pedagogy</li>
                        <li data-filter=".filter-curriculum">Curriculum</li>
                        <li data-filter=".filter-assessment">Assessment</li>
                    </ul> --><!-- End Portfolio Filters -->
                    <ul class="portfolio-flters nav justify-content-center" role="tablist" id="portfolio-flters">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#all">All</a>
						</li>
            <li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#Pedagogy">Pedagogy</a>
						</li>
            <li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#Curriculum">Curriculum</a>
						</li>
            <li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#Assessment">Assessment</a>
						</li>
					</ul>
                    <div class="tab-content" id="teachSupportTabTable">
						<div id="all" class="container-fluid tab-pane active">
							
                        <section id="gallery" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center" id="mainContainer">
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
</div>
 <!-- PEDAGOGY-->
 <div id="Pedagogy" class="container-fluid tab-pane fade">
							
              
<section id="galleryP" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center" id="mainContainerP">
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
              </div>
<!-- CURRICULUM -->
<div id="Curriculum" class="container-fluid tab-pane fade">
							

<section id="galleryC" class="gallery section-bg">
      <div class="container" data-aos="fade-up">


        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center" id="mainContainerC">
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
</div>
<!-- ASSESSMENT -->
<div id="Assessment" class="container-fluid tab-pane fade">
							

<section id="galleryA" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center" id="mainContainerA">
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
</div>
<!--END -->
					</div>


            </div>
          </section>



          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include("../commonPHP/footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php  include("../commonPHP/jsFiles.php"); ?>

  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/swiper-portfolio/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/glightbox-portfolio/js/glightbox.min.js"></script>
  <script src="../assets/vendor//bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/vendor/aos-portfolio/aos.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  
	 <!-- Jquery JS-->
     <script src="../assets/vendor/jquery/jquery.min.js"></script>
   
   <script src="../assets/js/manageTeachSupport.js">
   </script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
  <script>
    $(document).ready(function () {

$('.nav').on('shown.bs.tab', function (e) {
        activeValue = $(".active").attr("href");
        
        activeValue = activeValue.slice(1);
        $("#forTab").val(activeValue);
        //console.log($("#forTab").val());
      });
     /*  $("#forTab").change(function () { */
    /* if( $("#forTab").val() !=''){
      console.log($("#forTab").val()); */
      $.ajax({
    type: "get",
    url: "getAllTeachingSupport.php",
    success: function (output, status, xhr) {
        var result = $.parseJSON(output);
        //console.log(result);
        var mainContainer = document.getElementById("mainContainer");
     
        
        for(var i=0; i<result.length; i++){

var swiperSlideDiv = document.createElement("div");
swiperSlideDiv.classList.add("swiper-slide");


var alink = document.createElement("a");
alink.setAttribute("href","viewTeachingSupport.php?ts_id=" + result[i].ts_id);

var image = document.createElement("img");
image.setAttribute("src","../assets/" + result[i].ts_imgPath);
image.classList.add("img-fluid");
image.setAttribute("height","300px");
image.setAttribute("data-gallery","images-gallery");

alink.appendChild(image);

swiperSlideDiv.appendChild(alink);

mainContainer.appendChild(swiperSlideDiv);

}

    },
    error: function (xhr, resp, text) {
        $('#packageDetailsMessage').fadeIn();
        $('#packageDetailsMessage').html(xhr.responseText);
    },
});

$.ajax({
    type: "get",
    url: "getAllTeachingSupport.php?ts_type=Pedagogy",
    success: function (output, status, xhr) {
        var result = $.parseJSON(output);
        //console.log(result);
        
        var mainContainer = document.getElementById("mainContainerP");
        
        for(var i=0; i<result.length; i++){

var swiperSlideDiv = document.createElement("div");
swiperSlideDiv.classList.add("swiper-slide");


var alink = document.createElement("a");
alink.setAttribute("href","viewTeachingSupport.php?ts_id=" + result[i].ts_id);

var image = document.createElement("img");
image.setAttribute("src","../assets/" + result[i].ts_imgPath);
image.classList.add("img-fluid");
image.setAttribute("height","300px");
image.setAttribute("data-gallery","images-gallery");

alink.appendChild(image);

swiperSlideDiv.appendChild(alink);

mainContainer.appendChild(swiperSlideDiv);

}

    },
    error: function (xhr, resp, text) {
        $('#packageDetailsMessage').fadeIn();
        $('#packageDetailsMessage').html(xhr.responseText);
    },
});

$.ajax({
    type: "get",
    url: "getAllTeachingSupport.php?ts_type=Curriculum",
    success: function (output, status, xhr) {
        var result = $.parseJSON(output);
        //console.log(result);
        var mainContainer = document.getElementById("mainContainerC");
        for(var i=0; i<result.length; i++){

var swiperSlideDiv = document.createElement("div");
swiperSlideDiv.classList.add("swiper-slide");


var alink = document.createElement("a");
alink.setAttribute("href","viewTeachingSupport.php?ts_id=" + result[i].ts_id);

var image = document.createElement("img");
image.setAttribute("src","../assets/" + result[i].ts_imgPath);
image.classList.add("img-fluid");
image.setAttribute("height","300px");
image.setAttribute("data-gallery","images-gallery");

alink.appendChild(image);

swiperSlideDiv.appendChild(alink);

mainContainer.appendChild(swiperSlideDiv);

}

    },
    error: function (xhr, resp, text) {
        $('#packageDetailsMessage').fadeIn();
        $('#packageDetailsMessage').html(xhr.responseText);
    },
});

$.ajax({
    type: "get",
    url: "getAllTeachingSupport.php?ts_type=Assessment",
    success: function (output, status, xhr) {
        var result = $.parseJSON(output);
        //console.log(result);
        var mainContainer = document.getElementById("mainContainerA");
        
        for(var i=0; i<result.length; i++){

var swiperSlideDiv = document.createElement("div");
swiperSlideDiv.classList.add("swiper-slide");


var alink = document.createElement("a");
alink.setAttribute("href","viewTeachingSupport.php?ts_id=" + result[i].ts_id);

var image = document.createElement("img");
image.setAttribute("src","../assets/" + result[i].ts_imgPath);
image.classList.add("img-fluid");
image.setAttribute("height","300px");
image.setAttribute("data-gallery","images-gallery");

alink.appendChild(image);

swiperSlideDiv.appendChild(alink);

mainContainer.appendChild(swiperSlideDiv);

}

    },
    error: function (xhr, resp, text) {
        $('#packageDetailsMessage').fadeIn();
        $('#packageDetailsMessage').html(xhr.responseText);
    },
});

   /*  }else{
      console.log("yeah2");
      $.ajax({
    type: "get",
    url: "getAllTeachingSupport.php",
    success: function (output, status, xhr) {
        var result = $.parseJSON(output);
        console.log(result);
        
        var mainContainer = document.getElementById("mainContainer");
     
        for(var i=0; i<result.length; i++){

var swiperSlideDiv = document.createElement("div");
swiperSlideDiv.classList.add("swiper-slide");


var alink = document.createElement("a");
alink.setAttribute("href","viewTeachingSupport.php?ts_id=" + result[i].ts_id);

var image = document.createElement("img");
image.setAttribute("src","../assets/" + result[i].ts_imgPath);
image.classList.add("img-fluid");
image.setAttribute("height","300px");
image.setAttribute("data-gallery","images-gallery");

alink.appendChild(image);

swiperSlideDiv.appendChild(alink);

mainContainer.appendChild(swiperSlideDiv);

}

    },
    error: function (xhr, resp, text) {
        $('#packageDetailsMessage').fadeIn();
        $('#packageDetailsMessage').html(xhr.responseText);
    },
});
    } */ /*
    else{
      console.log("yeah");
      $.ajax({
    type: "get",
    url: "getAllTeachingSupport.php",
    success: function (output, status, xhr) {
        var result = $.parseJSON(output);
        console.log(result);
        
        var mainContainer = document.getElementById("mainContainer");
     
        for(var i=0; i<result.length; i++){

var swiperSlideDiv = document.createElement("div");
swiperSlideDiv.classList.add("swiper-slide");


var alink = document.createElement("a");
alink.setAttribute("href","viewTeachingSupport.php?ts_id=" + result[i].ts_id);

var image = document.createElement("img");
image.setAttribute("src","../assets/" + result[i].ts_imgPath);
image.classList.add("img-fluid");
image.setAttribute("height","300px");
image.setAttribute("data-gallery","images-gallery");

alink.appendChild(image);

swiperSlideDiv.appendChild(alink);

mainContainer.appendChild(swiperSlideDiv);

}

    },
    error: function (xhr, resp, text) {
        $('#packageDetailsMessage').fadeIn();
        $('#packageDetailsMessage').html(xhr.responseText);
    },
});
    } */
  /* }); */
});
  /* var xhr2 = new XMLHttpRequest();
var activeValue = "all";
$('.nav').on('shown.bs.tab', function (e) {
        activeValue = $(".active").attr("href");
        
        activeValue = activeValue.slice(1);
        //console.log(activeValue);
    
    if(activeValue != 'all'){
  xhr2.open("get", "getAllTeachingSupport.php?ts_type="+activeValue);
  xhr2.send();
  
  xhr2.onload = function(){
    

    var jsonData = JSON.parse(xhr2.responseText);
    console.log(jsonData);
    //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIVED DATA.
    if(activeValue=="Pedagogy"){
        
    var mainContainer = document.getElementById("mainContainerP");
    }else if(activeValue=="Curriculum"){
        
        var mainContainer = document.getElementById("mainContainerC");
    }else if(activeValue=="Assessment"){
        
        var mainContainer = document.getElementById("mainContainerA");
    }else{
       var mainContainer = document.getElementById("mainContainer");
 
    }
    
    for(var i=0; i<jsonData.length; i++){

      var swiperSlideDiv = document.createElement("div");
      swiperSlideDiv.classList.add("swiper-slide");


      var alink = document.createElement("a");
      alink.setAttribute("href","viewTeachingSupport.php?ts_id=" + jsonData[i].ts_id);

      var image = document.createElement("img");
      image.setAttribute("src","../assets/" + jsonData[i].ts_imgPath);
      image.classList.add("img-fluid");
      image.setAttribute("height","300px");
      image.setAttribute("data-gallery","images-gallery");

      alink.appendChild(image);

      swiperSlideDiv.appendChild(alink);

      mainContainer.appendChild(swiperSlideDiv);

    }
    

  }
}else{
  xhr2.open("get", "getAllTeachingSupport.php");
  xhr2.send();
  
  xhr2.onload = function(){
    

    var jsonData = JSON.parse(xhr2.responseText);
    console.log(jsonData);
    //  START TO MANIPULATE THE DOM TO PUT IN THE RETRIVED DATA.
    if(activeValue=="Pedagogy"){
        
    var mainContainer = document.getElementById("mainContainerP");
    }else if(activeValue=="Curriculum"){
        
        var mainContainer = document.getElementById("mainContainerC");
    }else if(activeValue=="Assessment"){
        
        var mainContainer = document.getElementById("mainContainerA");
    }else{
       var mainContainer = document.getElementById("mainContainer");
 
    }
    
    for(var i=0; i<jsonData.length; i++){

      var swiperSlideDiv = document.createElement("div");
      swiperSlideDiv.classList.add("swiper-slide");


      var alink = document.createElement("a");
      alink.setAttribute("href","viewTeachingSupport.php?ts_id=" + jsonData[i].ts_id);

      var image = document.createElement("img");
      image.setAttribute("src","../assets/" + jsonData[i].ts_imgPath);
      image.classList.add("img-fluid");
      image.setAttribute("height","300px");
      image.setAttribute("data-gallery","images-gallery");

      alink.appendChild(image);

      swiperSlideDiv.appendChild(alink);

      mainContainer.appendChild(swiperSlideDiv);

    }
    

  }

  }
    
  }); */

</script>

</body>

</html>
