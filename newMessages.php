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
		</ul>
	</section>
	<div style="padding-top:20px; border-bottom:gray 3px solid;">
		<h2 align="center">New Messages</h2>
	</div><?php 
	 
	  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
	  $resultB = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_User.userID, TrainerPal_User.profilePictureURL, TrainerPal_MessageHandler.subject, TrainerPal_MessageHandler.messageID, 
	                           TrainerPal_MessageHandler.message, TrainerPal_MessageHandler.senderID
	                           FROM TrainerPal_User INNER JOIN TrainerPal_MessageHandler ON TrainerPal_User.userID = TrainerPal_MessageHandler.senderID WHERE TrainerPal_MessageHandler.recipientID = '$activeID'
	                           AND TrainerPal_MessageHandler.messageRead = '1' AND TrainerPal_MessageHandler.inTrash = '1' ORDER BY TrainerPal_MessageHandler.messageID DESC");
	        if(!$resultB) {
	    echo "did not work";
	    }
	    
	 $num = $resultB -> num_rows;

	if ($num == 0) {  
	 echo " <font color = 'red'> <h2 align='center'>You have no new messages!</h2></font>
	 <div align ='center' style = 'padding-bottom:10px;'>
	 <a class='btn btn-primary' href='messengerHome.php' role='button'>Back to Messages</a>
	 </div>";

	}
	  while($row=$resultB->fetch_assoc()){

	  $profileImage = $row['profilePictureURL'];    
	  $firstName = $row["firstName"];
	  $lastName= $row["lastName"];
	  $subject = $row["subject"];
	  $message = $row["message"];
	  
	  $messageID = $row["messageID"];
	  
	  //MULTIPLIES TO A RANDOM VALUE
	  $messageID = ($messageID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $messageID= base64_encode($messageID); 

	   echo 
	   "
	   <div align = 'center' class='media' style = 'padding-top:20px; border-bottom: gray 2px solid;'>
	  <div class='media-body'>
	  <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
	    <h3 class='mt-0'>Message from $firstName $lastName</h3>
	    <h4>$subject</h4>
	     <a class='btn btn-warning' href='viewMessage.php?messageID=$messageID' role='button'>Read</a>
	     <p style = 'padding-top:10px;'><a class='btn btn-primary' href='messengerHome.php' role='button'>Back to Messages</a></p>
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