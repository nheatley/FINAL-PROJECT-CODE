<?php
session_start();
$userID = $_SESSION['loggedSession'];
if(!isset($_SESSION['loggedSession'])) {
header("location: trainerLogin.php");
}
    unset($_SESSION['gymName']);
    unset($_SESSION['trainerBio']);
    unset($_SESSION['specialistAreas']);
    unset($_SESSION['gymAddress']);
    unset($_SESSION['gymPostcode']);
    unset($_SESSION['gymCity']);
    unset($_SESSION['gymCountry']);

include('connect.php');
include('browserCheck.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Niall Heatley 40128349">
	<title> TrainerPal: Health & Fitness </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"</script>
	<script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
	<link rel = "stylesheet" href="css/style.css">  
	
<!-- require Google Maps API -->
<script src="//maps.googleapis.com/maps/api/js"></script>
</head>
<body>
         
     
     
         <!---- SCRIPTS TO HAVE CHECK ON ALL REGISTRATION FORM DATA ENTERIES ---->
    
   <script> 
   
            																																														            
            jQuery(document).ready(function () {
                jQuery('form').submit(function (e) {
                
                
                var gymName = jQuery.trim($('#gymName').val());

                    /**
                     * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
                     */
                    if (gymName.length <= 0) {
                        e.preventDefault();
                        jQuery('#gymNameVal').html("You must insert a gym name!");
                    }
                
                var trainerBio = jQuery.trim($('#trainerBio').val());

                    /**
                     * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
                     */
                    if (trainerBio.length <= 0) {
                        e.preventDefault();
                        jQuery('#trainerBioVal').html("Please insert a short bio about yourself as a trainer.");
                    }
                    
                                    
                var specialistAreas = jQuery.trim($('#specialistAreas').val());

                    /**
                     * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
                     */
                    if (specialistAreas.length <= 0) {
                        e.preventDefault();
                        jQuery('#specialistAreasVal').html("Please insert your ares of expertise.");
                    }

                    var gymAddress = jQuery.trim($('#gymAddress').val());

                    /**
                     * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
                     */
                    if (gymAddress.length <= 0) {
                        e.preventDefault();
                        jQuery('#gymAddressVal').html("Please insert an address for your gym!");
                    }

                    var gymCity = jQuery.trim($('#gymCity').val());

                    /**
                     * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
                     */
                    if (gymCity.length <= 0) {
                        e.preventDefault();
                        jQuery('#gymCityVal').html("Please insert the city your gym is in!");
                    }

                    var gymCountry = jQuery.trim($('#gymCountry').val());

                    /**
                     * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
                     */
                    if (gymCountry.length <= 0) {
                        e.preventDefault();
                        jQuery('#gymCountryVal').html("Please insert the country your gym is in!");
                    }

                    var gymPostcode = jQuery.trim($('#gymPostcode').val());

                    /**
                     * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
                     */
                    if (gymPostcode.length <= 0) {
                        e.preventDefault();
                        jQuery('#gymPostcodeVal').html("Please insert your gym's postcode!");
                    }
                });

            });
</script>

<!--- Navigation --->
<header id = "navHeader">
<nav id = "navbar" class = "navbar navbar-expand-md navbar-light sticky-top" style ="background-color:#648CFF;">
<div class = "container-fluid">
	<a href = "index.php" > <h4 id= "navTitle"><font color = "white">TrainerPal: Health & Fitness</font></h4> </a>
	<button class = "navbar-toggler" type = "button" data-toggle="collapse" data-target="#navbarResponsive">
	<span class = "navbar-toggler-icon"></span>
	</button>
	<div class ="collapse navbar-collapse" id = "navbarResponsive">
		<ul class = "navbar-nav ml-auto">
			<li class = "nav-item active">
				<a class = "nav-link" href="index.php"><font color = "white">Home</font></a>
			</li>
			<li class = "nav-item">
				<a class = "nav-link" href="workouts.php"><font color = "white">Workouts</font></a>
			</li>
			</li>
			<li class = "nav-item">
				<a class = "nav-link" href="trainers.php"><font color = "white">Trainers</font></a>
			</li>
			<li class = "nav-item active">
				<a class = "nav-link" href="account.php"><font color = "white">Account</font></a>
			</li>
			
			<li class = "nav-item active">
				<a class = "nav-link" href="trainerAccount.php"><font color = "white">Trainer Portal</font></a>
			</li>
			
			<!---- LOG OUT BUTTON APPEARS IN THE NAV BAR WHEN USER IS LOGGED IN ---->
			
			<?php if(isset($_SESSION['loggedSession'])) {
			echo "
				<li class = 'nav-item active'>
				<a class = 'nav-link' href='logOut.php'><font color = 'white'>Log Out</font></a>
			</li>";
			
			$selectQuery = "SELECT * FROM TrainerPal_Admins where userID = '$userID'";
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
</nav>
</header>
  <!----- Registration Form ----->
      
       <div id = "regDiv" class = "col-8">
			<h3 id = "signUpTitle">Trainer Registration </h3>
            <!-- SIGN UP FORM -->
            <form class = "signUpForm" action="preProcessTrainerRegister.php" method="post" enctype="multipart/form-data" onSubmit='return fileValid()'>
                 
             <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                   <font color = 'red'> <div class='notAvailable' id="gymNameVal"></div></font>
                      <input class="form-control" type="text" name='gymName' placeholder = "gym name" id='gymName' maxlength='50' required>
                </div>


                <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                    <font color = 'red'><div class='notAvailable' id="trainerBioVal"></div> </font>
                      <input class="form-control" type="text" name='trainerBio' placeholder = "Short Trainer Bio" id='trainerBio' maxlength='50' required>
                </div>
 
                <div class="form-group">

                    <!-- DISPLAYS VALIDATION MESSAGE -->
                   <font color = 'red'> <div class='notAvailable' id="specialistAreasVal"></div></font>
                      <input class="form-control" type="text" name='specialistAreas' placeholder = "your areas of expertise" id='specialistAreas' maxlength='50' required> 
                </div>
						
                <div class="form-group">

                    <!-- DISPLAYS VALIDATION MESSAGE -->
                   <font color = 'red'> <div class='notAvailable' id="gymAddressVal"></div></font>
                    <h4> <font color = 'red'>The address credentials you have entered do not exist according to Google Maps.<br> Please insert correct Credentials.<h4></font>
                      <input class="form-control" type="text" name = 'gymAddress' id="gymAddress"  placeholder = "gym address" required />
                </div>

                <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                   <font color = 'red'> <div class='notAvailable' id="gymCityVal"></div></font>
                    <input class="form-control" type="text" name='gymCity' id='gymCity' placeholder = "gym city" maxlength='50'   required>
                </div>


                <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                    <font color = 'red'><div class='notAvailable' id="gymPostcodeVal"></div></font>
                    <input class="form-control" type="text" name='gymPostcode' placeholder = "gym postcode"id='gymPostcode' maxlength='30' required>
                </div>

                <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                  <font color = 'red'>  <div class='notAvailable' id="gymCountryVal"></div> </font>
                     <input class="form-control"type="text" name='gymCountry' placeholder = "gymCountry"id='gymCountry' maxlength='50'   required>
                </div>
      
                <!-- SUBMISSION BUTTON FOR THIS FORM -->
                <input class="button btn-primary u-full-width" id="signUp" name='subButton' type="submit" value="Register">

            </form>
        </div>

	          <!--- Footer Section --->    
     
<section id="footerSection">
<div class = "container-fluid padding">
<div class="row text-center padding">
	<div class = "col-12">
		<p><font color="white" size="2px;">TrainerPal: Health & Fitness <br> Copyright &copy; 2019</font></p>
		</div>
	
	</section>
</body>

</html>