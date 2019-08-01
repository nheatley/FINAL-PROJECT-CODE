<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
}
unset($_SESSION['carryExerciseID']);
unset($_SESSION['youtubeVideoURL']);
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
				<a class="nav-link" href="adminHome.php"><font color="white">Admin Home</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="allTrainers.php"><font color="white">Trainers</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="basicUsers.php"><font color="white">Basic Users</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="adminUsers.php"><font color="white">Admins</font></a>
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
		<h2 align="center">All Workouts/Exercises</h2>
	</div><?php

	echo "
	<div style='overflow-x:auto;'>
	<table class='table table-hover'>
	  <thead>
	    <tr>
	    <th scope='col'></th>
	      <th scope='col'>Exercise Name</th>
	      <th scope='col'>Workout Type</th>
	      <th scope='col'>Muscle Group</th>
	      <th scope='col'>Description</th>
	      <th scope='col'>Sets</th>
	      <th scope='col'>Reps</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>";
	    

	// QUERY TO GENERATE ALL THE CORRECT INFORMATION FOR THE INVOICE
	$resultB = $conn->query("SELECT * FROM TrainerPal_Exercises");

	    if(!$resultB) {
	    echo "did not work";
	    }
	        
	 $num = $resultB -> num_rows;
	   if ($num == 0) {  
	 echo "  <div align ='center' style = 'padding-top:10px;'>
	 <font color = 'red'> <h2 align='center'>There are no exercises at the moment.</h2></font>
	 </div>";
	 } 
	 
	  while($row=$resultB->fetch_assoc()){
	  
	                  $workoutType= $row['workoutType'];
	                  $muscleGroup= $row['muscleGroup'];
	                  $exerciseName = $row['exerciseName']; 
	                  $description = $row['description'];
	                  $sets= $row['sets'];
	                  $reps = $row['reps'];
	                  
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
	  
	  
	  echo "
	      <th scope='row'></th>
	      <td>$exerciseName</td>
	      <td>$workoutType</td>
	      <td>$muscleGroup</td>
	      <td>$description</td>
	        <td>$sets</td>
	          <td>$reps</td>
	                  <td><a class='btn btn-primary' href='editExercise.php?exerciseID=$exerciseID' role='button'>Edit</a></td> 
	                  <td><a class='btn btn-danger' href='preDeleteExercise.php?exerciseID=$exerciseID' role='button'>Delete</a></td> 
	         </tr> 
	         </div>";
	            
	}
	?>
	
	</tbody>
	</table>
	</div>
	
<!--- Footer Section =-->
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