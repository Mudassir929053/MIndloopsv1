<?php
include("../commonPHP/adminNavBar.php");
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="../assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  

<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<!-- Vendor CSS-->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>

<link href="../assets/css/manageTeachSupport.css" rel="stylesheet">
<div class="container-fluid">
<div class="row">
<div class="col-lg-11" style="margin:auto auto;">
			<div class="tab-content" id="v-pills-tabContent">
			  <div class="tab-pane fade show active" id="v-pills-item" role="tabpanel" aria-labelledby="v-pills-item-tab">
				<div class="card card-outline-secondary my-4">
            <h2 style="text-align: center;color:black;"><br>Manage Teaching Support</h2>
            
				  <div class="card-body">
          <a class="btn btn-warning" style="margin-bottom:10px;padding:10px;" href="addTeachSupport.php"><i
                            class="bi bi-plus-circle"></i> Add New</a>
					<ul class="nav nav-tabs justify-content-center" role="tablist" id="tabList">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#itemDetailsTab">All</a>
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
						<div id="itemDetailsTab" class="container-fluid tab-pane active">
							
<section id="contributionTableCSS">
  <div class="container">
  
    <div class="row gy-4">

      <div class="col-lg-12">
		<table id="teachSupportTable" class="table datatable table-warning table-striped table-hover" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
				      <th>Date</th>
	            <th>Author</th>
	            <th>Content Type</th>
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
 <!-- PEDAGOGY-->
 <div id="Pedagogy" class="container-fluid tab-pane fade">
							
              <section id="contributionTableCSS">
                <div class="container">
                
                  <div class="row gy-4">
              
                    <div class="col-lg-12">
                  <table id="teachSupportTablePedagogy" class="table datatable table-warning table-striped table-hover" width="100%">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Title</th>
                              <th>Description</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Content Type</th>
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
<!-- CURRICULUM -->
<div id="Curriculum" class="container-fluid tab-pane fade">
							
<section id="contributionTableCSS">
  <div class="container">
  
    <div class="row gy-4">

      <div class="col-lg-12">
		<table id="teachSupportTableCurriculum" class="table datatable table-warning table-striped table-hover" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
				      <th>Date</th>
	            <th>Author</th>
	            <th>Content Type</th>
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
<!-- ASSESSMENT -->
<div id="Assessment" class="container-fluid tab-pane fade">
							
<section id="contributionTableCSS">
  <div class="container">
  
    <div class="row gy-4">

      <div class="col-lg-12">
		<table id="teachSupportTableAssessment" class="table datatable table-warning table-striped table-hover" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
				      <th>Date</th>
	            <th>Author</th>
	            <th>Content Type</th>
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
<!--END -->
					</div>
          
				  </div> 
				</div>
			  </div>
</div>
			  </div>
</div>
</div>
</div>
</div>
</div>

<?php 
include("../commonPHP/footer_admin.php");
?>


<?php 
include("../commonPHP/jsFiles.php");
?>


	 <!-- Jquery JS-->
   <script src="../assets/vendor/jquery/jquery.min.js"></script>
   
    <script src="../assets/js/manageTeachSupport.js">
	</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    
</body>

</html>