	 
	window.addEventListener('online',  updateOnlineStatus);
	window.addEventListener('offline', updateOnlineStatus);

	function updateOnlineStatus(event) {
		
	  var condition = navigator.onLine ? "online" : "offline";
	   
		
		if(condition == "offline"){
			
			swal("You have lost your Internet Connection", {
			  dangerMode: true,
			  buttons: true,
			});
			
		}else{
			
			swal("Your Connection is Back ", {
			  successMode: true,
			  buttons: true,
			});
			
		}
		
	}
	
	
	
	
	function getUrlVars(){
		
		var vars = {};
			
			var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
				vars[key] = value;
			});
			
		return vars;
	}
	
	 
	 
	//track User Activities
		function trackUserActivities(description){
			
			var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/user_tracker.php?theuserid="+theuserid+"&description="+description, function(data) {

				console.log(data);
			 		   
			});
			
		}
	//track User Activities end
	
	
	
// The User Location

// The User Location


	function ipLookUp(username,email,thepassword,thecpassword,userbroswer,referral){
		
		
		
		 // $.ajax('http://ip-api.com/json')
		  // .then(
			// function success(response) {
				  
				  // console.log('User\'s Location Data is ', response);
				  
				   
					// var userContinent = response.continent;
					// var userCountry = response.country;
					// var userState = response.regionName;
					// var userCity = response.city;
					// var userLongitude = response.lon;
					// var userLatitude = response.lat;
					// var timezone = response.timezone;
					// var userip = response.query;
					
					// $("#signupbtn").html("Please Wait ...");
					
				  // sendAllRegistration(username,email,thepassword,thecpassword,userContinent,userCountry,userState,userCity,userLongitude,userLatitude,timezone,userip,userbroswer);
				  
			// },

			  // function fail(data, status) {
				  // console.log('Request failed.  Returned status of',
							  // status);
			  // }
		  // );
		  
		  
		  
			 
						
					$.getJSON("https://api.ipify.org?format=json", function(data){ 
  
						 
						var userip = data.ip;
						
					    var userContinent = "";
						var userCountry = "";
						var userState = "";
						var userCity = "";
						var userLongitude = "";
						var userLatitude = "";
						var timezone = "";
						 	
						$("#signupbtn").html("Please Wait ...");
											
						sendAllRegistration(username,email,thepassword,thecpassword,userContinent,userCountry,userState,userCity,userLongitude,userLatitude,timezone,userip,userbroswer,referral);
					
			 
					}).fail(function() { 
						
						
						$.getJSON("https://geolocation-db.com/json/0f761a30-fe14-11e9-b59f-e53803842572", function(location){ 
								
								 
								var userContinent = "";
								var userCountry = location.country_name;
								var userState = location.state;
								var userCity = location.city;
								var userLongitude = location.latitude;
								var userLatitude = location.longitude;
								var timezone = "";
								var userip = location.IPv4;
									
								$("#signupbtn").html("Please Wait ...");
													
								 sendAllRegistration(username,email,thepassword,thecpassword,userContinent,userCountry,userState,userCity,userLongitude,userLatitude,timezone,userip,userbroswer,referral);
							
							 
						}).fail(function(){ 
						
						
							$("#signupbtn").html("Please Wait ...");
												
							sendAllRegistration(username,email,thepassword,thecpassword,userContinent,userCountry,userState,userCity,userLongitude,userLatitude,timezone,userip,userbroswer,referral);
						
								 
						});   
					  
							
						
						
					});   
				  
						
				 
		  
					
				   
			
			
			// $.getJSON("https://api.ipify.org?format=json",function(data) { 
			
					
					// var xmlhttp = new XMLHttpRequest();
					// var ip_address =  data.ip;
					// var auth = '27cfc709-e6fe-493c-9980-86d61f601bfd';
					// var url = "https://ipfind.co/?auth=" + auth + "&ip=" + ip_address;

					// xmlhttp.onreadystatechange = function() {
					// if (this.readyState == 4 && this.status == 200){
						  // var result = JSON.parse(this.responseText);
						  
							// var userContinent = result.continent;
							// var userCountry = result.country;
							// var userState = result.city;
							// var userCity = result.county;
							// var userLongitude = result.latitude;
							// var userLatitude = result.longitude;
							// var timezone = result.timezone;
							// var userip = data.ip;
						
							// sendAllRegistration(username,email,thepassword,thecpassword,userContinent,userCountry,userState,userCity,userLongitude,userLatitude,timezone,userip,userbroswer);
						
						// }else{
							
							// $("#signupbtn").html("Please wait ...");
						// }
						
					// };

					// xmlhttp.open("GET", url, true);
					// xmlhttp.send();			 
							 
			// }) 
			
			
			
			
			
			// $.getJSON("https://api.ipify.org?format=json",function(data) { 
			
				 
					// var xmlhttp = new XMLHttpRequest();
					// var ip_address =  data.ip;
					// var auth = '27cfc709-e6fe-493c-9980-86d61f601bfd';
					// var url = "https://www.geoplugin.net/json.gp/?ip=" + ip_address;

					// xmlhttp.onreadystatechange = function() {
					// if (this.readyState == 4 && this.status == 200) {
						  // var result = JSON.parse(this.responseText);
						  
						  
						// var userContinent = result.geoplugin_continentName;
						// var userCountry = result.geoplugin_countryName;
						// var userState = result.geoplugin_region;
						// var userCity = result.geoplugin_city;
						// var userLongitude = result.geoplugin_latitude;
						// var userLatitude = result.geoplugin_longitude;
						// var timezone = result.geoplugin_timezone;
						// var userip = result.geoplugin_request;
						 
							// sendAllRegistration(username,email,thepassword,thecpassword,userContinent,userCountry,userState,userCity,userLongitude,userLatitude,timezone,userip,userbroswer);
						
						// }else{
							 // $("#signupbtn").html("Please wait ...");
						// }
					// };

					// xmlhttp.open("GET", url, true);
					// xmlhttp.send();			 
							 
			// }) 
			
			
			 
	 
	}
// The User Location end 


	function validateEmail(mail){
		
		 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.emailAddr.value)){
			 
			return true;
			
		  }else{
			  
			 swal ( "" , "You have entered an invalid email address !" ,  "error" );
			 return false; 
		  }
			 
			
	}




	// The User Agent 

	function theUserAgent(){
	  
	  var ba = ["Chrome","Firefox","Safari","Opera","MSIE","Trident","Edge"];
		var b, ua = navigator.userAgent;
		var browser = document.getElementById("agent");
		for(var i=0; i < ba.length; i++){
			if( ua.indexOf(ba[i]) > -1 ){
				b = ba[i];
				break;
			}
		}
		if(b == "MSIE" || b == "Trident" || b == "Edge"){
			b = "Internet Explorer";
		}
		
		browser.value = b;
	} 
	// The User Agent end 
	 



	
	// The reigester function  

	function registerNow(){
			 
			var username = document.getElementById("username").value;
			var email = document.getElementById("email").value;
			 var thepassword = document.getElementById("password").value;
			 var thecpassword = document.getElementById("cpassword").value;
			 var userbroswer = document.getElementById("agent").value;
			 var referral = document.getElementById("referral").value;
			  
			  
			if(username.trim() == ""){
				
				swal ( "" , "Please Enter Full Name !" ,  "error" );
				
				return false;
				
			}else if(username.length < 3 ){
				
				swal ( "" , "Invalid Full Name !" ,  "error" );
				
				return false;
				
			}else if(email.trim() == ""){
				
				swal ( "" ,  "Please Enter Email !" ,  "error" );
				
				return false;
				
			}else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))){

					swal ( "" ,  "You have entered an invalid email address!" ,  "error" );
				
					return false;

			}else if(thepassword.trim() == ""){
				
				swal ( "" ,  "Please Enter Password !" ,  "error" );
				
				return false;
				
			}else if(thepassword.length < 6 ){
				
				swal ( "" ,  "Your Password can't be less than 6 Characters" ,  "error" );
				
				return false;
				
			}else if(thecpassword.trim() == ""){
				
				swal ( "" ,  "Please Enter Confirm  Password !" ,  "error" );
				
				return false;
				
			}else if(thecpassword != thepassword){
				
				swal ( "" ,  "Your Passwords Do not Match" ,  "error" );
				
				return false;
				
			}else{
				
				$("#signupbtn").html("Please Wait ...");
				
				 ipLookUp(username,email,thepassword,thecpassword,userbroswer,referral); 
					
			 }
			
			
	}





	
	
	// Send All Registration


	function sendAllRegistration(username,email,thepassword,thecpassword,userContinent,userCountry,userState,userCity,userLongitude,userLatitude,timezone,userip,userbroswer,referral){
		
		
			var formdata = new FormData(); 
			  
				 formdata.append("username", username); 
				 formdata.append("email", email); 
				 formdata.append("thepassword", thepassword); 
				 formdata.append("thecpassword", thecpassword); 
				 formdata.append("userContinent", userContinent); 
				 formdata.append("userCountry", userCountry); 
				 formdata.append("userState", userState); 
				 formdata.append("userCity", userCity); 
				 formdata.append("userLongitude", userLongitude); 
				 formdata.append("userLatitude", userLatitude); 
				 formdata.append("timezone", timezone); 
				 formdata.append("userip", userip); 
				 formdata.append("userAgent", userbroswer); 
				 formdata.append("referral", referral); 
				
				 
					
								
					if(window.XMLHttpRequest){
					
						xmlhttp = new XMLHttpRequest();

					}else{
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					 }
								
					xmlhttp.onreadystatechange = function(){
										
						if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
											 
												   
							if(Number.isInteger(parseInt(xmlhttp.responseText.trim()))){
													
								var userid = parseInt(xmlhttp.responseText.trim());
													
								localStorage.setItem("junky_userid",userid);
								
								localStorage.setItem("junky_email",email);
													  
								$("#signupbtn").html("Register");
									
								trackUserActivities('User created an account via Web mygamehive.com');
									
								//swal("", "Registration Successful!", "success");
													 
								window.location='account.php';
													 
							}else{
													 
								swal ( "" ,xmlhttp.responseText.trim(),  "error" );
													 
									$("#signupbtn").html("Register");
								}
											 
						}else{
											
							 $("#signupbtn").html("Processing...");
							 
						}
								
					}
								
						xmlhttp.open("POST","apiengine/appaction/signup_update.php", true);
								
						xmlhttp.send(formdata);
										
								
				 
		
	}
// The reigester function  end




 
	
	

// The login function  


	function login(){
			
			var email = document.getElementById("email").value;
			
			var logpassword = document.getElementById("password").value;
			
			
			if(email.trim() == ""){
				
				swal ( "" ,  "Please Enter Email !" ,  "error" );
				
				return false;
				
			}else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))){

					swal ( "" ,  "You have entered an invalid email address!" ,  "error" );
				
					return false;

				  
			}else if(logpassword.trim() == ""){
				
				swal ( "" ,  "Please Enter Password !" ,  "error" );
				
				return false;
				
			}else{
				
				$("#loginbtn").html("Please wait ...");
				
				$.ajax({
				url: "https://geolocation-db.com/json/0f761a30-fe14-11e9-b59f-e53803842572",
				jsonpCallback: "callback",
				dataType: "json",
				success: function(location){
					 	 
						 if(location.country_name == ""){
							 
							 swal ( "" ,  "Invalid Location",  "error" );
							
								$("#loginbtn").html("Login");
								
							return false;
							 
						 }else{
							 
							 
							  var formdata = new FormData(); 
			  
								 formdata.append("email", email); 
								 formdata.append("logpassword", logpassword); 
								 formdata.append("country", location.country_name); 
								 formdata.append("state", location.state); 
								 formdata.append("userip", location.IPv4); 
								  
								
								if(window.XMLHttpRequest){
									
									xmlhttp = new XMLHttpRequest();

								}else{
									
									xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
									
								}
								
									xmlhttp.onreadystatechange = function(){
										
									if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
										 
										  
										 if(Number.isInteger(parseInt(xmlhttp.responseText.trim()))){
											
											var userid = parseInt(xmlhttp.responseText.trim());
											
											localStorage.setItem("junky_userid",userid);
											localStorage.setItem("junky_email",email);
											   
											   $("#loginbtn").html("Login");
											 
											 // swal("", "Login Successful!", "success");
											 
											   trackUserActivities('User login  account via web mygamehive.com');
											  
											 window.location='account.php';
											 
										 }else{
											 
											 $("#loginbtn").html("Login");
											 
											 swal ( "" ,  xmlhttp.responseText,  "error" );
										 }
										 
									}else{
										
										$("#loginbtn").html("Please wait ...");
										
									} 
								
								}
								
								xmlhttp.open("POST","apiengine/appaction/login.php", true);
								
								xmlhttp.send(formdata);
							 
							 
						  }
						 
						 
					 }
				});	
			
			
			 }
			
			
	}









	function login_admin(){
			
			var email = document.getElementById("email").value;
			
			var logpassword = document.getElementById("password").value;
			
			
			if(email.trim() == ""){
				
				swal ( "" ,  "Please Enter Email !" ,  "error" );
				
				return false;
				
			}else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))){

					swal ( "" ,  "You have entered an invalid email address!" ,  "error" );
				
					return false;

				  
			}else if(logpassword.trim() == ""){
				
				swal ( "" ,  "Please Enter Password !" ,  "error" );
				
				return false;
				
			}else{
				
				$("#loginbtn").html("Please wait ...");
				
				$.ajax({
				url: "https://geolocation-db.com/json/0f761a30-fe14-11e9-b59f-e53803842572",
				jsonpCallback: "callback",
				dataType: "json",
				success: function(location){
					 	 
						 if(location.country_name == ""){
							 
							 swal ( "" ,  "Invalid Location",  "error" );
							
								$("#loginbtn").html("Login");
								
							return false;
							 
						 }else{
							 
							 
							  var formdata = new FormData(); 
			  
								 formdata.append("email", email); 
								 formdata.append("logpassword", logpassword); 
								 formdata.append("country", location.country_name); 
								 formdata.append("state", location.state); 
								 formdata.append("userip", location.IPv4); 
								  
								
								if(window.XMLHttpRequest){
									
									xmlhttp = new XMLHttpRequest();

								}else{
									
									xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
									
								}
								
									xmlhttp.onreadystatechange = function(){
										
									if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
										 
										  
										 if(Number.isInteger(parseInt(xmlhttp.responseText.trim()))){
											
											var userid = parseInt(xmlhttp.responseText.trim());
											
											localStorage.setItem("junky_userid",userid);
											localStorage.setItem("junky_email",email);
											   
											   $("#loginbtn").html("Login");
											 
											 // swal("", "Login Successful!", "success");
											 
											 window.location='account.php';
											 
										 }else{
											 
											 $("#loginbtn").html("Login");
											 
											 swal ( "" ,  xmlhttp.responseText,  "error" );
										 }
										 
									}else{
										
										$("#loginbtn").html("Please wait ...");
										
									} 
								
								}
								
								xmlhttp.open("POST","apiengine/appaction/login_admin.php", true);
								
								xmlhttp.send(formdata);
							 
							 
						  }
						 
						 
					 }
				});	
			
			
			 }
			
			
	}
 


	// The login function  end





	//login in Session functions 


	function logout(){
			
			localStorage.removeItem("junky_userid");
			localStorage.removeItem("junky_email");
			localStorage.clear();
			window.location='index.php';	
	}
		
		
		
		
	 function checkIsLogin(){
						
				if(localStorage.junky_userid && localStorage.junky_email){
				
				  window.location='account.php';	
				 
				}		
	  } 
	  
	  
	   


	function checkNotLogin(){
				
			if(!localStorage.junky_userid || !localStorage.junky_email){
				
				window.location='login.php';			 
			}		

	}




	function checkIsLoginMenu(){
						
			if(localStorage.junky_userid && localStorage.junky_email){
				
				 $("#logmenu").html('<a href="account.php" class="btn btn-warning mainbtn pull-right">My Profile</a>');
				 
			}		
	  }
		
		
	function checkIsLoginMenuInner(){
						
			if(localStorage.junky_userid && localStorage.junky_email){
				
				 $("#logmenu").html('<a href="../account.php" class="btn btn-warning mainbtn pull-right">My Profile</a>');
				 
			}		
	  }
				



	//login in Session functions  ends 


	
	
	function checkReferralURL(){
				
		 getUrlVars(); 
				
		var referral = getUrlVars()["ref"];
							
							
		if(typeof referral == 'undefined' || referral  == ''){
							
			document.getElementById("referral").value = 'myku981385';
								  
		}else{
								
			document.getElementById("referral").value = referral;
								 
		}
						
	}
	
	
	
	
	
	
	//forget password 

		

	function f_password(){
			
			 var email = document.getElementById("email").value;
			 
			
			 if(email.trim() == ""){
				
				swal ( "" ,  "Please Enter Email address !" ,  "error" );
				
			}else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))){

					swal ( "" ,  "You have entered an invalid email address!" ,  "error" );
				
					return false;

				  
			}else{
				
				
				 var formdata = new FormData(); 
			  
				  formdata.append("email", email); 
				  
				
				if(window.XMLHttpRequest){
					
					xmlhttp = new XMLHttpRequest();

				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				
					xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						 
						if(xmlhttp.responseText.trim() == "1"){
							
							$("#repassword").html("Reset Password");
							  
							 swal("", "A new password have been sent to your email address", "success");
						 
						 }else{
							 
							 swal ( "" ,  xmlhttp.responseText,  "error" );
							 
							  $("#repassword").html("Reset Password");
						 }
					} else{
						
						 $("#repassword").html("Please wait ...");
					}
				
				}
				xmlhttp.open("POST","apiengine/appaction/forget_password.php", true);
				
				xmlhttp.send(formdata);
			
			
				
			}
			
			
	}

	 

	//forget password ends 



	
	


// check user verification 

	function checkUserVerification(){
		
		 var theuserid = localStorage.junky_userid;
		
		$.get("apiengine/appaction/check_user_verification.php?theuserid="+theuserid, function(data) {

			if(data.trim() == "yes"){
						 
				 console.log(data);
							
			}else{
				$("#checkaccountVerify").html(data);
				
			}
					   
		});
		
	}
	
// check user verification end






// Resend verification 

	function resendVerification(){
		
		trackUserActivities('User request account verification link');
		
		$("#resend_link").html("Processing ...");
		
		var theuserid = localStorage.junky_userid;
		
		$.get("apiengine/appaction/resend_verification.php?theuserid="+theuserid, function(data) {

			if(data.trim() == ""){
						 
				swal ( "" ,  "The Verification link has been sent.",  "success" );
				
				$("#resend_link").html("Resend Link");
							
			}else if(data.trim() == "error"){
						 
				swal ( "Oops" ,  "There was an Error",  "error" );
				
				$("#resend_link").html("Resend Link");
							
			}else{
				swal ( "Oops" ,  data,  "error" );	
				
				$("#resend_link").html("Resend Link");
				
			}
					   
		});
		
	}
	
	
// Resend verification end
 
	
	
			
	 // load Account  
 

	 
	function loadEditAccount(){
			
			
			
			var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/load_edit_acount.php?theuserid="+theuserid, function(data) {

				  
				  if(data.trim() == "none"){
					 
					  logout();
					   
				 }else{
					 
					 $("#useraccountform").html(data);
				}
				   
			});
		 
	}
 
 
 // load Account end 		
			
			
			
			
	
 
	function updateAccount(){
	 
	 
		var accusername = document.getElementById("accusername").value;
		var accemail = document.getElementById("accemail").value;
		var accphone = document.getElementById("accphone").value;
		var dateofbirth = document.getElementById("dateofbirth").value;
		var aboutme = document.getElementById("aboutme").value;
		
			   
			 
				 if(accusername.trim() == ""){
					
					swal ( "" ,  "Enter Full Name" ,  "error" );
					
					return false
					
				}else if(accusername.length < 3){
					
				swal ( "" ,  "Invalid Full Name" ,  "error" );
					
					return false
					
				}else if(accemail.trim() == ""){
					
				swal ( "" ,  "Enter Email Address" ,  "error" );
					
					return false
					
				}else{
					
					
					 var formdata = new FormData(); 
				  
					   
					  formdata.append("accusername", accusername); 
					  formdata.append("accemail", accemail); 
					  formdata.append("accphone", accphone); 
					  formdata.append("dateofbirth", dateofbirth); 
					  formdata.append("aboutme", aboutme); 
					  
					  formdata.append("theuserid", localStorage.junky_userid);
					 
					 
				 
					if(window.XMLHttpRequest){
						
						xmlhttp = new XMLHttpRequest();

					}else{
						
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					
						xmlhttp.onreadystatechange = function(){
						if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
							 
							 if(xmlhttp.responseText.trim() == "1"){
								
								 
								$("#updateacc").html("Save Changes");
								
								   swal ( "" , "Saved... ",  "success" );
								   
									 trackUserActivities('User update account information');
									 
								}else{
								 
								 swal ( "" ,  xmlhttp.responseText,  "error" );
								 
								  
								$("#updateacc").html("Save Changes");
							  }
						} else{
							
							$("#updateacc").html("Please wait ...");
						}
					
					}
					xmlhttp.open("POST","apiengine/appaction/update_account.php", true);
					
					xmlhttp.send(formdata);
				
				
			}
	 
	}
 
 
 
 		
			
			
	
		
		
	function accountPhotoUploader(){
		
	 
		$image_crop = $('#image_demo').croppie({
		enableExif: true,
		viewport: {
		  width:200,
		  height:200,
		  type:'circle' // square
		},
		boundary:{
		  width:300,
		  height:300
		}
	  });

	  $('#upload_image').on('change', function(){
		var reader = new FileReader();
		reader.onload = function (event) {
		  $image_crop.croppie('bind', {
			url: event.target.result
		  }).then(function(){
			console.log('jQuery bind complete');
		  });
		}
		reader.readAsDataURL(this.files[0]);
		$('#uploadimageModal').modal('show');
	  });

	  $('.crop_image').click(function(event){
		$image_crop.croppie('result', {
		  type: 'canvas',
		  size: 'viewport'
		}).then(function(response){
			
			 var theuserid = localStorage.junky_userid;
			 
			 $('#setprophoto').html("PROCESSING...");
			
			var formData = {
				'image' : response,
				'theuserid': theuserid
			};
			
		  $.ajax({
			url:"apiengine/appaction/account_photo_upload.php",
			type: "POST",
			data: formData,
			success:function(data)
			{
			  $('#uploadimageModal').modal('hide');
			  $('#uploaded_image').html(data);
			  
			  loadTopMenuDetails();
			  
			  loadAsideMenuDetails();
			  
			  $('#setprophoto').html("SET PROFILE PHOTO");
			  
			   trackUserActivities('User upload profile photo');
			}
		  });
		})
	  });

	 

	}
		//Account photo uploader end


 
 
			
	//Account photo uploader  
 
	function loadAccPhoto(){
			
			 
			  var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/load_account_photo.php?theuserid="+theuserid, function( data ) {

				  
				  if(data.trim() == "none"){
					 
					   logout();
					   
				 }else{
					 
					 $("#uploaded_image").html(data);
				}
				   
			});
		 
	 }
	 
	 
	 
	 
	 
	 
	   
 
 
 		
			
			
	
 	//Account info
	
	function loadAccUsername(){
			
			
			  var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/load_account_username.php?theuserid="+theuserid, function( data ) {

				  
				  if(data.trim() == "none"){
					 
					   logout();
					   
				 }else{
					 
					 $("#acctusername").html(data);
					 $("#dashname").html(data);
				}
				   
			});
		 
	 }
 
 
 		
			
			
			
			
			
			
	
 // load Setting Start
 
 
	function loadSetting(){
			
		 $(document).ready(function () {	
		 
			  var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/load_setting.php?theuserid="+theuserid, function( data ) {

				  
				  if(data.trim() == "none"){
					 
					   logout();
					   
				 }else{
					 
					 $("#settingform").html(data);
				}
				   
			});
			
		 });
	}
 
 
 
 
  // load Setting Start end
 
 		
			
			
			
			
			
			
	

// save_setting start  

	function save_setting(){
	
		var thepassform = document.getElementById("settingform");
		
		var feedback = document.getElementById("feedback").value;
		var privacy = document.getElementById("private").value;
		var sms = document.getElementById("sms").value;
		var message = document.getElementById("message").value;
			  
			 var theuserid = localStorage.junky_userid;
		 
			 var formdata = new FormData(); 
		  
			 formdata.append("feedback", feedback); 
			 formdata.append("privacy", privacy); 
			 formdata.append("sms", sms); 
			 formdata.append("message", message); 
			 formdata.append("theuserid", theuserid); 
			
			
			if(window.XMLHttpRequest){
				
				xmlhttp = new XMLHttpRequest();

			}else{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
				xmlhttp.onreadystatechange = function(){
					
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						 
						if(xmlhttp.responseText.trim() == "1"){
							
							 
							  $("#thesavesetting").html("Save Setting");
							  
							 swal(" ", "Saved.", "success");
							 
							 loadSetting();
							 
							  trackUserActivities('User save account setting  information');
							  
						 }else{
							 
							 swal ( "Oops" ,  xmlhttp.responseText,  "error" );
							 
							  $("#thesavesetting").html("Save Setting");
						 }
					} else{
						
						 $("#thesavesetting").html("Please wait ...");
					}
				
				}
				
			xmlhttp.open("POST","apiengine/appaction/save_setting.php", true);
			
			xmlhttp.send(formdata);
		
	}

 
 
 
 // save_setting  end
 
 
 
 
 		
			
			
	
 // change password start
 

 function change_password(){
	
	var thepassform = document.getElementById("changepasswordform");
	
	var oldpassword = document.getElementById("oldpassword").value;
		var newpassword = document.getElementById("npassword").value;
		var newpassword2 = document.getElementById("cpassword").value;
		 
		 var theuserid = localStorage.junky_userid;
		
		
		if(oldpassword.trim() == ""){
			
			swal ( "" ,  "Please Enter Current password !" ,  "error" );
			return false
			
		}else if(newpassword.trim() == ""){
			
			swal ( "" ,  "Please New password !" ,  "error" );
			return false
			
		}else if(newpassword.length < 6 ){
			
			swal ( "" ,  "Your Password can't be less than 6 Characters",  "error" );
			
			return false
			
		} else if(newpassword2.trim() == ""){
			
			swal ( "" ,  "Please Confirm New Password !" ,  "error" );
			return false
			
		}else if(newpassword2 !== newpassword){
			
			swal ( "" ,  "Password do not march!" ,  "error" );
			return false
		}else{
			
			
			 var formdata = new FormData(); 
		  
			 formdata.append("oldpassword", oldpassword); 
			 formdata.append("newpassword", newpassword); 
			 formdata.append("theuserid", theuserid); 
			
			
			if(window.XMLHttpRequest){
				
				xmlhttp = new XMLHttpRequest();

			}else{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
				xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					 
					if(xmlhttp.responseText.trim() == "1"){
						
						 
						  $("#repassword").html("Change Password");
						  
						 swal(" ", " Password Change was successful.", "success");
						 
						 thepassform.reset();
						 
						  trackUserActivities('User change account password');
						 
					 }else{
						 
						 swal ( "Oops" ,  xmlhttp.responseText,  "error" );
						 
						  $("#repassword").html("Change Password");
					 }
				} else{
					
					 $("#repassword").html("Please wait ...");
				}
			
			}
			xmlhttp.open("POST","apiengine/appaction/change_password.php", true);
			
			xmlhttp.send(formdata);
		
		
			
		}
}



// change password  end


 



// load New Arrival

			
	 
	 $('.tab-active').owlCarousel({
				smartSpeed: 1000,
				nav: true,
				autoplay: false,
				dots: false,
				loop: true,
				margin: 20,
				navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
				responsive: {
					0: {
						items: 1
					},
					480: {
						items: 2
					},
					768: {
						items: 3
					},
					992: {
						items: 4
					},
					1170: {
						items: 4
					},
					1300: {
						items: 5
					}
				}
			})
	
	
	// load New Arrival end 
	
	
	
	
	
	function loadFinance(){
			
		  
		$(document).ready(function () {	
		 
			 var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/load_finance_books.php?theuserid="+theuserid, function( data ) {

				  $("#load-finance-book").html(data);
				  loadFinanceSlider();
			});
			 
			
		});
			
		  
	}		
	
	
	
	
	function loadFinanceSlider(){
		
		   $('.loadFinance').owlCarousel({
				smartSpeed: 1000,
				nav: true,
				autoplay: false,
				dots: false,
				loop: true,
				margin: 20,
				navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
				responsive: {
					0: {
						items: 1
					},
					480: {
						items: 2
					},
					768: {
						items: 3
					},
					992: {
						items: 4
					},
					1170: {
						items: 4
					},
					1300: {
						items: 5
					}
				}
			})
	}
	
	 
	
	
	
	
	
	function loadInsurance(){
			
		  
		$(document).ready(function () {	
		 
			 var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/load_insurance_books.php?theuserid="+theuserid, function( data ) {

				  $("#load-insurance-book").html(data);
				  loadInsuranceSlider();
			});
			 
			
		});
			
		  
	}		
	
	
	
	
	function loadInsuranceSlider(){
		
		   $('.loadInsurance').owlCarousel({
				smartSpeed: 1000,
				nav: true,
				autoplay: false,
				dots: false,
				loop: true,
				margin: 20,
				navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
				responsive: {
					0: {
						items: 1
					},
					480: {
						items: 2
					},
					768: {
						items: 3
					},
					992: {
						items: 4
					},
					1170: {
						items: 4
					},
					1300: {
						items: 5
					}
				}
			})
	}
	
	 
	// load New Arrival end
	
	
	
	
	//most Recent Book   
	
	function mostRecentBook(){
			
		  
		$(document).ready(function () {	
		 
			 var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/most_recent_books.php?theuserid="+theuserid, function( data ) {

				  $("#most-recent-book").html(data);
				  
			});
			 
			
		});
			
		  
	}	

	
	//most Recent Book end  
	
	
	
	
	
	//four Side Book Slider  
	 
	
	function fourSideBook(){
			
		  
		$(document).ready(function () {	
		 
			 var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/four_side_book.php?theuserid="+theuserid, function( data ) {

				  $("#four-side-book").html(data);
				  
				  fourSideBookSlider();
			});
			 
			
		});
			
		  
	}		
	
	
	
	
	function fourSideBookSlider(){
		
		$('.bestseller-active').owlCarousel({
			smartSpeed: 1000,
			margin: 0,
			nav: true,
			autoplay: false,
			dots: false,
			margin: 20,
			loop: true,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			responsive: {
				0: {
					items: 1
				},
				480: {
					items: 2
				},
				768: {
					items: 2
				},
				1000: {
					items: 2
				}
			}
		})
    
		  
	}
	

//four Side Book Slider end 


//featured Books

			
	 
	
	function featuredBooks(){
			
		  
		$(document).ready(function () {	
		 
			 var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/featured_books.php?theuserid="+theuserid, function( data ) {

				  $("#load-featured-book").html(data);
				  
				  featuredBooksSlider();
			});
			 
			
		});
			
		  
	}		




	function featuredBooksSlider(){
			
		  
		  $('.tab-active').owlCarousel({
			smartSpeed: 1000,
			nav: true,
			autoplay: false,
			dots: false,
			loop: true,
			margin: 20,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			responsive: {
				0: {
					items: 1
				},
				480: {
					items: 2
				},
				768: {
					items: 3
				},
				992: {
					items: 4
				},
				1170: {
					items: 4
				},
				1300: {
					items: 5
				}
			}
		})

			
		  
	}		


//featured Books end






//category list 


	function categoryList1(){
			
		  
		$(document).ready(function () {	
		 
			 var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/category_list_1.php?theuserid="+theuserid, function( data ) {

				  $("#book-category-list-1").html(data);
				  
				 
			});
			 
			
		});
			
		  
	}	




	function categoryList2(){
			
		  
		$(document).ready(function () {	
		 
			 var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/category_list_2.php?theuserid="+theuserid, function( data ) {

				  $("#book-category-list-2").html(data);
				  
				 
			});
			 
			
		});
			
		  
	}	





	function categoryList3(){
			
		  
		$(document).ready(function () {	
		 
			 var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/category_list_3.php?theuserid="+theuserid, function( data ) {

				  $("#book-category-list-3").html(data);
				  
				 
			});
			 
			
		});
			
		  
	}	




	function categoryList4(){
			
		  
		$(document).ready(function () {	
		 
			 var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/category_list_4.php?theuserid="+theuserid, function( data ) {

				  $("#book-category-list-4").html(data);
				  
				 
			});
			 
			
		});
			
		  
	}	





	function loadDownloadBook(){
			
		  
		$(document).ready(function () {	
		 
			 var theuserid = localStorage.junky_userid;
			
			$.get("apiengine/appaction/my_download_book.php?theuserid="+theuserid, function( data ) {

				  $("#show-download-book").html(data);
				  
				 
			});
			 
			
		});
			
		  
	}	









	function requestABook(){
	
		var therequestBookform = document.getElementById("requestBookform");
	
		var booktitle = document.getElementById("booktitle").value;
		var author = document.getElementById("author").value;
		var note = document.getElementById("note").value;
		var theuserid = localStorage.junky_userid;
		
		
		if(booktitle.trim() == ""){
			
			swal ( "" ,  "Please Enter Book title !" ,  "error" );
			return false
			
		}else if(author.trim() == ""){
			
			swal ( "" ,  "Please Enter Book author !" ,  "error" );
			return false
			
		}else{
			
			
			 var formdata = new FormData(); 
		  
			 formdata.append("booktitle", booktitle); 
			 formdata.append("author", author); 
			 formdata.append("note", note); 
			 formdata.append("theuserid", theuserid); 
			
			
			if(window.XMLHttpRequest){
				
				xmlhttp = new XMLHttpRequest();

			}else{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
				xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					 
					if(xmlhttp.responseText.trim() == "1"){
						
						 
						  $("#requestBook").html("Send Request");
						  
						 swal(" ", "Request sent successful.", "success");
						 
						 therequestBookform.reset();
						 
						  trackUserActivities('User Request a Book');
						 
					 }else{
						 
						 swal ( "Oops" ,  xmlhttp.responseText,  "error" );
						 
						  $("#requestBook").html("Send Request");
					 }
				} else{
					
					 $("#requestBook").html("Please wait ...");
				}
			
			}
			xmlhttp.open("POST","apiengine/appaction/request_a_book.php", true);
			
			xmlhttp.send(formdata);
		
		
			
		}
		
		
	}




	
	
	
	


	function publishABook(){
	
		var thepublishBookform = document.getElementById("publishBookform");
	
		var booktitle = document.getElementById("pbooktitle").value;
		var author = document.getElementById("pauthor").value;
		var description = document.getElementById("pdescription").value;
		var thebookfile = document.getElementById("pbookfile").files[0];
		var theposter = document.getElementById("pposter").files[0];
		var theuserid = localStorage.junky_userid;
		
		
		if(booktitle.trim() == ""){
			
			swal ( "" ,  "Please Enter Book title !" ,  "error" );
			return false
			
		}else if(author.trim() == ""){
			
			swal ( "" ,  "Please Enter Book author !" ,  "error" );
			return false
			
		}else if(description.trim() == ""){
			
			swal ( "" ,  "Please Enter Book Description !" ,  "error" );
			return false
			
		}else if(theuserid.trim() == ""){
			
			swal ( "" ,  "Please Create an account or sign in !" ,  "error" );
			return false
			
		}else{
			
			
			 var formdata = new FormData(); 
		  
			 formdata.append("booktitle", booktitle); 
			 formdata.append("author", author); 
			 formdata.append("description", description); 
			 formdata.append("thebookfile", thebookfile); 
			 formdata.append("theposter", theposter); 
			 formdata.append("theuserid", theuserid); 
			
			
			if(window.XMLHttpRequest){
				
				xmlhttp = new XMLHttpRequest();

			}else{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
				xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					 
					if(xmlhttp.responseText.trim() == "1"){
						
						 
						  $("#publishBook").html("Publish Book");
						  
						 swal(" ", "Request sent successful.", "success");
						 
						 thepublishBookform.reset();
						 
						  trackUserActivities('User Request a Book');
						 
					 }else{
						 
						 swal ( "Oops" ,  xmlhttp.responseText,  "error" );
						 
						  $("#publishBook").html("Publish Book");
					 }
				} else{
					
					 $("#publishBook").html("Please wait ...");
				}
			
			}
			xmlhttp.open("POST","apiengine/appaction/publish_a_book.php", true);
			
			xmlhttp.send(formdata);
		
		
			
		}
		
		
	}









	function downloadBook(bookid){
		
		$(document).ready(function(){	
		 
			 
			if(!localStorage.junky_userid || !localStorage.junky_email){
				
				var theuserid = "anonymous";
			  
			}else{
				
				var theuserid = localStorage.junky_userid;
			  
			}	
			
			 
			$.get("../apiengine/appaction/download_book.php?theuserid="+theuserid+"&bookid="+bookid, function(data){
				
				console.log(data);
				 
			});
			 
			
		});
		
	}
	








	function readBookOnline(bookid){
		
		$(document).ready(function(){	
		 
			 
			if(!localStorage.junky_userid || !localStorage.junky_email){
				
				var theuserid = "anonymous";
			  
			}else{
				
				var theuserid = localStorage.junky_userid;
			  
			}	
			
			 
			$.get("../apiengine/appaction/read_book_online.php?theuserid="+theuserid+"&bookid="+bookid, function(data){
				
				console.log(data);
				 
			});
			 
			
		});
		
	}
	


//category list end
 


	
	
	
	
 