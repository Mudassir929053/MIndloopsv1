<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php");
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
?>
<style>

body{
  background-image: url('../../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
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

#insertLpForm{
        width:60%; 
        margin-left:auto; 
        margin-right:auto; 
        padding:15px; 
        background-color: azure;
        border: solid 1px rgba(255,255,0,0);
        border-radius: 30px;
    }

    #m_id {
        background-color:transparent;
        border:0px;
        outline: none;
    }

    #m_id:focus {
        background-color:transparent;
        border:0px;
        outline: none;
    }

</style>

<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
  

<body>



  <main id="main">

    <!-- <div id="magazine-hero">
    </div> -->

    <!-- <img id="magazine-img" src="./assets/img/MindLOOPS_Resouces/Asset_4.jpg" alt="" height="300px" class="col-lg-12"> -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h2 style="text-align: center;">Create Forum</h2>

        <br>

        <div class="row gy-4">

          <a href="forum.php" class="btn btn-sm btn-warning col-lg-1"><i class="bi bi-arrow-left"></i> Back</a>

          <div class="col-lg-12">

          <form id="insertLpForm" action="addforumBackend.php" method="POST" enctype='multipart/form-data'>
            <div class="form-group"> 
                <label for="c_name">Forum Name</label>
                <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Enter Title" required>
            </div>
            <br>
            
            <div class="form-group">
              <label for="created_by">Forum Created</label>
              <select class="form-select" name="created_by" id="created_by" required="">
                <option selected="" disabled="">Select User</option> 
                <option value="parent">parent</option> 
              </select>
            </div>
            <br>  
            <div class="form-group">
              <label for="forum_for">Forum For</label>
              <select class="form-select" name="forum_for" id="forum_for" required="">
                <option selected="" disabled="">Select User</option> 
                <option value="Kids">Kids</option> 
                <option value="Adults">Adults</option> 
              </select>
            </div>
            <br>       
            <div class="form-group"> 
                <label for="c_desc">Forum Description</label>
                <textarea class="form-control" id="c_desc" name="c_desc" placeholder="Enter Community description..." maxlength="1000" required></textarea>
            </div>
            <br>       
 
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-warning">Add Forum</button>
                <button type="reset" class="btn btn-sm btn-secondary">Clear</button>
            </div>
            
          </form>


          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>
</body>

</html>