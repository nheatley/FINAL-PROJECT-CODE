<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
} 
include('connect.php');
include('browserCheck.php');

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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Niall Heatley 40128349">
	<title> TrainerPal: Health & Fitness </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"</script>
	<script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
	<link rel = "stylesheet" href="css/style.css">  
</head>

<body>
<!--- Navigation --->
<header id = "navHeader">
<nav id = "navbar" class = "navbar navbar-expand-md navbar-light sticky-top" style ="background-color:#648CFF;">
<div class = "container-fluid">
	<a href = "index.php" > <h4 id= "navTitle"><font color = "white">TrainerPal: Health & Fitness</font></h4> </a>
	<button class = "navbar-toggler ml-auto" type = "button" data-toggle="collapse" data-target="#navbarResponsive">
	<span class = "navbar-toggler-icon"></span>
	</button>
	<div class ="collapse navbar-collapse" id = "navbarResponsive">
		<ul class = "navbar-nav ml-auto">
			<li class = "nav-item active">
				<a class = "nav-link" href="index.php"><font color = "white">Home</font></a>
			</li>
			<li class = "nav-item">
				<a class = "nav-link" href="workouts.php"><font color = "white">Workouts</font></a>
			</li>
			</li>
			<li class = "nav-item">
				<a class = "nav-link" href="trainers.php"><font color = "white">Trainers</font></a>
			</li>
			<li class = "nav-item active">
				<a class = "nav-link" href="account.php"><font color = "white">Account</font></a>
			</li>
			
			<li class = "nav-item active">
				<a class = "nav-link" href="trainerAccount.php"><font color = "white">Trainer Portal</font></a>
			</li>
			
			<!---- LOG OUT BUTTON APPEARS IN THE NAV BAR WHEN USER IS LOGGED IN ---->
			
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
</nav>
</header>
      
       <!--- SECOND ACCOUNT NAVIGATION --->  
<!-- second fixed navbar-->
<section id = "accountNav" >
<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link" href="trainerAccount.php"><font color = "white">My Trainer Account Details</font></a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="messengerHome.php"><font color = "white">Messenger</font></a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="clientManagerHome.php"><font color = "white">Client Manager</font></a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="clientTrainerWorkouts.php"><font color = "white">Client/Trainer Workouts</font></a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="paymentsHome.php"><font color = "white">Payment Manager</font></a>
  </li>
</ul>
      </section> 
   <div align = 'center' style = "padding-top:20px">
<h2 align="center">Verify your Trainer Account</h2>
<h4 align = 'center'> In order to advertise your services, you must first be Verified by the system Admins.</h4>
<h5> Step 1 - Please upload an image of a valid ID - a Driving licence or Passport will suffice.</h5>
<h5> Step 2 - please upload evidence you have Recieved your qualification as a Personal Trainer. </h5>
</div>

      
       <div style = 'padding-top:15px' id = "regDiv" class = "col-8">
	
            <!-- VERIFY TRAINER FORM -->
            <form class = "signUpForm" action="uploadVerification.php" method="post" enctype="multipart/form-data" onSubmit='return fileValid()'> 
                <h4 class = "regTitle" ><font color = 'blue'>Identification Image</font></h4>
                <div  align = 'center'class="input-group">
                    <input type="file" id="file-input" name='finput' accept=".jpg, .jpeg, .png" required>
                </div>
                <br/>
                            <h4 class = "regTitle"><font color = 'blue'>Qualification Evidence Image </font></h4>
                <div  align = 'center' class="input-group">
                    <input type="file" id="file-input" name='finput2' accept=".jpg, .jpeg, .png" required>
                </div>
                <!-- SUBMISSION BUTTON FOR THIS FORM -->
                <input class="button btn-primary u-full-width" id="signUp" name='subButton' type="submit" value="Upload">

            </form>
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