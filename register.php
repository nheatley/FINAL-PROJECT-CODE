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
</head>
<body>
         
         <!---- SCRIPTS TO HAVE CHECK ON ALL REGISTRATION FORM DATA ENTERIES ---->
         
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
                        jQuery('#emailVal').html("Please insert an email!");
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

                    var telephoneNumber = jQuery.trim($('#telephoneNumber').val());

                    /**
                     * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
                     */
                    if (telephoneNumber.length <= 0) {
                        e.preventDefault();
                        jQuery('#telephoneNumberVal').html("Please insert a telephone Number!");
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
			
			<?php if(!isset($_SESSION['loggedSession'])) {
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
			<li class = "nav-item active">
				<a class = "nav-link" href="trainerAccount.php"><font color = "white">Trainer Portal</font></a>
			</li>
			
			<!---- LOG OUT BUTTON APPEARS IN THE NAV BAR WHEN USER IS LOGGED IN ---->
			
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
</nav>
</header>

  <!----- Registration Form ----->
      
       <div id = "regDiv" class = "col-8">
			<h3 id = "signUpTitle">TrainerPal Sign Up</h3>
            <!-- SIGN UP FORM -->
            <form class = "signUpForm" action="processRegister.php" method="post" enctype="multipart/form-data" onSubmit='return fileValid()'>
                 
             <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                   <font color = 'red'> <div class='notAvailable' id="firstNameVal"></div></font>
                      <input class="form-control" type="text" name='firstName' placeholder = "first name" id='firstName' maxlength='50' required>
                </div>


                <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                    <font color = 'red'><div class='notAvailable' id="lastNameVal"></div> </font>
                      <input class="form-control" type="text" name='lastName' placeholder = "last name" id='lastName' maxlength='50' required>
                </div>
 
                <div class="form-group">

                    <!-- DISPLAYS VALIDATION MESSAGE -->
                   <font color = 'red'> <div class='notAvailable' id="passwordVal"></div></font>
                      <input class="form-control" type="password" name='password' placeholder = "password" id='password' maxlength='50' required> 
                </div>

                <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                  <font color = 'red'>  <div class='notAvailable' id="confirmPasswordVal"></div> </font>
                      <input class="form-control" type="password" name='confirmPassword' placeholder = "confirm password" id='confirmPassword' maxlength='50' required>
                </div>
            
                <div class="form-group">
                     <label class = "regLabel" for='securityQuestion'><h5 class = "regTitle" >Security Question:</h5></label>
                    <select class="u-full-width" name='securityQuestion' id='securityQuestion'>
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What was the make of your first car?">What was the make of your first car?</option>
                        <option value="What city were you born in?">What city were you born in?</option>
                        <option value="What is your favourite colour?">What is your favourite colour?</option>
                    </select>
                </div>
                
                        <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                   <font color = 'red'> <div class='notAvailable' id="securityQuestionAnswerVal"></div> </font>
                      <input class="form-control" type="text" name='securityQuestionAnswer' placeholder = "security question answer" id='securityQuestionAnswer' maxlength='50' required>
                </div>
						
                <div class="form-group">

                    <!-- DISPLAYS VALIDATION MESSAGE -->
                    <font color = 'red'><div class='notAvailable' id="emailVal"></div></font>
                    <!-- EMAIL INPUT ACCESSES CHECKEMAIL() WHEN TYPED IN -->
                      <input class="form-control" type="email" placeholder = "email" name='email' id='email'
                           title="Please provide only a valid email." onBlur="checkEmail()" maxlength='40' required>
                    <!-- DISPLAYS LIVE CHECK FEEDBACK -->
                    <p id="emailAvailabilityFeedback"></p>
                </div>

                <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                   <font color = 'red'> <div class='notAvailable' id="confirmEmailVal"></div> </font>
                     <input class="form-control" type="email" name='confirmEmail' placeholder = "confirm email" id='confirmEmail' maxlength='40' required>
                </div>
            
      
                <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                   <font color = 'red'> <div class='notAvailable' id="telephoneNumberVal"></div></font>
                    <input class="form-control" type="text" name='telephoneNumber' id='telephoneNumber' placeholder = "telephoneNumber" maxlength='50' required>
                </div>

                <div class="form-group">

                    <!-- DISPLAYS VALIDATION MESSAGE -->
                   <font color = 'red'> <div class='notAvailable' id="addressVal"></div></font>
                      <input class="form-control"type="text" name='address' placeholder = "address" id='address' maxlength='100' required>
                </div>

                <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                   <font color = 'red'> <div class='notAvailable' id="cityVal"></div></font>
                    <input class="form-control" type="text" name='city' id='city' placeholder = "city" maxlength='50' required>
                </div>


                <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                    <font color = 'red'><div class='notAvailable' id="postcodeVal"></div></font>
                    <input class="form-control" type="text" name='postcode' placeholder = "postcode"id='postcode' maxlength='30' required>
                </div>

                <div class="form-group">
                    <!-- DISPLAYS VALIDATION MESSAGE -->
                  <font color = 'red'>  <div class='notAvailable' id="countryVal"></div> </font>
                     <input class="form-control"type="text" name='country' placeholder = "country"id='country' maxlength='50' required>
                </div>

                
                <br/>
                <h5 class = "regTitle" >Profile Picture:</h5>
                <div class="input-group">
                    <input type="file" id="file-input" name='finput' accept=".jpg, .jpeg, .png">
                </div>
                <br/>

                <!-- SUBMISSION BUTTON FOR THIS FORM -->
                <input class="button btn-primary u-full-width" id="signUp" name='subButton' type="submit" value="Sign Up">

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