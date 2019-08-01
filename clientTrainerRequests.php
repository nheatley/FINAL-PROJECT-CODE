<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
} 
include('connect.php');
include('browserCheck.php');
$activeID = $_SESSION['loggedSession'];

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
		<h2 align="center">Trainer Requests</h2>
		<h5 align="center">Here is a record of the Trainer Requests<br>
		you have sent.</h5>
	</div>
	<table class='table table-hover'>
		<thead>
			<tr>
				<th scope='col'></th>
				<th scope='col'>Trainer Last Name</th>
				<th scope='col'>Trainer First Name</th>
				<th scope='col'>Your Message</th>
				<th scope='col'>Trainer Response</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php

				// QUERY TO GENERATE ALL THE CORRECT INFORMATION FOR THE INVOICE
				$resultB = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_TrainerRequests.trainerRequestID, TrainerPal_User.lastName, TrainerPal_TrainerRequests.message, TrainerPal_TrainerRequests.trainerRequestResponse 
				                         FROM TrainerPal_User INNER JOIN TrainerPal_TrainerRequests ON TrainerPal_User.userID = TrainerPal_TrainerRequests.trainer 
				                         WHERE TrainerPal_TrainerRequests.client = '$activeID' ORDER BY TrainerPal_TrainerRequests.trainerRequestID DESC");

				    if(!$resultB) {
				    echo "did not work";
				    }
				        
				 $num = $resultB -> num_rows;
				   if ($num == 0) {  
				 echo "  <div align ='center' style = 'padding-top:10px;'>
				 <font color = 'red'> <h2 align='center'>You have sent no trainer requests at the moment!</h2></font>
				 </div>";
				 } 
				 
				  while($row=$resultB->fetch_assoc()){
				        
				  $firstName = $row["firstName"];
				  $lastName= $row["lastName"];
				  $message = $row["message"];
				  $requestResponse = $row["trainerRequestResponse"];
				  
				 $trainerRequestID = $row["trainerRequestID"];
				  
				  //MULTIPLIES TO A RANDOM VALUE
				  $trainerRequestID = ($trainerRequestID*$_SESSION['random']);
				  
				  //ENCODES THE RANDOM VALUE
				  $trainerRequestID= base64_encode($trainerRequestID);
				    
				  echo "
				      <th scope='row'></th>
				      <td>$lastName</td>
				      <td>$firstName</td>
				      <td>$message</td>";
				      
				      if($requestResponse == 1) {
				      echo "
				       <td>Pending <br> <a class='btn btn-warning' href='cancelRequest.php?trainerRequestID=$trainerRequestID' role='button'>Cancel</a></td>
				              
				         </tr>
				  ";
				      }
				       if($requestResponse == 2) {
				      echo "
				       <td><font color = 'red'>Denied</font></td>
				         </tr>
				  ";
				      }
				       if($requestResponse == 3) {
				      echo "
				       <td><font color = 'green'>Accepted<font></td>
				         </tr>
				  ";
				      }
				    
				}
				?>
		</tbody>
	</table>
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