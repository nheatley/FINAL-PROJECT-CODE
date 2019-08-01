<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
} 
include('connect.php');
include('browserCheck.php');
unset($_SESSION['errorShow']);

$activeID = $_SESSION['loggedSession'];

// QUERY TO CHECK THE ACCOUNT TYPE OF THE USER WHEN A USER IS ALREADY LOGGED IN ON THEIR BASIC ACCOUNT AND THEY ATTEMPT TO SWITCH OVER 
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
				<a class="nav-link" href="messengerHome.php"><font color="white">Messenger</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clientManagerHome.php"><font color="white">Client Manager</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clientTrainerWorkouts.php"><font color="white">Client/Trainer Workouts</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="paymentsHome.php"><font color="white">Payment Manager</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">Trainer Account Details</h2>
	</div><?php 
	 
	  /// INNER JOIN QUERY TO GET DETAILS OF THE TRAINER ACCOUNT

	   $read = "SELECT TrainerPal_User.firstName, TrainerPal_Trainer.verified, TrainerPal_User.lastName,
	            TrainerPal_User.telephoneNumber, TrainerPal_User.profilePictureURL, TrainerPal_Trainer.gymName, 
	            TrainerPal_Trainer.trainerBio, TrainerPal_Trainer.specialistAreas, TrainerPal_Trainer.gymAddress, TrainerPal_Trainer.gymCity, TrainerPal_Trainer.gymPostcode, 
	            TrainerPal_Trainer.gymCountry FROM TrainerPal_User INNER JOIN TrainerPal_Trainer ON TrainerPal_User.userID = TrainerPal_Trainer.userID
	            WHERE TrainerPal_User.userID = '$activeID'";     
	                       
	     $result = $conn->query($read);
	      if(!$result){
	         echo "did not work";    
	        }
	  
	  while($row=$result->fetch_assoc()){

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
	  $verified = $row["verified"];
	  
	   echo 
	  
	  "
	      <div class = 'col-12'>
	               <div align = 'center'>
	          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	          </div>
	           <div class = 'col-12' style='width:800px; margin:0 auto;'>
	           <div align = 'center'>
	            <p style = 'padding-top:10px'>Name: $firstName $lastName</p>
	            <p>Trainer Bio: $trainerBio</p> 
	            <p>Specialist Areas: $specialistAreas</p>
	            <p>Telephone Number: $telephoneNumber</p>
	            <p>Gym Address: <br>$gymAddress,<br> $gymCity, $gymPostcode, <br>$gymCountry </p>
	      <p><a href='editTrainerDetails.php' class='btn btn-primary'>Edit Trainer Account Details</a></p>
	     "
	     ;
	         
	       // CHECKS TO SEE IF THE ACCOUNT IS VERIFIED OR NOT
	          
	      if($verified =='1') {
	      
	      // QUERY TO CHECK IF THERE IS A VERIFICATION REQUEST THAT STILL NEEDS RESPONDED TO
	       $check = "SELECT * FROM TrainerPal_Verifications WHERE userID = '$activeID' AND adminResponded = '1'";
	       
	      $result2 = $conn->query($check);
	      if(!$result2){
	         echo "did not work";    
	        }
	        
	      $num = $result2 -> num_rows;
	      
	      if($num > 0) {
	      echo "<h5 style = 'padding-bottom:15px' ><font color = 'blue'>Please wait for the Admins to respond to your Verification Request.</font></h5>";
	      }
	      else {
	      echo " 
	      <p><a href='verifyTrainerAccount.php' class='btn btn-success'>Verify your Trainer Account.</a> </p>
	      ";
	      }
	      }
	      else {
	      echo
	       "  <div align = 'center'>
	          <img style = 'max-width: 100px' src='img/verification.jpg' class='rounded-circle'>
	          </div> ";
	      }  
	}
	  ?>
	  </div>
	  </div>
	  </div>
	  <!--- Footer Section =-->
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