<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
header("location: trainerLogin.php");
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
	<link href="css/style.css" rel="stylesheet"><!-- require Google Maps API -->

	<script src="//maps.googleapis.com/maps/api/js">
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
	</header><?php


	   // TO HAVE REFERENCE OF A WORKING JSON AS EXAMPLE TO GET DATA FROM
	   // https://maps.googleapis.com/maps/api/place/textsearch/json?query=Belfast+BT15%205EA&key=AIzaSyC2VirUwP1W5dqK0_-ZuFsdNnfttUTjUZo
	   
	    /*
	     * PROCESSES POSTS OF ALL INPUTS AND GETS THEM READY FOR SQL ENTRY
	     */
	    $gymName = $conn->real_escape_string($_POST['gymName']);
	    $trainerBio = $conn->real_escape_string($_POST['trainerBio']);
	    $specialistAreas = $conn->real_escape_string($_POST['specialistAreas']);

	    $gymAddress = $conn->real_escape_string($_POST['gymAddress']);
	    $gymPostcode = $conn->real_escape_string($_POST['gymPostcode']);
	    $gymCity = $conn->real_escape_string($_POST['gymCity']);
	    $gymCountry = $conn->real_escape_string($_POST['gymCountry']);   
	    
	        // SETTING THE INPUTS AS SESSION VARIABLES
	    $_SESSION['gymName'] = $gymName;
	    $_SESSION['trainerBio'] = $trainerBio;
	    $_SESSION['specialistAreas'] = $specialistAreas;
	    $_SESSION['gymAddress'] = $gymAddress;
	    $_SESSION['gymPostcode'] = $gymPostcode;
	    $_SESSION['gymCity'] = $gymCity;
	    $_SESSION['gymCountry'] = $gymCountry;
	    
	    $gymAddressNew = str_replace(" ","+",$gymAddress);
	    $gymCityNew = str_replace(" ","+",$gymCity);
	    $gymPostcodeNew = str_replace(" ","+",$gymPostcode);
	    
	    $address = $gymAddressNew;
	    $city = $gymCityNew;
	    $postcode = $gymPostcodeNew;
	    
	    $homepage = file_get_contents("https://maps.googleapis.com/maps/api/place/textsearch/json?query=$address+$city+$postcode+/&key=AIzaSyC2VirUwP1W5dqK0_-ZuFsdNnfttUTjUZo");
	   
	    $data = json_decode($homepage);  
	        
	    //echo  $data->status;
	       
	    $statusCheck = $data->status;
	    
	    if($statusCheck == "OK") {
	    
	    echo "
	    <div align = 'center' style = 'padding-top:10px'>
	    <h3> Is this the map location you expected? </h3>
	    <iframe width='300' height='400' id='gmap_canvas' src='https://maps.google.com/maps?q=$gymAddress%20$gymCity&t=&z=13&ie=UTF8&iwloc=&output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'></iframe><a href='https://www.vpnchief.com'></a></div>
	   <div align = 'center' style = 'padding-bottom:10px;' >
	   </iframe>
	   <div align = 'center' style = 'padding-top:10px'>
	<a class='btn btn-success btn-lg' href='processTrainerRegister.php' name = 'noButton' role='button'><font color = 'white'>Yes, this is the one</font></a>
	         </div>
	<div align = 'center' style = 'padding-top:10px'>
	<a class='btn btn-warning btn-lg' href='trainerRegister.php' name = 'noButton' role='button'>No, this is wrong.</a>
	         </div>
	   </div>";

	    }
	    if($statusCheck == "ZERO_RESULTS") {
	    echo "not worked";
	    header('location: trainerRegisterMapError.php');
	    }
	    
	?><!--- Footer Section =-->
	<section id="footerSection">
		<div class='u-full-width'>
			<div class="container-fluid padding">
				<div class="row text-center padding">
					<div class="col-12">
						<p><font color="white" size="2px;">TrainerPal: Health & Fitness<br>
						Copyright &copy; 2019</font></p>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>