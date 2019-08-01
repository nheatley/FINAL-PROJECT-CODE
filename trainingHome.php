<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
} 
include('connect.php');
include('browserCheck.php');
$activeID = $_SESSION['loggedSession'];

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
				<a class="nav-link" href="trainingHome.php"><font color="white">Training Home</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="workouts.php"><font color="white">All workouts</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="trainers.php"><font color="white">Search Trainers</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clientTrainerRequests.php"><font color="white">Trainer Requests</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="workoutsFromTrainer.php"><font color="white">Workouts From Trainer</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">My Training</h2>
	</div><?php 
	 
	  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
	  $result = $conn->query("SELECT * FROM TrainerPal_User WHERE userID = '$activeID' ");
	  
	    if(!$result) {
	    echo "did not work";
	    }
	  
	  while($row=$result->fetch_assoc()){

	  $profileImage = $row['profilePictureURL'];    
	  $firstName = $row["firstName"];
	  $lastName= $row["lastName"];
	  
	   echo 
	  "
	      <div class = 'col-12' style ='border-bottom: gray 3px solid;'>
	        <div align = 'center'>
	          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	          </div>
	          <font color = 'green'> <h4 align = 'center'>Hello $firstName, below is the Trainer/Trainers <br> you are registered with.</h4></font>
	      </div>";         
	}
	?><?php

	  /// QUERY TO GET DETAILS OF YOUR TRAINER
	  $resultA = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_User.userID, TrainerPal_User.lastName, TrainerPal_User.profilePictureURL, TrainerPal_User.telephoneNumber, TrainerPal_User.email, TrainerPal_User.profilePictureURL,
	                           TrainerPal_Trainer.gymName, TrainerPal_Trainer.trainerBio, TrainerPal_Trainer.specialistAreas, TrainerPal_Trainer.gymAddress, TrainerPal_Trainer.gymCity, TrainerPal_Trainer.gymPostcode, TrainerPal_Trainer.gymCountry,
	                           TrainerPal_TrainerClients.client, TrainerPal_TrainerClients.trainer
	                           FROM TrainerPal_User INNER JOIN TrainerPal_Trainer ON TrainerPal_User.userID = TrainerPal_Trainer.userID 
	                           INNER JOIN TrainerPal_TrainerClients ON TrainerPal_Trainer.userID = TrainerPal_TrainerClients.trainer WHERE TrainerPal_TrainerClients.client = '$activeID'");
	  
	    if(!$resultA) {
	    echo "did not work";
	    }
	       $num = $resultA -> num_rows;

	if ($num == 0) {  
	 echo " <font color = 'red'> <h2 style='padding-top:10px' align='center'>You are not yet registered with a Trainer. </h2></font>
	 <div align ='center' style = 'padding-bottom:10px;'>
	 <a class='btn btn-warning' href='trainers.php' role='button'>Search Trainers</a>
	 </div>";
	 } else {
	 echo " <div class='card-group'>";
	 
	 }
	  
	  while($row=$resultA->fetch_assoc()){

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
	  $email =  $row["email"];
	  
	  $userID =  $row["userID"]; 
	  
	  //MULTIPLIES TO A RANDOM VALUE
	  $userID = ($userID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $userID= base64_encode($userID); 
	  
	  echo "

	  <div class='card'>
	    <div align = 'center'>
	          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	           <img style = 'max-width: 50px' src='img/verification.jpg' class='rounded-circle'>
	          </div>
	    <div align = 'center' class='card-body'>
	      <h3 class='card-title'>$firstName $lastName</h3>
	        <h5 class='card-title'>Telephone Number: $telephoneNumber</h5>
	             <h5 class='card-title'>Email: $email</h5>
	      <p class='card-text'>Specialist Areas: $specialistAreas </p>
	      <p class='card-text'>Bio: $trainerBio </p>
	      <p class='card-text'>Gym: $gymName</p>
	         <p class='card-text'>Address: $gymAddress, $gymCity <br> $gymPostcode, $gymCountry</p>
	      <p class='card-text'></p>
	        <div style = 'padding-top:10px'>
	      <a class='btn btn-primary' href='contactTrainer.php?userID=$userID' role='button'>Contact $firstName</a> 
	      </div>
	      <div style = 'padding-top:10px'>
	      <a class='btn btn-warning' href='sendReport.php?userID=$userID' role='button'>Send $firstName Progress Report</a>
	      </div>
	        <div style = 'padding-top:10px'>
	       <a class='btn btn-danger' href='removeTrainer.php?userID=$userID' role='button'>Remove as your Trainer</a>
	</div>
	    </div>
	  </div>
	  ";


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