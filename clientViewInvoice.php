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
				<a class="nav-link" href="clientPaymentsHome.php"><font color="white">Payments Home</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="messengerHome.php"><font color="white">Messenger</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clientPaidInvoices.php"><font color="white">Paid Invoices</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clientOutstandingInvoices.php"><font color="white">Outstanding Invoices</font></a>
			</li>
		</ul>
	</section>
	<div style="padding-top:20px">
		<h2 align="center">Invoice</h2>
	</div>
	<style>
	   .invoice-box {
	       max-width: 800px;
	       margin: auto;
	       padding: 30px;
	       border: 1px solid #eee;
	       box-shadow: 0 0 10px rgba(0, 0, 0, .15);
	       font-size: 16px;
	       line-height: 24px;
	       font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
	       color: #555;
	   }
	   
	   .invoice-box table {
	       width: 100%;
	       line-height: inherit;
	       text-align: left;
	   }
	   
	   .invoice-box table td {
	       padding: 5px;
	       vertical-align: top;
	   }
	   
	   .invoice-box table tr td:nth-child(2) {
	       text-align: right;
	   }
	   
	   .invoice-box table tr.top table td {
	       padding-bottom: 20px;
	   }
	   
	   .invoice-box table tr.top table td.title {
	       font-size: 45px;
	       line-height: 45px;
	       color: #333;
	   }
	   
	   .invoice-box table tr.information table td {
	       padding-bottom: 40px;
	   }
	   
	   .invoice-box table tr.heading td {
	       background: #eee;
	       border-bottom: 1px solid #ddd;
	       font-weight: bold;
	   }
	   
	   .invoice-box table tr.details td {
	       padding-bottom: 20px;
	   }
	   
	   .invoice-box table tr.item td{
	       border-bottom: 1px solid #eee;
	   }
	   
	   .invoice-box table tr.item.last td {
	       border-bottom: none;
	   }
	   
	   .invoice-box table tr.total td:nth-child(2) {
	       border-top: 2px solid #eee;
	       font-weight: bold;
	   }
	   
	   @media only screen and (max-width: 600px) {
	       .invoice-box table tr.top table td {
	           width: 100%;
	           display: block;
	           text-align: center;
	       }
	       
	       .invoice-box table tr.information table td {
	           width: 100%;
	           display: block;
	           text-align: center;
	       }
	   }
	   
	   /** RTL **/
	   .rtl {
	       direction: rtl;
	       font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
	   }
	   
	   .rtl table {
	       text-align: right;
	   }
	   
	   .rtl table tr td:nth-child(2) {
	       text-align: left;
	   }
	</style><?php

	// GETTING THE INVOICE ID FROM PREVIOUS PAGE
	  $invoiceID = htmlentities($_GET['invoiceID']);
	 
	  //DECODES THE VALUE
	  $invoiceID= base64_decode($invoiceID);
	  
	  //DIVIDES VALUE TO ORIGINAL VALUE
	  $invoiceID = ($invoiceID/$_SESSION['random']);
	  
	// QUERY TO GENERATE ALL THE CORRECT INFORMATION FOR THE INVOICE
	$resultB = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_User.telephoneNumber, TrainerPal_User.email, TrainerPal_User.city, TrainerPal_User.address, 
	TrainerPal_User.postcode, TrainerPal_User.country, TrainerPal_Invoices.invoiceTitle, TrainerPal_Invoices.invoiceDescription, TrainerPal_Invoices.invoiceDate, TrainerPal_Invoices.invoiceAmount,
	TrainerPal_Invoices.client, TrainerPal_Invoices.paid, TrainerPal_Invoices.invoiceID, TrainerPal_Trainer.gymName,  TrainerPal_Trainer.gymAddress,  TrainerPal_Trainer.gymCity, TrainerPal_Trainer.gymPostcode, TrainerPal_Trainer.gymCountry
	FROM TrainerPal_User INNER JOIN TrainerPal_Invoices ON TrainerPal_User.userID = TrainerPal_Invoices.client INNER JOIN TrainerPal_Trainer ON TrainerPal_Invoices.owner=TrainerPal_Trainer.userID WHERE TrainerPal_Invoices.invoiceID = '$invoiceID' ORDER BY TrainerPal_Invoices.invoiceID DESC");

	    if(!$resultB) {
	    echo "did not work";
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
	  $invoiceDescription= $row['invoiceDescription'];
	  $invoiceDate = $row['invoiceDate'];
	  $invoiceAmount= $row['invoiceAmount'];
	  $gymName= $row['gymName'];
	  $gymAddress= $row['gymAddress'];
	  $gymCity= $row['gymCity'];
	  $gymPostcode= $row['gymPostcode'];
	  $gymCountry= $row['gymCountry'];
	  
	  $paid = $row['paid'];
	  $invoiceID = $row['invoiceID'];
	  
	  
	  echo "
	    <div style = 'padding-bottom:20px'>
	     <div class='invoice-box' style = 'padding-bottom:15px'>
	        <table cellpadding='0' cellspacing='0'>
	            <tr class='top'>
	                <td colspan='2'>
	                    <table>
	                        <tr>
	                            <td class='title'>
	                            </td>
	                            <td>
	                                Date: $invoiceDate
	                            </td>
	                        </tr>
	                    </table>
	                </td>
	            </tr>
	            
	            <tr class='information'>
	                <td colspan='2'>
	                    <table>
	                        <tr>
	                            <td>
	                            To:
	                            $firstName  $lastName<br>
	                                $address,<br>
	                                $city, $postcode<br>
	                                $country
	                            </td>
	                            
	                            <td>";
	                            }

	// QUERY TO GENERATE ALL THE CORRECT INFORMATION FOR THE INVOICE
	$resultB = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_User.telephoneNumber, TrainerPal_User.email, TrainerPal_User.city, TrainerPal_User.address, 
	TrainerPal_User.postcode, TrainerPal_User.country, TrainerPal_Invoices.invoiceTitle, TrainerPal_Invoices.invoiceDescription, TrainerPal_Invoices.invoiceDate, TrainerPal_Invoices.invoiceAmount,
	TrainerPal_Invoices.client, TrainerPal_Invoices.paid, TrainerPal_Invoices.invoiceID, TrainerPal_Trainer.gymName,  TrainerPal_Trainer.gymAddress,  TrainerPal_Trainer.gymCity, TrainerPal_Trainer.gymPostcode, TrainerPal_Trainer.gymCountry
	FROM TrainerPal_User INNER JOIN TrainerPal_Invoices ON TrainerPal_User.userID = TrainerPal_Invoices.owner INNER JOIN TrainerPal_Trainer ON TrainerPal_Invoices.owner=TrainerPal_Trainer.userID WHERE TrainerPal_Invoices.invoiceID = '$invoiceID' ORDER BY TrainerPal_Invoices.invoiceID DESC");

	    if(!$resultB) {
	    echo "did not work";
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
	  $invoiceDescription= $row['invoiceDescription'];
	  $invoiceDate = $row['invoiceDate'];
	  $invoiceAmount= $row['invoiceAmount'];
	  $gymName= $row['gymName'];
	  $gymAddress= $row['gymAddress'];
	  $gymCity= $row['gymCity'];
	  $gymPostcode= $row['gymPostcode'];
	  $gymCountry= $row['gymCountry'];
	                     
	       echo " 
	                                From:
	                                $firstName $lastName<br>
	                                 $gymName <br>
	                                 $gymAddress<br>
	                                 $gymCity, $gymPostcode <br>
	                                 $gymCountry  </td>
	                        </tr>
	                    </table>
	                </td>
	            </tr>    
	            <tr class='heading'>
	                <td>
	                    $invoiceTitle
	                </td>
	                
	                <td>
	                    Price
	                </td>
	            </tr>
	            
	            <tr class='item last'>
	                <td>
	                     $invoiceTitle <br>
	                     $invoiceDescription
	                </td>
	                
	                <td>
	                    £$invoiceAmount
	                </td>
	            </tr>
	            
	            <tr class='total'>
	                <td></td>
	                
	                <td>
	                   Total: £$invoiceAmount
	                </td>
	            </tr>
	        </table>
	    </div> 
	    </div>
	  ";

	}
	?>
	<div align='center' style='padding-bottom:10px'>
		<a class='btn btn-primary' href='clientPaymentsHome.php' role='button'>Back to Payment Manager</a>
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