<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
}

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
						                                    
						                                    // QUERY TO CHECK IF THE USER IS OF ADMIN USER TYPE
						                                    $selectQuery = "SELECT * FROM TrainerPal_Admins where userID = '$activeID'";
						                                        $result = $conn->query($selectQuery);
						                                             if(!$result) {
						                                             echo $conn -> error;
						                                                            } 
						                                       //IF THE USER IS AN ADMIN THEN THE NUM OF ROWS RETURNED WILL BE GREATER THAN ZERO
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
	</header>
	
	<!--- SECOND ACCOUNT NAVIGATION =--><!-- second fixed navbar-->
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
		<h2 align="center">Admin Actions</h2>
	</div><?php 
	     
	     // CARRIES OVER THE USERID
	     $userID = htmlentities($_GET['userID']);
	 
	      //DECODES THE VALUE
	  $userID= base64_decode($userID);
	  
	  //DIVIDES VALUE TO ORIGINAL VALUE
	  $userID = ($userID/$_SESSION['random']);


	      /// QUERY TO GET DETAILS OF THE USER ACCOUNT
	      $result = $conn->query("SELECT * FROM TrainerPal_User WHERE userID = '$userID' ");
	      
	        if(!$result) {
	        echo "did not work";
	        }
	        
	      while($row=$result->fetch_assoc()){

	      $profileImage = $row['profilePictureURL'];    
	      $firstName = $row["firstName"];
	      $lastName= $row["lastName"];
	      
	      $resultB = $conn->query("SELECT * FROM TrainerPal_Admins WHERE userID = '$userID' ");
	      
	      $num = $resultB -> num_rows;
	      
	      if ($num < 1) {
	      
	  //MULTIPLIES VALUE TO RANDOM VALUE
	  $userID = ($userID*$_SESSION['random']);
	      
	  //ENCODES THE VALUE
	  $userID= base64_encode($userID);
	  
	      // IF THE USER IS AN ADMIN THEN THE OPTION TO ADD ADMIN ACCESS IS SHOWN
	       echo 
	      "
	          <div class = 'col-12' style ='border-bottom: gray 3px solid;'>
	                  <div align = 'center'>
	              <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	              </div>
	            <h4 align = 'center'>Would you like to grant Admin access to $firstName $lastName?</h4>
	            
	            <div align = 'center' style = 'padding-top:10px'>
	            <a class='btn btn-success' href='grantAdminAccess.php?userID=$userID' role='button'>Yes, Grant Admin Access.</a></td> 
	          </div>
	              <div align = 'center' style = 'padding-top:10px'>
	            <a class='btn btn-primary' href='adminHome.php' role='button'>No, back to Admin Home.</a></td> 
	          </div>
	          </div>"; 
	          }
	        
	       if($num > 0) {
	       
	  //MULTIPLIES VALUE TO RANDOM VALUE
	  $userID = ($userID*$_SESSION['random']);
	      
	  //ENCODES THE VALUE
	  $userID= base64_encode($userID);
	       
	       // IF THE USER IS AN ADMIN THEN THE REMOVE ACCESS BUTTON IS SHOWN
	         echo 
	      "
	          <div class = 'col-12' style ='border-bottom: gray 3px solid;'>
	                   <div align = 'center'>
	              <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	              </div>
	            <h4 align = 'center'>Would you like to remove Admin access from $firstName $lastName?</h4>
	            
	            <div align = 'center' style = 'padding-top:10px'>
	            <a class='btn btn-danger' href='removeAdminAccess.php?userID=$userID' role='button'>Yes, Remove admin access.</a></td> 
	          </div>
	              <div align = 'center' style = 'padding-top:10px'>
	            <a class='btn btn-primary' href='adminHome.php' role='button'>No, back to Admin Home.</a></td> 
	          </div>
	          </div>"; 
	       
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