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
	<script>

	   
	                   
	           jQuery(document).ready(function () {
	               jQuery('form').submit(function (e) {
	               
	               
	               var invoiceTitle = jQuery.trim($('#invoiceTitle').val());

	                   /**
	                    * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (invoiceTitle.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#invoiceTitleVal').html("You must give the invoice a title!");
	                   }
	               
	               var invoiceDate = jQuery.trim($('#invoiceDate').val());

	                   /**
	                    * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (invoiceDate.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#invoiceDateVal').html("You must make note of the date!");
	                   }
	     
	                   var invoiceDescription = jQuery.trim($('#invoiceDescription').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (invoiceDescription.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#invoiceDescriptionVal').html("Please insert an invoice description!");
	                   }

	                   var invoiceAmount = jQuery.trim($('#invoiceAmount').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (invoiceAmount.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#invoiceAmountVal').html("Please insert an amount for this invoice!");
	                   }
	               });

	           });
	</script>
</head><!--== SCRIPTS TO HAVE CHECK ON ALL INVOICE DATA ENTERIES==-->
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
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">Invoice Generator</h2>
	</div><!--=== INVOICE Form ===-->
	<?php    
	 
	  $userID = htmlentities($_GET['userID']);
	    
	 echo " 
	       <div id = 'regDiv' class = 'col-8'>
	            <h3 id = 'ignUpTitle'>Invoice</h3>
	            <!-- SIGN UP FORM -->
	            <form class = 'signUpForm' action='processInvoice.php?userID=$userID' method='post' enctype='multipart/form-data' onSubmit='return fileValid()'>
	                 
	             <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                   <font color = 'red'> <div class='notAvailable' id='invoiceTitleVal'></div></font>
	                      <input class='form-control' type='text' name='invoiceTitle' placeholder = 'Invoice Ttitle' id='invoiceTitle' maxlength='50' required>
	                </div>

	                <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='invoiceDateVal'></div> </font>
	                      <input class='form-control' type='text' name='invoiceDate' placeholder = 'Date dd/mm/yyyy' id='invoiceDate' maxlength='50' required>
	                </div>
	                
	                
	               <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='invoiceDescriptionVal'></div> </font>
	                      <input class='form-control' type='text' name='invoiceDescription' placeholder = 'description' id='invoiceDescription' required>
	                </div>
	                
	               <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                   <font color = 'red'> <div class='notAvailable' id='invoiceAmountVal'></div></font>
	                    <input class='form-control' type='text' name='invoiceAmount' id='invoiceAmount' placeholder = 'Amount in £...' maxlength='50' required>
	                </div>

	                <!-- SUBMISSION BUTTON FOR THIS FORM -->
	                <input class='button btn-primary u-full-width' id='invoice' name='invoiceButton' type='submit' value='Send Invoice'>

	            </form>
	        </div>";
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