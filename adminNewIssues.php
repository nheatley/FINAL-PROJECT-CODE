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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
				<a class="nav-link" href="adminMessenger.php"><font color="white">Admin Messenger</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="adminNewIssues.php"><font color="white">New Issues</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="adminIssueResponses.php"><font color="white">Issue Responses</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">New Issues</h2>
	</div>
	<div class='container-fluid padding'>
		<div class='row padding'>
			<?php 

			  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
			  $result = $conn->query("SELECT * FROM TrainerPal_User WHERE userID = '$activeID' ");
			  
			    if(!$result) {
			    echo "did not work";
			    }
			  
			  while($row=$result->fetch_assoc()){

			  $profileImage = $row['profilePictureURL'];    
			  $firstName = $row["firstName"];
			  $lastName= $row["lastName"];
			  
			   echo 
			  "
			       <div class = 'col-12' style ='border-bottom: gray 3px solid;'>
			      <div align = 'center'>
			          <img style = 'max-width: 150px' src='uploadedfiles/$profileImage' class='rounded-circle'>
			          </div>
			      ";          
			}
		
			  
			  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
			  $resultB = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_User.userID, TrainerPal_User.lastName, TrainerPal_User.userID, TrainerPal_User.profilePictureURL, TrainerPal_AdminMessageHandler.subject, TrainerPal_AdminMessageHandler.adminMessageID, 
			                           TrainerPal_AdminMessageHandler.message, TrainerPal_AdminMessageHandler.senderID, TrainerPal_AdminMessageHandler.responded, TrainerPal_AdminMessageHandler.adminMessageID
			                           FROM TrainerPal_User INNER JOIN TrainerPal_AdminMessageHandler ON TrainerPal_User.userID = TrainerPal_AdminMessageHandler.senderID 
			                           WHERE TrainerPal_AdminMessageHandler.responded = '1'
			                           ORDER BY TrainerPal_AdminMessageHandler.adminMessageID DESC");
			        if(!$resultB) {
			    echo "did not work";
			    }
			    
			     $num = $resultB -> num_rows;

			   if ($num == 0) {  
			   
			 echo "  
			 <font color = 'red'><h2 align='center'>There are no new issues at the moment!</h2></font>
			 ";
			 } 
			 
			 echo "</div>";

			  while($row=$resultB->fetch_assoc()){

			  $profileImage = $row['profilePictureURL'];    
			  $firstName = $row["firstName"];
			  $lastName= $row["lastName"];
			  $subject = $row["subject"];
			  $message = $row["message"];
			  $responded = $row["responded"];
			  
			  $adminMessageID = $row["adminMessageID"];
			  
			  //MULTIPLIES TO A RANDOM VALUE
			  $adminMessageID = ($adminMessageID*$_SESSION['random']);
			  
			  //ENCODES THE RANDOM VALUE
			  $adminMessageID= base64_encode($adminMessageID);
			 
			  $userID= $row["userID"];
			    
			  //MULTIPLIES TO A RANDOM VALUE
			  $userID = ($userID*$_SESSION['random']);
			  
			  //ENCODES THE RANDOM VALUE
			  $userID= base64_encode($userID);
			    
			   echo 
			  
			  "
			    <div class = 'col-xs-3 col-lg-4'>
			    <div class ='card' style = 'border-bottom: gray 3px solid; border-top: blue 2px solid; padding-top:8px;'>
			              <div align = 'center'>
			          <img style = 'max-width: 150px' src='uploadedfiles/$profileImage' class='rounded-circle'>
			          </div>
			        <div align = 'center' class ='card-body'>
			        <h5 class = 'card-title'>Sender: $firstName $lastName</h5>
			         <p>Subject: $subject</p> 
			            <p>Message: $message </p>
			             <p><a href='adminRespond.php?adminMessageID=$adminMessageID' class='btn btn-success'>Respond to $firstName</a></p> 
			       </div> 
			    </div>
			    </div>";
			       }
			  ?>
		</div>
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