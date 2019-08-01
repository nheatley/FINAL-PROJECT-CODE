<?php
session_start();
if(isset($_SESSION['loggedSession'])) {
 header("location: account.php");
 
}
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
</head>
<body>
	<!--== SCRIPTS TO HAVE CHECK ON ALL REGISTRATION FORM DATA ENTERIES ==-->
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
	               
	               
	               var firstName = jQuery.trim($('#firstName').val());

	                   /**
	                    * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (firstName.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#firstNameVal').html("You must insert a first name!");
	                   }
	               
	               var lastName = jQuery.trim($('#lastName').val());

	                   /**
	                    * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (lastName.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#lastNameVal').html("You must insert a last name!");
	                   }
	                   
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
	                       jQuery('#passwordVal').html("A secure password must be at least 8 characters, contain one uppercase letter, contain a lowercase letter and one number!");
	                   }

	                   var confirmPassword = jQuery.trim($('#confirmPassword').val());

	                   if (confirmPassword !== password) {
	                       e.preventDefault();
	                       jQuery('#confirmPasswordVal').html("Passwords do not match! Please Re-enter your password.");
	                   }
	                   
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

	                    var securityQuestionAnswer = jQuery.trim($('#securityQuestionAnswer').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (securityQuestionAnswer.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#securityQuestionAnswerVal').html("Please insert a security question answer!");
	                   }


	                   var address = jQuery.trim($('#address').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (address.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#addressVal').html("Please insert an address!");
	                   }

	                   var city = jQuery.trim($('#city').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (city.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#cityVal').html("Please insert a city!");
	                   }

	                   var country = jQuery.trim($('#country').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (country.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#countryVal').html("Please insert a country!");
	                   }

	                   var postcode = jQuery.trim($('#postcode').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (postcode.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#postcodeVal').html("Please insert a postcode!");
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
						</li><?php if(!isset($_SESSION['loggedSession'])) {
						                echo "
						                <li class = 'nav-item active'>
						                <a class = 'nav-link' href='login.php'><font color = 'white'>Login</font></a>
						            </li>";
						            }
						            else {
						            echo"
						            <li class = 'nav-item active'>
						                <a class = 'nav-link' href='account.php'><font color = 'white'>Account</font></a>
						            </li>";
						            }
						            
						            ?>
						<li class="nav-item active">
							<a class="nav-link" href="trainerAccount.php"><font color="white">Trainer Portal</font></a>
						</li><!--== LOG OUT BUTTON APPEARS IN THE NAV BAR WHEN USER IS LOGGED IN ==-->
						<?php if(isset($_SESSION['loggedSession'])) {
						            
						            $activeID = $_SESSION['loggedSession']; 
						            
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
	</header><!--=== Registration Form ===-->
	<div class="col-8" id="regDiv">
		<h3 id="signUpTitle">TrainerPal Sign Up</h3>
		<h5><font color="red">You have attempted to register with an email address already within the system! Please use another email address.</font></h5><!-- SIGN UP FORM -->
		<form action="processRegister.php" class="signUpForm" enctype="multipart/form-data" method="post" onsubmit='return fileValid()'>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color='red'></font>
				<div class='notAvailable' id="firstNameVal">
					<font color='red'></font>
				</div><input class="form-control" id='firstName' maxlength='50' name='firstName' placeholder="first name" required="" type="text">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				<font color='red'></font>
				<div class='notAvailable' id="lastNameVal">
					<font color='red'></font>
				</div><input class="form-control" id='lastName' maxlength='50' name='lastName' placeholder="last name" required="" type="text">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color='red'></font>
				<div class='notAvailable' id="passwordVal">
					<font color='red'></font>
				</div><input class="form-control" id='password' maxlength='50' name='password' placeholder="password" required="" type="password">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color='red'></font>
				<div class='notAvailable' id="confirmPasswordVal">
					<font color='red'></font>
				</div><input class="form-control" id='confirmPassword' maxlength='50' name='confirmPassword' placeholder="confirm password" required="" type="password">
			</div>
			<div class="form-group">
				<label class="regLabel" for='securityQuestion'></label>
				<h5 class="regTitle"><label class="regLabel" for='securityQuestion'>Security Question:</label></h5><select class="u-full-width" id='securityQuestion' name='securityQuestion'>
					<option value="What is your mother's maiden name?">
						What is your mother's maiden name?
					</option>
					<option value="What was the make of your first car?">
						What was the make of your first car?
					</option>
					<option value="What city were you born in?">
						What city were you born in?
					</option>
					<option value="What is your favourite colour?">
						What is your favourite colour?
					</option>
				</select>
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color='red'></font>
				<div class='notAvailable' id="securityQuestionAnswerVal">
					<font color='red'></font>
				</div><input class="form-control" id='securityQuestionAnswer' maxlength='50' name='securityQuestionAnswer' placeholder="security question answer" required="" type="text">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				<div class='notAvailable' id="emailVal"></div><!-- EMAIL INPUT ACCESSES CHECKEMAIL() WHEN TYPED IN -->
				<input class="form-control" id='email' maxlength='40' name='email' onblur="checkEmail()" placeholder="email" required="" title="Please provide only a valid email." type="email"> <!-- DISPLAYS LIVE CHECK FEEDBACK -->
				<p id="emailAvailabilityFeedback"></p>
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				<div class='notAvailable' id="confirmEmailVal"></div><input class="form-control" id='confirmEmail' maxlength='40' name='confirmEmail' placeholder="confirm email" required="" type="email">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color='red'></font>
				<div class='notAvailable' id="telephoneNumberVal">
					<font color='red'></font>
				</div><input class="form-control" id='telephoneNumber' maxlength='50' name='telephoneNumber' placeholder="telephone number" required="" type="text">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color='red'></font>
				<div class='notAvailable' id="addressVal">
					<font color='red'></font>
				</div><input class="form-control" id='address' maxlength='100' name='address' placeholder="address" required="" type="text">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color='red'></font>
				<div class='notAvailable' id="cityVal">
					<font color='red'></font>
				</div><input class="form-control" id='city' maxlength='50' name='city' placeholder="city" required="" type="text">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				<font color='red'></font>
				<div class='notAvailable' id="postcodeVal">
					<font color='red'></font>
				</div><input class="form-control" id='postcode' maxlength='30' name='postcode' placeholder="postcode" required="" type="text">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color='red'></font>
				<div class='notAvailable' id="countryVal">
					<font color='red'></font>
				</div><input class="form-control" id='country' maxlength='50' name='country' placeholder="country" required="" type="text">
			</div><br>
			<h5 class="regTitle">Profile Picture:</h5>
			<div class="input-group">
				<input accept=".jpg, .jpeg, .png" id="file-input" name='finput' type="file">
			</div><br>
			<!-- SUBMISSION BUTTON FOR THIS FORM -->
			 <input class="button btn-primary u-full-width" id="signUp" name='subButton' type="submit" value="Sign Up">
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