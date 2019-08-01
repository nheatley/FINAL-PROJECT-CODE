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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
</head>

<body>
	<!--- NAVIGATION BAR=-->
	<header id="navHeader">
		<nav class="navbar navbar-expand-md navbar-light sticky-top" id="navbar" style="background-color:#648CFF;">
			<div class="container-fluid">
				<a href="index.php">
				<h4 id="navTitle"><font color="white">TrainerPal: Health & Fitness</font></h4>
				</a> <button class="navbar-toggler ml-auto" data-target="#navbarResponsive" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
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
						</li>
						<!--== LOG OUT BUTTON APPEARS IN THE NAV BAR WHEN USER IS LOGGED IN ==-->
						<?php if(isset($_SESSION['loggedSession'])) {
						            echo "
						                <li class = 'nav-item active'>
						                <a class = 'nav-link' href='logOut.php'><font color = 'white'>Log Out</font></a>
						            </li>";
						            
						            // QUERY TO SEARCH IF USER IS OF ADMIN USER TYPE
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
	
	<!--- SECOND ACCOUNT NAVIGATION --->
	<section id="accountNav">
		<ul class="nav justify-content-center">
			<li class="nav-item">
				<a class="nav-link" href="messengerHome.php"><font color="white">Messenger</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="trainingHome.php"><font color="white">My Training</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clientPaymentsHome.php"><font color="white">Payments</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">Account Details</h2>
	</div>

<?php 
	 
	  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
	  $result = $conn->query("SELECT * FROM TrainerPal_User WHERE userID = '$activeID' ");
	  
	  while($row=$result->fetch_assoc()){

	  $profileImage = $row['profilePictureURL'];    
	  $firstName = $row["firstName"];
	  $lastName= $row["lastName"];
	  $email = $row["email"];
	  $address = $row["address"];
	  $city= $row["city"];
	  $postcode = $row["postcode"];
	  $country= $row["country"];
	  $telephoneNumber = $row['telephoneNumber'];
	  $profileImage = $row['profilePictureURL'];
	  $accountType = $row['accountType'];
	  
	  // MAIN CONTENT
	   echo 
	  
	  "
	      <div class = 'col-12'>
	      <div align = 'center'>
	          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	          </div>
	             <div class = 'col-12' style='width:800px; margin:0 auto;'>
	            <div align = 'center'>
	                 <p style = 'padding-top:10px'>Name: $firstName $lastName</p>
	                    <p>Email: $email</p>
	                        <p>Telephone Number: $telephoneNumber</p>
	                        <p>Address: <br> $address,<br> $city, $postcode, <br>$country </p>
	                            <p><a href='editDetails.php' class='btn btn-primary'>Edit Account Details</a></p>";
	      
	        // IF THE USER'S ACCOUNT IS A BASIC ACCOUNT, THE PROMPT TO UPGRADE TO A TRAINER ACCOUNT IS DISPPLAYED
	                      if($accountType == 1) {
	                                     echo "
	                                <p> Are you a new Trainer? <br>Click<a href = 'payPalUpgradePage.php'> here to upgrade your account.<p></a>";
	                                }
	      
	     echo "
	     </div> </div>
	      </div>";
	          
	}
?>
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