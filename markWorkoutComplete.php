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
	<link href="css/style.css" rel="stylesheet">
	<script>
	           
	           jQuery(document).ready(function () {
	               jQuery('form').submit(function (e) {
	               
	               
	                   var ratingComment = jQuery.trim($('#ratingComment').val());

	                   /**
	                    * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (ratingComment.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#ratingCommentVal').html("You must give a comment!");
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
		<h2 align="center">Let your Trainer know you have completed this workout.</h2>
	</div><?php

	  $clientWorkoutID = htmlentities($_GET['clientWorkoutID']);
	 
	      //DECODES THE VALUE
	  $clientWorkoutID= base64_decode($clientWorkoutID);
	  
	  //DIVIDES VALUE TO ORIGINAL VALUE
	  $clientWorkoutID = ($clientWorkoutID/$_SESSION['random']);  
	  

	$selectQuery ="SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_TrainerClientWorkouts.exerciseName,
	TrainerPal_TrainerClientWorkouts.description,TrainerPal_TrainerClientWorkouts.clientWorkoutID, TrainerPal_TrainerClientWorkouts.sets, TrainerPal_TrainerClientWorkouts.reps, TrainerPal_TrainerClientWorkouts.youtubeVideoURL
	FROM TrainerPal_User 
	INNER JOIN TrainerPal_TrainerClientWorkouts ON TrainerPal_User.userID = TrainerPal_TrainerClientWorkouts.trainerID 
	WHERE TrainerPal_TrainerClientWorkouts.clientWorkoutID = '$clientWorkoutID'";

	$result = $conn->query($selectQuery);

	if(!$result) {
	echo "did not work";
	}

	 while($row = $result->fetch_assoc() ){
	 
	   
	                  $exerciseName = $row['exerciseName'];
	                  $firstName = $row['firstName'];   
	                  $lastName = $row['lastName'];     
	                  $description = $row['description'];
	                  $sets= $row['sets'];
	                  $reps = $row['reps'];
	                  $youtubeVideoURL = $row['youtubeVideoURL'];
	                  
	                  $clientWorkoutID =  $row['clientWorkoutID'];
	                   
	  //MULTIPLIES TO A RANDOM VALUE
	  $clientWorkoutID = ($clientWorkoutID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $clientWorkoutID= base64_encode($clientWorkoutID); 

	   
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
	     
	     <h2 style = 'border-top:blue 3px solid; padding-top:10px;'> Assigned By: $firstName $lastName </h2>
	     <h4> Exercise Name: $exerciseName </h4>
	       <h5> Description: $description </h5>
	             <p>Video: </p>
	             
	             <iframe width='300' height='345' src=https://www.youtube.com/embed/$youtube_id?autoplay=1'>             
	</iframe>

	  <div id = 'regDiv' class = 'col-8'>
	         <form class = 'signUpForm' action='processMarkWorkoutComplete.php?clientWorkoutID=$clientWorkoutID' method='post' enctype='multipart/form-data' onSubmit='return fileValid()'>'
	                <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='ratingCommentVal'></div> </font>
	                      <input class='form-control' type='text' name='ratingComment' placeholder = 'comment...' id='ratingComment' required>
	                </div>
	                
	                                <div class='form-group'>
	                     <label class = 'regLabel' for='rating'><h5 class = 'regTitle' >Rating:</h5></label>
	                    <select class='u-full-width' name='rating' id='rating'>
	                        <option value='1'>1 Star</option>
	                        <option value='2'>2 Stars</option>
	                        <option value='3'>3 Stars</option>
	                        <option value='4'>4 Stars</option>
	                        <option value='5'>5 Stars</option>
	                    </select>
	                </div>
	                <!-- SUBMISSION BUTTON FOR THIS FORM -->
	                <input class='button btn-primary u-full-width' id='exercise' name='exerciseButton' type='submit' value='Rate Workout'>

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