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
		<h2 align="center">Admin Users</h2>
	</div><?php 
	 
	  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
	  $result = $conn->query("SELECT * FROM TrainerPal_User WHERE userID = '$activeID' ");
	  
	    if(!$result) {
	    echo "did not work";
	    }
	    
	     $check = $conn->query("SELECT * FROM TrainerPal_Admins");
	  
	    if(!$check) {
	    echo "did not work";
	    }
	    
	    $num = $check -> num_rows;
	    
	  while($row=$result->fetch_assoc()){

	  $profileImage = $row['profilePictureURL'];    
	  $firstName = $row["firstName"];
	  $lastName= $row["lastName"];
	  
	   echo 
	  "
	      <div class = 'col-12' style ='border-bottom: gray 3px solid;'>
	                <div align = 'center'>
	          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	          </div>
	        <h4 align = 'center'>Below is a list of all Admin Users.</h4>
	        <h5 align = 'center'> The total amount of Admin users is: $num </h5>
	      </div>";         
	}

	echo "
	<div style='overflow-x:auto;'>
	<table class='table table-hover'>
	  <thead>
	    <tr>
	    <th scope='col'></th>
	      <th scope='col'>Last Name</th>
	      <th scope='col'>First Name</th>
	      <th scope='col'>Email</th>
	      <th scope='col'>Telephone Number</th>
	      <th scope='col'>Made Admin By</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>";
	    
	// QUERY TO GENERATE ALL THE CORRECT INFORMATION FOR THE INVOICE
	$result2 = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_User.userID, TrainerPal_User.lastName, TrainerPal_User.telephoneNumber, TrainerPal_User.email, TrainerPal_Admins.userID, TrainerPal_Admins.adminID 
	                         FROM TrainerPal_User INNER JOIN TrainerPal_Admins ON TrainerPal_User.userID = TrainerPal_Admins.userID");

	    if(!$result2) {
	    echo "did not work";
	    }
	        
	 $num = $result2 -> num_rows;
	   if ($num == 0) {  
	 echo "  <div align ='center' style = 'padding-top:10px;'>
	 <font color = 'red'> <h2 align='center'>There are no Admin users at the moment.</h2></font>
	 </div>";
	 } 
	 
	  while($row=$result2->fetch_assoc()){
	        
	  $firstName = $row["firstName"];
	  $lastName= $row["lastName"];
	  $email = $row["email"];
	  $telephoneNumber = $row["telephoneNumber"];
	  $adminID = $row["adminID"];
	  $userID = $row["userID"];
	  
	  //MULTIPLIES TO A RANDOM VALUE
	  $userID = ($userID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $userID= base64_encode($userID);
	                
	    echo "
	      <th scope='row'></th>
	      <td>$lastName</td>
	      <td>$firstName</td>
	      <td>$email</td>
	      <td>$telephoneNumber</td>";
	      
	            $checker = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_Admins.madeAdminBy 
	                               FROM TrainerPal_User INNER JOIN TrainerPal_Admins ON TrainerPal_User.userID = TrainerPal_Admins.madeAdminBy
	                               WHERE TrainerPal_Admins.adminID = '$adminID'");
	        if(!$checker) {
	    echo "did not work";
	    }       
	      while($row=$checker->fetch_assoc()){
	        
	  $firstNameB = $row["firstName"];
	  $lastNameB = $row["lastName"];    
	  
	        echo "<td>$lastNameB, $firstNameB</td>
	              <td><a class='btn btn-danger' href='removeAdminAccess.php?userID=$userID' role='button'>Remove admin access.</a></td> 
	         </tr>
	         </div>";
	              }
	    }  
	?>
</tbody>
</table> 
</div>	 <!--- Footer Section =-->
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