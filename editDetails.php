<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
}
$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="Niall Heatley 40128349" name="author">
	<title>TrainerPal: Health & Fitness</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
	</script>
	<script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	</script>
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js">
	</script>
	<link href="css/style.css" rel="stylesheet">
	<script>

	           jQuery(document).ready(function () {

	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#firstNameForm').submit(function (e) {

	                   var firstName = jQuery.trim($('#firstName').val());

	                   if (firstName.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#firstNameVal').html("Please insert a first name!");
	                   }

	               });

	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#lastNameForm').submit(function (e) {
	                   var lastName = jQuery.trim($('#lastName').val());

	                   if (lastName.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#lastNameVal').html("Please insert a last name!");
	                   }

	               });
	                      
	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#telephoneNumberForm').submit(function (e) {
	                   var telephoneNumber= jQuery.trim($('#telephoneNumber').val());

	                   if (telephoneNumber.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#telephoneNumberVal').html("Please insert a telephone number!");
	                   }

	               });
	               
	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#addressForm').submit(function (e) {
	               
	                   var address = jQuery.trim($('#address').val());

	                   if (address.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#addressVal').html("Please insert an address!");
	                   }
	               
	                   var city= jQuery.trim($('#city').val());

	                   if (city.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#cityVal').html("Please insert a city!");
	                   }
	                   
	                                   
	                   var postcode= jQuery.trim($('#postcode').val());

	                   if (postcode.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#postcodeVal').html("Please insert a postcode!");
	                   }
	                   
	                                   
	                   var country= jQuery.trim($('#country').val());

	                   if (country.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#countryVal').html("Please insert a country!");
	                   }
	  
	               });
	                      
	               });
	               

	</script>
</head>
<body>
	<!--- Navigation =-->
	<header id="navHeader">
		<nav class="navbar navbar-expand-md navbar-light sticky-top" id="navbar" style="background-color:#648CFF;">
			<div class="container-fluid">
				<a href="index.php">
				<h4 id="navTitle"><font color="white">TrainerPal: Health & Fitness</font></h4></a> <button class="navbar-toggler" data-target="#navbarResponsive" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="index.php"><font color="white">Home</font></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="workouts.php"><font color="white">Workouts</font></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="trainers.php"><font color="white">Trainers</font></a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="account.php"><font color="white">Account</font></a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="trainerAccount.php"><font color="white">Trainer Portal</font></a>
						</li><!--== LOG OUT BUTTON APPEARS IN THE NAV BAR WHEN USER IS LOGGED IN ==-->
						<?php if(isset($_SESSION['loggedSession'])) {
						            echo "
						                <li class = 'nav-item active'>
						                <a class = 'nav-link' href='logOut.php'><font color = 'white'>Log Out</font></a>
						            </li>";
						            
						            $selectQuery = "SELECT * FROM TrainerPal_Admins where userID = '$activeID'";
						                $result = $conn->query($selectQuery);
						                     if(!$result) {
						                     echo $conn -> error;
						                                    } 
						    
						                $num = $result -> num_rows;
						                
						                if ($num > 0) {
						                    echo "
						                <li class = 'nav-item active'>
						                <a class = 'nav-link' href='adminHome.php'><font color = 'white'>Admin</font></a>
						            </li>";
						                }
						            
						            }
						            ?>
					</ul>
				</div>
			</div>
		</nav>
	</header><!--- SECOND ACCOUNT NAVIGATION =--><!-- second fixed navbar-->
	<section id="accountNav">
		<ul class="nav justify-content-center">
			<li class="nav-item">
				<a class="nav-link" href="account.php"><font color="white">Account Details</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><font color="white">Messenger</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><font color="white">My Trainer</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><font color="white">My Workouts</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><font color="white">Payments</font></a>
			</li>
		</ul>
	</section><!--- DISPLAYS ACCOUNT INFORMATION AND HAS THE FORMS FOR EDITING DETAILS=--><?php   
	       
	       $read = "SELECT * FROM TrainerPal_User WHERE userID = '$activeID'";

	$result = $conn->query($read);       
	                while($row = $result->fetch_assoc() ){
	                  
	                  $profileImage = $row['profilePictureURL'];    
	                  $firstName = $row['firstName'];
	                  $lastName= $row['lastName'];
	                  $telephoneNumber = $row['telephoneNumber'];
	                  $email = $row['email'];
	                  $address= $row['address'];
	                  $city = $row['city'];
	                  $postcode = $row['postcode'];
	                  $country = $row['country'];
	                       
	                        echo "
	                        
	                        <div class = 'col-12' style = 'margin:auto; text-align:center; padding-top:30px;'>
	                       <h2>Edit Account Details</h2>
	                              
	                              <div class = 'col-12'> 
	                              <div align = 'center'>
	          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	          </div>
	                                              <h5 style = 'padding-top:15px;' >Profile Picture</h5>
	                <form class='subform' id='profilePic' action='processChangeProfilePic.php' method='post' enctype='multipart/form-data' onSubmit='return fileValid()'>
	                    <input type='file' id='file-input' name='finput' accept='.jpg, .jpeg, .png' required>
	                     <input class='button btn-primary'  id='profilePicSub' name='profilePicSubButton' type='submit' value='Change'>
	                </div>
	                              
	                              </form>
	                              
	                                 <h5 style = 'padding-top:15px;' >First Name: $firstName</h5>
	                                               <form class='subform' id='firstNameForm' action='processEditAccount.php' method='POST'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                     <font color = 'red'><div class='validation' id='firstNameVal'></div> </font>
	                    <input class='col-6' type='text' name='firstName' id='firstName' maxlength='50'>
	                     <input class='button btn-primary' id='firstNameSub' name='firstNameSubButton' type='submit' value='Change'>

	            </form>
	            
	                               <h5 style = 'padding-top:15px;'>Last Name: $lastName</h5>
	                                               <form class='subform' id='lastNameForm'  action='processEditAccount.php' method='POST'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'> <div class='validation' id='lastNameVal'></div> </font>
	                    <input class='col-6' type='text' name='lastName' id='lastName' maxlength='50'>
	                     <input class='button btn-primary' id='lastNameSub' name='lastNameSubButton' type='submit' value='Change'>
	                
	            </form>
	                                    
	                                       <h5 style = 'padding-top:15px;'>Telephone Number: $telephoneNumber</h5>
	                        
	                                    <form class='subform' id='telephoneNumberForm'  action='processEditAccount.php' method='POST'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                     <font color = 'red'><div class='validation' id='telephoneNumberVal'></div> </font>
	                    <input class='col-6' type='text' name='telephoneNumber' id='telephoneNumber' maxlength='50'>
	                      <input class='button btn-primary'  id='telephoneNumberSub' name='telephoneNumberSubButton' type='submit' value='Change'>
	                
	            </form>
	    
	    
	                    <h5 style = 'padding-top:15px;' >Address: $address, $city <br> $postcode, $country</h5>
	                    <form class='subform' id='addressForm'  action='processEditAccount.php' method='POST'>
	                    <div class='form-group'>

	                            <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='addressVal'></div></font>
	                    <input class='col-6' type='text' name='address' placeholder = 'address'id='address' maxlength='30' required>
	                </div>

	                <div class='form-group'>
	                               <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='cityVal'></div></font>
	                    <input class='col-6' type='text' name='city' placeholder = 'city'id='city' maxlength='30' required>
	                </div>
	                
	                <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='postcodeVal'></div></font>
	                    <input class='col-6' type='text' name='postcode' placeholder = 'postcode'id='postcode' maxlength='30' required>
	                </div>

	                <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='countryVal'></div></font>
	                    <input class='col-6' type='text' name='country' placeholder = 'country'id='country' maxlength='30' required>
	                </div>
	              <input class='button btn-primary' id='adressSub' name='addressSubButton' type='submit' value='Change Address'>
	            </form>
	         
	             </div>
	                 </div>                         
	                                ";                                              
	                }
	                 ?>
	<div class="col-12" style="margin:auto; text-align:center; padding-top:20px;">
		<p><a class='btn btn-primary' href='changePassword.php'>Change Password</a></p>
		<p><a class='btn btn-primary' href='changeEmail.php'>Change Email</a></p>
	</div><!--- Footer Section =-->
	<section id="footerSection">
		<div class="container-fluid padding">
			<div class="row text-center padding">
				<div class="col-12">
					<p><font color="white" size="2px;">TrainerPal: Health & Fitness<br>
					Copyright &copy; 2019</font></p>
				</div>
			</div>
		</div>
	</section>
</body>
</html>