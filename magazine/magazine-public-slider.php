
<section id="gallery" class="gallery section-bg" style="background-color: #FFCC33;">
      <div class="container" data-aos="fade-up">


        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center" id="mainContainer">
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
    // console.log(jsonData)
    var mainContainer = document.getElementById("mainContainer");
    let div = document.createElement("div");
    // div.innerText = "Hello Amir";
    let  text = document.createElement('p');
    for(var i=0; i<jsonData.length; i++){

      var swiperSlideDiv = document.createElement("div");
      swiperSlideDiv.classList.add("swiper-slide");


      var alink = document.createElement("a");
      // alink.setAttribute("href","../magazine/magazine-description.php?m_id=" + jsonData[i].m_id);

      var image = document.createElement("img");
      image.setAttribute("src","../assets/" + jsonData[i].m_imgPath);
      image.classList.add("img-fluid");
      image.setAttribute("height","300px");
      image.setAttribute("data-gallery","images-gallery");

      alink.appendChild(image);

      swiperSlideDiv.appendChild(alink);
      
      // text.innerText="Hello Amir";
      // text.setAttribute("color","red");
      // div.appendChild(text);

      mainContainer.appendChild(swiperSlideDiv);
      mainContainer.appendChild(div);

    }
    

  }

</script>