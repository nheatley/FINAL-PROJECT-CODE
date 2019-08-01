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
    <a class="nav-link" href="account.php"><font color = "white">Account Details</font></a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="messengerHome.php"><font color = "white">Messenger</font></a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="trainingHome.php"><font color = "white">My Training</font></a>
  </li>

    <li class="nav-item">
    <a class="nav-link" href="clientPaymentsHome.php"><font color = "white">Payments</font></a>
  </li>
</ul>
      </section>  
      <div>
                          <form class='subform' id='firstNameForm' action='trainers.php' method='POST'>
                          <input class="btn btn-warning" id='defineSearch' name='defineSearch' type='submit' value='Search'>
                    <input class='u-full-width' type='text' placeholder = "search..." name='defineSearch' id='defineSearch' maxlength='50'>
                </div> 
            </form> 
           <?php   if (isset($_POST['defineSearch'])) {
           
           echo "
           <a class='btn btn-info' href='trainers.php' role='button'>All Trainers</a>
           ";}
           
              ?>

<div class = 'col-12' style = "padding-top:20px">
<h2 align="center">Our Trainers</h2>
<h5 style = 'padding-bottom:10px;' align="center">All of our trainers are fully qualified and verified instructors.</h5>
</div>     
<div class="card-group">

<style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style>

<?php 
  /// INNER JOIN QUERY TO GET DETAILS OF THE TRAINER ACCOUNT

   $read = "SELECT TrainerPal_User.firstName, TrainerPal_User.userID, TrainerPal_User.email, TrainerPal_Trainer.verified, TrainerPal_User.lastName, TrainerPal_User.telephoneNumber, TrainerPal_User.profilePictureURL, TrainerPal_Trainer.gymName, 
            TrainerPal_Trainer.trainerBio, TrainerPal_Trainer.specialistAreas, TrainerPal_Trainer.gymAddress, TrainerPal_Trainer.gymCity, TrainerPal_Trainer.gymPostcode, 
            TrainerPal_Trainer.gymCountry FROM TrainerPal_User INNER JOIN TrainerPal_Trainer ON TrainerPal_User.userID = TrainerPal_Trainer.userID
            WHERE TrainerPal_Trainer.verified = '2' ORDER BY TrainerPal_Trainer.userID DESC";     
                       
     $result = $conn->query($read);
      if(!$result){
         echo "did not work";    
        }
  
  while($row=$result->fetch_assoc()){

  $profileImage = $row['profilePictureURL'];
  $firstName = $row["firstName"];	
  $lastName = $row["lastName"];
  $telephoneNumber =$row["telephoneNumber"];
  $gymName = $row["gymName"];
  $trainerBio= $row["trainerBio"];
  $specialistAreas = $row['specialistAreas'];
  $gymAddress = $row["gymAddress"];
  $gymCity= $row["gymCity"];
  $gymPostcode = $row["gymPostcode"];
  $gymCountry= $row["gymCountry"];
  $email =  $row['email'];
  
  $userID = $row['userID'];
  
   if (!isset($_POST['defineSearch'])) {
  echo "

  <div class='card'>
       <div align = 'center'>
          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
           <img style = 'max-width: 50px' src='img/verification.jpg' class='rounded-circle'>
          </div>
    <div align = 'center' class='card-body'>
      <h3 class='card-title'>$firstName $lastName</h3>
        <h5 class='card-title'>Telephone Number: $telephoneNumber</h5>
             <h5 class='card-title'>Email: $email</h5>
      <p class='card-text'>Specialist Areas: $specialistAreas </p>
      <p class='card-text'>Bio: $trainerBio </p>
      <p class='card-text'>Gym: $gymName</p>
         <p class='card-text'>Address: $gymAddress, $gymCity <br> $gymPostcode, $gymCountry</p>
      <p class='card-text'></p>";
      
      //CHECKS TO SEE IF THE USER ID OF THE TRAINER ACCOUNT IS THE SAME AS THE LOGGED IN USER
      //IF THE ID IS THE SAME, THE USER WILL BE TOLD IT IS THEIR LISTING
      //WHICH MEANS THEY CANNOT ADD THEMSELVES AS A CLIENT ETC
      
      if($userID != $activeID) {
         //MULTIPLIES TO RANDOM VALUE  
    $userID = ($userID*$_SESSION['random']);
    //ENCODES THE VALUE
    $userID= base64_encode($userID);
      echo "
      <p><a href='contactTrainer.php?userID=$userID' class='btn btn-success'>Message $firstName</a> <a href='requestTrainer.php?userID=$userID' class='btn btn-primary'>Send Trainer Request</a></p>";
      }
        if($userID === $activeID) {
   echo "<p> <font color = 'blue'>This is your listing </font></p>";
      }
  
 echo "<iframe width='300' height='400' id='gmap_canvas' src='https://maps.google.com/maps?q=$gymAddress%20$gymCity&t=&z=13&ie=UTF8&iwloc=&output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'></iframe><a href='https://www.vpnchief.com'></a></div>
   <div align = 'center' style = 'padding-bottom:10px;' >
   <h5> To view more map information, click 'View Larger Map' above.</h5.>
</iframe>
  </div>
   </div>      
 </div>
  ";
  }
  
  }
    if (isset($_POST['defineSearch'])) {

    $definedSearch = $conn->real_escape_string($_POST['defineSearch']);
      
     $definedResult = "SELECT TrainerPal_User.firstName, TrainerPal_User.email, TrainerPal_User.userID, TrainerPal_User.profilePictureURL, TrainerPal_User.lastName,
             TrainerPal_User.telephoneNumber, TrainerPal_Trainer.gymName, TrainerPal_Trainer.trainerBio,
             TrainerPal_Trainer.specialistAreas,  TrainerPal_Trainer.gymAddress, TrainerPal_Trainer.gymCity, TrainerPal_Trainer.gymPostcode, TrainerPal_Trainer.gymCountry 
             FROM TrainerPal_Trainer INNER JOIN TrainerPal_User ON TrainerPal_Trainer.userID = TrainerPal_User.userID
             WHERE TrainerPal_User.firstName LIKE '%$definedSearch%' AND TrainerPal_Trainer.verified = '2'
             OR (TrainerPal_User.lastName LIKE '%$definedSearch%' AND TrainerPal_Trainer.verified = '2')
             OR (TrainerPal_Trainer.trainerBio LIKE '%$definedSearch%'AND TrainerPal_Trainer.verified = '2')
             OR (TrainerPal_Trainer.specialistAreas LIKE '%$definedSearch%' AND TrainerPal_Trainer.verified = '2')
             OR (TrainerPal_User.telephoneNumber LIKE '%$definedSearch%' AND TrainerPal_Trainer.verified = '2')
             OR (TrainerPal_Trainer.gymAddress LIKE '%$definedSearch%' AND TrainerPal_Trainer.verified = '2')
             OR (TrainerPal_Trainer.gymCity LIKE '%$definedSearch%' AND TrainerPal_Trainer.verified = '2')
             OR (TrainerPal_Trainer.gymPostcode LIKE '%$definedSearch%' AND TrainerPal_Trainer.verified = '2')
             OR (TrainerPal_Trainer.gymCountry LIKE '%$definedSearch%' AND TrainerPal_Trainer.verified = '2')
             OR (TrainerPal_User.profilePictureURL LIKE '%$definedSearch%'AND TrainerPal_Trainer.verified = '2')
             OR (TrainerPal_Trainer.gymName LIKE '%$definedSearch%' AND TrainerPal_Trainer.verified = '2')
             OR (TrainerPal_User.email LIKE '%$definedSearch%' AND TrainerPal_Trainer.verified = '2')
             ORDER BY TrainerPal_Trainer.userID DESC";
                      
     $result = $conn->query($definedResult);
      if(!$result){
         echo "did not work";    
        }

    $num = $result -> num_rows;
    
    if($num < 1) {

        echo "            </div>  
                          <div align = 'center'>
  							<font color = 'red'><h3> Sorry, we have no results that match your search at this time. </h3></font>
  							<a class='btn btn-warning' href='trainers.php' role='button'>Back to Trainers</a>
  							</div>
  							</div>
  							
 									";
  									  } 
             
  while($row=$result->fetch_assoc()){

  $profileImage = $row['profilePictureURL'];
  $firstName = $row["firstName"];	
  $lastName = $row["lastName"];
  $telephoneNumber =$row["telephoneNumber"];
  $gymName = $row["gymName"];
  $trainerBio= $row["trainerBio"];
  $specialistAreas = $row['specialistAreas'];
  $gymAddress = $row["gymAddress"];
  $gymCity= $row["gymCity"];
  $gymPostcode = $row["gymPostcode"];
  $gymCountry= $row["gymCountry"];
  $email =  $row['email'];
  
  $userID = $row['userID'];
  
  echo "

  <div class='card'>
       <div align = 'center'>
          <img style = 'max-width: 250px' src='uploadedfiles/$profileImage' class='rounded-circle'>
           <img style = 'max-width: 50px' src='img/verification.jpg' class='rounded-circle'>
          </div>
    <div align = 'center' class='card-body'>
      <h3 class='card-title'>$firstName $lastName</h3>
        <h5 class='card-title'>Telephone Number: $telephoneNumber</h5>
             <h5 class='card-title'>Email: $email</h5>
      <p class='card-text'>Specialist Areas: $specialistAreas </p>
      <p class='card-text'>Bio: $trainerBio </p>
      <p class='card-text'>Gym: $gymName</p>
         <p class='card-text'>Address: $gymAddress, $gymCity <br> $gymPostcode, $gymCountry</p>
      <p class='card-text'></p>";
      
      //CHECKS TO SEE IF THE USER ID OF THE TRAINER ACCOUNT IS THE SAME AS THE LOGGED IN USER
      //IF THE ID IS THE SAME, THE USER WILL BE TOLD IT IS THEIR LISTING
      //WHICH MEANS THEY CANNOT ADD THEMSELVES AS A CLIENT ETC
      
      if($userID != $activeID) {
         //MULTIPLIES TO RANDOM VALUE  
    $userID = ($userID*$_SESSION['random']);
    //ENCODES THE VALUE
    $userID= base64_encode($userID);
      echo "
      <p><a href='contactTrainer.php?userID=$userID' class='btn btn-success'>Message $firstName</a> <a href='requestTrainer.php?userID=$userID' class='btn btn-primary'>Send Trainer Request</a></p>";
      }
        if($userID === $activeID) {
   echo "<p> <font color = 'blue'>This is your listing </font></p>";
      }
  
 echo "<iframe width='300' height='400' id='gmap_canvas' src='https://maps.google.com/maps?q=$gymAddress%20$gymCity&t=&z=13&ie=UTF8&iwloc=&output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'></iframe><a href='https://www.vpnchief.com'></a></div>
   <div align = 'center' style = 'padding-bottom:10px;' >
   <h5> To view more map information, click 'View Larger Map' above.</h5.>
</iframe>
  </div>
   </div>      
 </div>
  ";
  }
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