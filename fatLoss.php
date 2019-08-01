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
				<a class="nav-link" href="workouts.php"><font color="white">Workouts</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="trainingHome.php"><font color="white">My Training</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="strengthTraining.php"><font color="white">Strength Training</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="hiit.php"><font color="white">HIIT</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="fatLoss.php"><font color="white">Fat Loss</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">Amazing Exercises for Fat Loss</h2>
		<h5 align="center">Here are some brilliant routines to help you shred body fat.</h5>
	</div><?php

	$selectQuery = "SELECT * FROM TrainerPal_Exercises WHERE workoutType = '2'";

	$result = $conn->query($selectQuery);

	if(!$result) {
	echo "did not work";
	}

	 while($row = $result->fetch_assoc() ){
	 
	   
	                  $exerciseName = $row['exerciseName']; 
	                  $description = $row['description'];
	                  $sets= $row['sets'];
	                  $reps = $row['reps'];
	                  $youtubeVideoURL = $row['youtubeVideoURL'];
	        
	  
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
	     
	     <h4 style = 'border-top:blue 3px solid; padding-top:10px;'> Exercise Name: $exerciseName </h4>
	       <h5> Description: $description </h5>
	         <h5> Number of sets: $sets </h5>
	           <h5>Number of Reps: $reps </h5>
	             <p>Video: </p>
	             
	             <iframe width='300' height='345' src=https://www.youtube.com/embed/$youtube_id?autoplay=1'>             
	</iframe>
	             
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