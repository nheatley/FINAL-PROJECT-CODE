<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
 
}
$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');
include('adminChecker.php');
  // UNSETTING SESSIONS SO A NEW ENTRY CAN BE MADE 
    unset($_SESSION['exerciseName']);
    unset($_SESSION['workoutType']); 
    unset($_SESSION['muscleGroup']); 
    unset($_SESSION['description']); 
    unset($_SESSION['sets']);
    unset($_SESSION['reps']);
    unset($_SESSION['youtubeVideoURL']);
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

	     
	         
	           
	           jQuery(document).ready(function () {
	               jQuery('form').submit(function (e) {
	               
	               
	                   var exerciseName = jQuery.trim($('#exerciseName').val());

	                   /**
	                    * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (exerciseName.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#exerciseNameVal').html("You must insert an exercise name!");
	                   }
	               
	               
	               var description = jQuery.trim($('#description').val());

	                   /**
	                    * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (description.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#descriptionVal').html("You must insert a description!");
	                   }
	            

	                    var sets = jQuery.trim($('#sets').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (sets.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#setsVal').html("Please insert a number of sets!");
	                   }

	                   var reps = jQuery.trim($('#reps').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (reps.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#repsVal').html("Please insert a number of reps!");
	                   }


	                   var youtubeVideoURL = jQuery.trim($('#youtubeVideoURL').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (youtubeVideoURL.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#youtubeVideoURLVal').html("Please insert a youTube video link!");
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
	</header><!--- SECOND ACCOUNT NAVIGATION =--><!-- second fixed navbar-->
	<section id="accountNav">
		<ul class="nav justify-content-center">
			<li class="nav-item">
				<a class="nav-link" href="adminHome.php"><font color="white">Admin Home</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="allTrainers.php"><font color="white">Trainers</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="basicUsers.php"><font color="white">Basic Users</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="insertExercise.php"><font color="white">Add Exercise</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="allExercises.php"><font color="white">All Exercises</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="verifyTrainers.php"><font color="white">Verify Trainers</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="adminMessenger.php"><font color="white">Admin Messenger</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">Create Exercise</h2>
	</div><!--=== Registration Form ===-->
	<div class="col-8" id="regDiv">
		<!-- SIGN UP FORM -->
		<form action="preProcessInsertExercise.php" class="signUpForm" enctype="multipart/form-data" method="post" onsubmit='return fileValid()'>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				<font color='red'></font>
				<div class='notAvailable' id="exerciseNameVal">
					<font color='red'></font>
				</div><input class="form-control" id='exerciseName' name='exerciseName' placeholder="exercise name" required="" type="text">
			</div>
			<div class="form-group">
				<label class="regLabel" for='workoutType'></label>
				<h5 class="regTitle"><label class="regLabel" for='workoutType'>Workout Type:</label></h5><select class="u-full-width" id='workoutType' name='workoutType'>
					<option value="1">
						Body Building
					</option>
					<option value="2">
						Fat Burning
					</option>
					<option value="3">
						Body Toning
					</option>
					<option value="4">
						HIIT
					</option>
					<option value="5">
						Strength Building
					</option>
				</select>
			</div>
			<div class="form-group">
				<label class="regLabel" for='muscleGroup'></label>
				<h5 class="regTitle"><label class="regLabel" for='muscleGroup'>Muscle Group:</label></h5><select class="u-full-width" id='muscleGroup' name='muscleGroup'>
					<option value="1">
						Chest
					</option>
					<option value="2">
						Back
					</option>
					<option value="3">
						Legs
					</option>
					<option value="4">
						Shoulders
					</option>
					<option value="5">
						Arms
					</option>
					<option value="6">
						N/A
					</option>
				</select>
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				<font color='red'></font>
				<div class='notAvailable' id="descriptionVal">
					<font color='red'></font>
				</div><input class="form-control" id='description' name='description' placeholder="exercise description" required="" type="text">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				 <font color='red'></font>
				<div class='notAvailable' id="repsVal">
					<font color='red'></font>
				</div><input class="form-control" id='reps' maxlength='50' name='reps' placeholder="repetitions" required="" type="text">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				<font color='red'></font>
				<div class='notAvailable' id="setsVal">
					<font color='red'></font>
				</div><input class="form-control" id='sets' maxlength='30' name='sets' placeholder="sets" required="" type="text">
			</div>
			<div class="form-group">
				<!-- DISPLAYS VALIDATION MESSAGE -->
				<font color='red'></font>
				<div class='notAvailable' id="youtubeVideoURLVal">
					<font color='red'></font>
				</div><input class="form-control" id='youtubeVideoURL' name='youtubeVideoURL' placeholder='youTube Video URL' required="" type="text">
			</div><!-- SUBMISSION BUTTON FOR THIS FORM -->
			<input class="button btn-primary u-full-width" id="exercise" name='exerciseButton' type="submit" value="Proceed">
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