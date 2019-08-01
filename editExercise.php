<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
 
}
unset($_SESSION['exerciseID']);
$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');
include('adminChecker.php');
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
	<script>

	           jQuery(document).ready(function () {

	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#exerciseNameForm').submit(function (e) {

	                   var exerciseName = jQuery.trim($('#exerciseName').val());

	                   if (exerciseName.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#exerciseNameVal').html("Please insert an exercise name!");
	                   }

	               });

	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#descriptionForm').submit(function (e) {
	                   var description = jQuery.trim($('#description').val());

	                   if (description.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#descriptionVal').html("Please insert a description!");
	                   }

	               });
	                      
	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#setsForm').submit(function (e) {
	                   var sets= jQuery.trim($('#sets').val());

	                   if (sets.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#setsVal').html("Please insert a number of sets!");
	                   }

	               });
	               
	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#youtubeVideoURLForm').submit(function (e) {
	                   var youtubeVideoURL= jQuery.trim($('#youtubeVideoURL').val());

	                   if (youtubeVideoURL.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#youtubeVideoURLVal').html("Please insert a number youtube Video URL!");
	                   }

	               });
	               
	               /**
	                * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                */
	               jQuery('#repsForm').submit(function (e) {
	               
	                   var reps = jQuery.trim($('#reps').val());

	                   if (reps.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#repsVal').html("Please insert a number of reps!");
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
		<h2 align="center">Edit Exercise</h2>
	</div><?php

	if(isset($_SESSION['carryExerciseID'] )) {
	$exerciseID = $_SESSION['carryExerciseID'];
	}

	if(!isset($_SESSION['carryExerciseID'] )) {

	$exerciseID = htmlentities($_GET['exerciseID']);
	 
	  //DECODES THE VALUE
	  $exerciseID= base64_decode($exerciseID);
	  
	  //DIVIDES VALUE TO ORIGINAL VALUE
	  $exerciseID = ($exerciseID/$_SESSION['random']);
	  

	}

	$selectQuery = "SELECT * FROM TrainerPal_Exercises WHERE exerciseID = '$exerciseID'";

	$result = $conn->query($selectQuery);

	if(!$result) {
	echo "did not work";
	}

	 while($row = $result->fetch_assoc() ){
	 
	                  $workoutType= $row['workoutType'];
	                  $muscleGroup= $row['muscleGroup'];
	                  $exerciseName = $row['exerciseName']; 
	                  $description = $row['description'];
	                  $sets= $row['sets'];
	                  $reps = $row['reps'];
	                  $youtubeVideoURL = $row['youtubeVideoURL'];
	                  $exerciseID =  $row['exerciseID'];
	                  

	  
	  //MULTIPLIES TO A RANDOM VALUE
	  $exerciseID = ($exerciseID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $exerciseID= base64_encode($exerciseID);
	                           
	                           // SETTING STRINGS FOR THE WORKOUT TYPE       
	         if($workoutType ==1) {
	         $workoutType = 'Body Building';
	         }     
	         
	          if($workoutType ==2) {
	         $workoutType = 'Fat Burning';
	         }
	         
	          if($workoutType ==3) {
	         $workoutType = 'Body Toning';
	         }
	         
	          if($workoutType ==4) {
	         $workoutType = 'HIIT';
	         }
	         
	          if($workoutType ==5) {
	         $workoutType = 'Strength Training';
	         }    
	         
	         // SETTING STRINGS FOR THE MUSCLE GROUP
	         
	        if($muscleGroup ==1) {
	         $muscleGroup = 'Chest';
	         }  
	         
	         if($muscleGroup ==2) {
	         $muscleGroup = 'Back';
	         }  
	         
	            if($muscleGroup ==3) {
	         $muscleGroup = 'Legs';
	         }  
	         
	            if($muscleGroup ==4) {
	         $muscleGroup = 'Shoulders';
	         }  
	         
	            if($muscleGroup ==5) {
	         $muscleGroup = 'Arms';
	         }  
	         
	            if($muscleGroup ==6) {
	         $muscleGroup = 'N/A';
	         }  
	   
	// Here is a sample of the URLs this regex matches: (there can be more content after the given URL that will be ignored)
	// http://youtu.be/dQw4w9WgXcQ
	// http://www.youtube.com/embed/dQw4w9WgXcQ
	// http://www.youtube.com/watch?v=dQw4w9WgXcQ
	// http://www.youtube.com/?v=dQw4w9WgXcQ
	// http://www.youtube.com/v/dQw4w9WgXcQ
	// http://www.youtube.com/e/dQw4w9WgXcQ
	// http://www.youtube.com/user/username#p/u/11/dQw4w9WgXcQ
	// http://www.youtube.com/sandalsResorts#p/c/54B8C800269D7C1B/0/dQw4w9WgXcQ
	// http://www.youtube.com/watch?feature=player_embedded&v=dQw4w9WgXcQ
	// http://www.youtube.com/?feature=player_embedded&v=dQw4w9WgXcQ
	// It also works on the youtube-nocookie.com URL with the same above options.
	// It will also pull the ID from the URL in an embed code (both iframe and object tags)

	preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $youtubeVideoURL, $match);

	$youtube_id = $match[1];           
	                                
	    echo       
	     " <div align = 'center' style = 'padding-bottom:10px'>
	     
	     
	                                      <h5 style = 'padding-top:15px;' >Exercise Name: $exerciseName</h5>
	                                               <form class='subform' id='exerciseNameForm' action='processEditExercise.php?exerciseID=$exerciseID' method='POST'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                     <font color = 'red'><div class='validation' id='exerciseNameVal'></div> </font>
	                    <input class='col-6' type='text' name='exerciseName' id='exerciseName' maxlength='50'>
	                     <input class='button btn-primary' id='exerciseNameSub' name='exerciseNameSubButton' type='submit' value='Change'>

	            </form>
	            
	                               <h5 style = 'padding-top:15px;'>Description: $description</h5>
	                                               <form class='subform' id='descriptionForm'  action='processEditExercise.php?exerciseID=$exerciseID'  method='POST'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'> <div class='validation' id='descriptionVal'></div> </font>
	                    <input class='col-6' type='text' name='description' id='description' maxlength='400'>
	                     <input class='button btn-primary' id='descriptionSub' name='descriptionSubButton' type='submit' value='Change'>
	                
	            </form>
	                                    
	                                       <h5 style = 'padding-top:15px;'>Number of Sets: $sets</h5>
	                        
	                                    <form class='subform' id='setsForm' action='processEditExercise.php?exerciseID=$exerciseID'  method='POST'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                     <font color = 'red'><div class='validation' id='setsVal'></div> </font>
	                    <input class='col-6' type='text' name='sets' id='sets' maxlength='50'>
	                      <input class='button btn-primary'  id='setsSub' name='setsSubButton' type='submit' value='Change'>
	                
	            </form>
	            
	                                                  <h5 style = 'padding-top:15px;'>Number of Reps: $reps</h5>
	                        
	                                    <form class='subform' id='repsForm' action='processEditExercise.php?exerciseID=$exerciseID' method='POST'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                     <font color = 'red'><div class='validation' id='repsVal'></div> </font>
	                    <input class='col-6' type='text' name='reps' id='reps' maxlength='50'>
	                      <input class='button btn-primary'  id='repsSub' name='repsSubButton' type='submit' value='Change'>
	                
	            </form>";
	            

	  if(isset($_SESSION['carryExerciseID'])){ 
	  
	  echo " <div align = 'center' style = 'padding-top:10px'>
	    <h5> <font color = 'red'>This Youtube Video URL does not Exist. Please try again!</font></h5>
	    </div>";
	    }
	     
	       echo" <p>Video: </p>
	             
	             <iframe width='300' height='345' src=https://www.youtube.com/embed/$youtube_id?autoplay=1'>             
	</iframe>

	                                                  <h5 style = 'padding-top:15px;'>Youtube Video</h5>
	        
	                                       <form class='subform' id='youtubeVideoURLForm'  action='preEditYoutubeVideo.php?exerciseID=$exerciseID' method='POST'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                     <font color = 'red'><div class='validation' id='youtubeVideoURLVal'></div> </font>
	                    <input class='col-6' type='text' name='youtubeVideoURL' id='youtubeVideoURL' maxlength='50'>
	                      <input class='button btn-primary'  id='youtubeVideoURLSub' name='youtubeVideoURLSubButton' type='submit' value='Change'>
	                
	            </form>
	             
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