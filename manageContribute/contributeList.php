<?php
include("../commonPHP/adminNavBar.php");
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="../assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

<!-- Vendor CSS-->
<link href="../assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
<link href="../assets/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
<link href="../assets/css/manageContribute.css" rel="stylesheet">
<div class="container-fluid">
<div class="row">
<div class="col-lg-11" style="margin:auto auto;padding-top:10%;">
			<div class="tab-content" id="v-pills-tabContent">
			  <div class="tab-pane fade show active" id="v-pills-item" role="tabpanel" aria-labelledby="v-pills-item-tab">
				<div class="card card-outline-secondary my-4">
            <h2 style="text-align: center;"><br>Manage Contribution</h2>

				  <div class="card-body">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#itemDetailsTab">All</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#writer">Writers</a>
						</li>
            <li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#illustrator">Illustrators</a>
						</li>
            <li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#comic">Comic Serial Creators</a>
						</li>
            <li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#cartoon">Cartoonists</a>
						</li>
					</ul>
          <div class="tab-content">
						<div id="itemDetailsTab" class="container-fluid tab-pane active">
							
<section id="contributionTableCSS">
  <div class="container">
  
    <div class="row gy-4">

      <div class="col-lg-12">
		<table id="contributeTable" class="table datatable table-warning table-striped table-hover" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
				      <th>Date</th>
	            <th>Author</th>
	            <th>Content Type</th>
              <th></th>
              <th>Published To</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
        </thead>
 
    </table>
    </div>

</div>
</div>

</section>
</div>
<div id="writer" class="container-fluid tab-pane fade">
  <section id="contributionTableCSS">
  <div class="container">
  
    <div class="row gy-4">

      <div class="col-lg-12">
		<table id="contributeTableWriter" class="table datatable table-warning table-striped table-hover" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
				      <th>Date</th>
	            <th>Author</th>
	            <th>Content Type</th>
              <th></th>
              <th>Published To</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
        </thead>
 
    </table>
    </div>

</div>
</div>

</section>
						</div>
  <div id="illustrator" class="container-fluid tab-pane fade">
  <section id="contributionTableCSS">
  <div class="container">
  
    <div class="row gy-4">

      <div class="col-lg-12">
		<table id="contributeTableIllustrator" class="table datatable table-warning table-striped table-hover" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
				      <th>Date</th>
	            <th>Author</th>
	            <th>Content Type</th>
              <th></th>
              <th>Published To</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
        </thead>
 
    </table>
    </div>

</div>
</div>

</section>
						</div>
                        <div id="cartoon" class="container-fluid tab-pane fade">
                        <section id="contributionTableCSS">
  <div class="container">
  
    <div class="row gy-4">

      <div class="col-lg-12">
		<table id="contributeTableCartoon" class="table datatable table-warning table-striped table-hover" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
				      <th>Date</th>
	            <th>Author</th>
	            <th>Content Type</th>
              <th></th>
              <th>Published To</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
        </thead>
 
    </table>
    </div>

</div>
</div>

</section>
						</div>
                        <div id="comic" class="container-fluid tab-pane fade">
                        <section id="contributionTableCSS">
  <div class="container">
  
    <div class="row gy-4">

      <div class="col-lg-12">
		<table id="contributeTableComic" class="table datatable table-warning table-striped table-hover" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
				      <th>Date</th>
	            <th>Author</th>
	            <th>Content Type</th>
              <th></th>
              <th>Published To</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
        </thead>
 
    </table>
    </div>

</div>
</div>

</section>
						</div>
					</div>
				  </div> 
				</div>
			  </div>
</div>
</div>
</div>
</div>
<div id="container">
<div class="form-popup" id="myForm">
  <h3>Publish contribution</h3>
  <form id="publishForm" class="form-container">
    <input style="display:none" id="c_id" name="c_id"></input>
  <div class="row row-space">
  <div class="col-6">
  <div class="rs-select2 js-select-simple select--no-search">
      <select name="c_part" id="part">
          <option disabled="disabled" selected="selected" value="null">Choose a place assign to</option>
          <option id="tips" value="tips">Tips</option>
          <option id="mindbooster" value="mindbooster">Mind Booster</option> 
          <!--<option id="loops" value="loops">Loops</option> 
           <option id="teach" value="teach">Teaching Support</option>  -->

      </select>
      
    <div class="select-dropdown"></div>
  </div>
  </div>
</div>

<!-- MINDBOOSTER FORM -->

  <div class="row row-space" id="mindBoosterMore" style="display:none">
  <div class="col-12">
    <div class="input-group">
    <br>
      <h4>Choose a subject for Mind Booster</h4>
        <div class="p-t-15" id="radioAJAX">
         </div> 
    </div>
</div>
  </div>


  <!-- TIPS FORM -->

  <div class="row row-space" id="tipsMore" style="display:none">
  <div class="col-12">
    <div class="input-group">
    <br>
      <h4>Choose a category for Tips</h4>
        <div class="p-t-15" id="radioAJAX">
        </div> 
    </div>
</div>
  </div>

<br>
    <button type="submit" class="learn-more">Publish</button>&nbsp&nbsp
    <button type="button" class="closeBtn" onclick="closeForm()">Close</button>
  </form>
</div>
</div>
</div>


<?php 
include("../commonPHP/footer_admin.php");
?>


<?php 
include("../commonPHP/jsFiles.php");
?>

<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>

	 <!-- Jquery JS-->
   <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="../assets/vendor/select2/select2.min.js"></script>
    <!-- Template Main JS File -->
    <script src="./assets/js/main.js"></script>
    <script src="../assets/vendor/datepicker/moment.min.js"></script>
    <script src="../assets/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="../assets/js/global.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/manageContribute.js">
    
	</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    
</body>

</html>