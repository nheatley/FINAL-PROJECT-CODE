<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
}
include('connect.php');
include('browserCheck.php');
$activeID = $_SESSION['loggedSession'];

    unset($_SESSION['gymAddress']);
    unset($_SESSION['gymPostcode']);
    unset($_SESSION['gymCity']);
    unset($_SESSION['gymCountry']);

// QUERY TO CHECK THE ACCOUNT TYPE OF THE USER WHEN A USER IS ALREADY LOGGED IN ON THEIR BASIC ACCOUNT AND ATTEMPTS TO SWITCH OVER 
// TO THE TRAINER PORTAL ACCOUNT - IT SAVES THEM FROM LOGGING IN TWICE
$checkDetails= "SELECT * FROM TrainerPal_User WHERE userID= '$activeID'";

   $result = $conn->query($checkDetails);
    if(!$result) {
    echo $conn -> error;
    }
    
    while($row =$result -> fetch_assoc()) {
        
        $accountCheck = $row['accountType'];    
        if ($accountCheck == '1') {
        
        $_SESSION['loggedSession'] = $row['userID'];
        header("location: trainerLoginUpgradeError.php");
        }
        }

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
	               jQuery('#trainerBioForm').submit(function (e) {
	                   var trainerBio = jQuery.trim($('#trainerBio').val());

	                   if (trainerBio.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#trainerBioVal').html("Please insert a trainer bio!");
	                   }

	               });
	               
	               
	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#gymAddressForm').submit(function (e) {
	               
	                   var gymAddress = jQuery.trim($('#gymAddress').val());

	                   if (gymAddress.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#gymAddressVal').html("Please insert a gym address!");
	                   }
	               
	                   var gymCity= jQuery.trim($('#gymCity').val());

	                   if (gymCity.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#gymCityVal').html("Please insert a gym city!");
	                   }
	                   
	                                   
	                   var gymPostcode= jQuery.trim($('#gymPostcode').val());

	                   if (gymPostcode.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#gymPostcodeVal').html("Please insert a gym postcode!");
	                   }
	                   
	                                   
	                   var gymCountry= jQuery.trim($('#gymCountry').val());

	                   if (gymCountry.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#gymCountryVal').html("Please insert a gym country!");
	                   }
	  
	               });
	                      
	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#specialistAreasForm').submit(function (e) {
	                   var specialistAreas= jQuery.trim($('#specialistAreas').val());

	                   if (specialistAreas.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#specialistAreasVal').html("Please insert your specialist areas!");
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
				<h4 id="navTitle"><font color="white">TrainerPal: Health & Fitness</font></h4></a> <button class="navbar-toggler ml-auto" data-target="#navbarResponsive" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
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
				<a class="nav-link" href="trainerAccount.php"><font color="white">My Trainer Account Details</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><font color="white">Messenger</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><font color="white">Client Manager</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><font color="white">My Workouts</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><font color="white">Payment Manager</font></a>
			</li>
		</ul>
	</section><!--- DISPLAYS ACCOUNT INFORMATION AND HAS THE FORMS FOR EDITING DETAILS=--><?php   
	       
	       
	   $read = "SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_User.telephoneNumber, TrainerPal_User.profilePictureURL, TrainerPal_Trainer.gymName, 
	            TrainerPal_Trainer.trainerBio, TrainerPal_Trainer.specialistAreas, TrainerPal_Trainer.gymAddress, TrainerPal_Trainer.gymCity, TrainerPal_Trainer.gymPostcode, 
	            TrainerPal_Trainer.gymCountry FROM TrainerPal_User INNER JOIN TrainerPal_Trainer ON TrainerPal_User.userID = TrainerPal_Trainer.userID
	            WHERE TrainerPal_User.userID = '$activeID'";     
	                       

	        $result = $conn->query($read);       
	                while($row = $result->fetch_assoc() ){
	     
	                     $profileImage = $row['profilePictureURL'];
	                     $firstName = $row["firstName"];    
	                     $lastName = $row["lastName"];
	                     $telephoneNumber =$row["telephoneNumber"];
	                     $gymName = $row["gymName"];
	                     $trainerBio= $row["trainerBio"];
	                     $specialistAreas = $row['specialistAreas'];
	                     $gymAddress = $row["gymAddress"];
	                     $gymCity= $row["gymCity"];
	                     $gymPostcode = $row["gymPostcode"];
	                     $gymCountry= $row["gymCountry"];
	                       
	                        echo "
	                        
	                        <div class = 'col-12' style = 'margin:auto; text-align:center; padding-top:30px;'>
	                       <h2>Edit Trainer Account Details</h2>
	                              
	                              <div class = 'col-12'>
	                              
	                             <div align = 'center'>
	          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	          </div>
	                             <h5 style = 'padding-top:15px;' >$firstName $lastName</h5>
	                             <h5 style = 'padding-top:15px;' >$telephoneNumber</h5>
	                             
	                          <h5 style = 'padding-top:15px;' >Trainer Bio: $trainerBio</h5>
	                    <form class='subform' id='trainerBioForm'  action='processEditTrainerAccount.php' method='POST'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'> <div class='validation' id='trainerBioVal'></div> </font>
	                    <input class='col-6' type='text' name='trainerBio' id='trainerBio' maxlength='200'>
	                    <input class='button btn-primary' id='trainerBioSub' name='trainerBioSubButton' type='submit' value='Change'>
	                
	            </form>       
	            
	                         <h5 style = 'padding-top:15px;' >Specialist Areas: $specialistAreas</h5>
	                    <form class='subform' id='specialistAreasForm'  action='processEditTrainerAccount.php' method='POST'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'> <div class='validation' id='specialistAreasVal'></div> </font>
	                    <input class='col-6' type='text' name='specialistAreas' id='specialistAreas' maxlength='50'>
	                    <input class='button btn-primary' id='specialistAreasSub' name='specialistAreasSubButton' type='submit' value='Change'>
	                
	            </form>  
	    
	                    <h5 style = 'padding-top:15px;' >Gym Address: $gymAddress, $gymCity <br> $gymPostcode, $gymCountry</h5>
	                    <form class='subform' id='gymAddressForm'  action='preProcessEditTrainerAccount.php' method='POST'>
	                    <div class='form-group'>";
	                    
	                   if(isset($_SESSION['errorShow'])) {
	                   echo "<h3> <font color = 'red'> That last location you entered is invalid. Please make sure you enter correct location details. </font> </h3>";
	                   }

	                           echo " <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='gymAddressVal'></div></font>
	                    <input class='col-6' type='text' name='gymAddress' placeholder = 'gym address'id='gymAddress' maxlength='100' required>
	                </div>

	                <div class='form-group'>
	                               <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='gymCityVal'></div></font>
	                    <input class='col-6' type='text' name='gymCity' placeholder = 'gym city'id='gymCity' maxlength='30' required>
	                </div>
	                
	                <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='gymPostcodeVal'></div></font>
	                    <input class='col-6' type='text' name='gymPostcode' placeholder = 'gym postcode'id='gymPostcode' maxlength='30' required>
	                </div>

	                <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='gymCountryVal'></div></font>
	                    <input class='col-6' type='text' name='gymCountry' placeholder = 'gym country'id='gymCountry' maxlength='50' required>
	                </div>
	              <input class='button btn-primary' id='gymAdressSub' name='gymAddressSubButton' type='submit' value='Change Address'>
	            </form>
	         
	             </div>
	                 </div>                         
	                                ";                                              
	                }
	                 ?>
	<div class="col-12" style="margin:auto; text-align:center; padding-top:20px;">
		<p><a class='btn btn-primary' href='trainerAccount.php'>Back to Trainer Account</a></p>
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