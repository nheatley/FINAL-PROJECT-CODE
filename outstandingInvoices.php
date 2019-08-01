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
				<a class="nav-link" href="paymentsHome.php"><font color="white">Payments Home</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="messengerHome.php"><font color="white">Messenger</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="paidInvoices.php"><font color="white">Paid Invoices</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="outstandingInvoices.php"><font color="white">Outstanding Invoices</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">Payment Manager</h2>
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
	          <font color = 'red'> <h4 align = 'center'>Outstanding Invoices. </h4></font>
	      </div>";         
	}
	?><?php

	// QUERY TO GENERATE ALL THE CORRECT INFORMATION FOR THE INVOICE
	$resultB = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_User.telephoneNumber, TrainerPal_User.email, TrainerPal_User.city, TrainerPal_User.address, 
	TrainerPal_User.postcode, TrainerPal_User.country, TrainerPal_Invoices.invoiceTitle, TrainerPal_Invoices.invoiceDescription, TrainerPal_Invoices.invoiceDate, TrainerPal_Invoices.invoiceAmount,
	TrainerPal_Invoices.client, TrainerPal_Invoices.paid, TrainerPal_Invoices.invoiceID
	FROM TrainerPal_User INNER JOIN TrainerPal_Invoices ON TrainerPal_User.userID = TrainerPal_Invoices.client WHERE TrainerPal_Invoices.owner = '$activeID' AND TrainerPal_Invoices.paid = '1' ORDER BY TrainerPal_Invoices.invoiceID DESC");

	    if(!$resultB) {
	    echo "did not work";
	    }
	        
	 $num = $resultB -> num_rows;
	   if ($num == 0) {  
	 echo "  <div align ='center' style = 'padding-top:10px;'>
	 <font color = 'red'> <h2 align='center'>You have no outstanding invoices at the moment!</h2></font>
	 </div>";
	 } else {
	 echo "
	 <table class='table table-hover'>
	  <thead>
	    <tr>
	    <th scope='col'></th>
	      <th scope='col'>Last Name</th>
	      <th scope='col'>First Name</th>
	      <th scope='col'>Amount</th>
	      <th scope='col'>Details</th>
	    </tr>
	  </thead>
	  <tbody style = 'background-color:#FCD5D5'>
	    <tr>
	 ";
	 }
	 
	  while($row=$resultB->fetch_assoc()){
	        
	  $firstName = $row["firstName"];
	  $lastName= $row["lastName"];
	  $email = $row["email"];
	  $address = $row["address"];
	  $city= $row["city"];
	  $postcode = $row["postcode"];
	  $country= $row["country"];
	  $telephoneNumber = $row['telephoneNumber'];
	  $invoiceTitle = $row['invoiceTitle'];
	  $invoieDescription= $row['invoiceDescription'];
	  $invoiceDate = $row['invoiceDate'];
	  $invoiceAmount= $row['invoiceAmount'];
	  
	  $paid = $row['paid'];
	  $invoiceID = $row['invoiceID'];
	  
	  //MULTIPLIES TO A RANDOM VALUE
	  $invoiceID = ($invoiceID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $invoiceID= base64_encode($invoiceID); 
	    
	  echo "
	      <th scope='row'></th>
	      <td>$lastName</td>
	      <td>$firstName</td>
	      <td>£$invoiceAmount</td>
	    <td><a class='btn btn-primary' href='viewInvoice.php?invoiceID=$invoiceID' role='button'>More</a></td> 
	         </tr>
	  ";

	}
	?>
	</tbody>
	</table>
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