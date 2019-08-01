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
				<a class="nav-link" href="messengerHome.php"><font color="white">Messenger Home</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="newMessages.php"><font color="white">New Messages</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="sentMessages.php"><font color="white">Sent Messages</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="trash.php"><font color="white">Trash</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="messagesToAdmin.php"><font color="white">Messages with Admin</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">Messages with Admin</h2>
	</div><?php 
	 
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
	          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	          </div>
	          <h3 align='center'>$firstName, below is a record of messages to the system Admins.</h3>
	           <div align = 'center' style = 'padding-bottom:15px;'>
	            <a class='btn btn-primary' href='contactAdmin.php' role='button'>Contact Admin</a>
	            </div>
	      </div>";         
	}
	  ?><?php 
	 
	  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
	  $resultB = $conn->query("SELECT * FROM TrainerPal_AdminMessageHandler WHERE senderID = '$activeID' ORDER BY TrainerPal_AdminMessageHandler.adminMessageID DESC");
	        if(!$resultB) {
	    echo "did not work";
	    }
	    
	     $num = $resultB -> num_rows;

	if ($num == 0) {  
	 echo "  <div align ='center' style = 'padding-top:10px;'>
	 <font color = 'red'> <h2 align='center'>You have no messages with the admin at the moment!</h2></font>
	 </div>";
	 }
	 
	  while($row=$resultB->fetch_assoc()){

	  $subject = $row['subject'];   
	  $message = $row["message"];
	  $responded = $row["responded"];
	  
	  $adminMessageID = $row["adminMessageID"];
	  
	  //MULTIPLIES TO A RANDOM VALUE
	  $adminMessageID = ($adminMessageID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $adminMessageID= base64_encode($adminMessageID); 

	 
	   echo 
	   "
	   <div align = 'center' class='media' style = 'padding-top:20px; border-bottom: gray 2px solid;'>
	 
	  <div class='media-body'>
	    <h3 class='mt-0'>Subject: $subject</h3>
	    <h4>Message: $message</h4>";
	    
	    if($responded == '1') {
	    echo " <h5> <font color = 'red'>Awaiting Admin Response </font> </h5>";
	    } else {
	    
	    $responseCheck = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_AdminMessageReplies.originalMessageID, TrainerPal_AdminMessageReplies.response 
	                                    FROM TrainerPal_User INNER JOIN TrainerPal_AdminMessageReplies ON TrainerPal_User.userID = TrainerPal_AdminMessageReplies.adminID
	                                    WHERE TrainerPal_AdminMessageReplies.originalMessageID = '$adminMessageID'");
	                                   
	    if(!$responseCheck) {
	    echo "did not work";
	    }  
	    
	    while($row=$responseCheck->fetch_assoc()){
	    
	    $firstNameA = $row["firstName"];
	    $response = $row["response"];
	                            
	    echo " 
	    <h4 class='mt-0'> <font color = 'blue'>Response From: Admin $firstNameA</font></h4>
	    <h4>Response: $response</h4>
	     <h5> Still not satisfied with this response? Message the admins again.</h5>
	        <div align = 'center' style = 'padding-bottom:15px;'>
	            <a class='btn btn-warning' href='contactAdmin.php' role='button'>Contact Admin</a>
	            </div>";
	  
	    }
	    }
	    
	   echo " 
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