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
    <a class="nav-link" href="adminHome.php"><font color = "white">Admin Home</font></a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="allTrainers.php"><font color = "white">Trainers</font></a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="basicUsers.php"><font color = "white">Basic Users</font></a>
  </li>
      <li class="nav-item">
    <a class="nav-link" href="adminUsers.php"><font color = "white">Admins</font></a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="insertExercise.php"><font color = "white">Add Exercise</font></a>
  </li>
      <li class="nav-item">
    <a class="nav-link" href="allExercises.php"><font color = "white">All Exercises</font></a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="verifyTrainers.php"><font color = "white">Verify Trainers</font></a>
  </li>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="adminMessenger.php"><font color = "white">Admin Messenger</font></a>
  </li>
</ul>
      </section> 
              
   <div style = "padding-top:20px">
   <div style ='border-bottom: gray 3px solid;'>
<h2 align= "center">Trainer Verification Requests</h2>
</div>
</div>
<?php 
  
  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
  // ENSURES THAT A TRAINER WHO IS ALSO AN ADMIN CANNOT VERIFY THEMSELVES
  $resultA = $conn->query("SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_User.profilePictureURL, TrainerPal_Verifications.verificationID,
						  TrainerPal_Verifications.idImage, TrainerPal_Verifications.qualificationImage, TrainerPal_Verifications.adminResponded FROM
						  TrainerPal_User INNER JOIN TrainerPal_Verifications ON TrainerPal_User.userID = TrainerPal_Verifications.userID 
						  WHERE TrainerPal_Verifications.adminResponded = '1' AND TrainerPal_Verifications.userID != '$activeID'");
  
    if(!$resultA) {
    echo "did not work";
    }
 
     $num = $resultA -> num_rows;
     
     if ($num < 1) {
     echo "<div align ='center' style = 'padding-top:10px'>
            <h3> <font color = 'red'> There are no unanswered Trainer Verification Requests that you can respond to at the moment. </font> </h3>
            </div> ";
     }
  
  while($row=$resultA->fetch_assoc()){

  $profileImage = $row['profilePictureURL'];	
  $firstName = $row["firstName"];
  $lastName = $row["lastName"];
  $profilePictureURL= $row["profilePictureURL"];
  $idImage= $row["idImage"];
  $qualificationImage= $row["qualificationImage"];
  $adminResponded = $row["adminResponded"];
  
  $verificationID= $row["verificationID"];
  

  //MULTIPLIES TO A RANDOM VALUE
  $verificationID = ($verificationID*$_SESSION['random']);
  
  //ENCODES THE RANDOM VALUE
  $verificationID= base64_encode($verificationID); 

  
   echo 
  "
      <div class = 'col-12' style ='border-bottom: gray 3px solid;'>
        <h4 style = 'padding-top:10px' align = 'center'>$firstName $lastName is seeking to verify their Trainer Account.<br>Below is evidence of their credentials.</h4>
<div align = 'center' class='container'>
  <div class='row'>
    <div class='col'>
       <h4>  <font color = 'blue'>Identification Image </font> </h4>
            <img style = 'max-width: 250px' src='uploadedfiles/$idImage' class='img-thumbnail'> 
    </div>
     <div class='col'>
        <h4>  <font color = 'blue'>Qualification Image </font> </h4>
            <img style = 'max-width: 250px' src='uploadedfiles/$qualificationImage' class='img-thumbnail'>
    </div>
          </div>
          </div>  
          <div align = 'center' style = 'padding-top:10px'>
           <a href='grantVerification.php?verificationID=$verificationID' class='btn btn-success'>Grant Verification.</a>   
           </div>
           <div align = 'center' style = 'padding-top:10px; padding-bottom:10px'>
            <a href='denyVerification.php?verificationID=$verificationID' class='btn btn-danger'>Deny Verification.</a> 
           </div>   
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