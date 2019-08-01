<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
} 
include('connect.php');
include('browserCheck.php');
unset($_SESSION['clientID']);
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
				<a class="nav-link" href="clientManagerHome.php"><font color="white">Client Manager</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="messengerHome.php"><font color="white">Messenger</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clientRequests.php"><font color="white">Client Requests</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="paymentsHome.php"><font color="white">Payment Manager</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clientProgressReports.php"><font color="white">Client Progress Reports</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px; border-bottom:gray 3px solid;">
		<h2 align="center">Client Progress Reports</h2>

			<?php 
			  
			   $resultB = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_User.userID, TrainerPal_User.profilePictureURL, TrainerPal_User.lastName, TrainerPal_User.telephoneNumber, TrainerPal_User.email, TrainerPal_ProgressReports.date, TrainerPal_ProgressReports.wentWell,TrainerPal_ProgressReports.didNotLike, 
			                            TrainerPal_ProgressReports.couldImprove, TrainerPal_ProgressReports.nextWeek 
			                            FROM TrainerPal_User INNER JOIN TrainerPal_ProgressReports ON TrainerPal_User.userID = TrainerPal_ProgressReports.clientID 
			                            WHERE TrainerPal_ProgressReports.trainerID = '$activeID' ORDER BY TrainerPal_ProgressReports.progressReportID DESC");
			                            
			    if(!$resultB) {
			    echo "did not work";
			    }
		
			     $num = $resultB -> num_rows;

			   if ($num == 0) {  
			 echo " 
			 <font color = 'red'> <h2 align='center'>You have no client progress reports at the moment!</h2></font>";
			 }

			  			   
			   echo " 	</div>
			   <div class='container-fluid padding'>
		<div class='row padding'>";
		
			  while($row=$resultB->fetch_assoc()){

			  $profileImage = $row['profilePictureURL'];    
			  $firstName = $row["firstName"];
			  $lastName= $row["lastName"];
			  $email = $row["email"];
			  $telephoneNumber = $row['telephoneNumber'];
			  $date = $row["date"];
			  $wentWell = $row["wentWell"];
			  $didNotLike = $row["didNotLike"];
			  $couldImprove = $row["couldImprove"];
			  $nextWeek = $row["nextWeek"];
			  
			  $userID = $row["userID"];
			   
			  //MULTIPLIES TO A RANDOM VALUE
			  $userID = ($userID*$_SESSION['random']);
			  
			  //ENCODES THE RANDOM VALUE
			  $userID= base64_encode($userID);
			    
			   echo 
			  
			  "
			    <div class = 'col-xs-3 col-lg-4'>
			    <div class ='card' style = 'border-bottom: gray 3px solid; border-top: blue 2px solid; padding-top:8px;'>
			         <div align = 'center'>
			          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
			          </div>
			        <div align = 'center' class ='card-body'>
			        <h5 class = 'card-title'>$firstName $lastName</h5>
			        <p class = 'card-text'>TelephoneNumber: $telephoneNumber</p>
			         <p>Email: $email</p> 
			            <p>Date: $date </p>
			                <p>What went well?: $wentWell </p>
			                    <p>What did you not like? $didNotLike </p>
			                        <p>What could be improved?: $couldImprove </p>
			                            <p>What would you like to do next week?: $nextWeek </p>
			                            
			           <p><a href='contactTrainer.php?userID=$userID' class='btn btn-success'>Message $firstName</a> <a href='sendInvoice.php?userID=$userID' class='btn btn-info'>Send Invoice</a></p>
			           <p><a href='sendWorkoutPlan.php?userID=$userID' class='btn btn-warning'>Send Workout Plan</a> </p>
			           
			           </div> 
			    </div>
			    </div>";
			          
			}
			  ?>
		</div>
	</div>
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