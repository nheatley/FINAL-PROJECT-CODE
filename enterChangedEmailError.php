<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
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
	<!--== SCRIPTS TO HAVE CHECK THE RESET PASSWORD FORM DATA ENTERIES ==-->
	<script>

	  
	          /**
	            * LIVE CHECKS THE EMAIL AGAINST OTHERS ALREADY IN THE DATABASE
	            * 
	            */
	           function checkEmail() {

	               var email = $("#email").val();
	               jQuery.ajax({
	                   url: "check.php",
	                   data: {
	                       email: email
	                   },
	                   type: "POST",
	                   success: function (data) {
	                       $("#emailAvailabilityFeedback").html(data);
	                   }
	               });
	           }
	           
	  
	           jQuery(document).ready(function () {
	               jQuery('form').submit(function (e) {
	               
	               /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    * AND ENSURE USER CANT SUBMIT A EMAIL THEY HAVE BEEN TOLD IS
	                    * NOT ALLOWED
	                    * ALSO ENSURES EMAIL AND CONFIRMATION MATCH
	                    */
	                   var email = jQuery.trim($('#email').val());

	                   if (email.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#emailVal').html("Please insert an email");
	                   }

	                   if ($('#emailAvailabilityFeedback').text() === ' This email is already registered with this site. Please Login or try a different email!') {
	                       e.preventDefault();

	                   }

	                   var confirmEmail = jQuery.trim($('#confirmEmail').val());

	                   if (confirmEmail !== email) {
	                       e.preventDefault();
	                       jQuery('#confirmEmailVal').html("Emails do not match!");
	                   }

	  
	                    });
	           });
	</script> <!--- Navigation =-->
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
	</header><!--=== RESET PASSWORD FORM ===-->
	<div class="col-8" id="regDiv">
		<h3 id="signUpTitle">Enter your new Email Address.</h3><font color='red'></font>
		<h5 id="signUpTitle"><font color='red'>You have attempted to change your email to an email address that is already registered with us! Please enter another email.</font></h5><!-- SIGN UP FORM -->
		<form action="insertChangedEmail.php" class="signUpForm" method="post">
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				<div class='notAvailable' id="emailVal"></div><!-- EMAIL INPUT ACCESSES CHECKEMAIL() WHEN TYPED IN -->
				<input class="form-control" id='email' maxlength='40' name='email' onblur="checkEmail()" placeholder="email" required="" title="Please provide only a valid email." type="email"> <!-- DISPLAYS LIVE CHECK FEEDBACK -->
				<p id="emailAvailabilityFeedback"></p>
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color="red"></font>
				<div class='notAvailable' id="confirmEmailVal">
					<font color="red"></font>
				</div><input class="form-control" id='confirmEmail' maxlength='40' name='confirmEmail' placeholder="confirm email" required="" type="email">
			</div><!-- SUBMISSION BUTTON FOR THIS FORM -->
			<input class="button btn-primary u-full-width" id="changeEmail" name='emailChange' type="submit" value="Change Email">
		</form>
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