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

	  
	           jQuery(document).ready(function () {
	               jQuery('form').submit(function (e) {
	                   /**
	                    * VALIDATES PASSWORD ENTRY
	                    * CHECKS LENGTH REQUIREMENT OF 8 CHARS
	                    * CHECKS FOR CAPITAL LETTER
	                    * CHECKS FOR LOWERCASE LETTER
	                    * CHECKS FOR NUMBER
	                    * AND ENSURES PASSWORD IS SAME AS CONFIRMATION
	                    * @type type
	                    */
	                   var password = jQuery.trim($('#password').val());

	                   if (password.length < 8 || !password.match(/[A-z]/) || !password.match(/[A-Z]/) || !password.match(/\d/)) {
	                       e.preventDefault();
	                       jQuery('#passwordVal').html("A secure new password must be at least 8 characters, contain one uppercase letter, contain a lowercase letter and one number!");
	                   }

	                   var confirmPassword = jQuery.trim($('#confirmPassword').val());

	                   if (confirmPassword !== password) {
	                       e.preventDefault();
	                       jQuery('#confirmPasswordVal').html("Passwords do not match! Please Re-enter your new password.");
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
		<h3 id="signUpTitle">Enter Your New Password</h3><!-- SIGN UP FORM -->
		<form action="insertChangedPassword.php" class="signUpForm" method="post">
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color="red"></font>
				<div class='notAvailable' id="passwordVal">
					<font color="red"></font>
				</div><input class="form-control" id='password' maxlength='50' name='password' placeholder="New password" required="" type="password">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color="red"></font>
				<div class='notAvailable' id="confirmPasswordVal">
					<font color="red"></font>
				</div><input class="form-control" id='confirmPassword' maxlength='50' name='confirmPassword' placeholder="Confirm new password" required="" type="password">
			</div><!-- SUBMISSION BUTTON FOR THIS FORM -->
			<input class="button btn-primary u-full-width" id="changePassword" name='passwordChange' type="submit" value="Change Password">
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