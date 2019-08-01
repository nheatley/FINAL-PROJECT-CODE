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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script>

	           jQuery(document).ready(function () {

	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#sendMessageForm').submit(function (e) {

	                   var sendMessage = jQuery.trim($('#sendMessage').val());

	                   if (sendMessage.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#sendMessageVal').html("Please insert some text!");
	                   }
	                   
	                   var subject = jQuery.trim($('#subject').val());

	                   if (subject.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#subjectVal').html("Please give this message a subject!");
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
				<a class="nav-link" href="messengerHome.php"><font color="white">Messenger</font></a>
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
	</section><?php 
	 
	  $userID = htmlentities($_GET['userID']);

	  $userID= base64_decode($userID);
	  
	  $userID = ($userID/$_SESSION['random']);
	  
	  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
	  $result = $conn->query("SELECT * FROM TrainerPal_User WHERE userID = '$userID' ");
	  
	  $num = $result -> num_rows;
	    
	  while($row=$result->fetch_assoc()){

	  $profileImage = $row['profilePictureURL'];    
	  $firstName = $row["firstName"];
	  $lastName= $row["lastName"];
	  $userID = $row["userID"];
	  

	  //MULTIPLIES TO A RANDOM VALUE
	  $userID = ($userID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $userID= base64_encode($userID);
	  
	   echo 
	  "
	     <div style = 'padding-top:20px'>
	<h4 align='center'>Send a Message to $firstName</h4>
	</div>
	      <div class = 'col-12'>
	         <div align = 'center'>
	          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	          </div>
	      </div>
	          
	<!------------- SEND MESSAGE FORM------------!>
	<div class = 'col-12' style = 'margin:auto; text-align:center; padding-top:30px; padding-bottom:20px;'>
	       <form class='subform' id='sendMessageForm' action='processContactTrainer.php?userID=$userID' method='POST'>
	                    <div class='form-group'>
	                             <!-- DISPLAYS VALIDATION MESSAGE -->
	                     <font color = 'red'><div class='validation' id='subjectVal'></div> </font>
	                    <input class='col-6' type='text' name='subject' id='subject' placeholder = 'Subject...' maxlength='50' required>
	                    </div>

	                <div class='form-group'>
	                                  <!-- DISPLAYS VALIDATION MESSAGE -->
	                     <font color = 'red'><div class='validation' id='sendMessageVal'></div> </font>
	                    <input class='col-6' type='text' name='sendMessage' id='sendMessage' placeholder = 'message...' maxlength='300' required>
	                </div>
	               <input class='button btn-success u-full-width' id='sendMessageSub' name='sendMessageSubButton' type='submit' value='Send Message'>
	            </form>
	            </div>
	            </div>";
	            
	            }
	       ?><!--- Footer Section =-->
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