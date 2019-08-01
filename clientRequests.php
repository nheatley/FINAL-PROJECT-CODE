<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
} 
include('connect.php');
include('browserCheck.php');
include('trainerChecker.php');
$activeID = $_SESSION['loggedSession'];

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
				<a class="nav-link" href="clientManagerHome.php"><font color="white">Client Manager</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="messengerHome.php"><font color="white">Messenger</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clientRequests.php"><font color="white">Client Requests</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="paymentsHome.php"><font color="white">Payment Manager</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">Client Requests</h2>
	</div><?php 
	 
	  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
	$result = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_User.email, TrainerPal_User.lastName, TrainerPal_User.profilePictureURL, TrainerPal_User.telephoneNumber,
	                          TrainerPal_TrainerRequests.message, TrainerPal_TrainerRequests.client,  TrainerPal_TrainerRequests.trainerRequestID FROM TrainerPal_User INNER JOIN TrainerPal_TrainerRequests 
	                          ON TrainerPal_User.userID = TrainerPal_TrainerRequests.client WHERE TrainerPal_TrainerRequests.trainerRequestResponse = '1' AND TrainerPal_TrainerRequests.trainer = '$activeID'
	                          ORDER BY TrainerPal_TrainerRequests.trainerRequestID DESC");
	  
	    if(!$result) {
	    echo "did not work";
	    }
	  
	$num = $result-> num_rows;

	if ($num == 0) {  
	 echo "  <div align ='center' style = 'padding-top:10px;'>
	 <font color = 'red'> <h2 align='center'>You have no client requests at the moment!</h2></font>
	 </div>";
	 }
	 
	  while($row=$result->fetch_assoc()){

	  $profileImage = $row['profilePictureURL'];    
	  $firstName = $row["firstName"];
	  $lastName= $row["lastName"];
	  $message =  $row["message"];
	  $telephoneNumber =  $row["telephoneNumber"];
	  $email =  $row["email"];
	  
	  // THE TWO VALUES I SHALL USE FOR THE HTML ENTITIES CODE
	  $trainerRequestID = $row["trainerRequestID"];
	  
	  //MULTIPLIES TO A RANDOM VALUE
	  $trainerRequestID = ($trainerRequestID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $trainerRequestID= base64_encode($trainerRequestID);
	  
	  $clientID = $row["client"];
	  
	  //MULTIPLIES TO A RANDOM VALUE
	  $clientID = ($clientID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $clientID= base64_encode($clientID);
	  
	   echo 
	   "
	   <div align = 'center' class='media' style = 'padding-top:20px; border-bottom: gray 2px solid;'>
	  <div class='media-body'>
	      <img style = 'max-width: 100px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	    <h3 class='mt-0'>Request from $firstName $lastName</h3>
	    <h4>$telephoneNumber</h4>
	      <h5>$email</h5>
	     <h5>$message</h5>
	        <a class='btn btn-success' href='acceptTrainerRequest.php?clientID=$clientID' role='button'>Accept</a>
	     <p style = 'padding-top:10px;'><a class='btn btn-danger' href='denyTrainerRequest.php?trainerRequestID=$trainerRequestID'' role='button'>Deny Request</a></p>
	  </div>
	</div>";    
	     
	}
	  ?>
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