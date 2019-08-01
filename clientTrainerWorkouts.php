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
				<a class="nav-link" href="trainerAccount.php"><font color="white">My Trainer Account Details</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="messengerHome.php"><font color="white">Messenger</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clientManagerHome.php"><font color="white">Client Manager</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clientTrainerWorkouts.php"><font color="white">Client/Trainer Workouts</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="paymentsHome.php"><font color="white">Payment Manager</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">Workouts you have assigned to your Clients.</h2>
	</div><?php


	 echo " 
	 
	 <div align = 'center' style = 'padding-bottom:10px border-bottom: 3px blue solid;'>
	 <form method='POST' action='clientTrainerWorkouts.php' style = 'border-bottom: 3px blue solid; padding-bottom:15px;'>
	<p>
	<div style = 'padding-bottom:10px'><input class = 'button btn-primary btn-lg' type='submit' name='assignedWorkouts' value='All Assigned Workouts'>
	</div>
	<div style = 'padding-bottom:10px'><input class = 'button btn-primary btn-lg'type='submit' name='uncompletedWorkouts'  value='Client Uncompleted Workouts'>
	</div>
	<div><input class = 'button btn-primary btn-lg' type='submit' name='completedWorkouts'   value='Client Completed Workouts'></p>
	</div></form>
	 </div>

	";
	if (isset($_POST['assignedWorkouts'])) {

	$selectQuery ="SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_TrainerClientWorkouts.exerciseName,
	TrainerPal_TrainerClientWorkouts.description, TrainerPal_TrainerClientWorkouts.workoutCompleted, TrainerPal_TrainerClientWorkouts.clientWorkoutID, TrainerPal_TrainerClientWorkouts.sets, TrainerPal_TrainerClientWorkouts.reps, TrainerPal_TrainerClientWorkouts.youtubeVideoURL
	FROM TrainerPal_User 
	INNER JOIN TrainerPal_TrainerClientWorkouts ON TrainerPal_User.userID = TrainerPal_TrainerClientWorkouts.clientID 
	WHERE TrainerPal_TrainerClientWorkouts.trainerID = '$activeID' ORDER BY TrainerPal_TrainerClientWorkouts.clientWorkoutID DESC";

	$result = $conn->query($selectQuery);

	if(!$result) {
	echo "did not work";
	}

	        $num = $result -> num_rows;
	                
	    if ($num == 0) {  
	 echo " <font color = 'red'> <h2 style='padding-top:10px' align='center'>You have not assigned any workouts at this time. </h2></font>
	 <div align ='center' style = 'padding-bottom:10px;'>
	 <a class='btn btn-warning' href='clientManagerHome.php' role='button'>Go to Clients</a>
	 </div>";
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
	                  $workoutCompleted =  $row['workoutCompleted'];
	   
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
	     
	     <h2 style = 'border-top:blue 3px solid; padding-top:10px;'> Workout assigned to: $firstName $lastName </h2>
	     <h4> Exercise Name: $exerciseName </h4>
	       <h5> Description: $description </h5>
	         <h5> Number of sets: $sets </h5>
	           <h5>Number of Reps: $reps </h5>
	             <p>Video: </p>
	             
	             <iframe width='300' height='345' src=https://www.youtube.com/embed/$youtube_id?autoplay=1'>             
	</iframe>";

	if($workoutCompleted !='2') {
	           
	           echo" <div align ='center' style = 'padding-bottom:10px;'>
	 <h5><font color = 'red'>$firstName is yet to be complete this workout.</font></h5>
	 </div>";
	 }
	 
	 if($workoutCompleted !='1') {           
	        $completeCheck = "SELECT * FROM TrainerPal_ClientWorkoutComplete WHERE TrainerPal_ClientWorkoutComplete.trainerClientWorkoutID = '$clientWorkoutID'";
	        
	        $resultA = $conn->query($completeCheck);
	        
	        while($row = $resultA->fetch_assoc() ){
	        
	        $workoutRating = $row['workoutRatingID'];
	        $comment= $row['comment'];  
	           
	           echo" <div align ='center' style = 'padding-bottom:10px;'>
	 <h5>$firstName rated this workout $workoutRating/5 Stars.</h5>
	  <h5>$firstName's comment: $comment</h5>
	 </div>"
	 ;
	 }
	 }
	        echo" </div>";
	                        
	}
	}
	if (isset($_POST['uncompletedWorkouts'])) {

	$selectQuery ="SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_TrainerClientWorkouts.exerciseName,
	TrainerPal_TrainerClientWorkouts.description, TrainerPal_TrainerClientWorkouts.workoutCompleted, TrainerPal_TrainerClientWorkouts.clientWorkoutID, TrainerPal_TrainerClientWorkouts.sets, TrainerPal_TrainerClientWorkouts.reps, TrainerPal_TrainerClientWorkouts.youtubeVideoURL
	FROM TrainerPal_User 
	INNER JOIN TrainerPal_TrainerClientWorkouts ON TrainerPal_User.userID = TrainerPal_TrainerClientWorkouts.clientID 
	WHERE TrainerPal_TrainerClientWorkouts.trainerID = '$activeID' AND TrainerPal_TrainerClientWorkouts.workoutCompleted = '1'
	ORDER BY TrainerPal_TrainerClientWorkouts.clientWorkoutID DESC";

	$result = $conn->query($selectQuery);

	if(!$result) {
	echo "did not work";
	}

	    $num = $result -> num_rows;
	                
	    if ($num == 0) {  
	 echo " <font color = 'red'> <h2 style='padding-top:10px' align='center'>There are no uncompleted workouts at this time. </h2></font>
	 <div align ='center' style = 'padding-bottom:10px;'>
	 <a class='btn btn-warning' href='clientManagerHome.php' role='button'>Go to Clients</a>
	 </div>";
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
	                  $workoutCompleted =  $row['workoutCompleted'];
	   
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
	     
	     <h2 style = 'border-top:blue 3px solid; padding-top:10px;'> Workout assigned to: $firstName $lastName </h2>
	     <h4> Exercise Name: $exerciseName </h4>
	       <h5> Description: $description </h5>
	         <h5> Number of sets: $sets </h5>
	           <h5>Number of Reps: $reps </h5>
	             <p>Video: </p>
	             
	             <iframe width='300' height='345' src=https://www.youtube.com/embed/$youtube_id?autoplay=1'>             
	</iframe>";

	if($workoutCompleted !='2') {
	           
	           echo" <div align ='center' style = 'padding-bottom:10px;'>
	 <h5><font color = 'red'>$firstName is yet to be complete this workout.</font></h5>
	 </div>";
	 } echo" </div>";
	                               
	}
	}

	if(isset($_POST['completedWorkouts'])) {

	$selectQuery ="SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_TrainerClientWorkouts.exerciseName,
	TrainerPal_TrainerClientWorkouts.description, TrainerPal_TrainerClientWorkouts.workoutCompleted, TrainerPal_TrainerClientWorkouts.clientWorkoutID, TrainerPal_TrainerClientWorkouts.sets, TrainerPal_TrainerClientWorkouts.reps, TrainerPal_TrainerClientWorkouts.youtubeVideoURL
	FROM TrainerPal_User 
	INNER JOIN TrainerPal_TrainerClientWorkouts ON TrainerPal_User.userID = TrainerPal_TrainerClientWorkouts.clientID 
	WHERE TrainerPal_TrainerClientWorkouts.trainerID = '$activeID' AND TrainerPal_TrainerClientWorkouts.workoutCompleted = '2' 
	ORDER BY TrainerPal_TrainerClientWorkouts.clientWorkoutID DESC";

	$result = $conn->query($selectQuery);

	if(!$result) {
	echo "did not work";
	}

	    $num = $result -> num_rows;
	                
	    if ($num == 0) {  
	 echo " <font color = 'red'> <h2 style='padding-top:10px' align='center'>There are no completed workouts at this time. </h2></font>
	 <div align ='center' style = 'padding-bottom:10px;'>
	 <a class='btn btn-warning' href='clientManagerHome.php' role='button'>Go to Clients</a>
	 </div>";
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
	                  $workoutCompleted =  $row['workoutCompleted'];
	                                
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
	     
	     <h2 style = 'border-top:blue 3px solid; padding-top:10px;'> Workout assigned to: $firstName $lastName </h2>
	     <h4> Exercise Name: $exerciseName </h4>
	       <h5> Description: $description </h5>
	         <h5> Number of sets: $sets </h5>
	           <h5>Number of Reps: $reps </h5>
	             <p>Video: </p>
	             
	             <iframe width='300' height='345' src=https://www.youtube.com/embed/$youtube_id?autoplay=1'>             
	</iframe>";

	if($workoutCompleted !='1') {           
	        $completeCheck = "SELECT * FROM TrainerPal_ClientWorkoutComplete WHERE TrainerPal_ClientWorkoutComplete.trainerClientWorkoutID = '$clientWorkoutID'";
	        
	        $resultA = $conn->query($completeCheck);
	        
	        while($row = $resultA->fetch_assoc() ){
	        
	        $workoutRating = $row['workoutRatingID'];
	        $comment= $row['comment'];  
	           
	           echo" <div align ='center' style = 'padding-bottom:10px;'>
	 <h5>$firstName rated this workout $workoutRating/5 Stars.</h5>
	  <h5>$firstName's comment: $comment</h5>
	 </div>"
	 ;
	 }
	 }
	  echo" </div>";
	                               
	}
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