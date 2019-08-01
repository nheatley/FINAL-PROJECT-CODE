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
	</header>
	<!--- SECOND ACCOUNT NAVIGATION =--><!-- second fixed navbar-->
	<section id="accountNav">
		<ul class="nav justify-content-center">
			<li class="nav-item">
				<a class="nav-link" href="adminHome.php"><font color="white">Admin Home</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="allTrainers.php"><font color="white">Trainers</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="basicUsers.php"><font color="white">Basic Users</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="adminUsers.php"><font color="white">Admins</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="insertExercise.php"><font color="white">Add Exercise</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="allExercises.php"><font color="white">All Exercises</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="verifyTrainers.php"><font color="white">Verify Trainers</font></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="adminMessenger.php"><font color="white">Admin Messenger</font></a>
			</li>
		</ul>
	</section>
	<form action='adminHome.php' class='subform' id='firstNameForm' method='post' name="firstNameForm">
		<input class="btn btn-warning" id='defineSearch' name='defineSearch' type='submit' value='Search'> <input class='u-full-width' id='defineSearch' maxlength='50' name='defineSearch' placeholder="search..." type='text'> 
	</form>
<?php   if (isset($_POST['defineSearch'])) {
	           
	           echo "
	           <a class='btn btn-info' href='adminHome.php' role='button'>All Users</a>
	           ";}
	           ?>
	<div style="padding-top:20px">
		<h2 align="center">Admin Home</h2>
	</div><?php 
	 
	  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
	  $result = $conn->query("SELECT * FROM TrainerPal_User WHERE userID = '$activeID' ");
	  
	    if(!$result) {
	    echo "did not work";
	    }
	    
	     $check = $conn->query("SELECT * FROM TrainerPal_User");
	  
	    if(!$check) {
	    echo "did not work";
	    }
	    
	    $num = $check -> num_rows;
	    
	  
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
	        <h4 align = 'center'>Welcome to the Admin Page $firstName. <br>Below is a record of registered TrainerPal Users.</h4>
	        <h5 align = 'center'> The total amount of registered users is: $num </h5>
	      </div>";         
	}

	//IF DEFINE SEARCH WAS NOT USED

	if(!isset($_POST['defineSearch'])) {
	echo "
	<div style='overflow-x:auto;'>
	<table class='table table-hover'>
	  <thead>
	    <tr>
	    <th scope='col'></th>
	      <th scope='col'>Last Name</th>
	      <th scope='col'>First Name</th>
	      <th scope='col'>Email</th>
	      <th scope='col'>Telephone Number</th>
	      <th scope='col'>Address</th>
	      <th scope='col'>City</th>
	       <th scope='col'>Postcode</th>
	       <th scope='col'>Country</th>
	       <th scope='col'>Account Type</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>";
	    

	// QUERY TO GENERATE ALL THE CORRECT INFORMATION FOR THE INVOICE
	$resultB = $conn->query("SELECT * FROM TrainerPal_User");

	    if(!$resultB) {
	    echo "did not work";
	    }
	        
	 $num = $resultB -> num_rows;
	   if ($num == 0) {  
	 echo "  <div align ='center' style = 'padding-top:10px;'>
	 <font color = 'red'> <h2 align='center'>There are no users at the moment.</h2></font>
	 </div>";
	 } 
	 
	  while($row=$resultB->fetch_assoc()){
	        
	  $firstName = $row["firstName"];
	  $lastName= $row["lastName"];
	  $email = $row["email"];
	  $telephoneNumber = $row["telephoneNumber"];
	    $address = $row["address"];
	      $city = $row["city"];
	        $postcode = $row["postcode"];
	          $country = $row["country"];
	           $accountType = $row["accountType"];
	           
	  $userID =  $row["userID"];
	  
	  //MULTIPLIES TO A RANDOM VALUE
	  $userID = ($userID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $userID= base64_encode($userID);
	                
	    echo "
	      <th scope='row'></th>
	      <td>$lastName</td>
	      <td>$firstName</td>
	      <td>$email</td>
	      <td>$telephoneNumber</td>
	        <td>$address</td>
	          <td>$city</td>
	            <td>$postcode</td>
	              <td>$country</td>";
	              
	              if($accountType == 1) {
	              echo "    <td>Basic User</td>
	               <td><a class='btn btn-primary' href='adminActions.php?userID=$userID' role='button'>Actions</a></td> 
	         </tr>";
	              }
	               if($accountType == 2) {
	              echo "    <td>Trainer</td>
	               <td><a class='btn btn-primary' href='adminActions.php?userID=$userID' role='button'>Actions</a></td> 
	         </tr>";
	              } 
	                        
	}
	echo "</div>";
	}

	// IF DEFINED SEARCH WAS NOT USED
	if(isset($_POST['defineSearch'])) {


	echo "
	<div style='overflow-x:auto;'>
	<table class='table table-hover'>
	  <thead>
	    <tr>
	    <th scope='col'></th>
	      <th scope='col'>Last Name</th>
	      <th scope='col'>First Name</th>
	      <th scope='col'>Email</th>
	      <th scope='col'>Telephone Number</th>
	      <th scope='col'>Address</th>
	      <th scope='col'>City</th>
	       <th scope='col'>Postcode</th>
	       <th scope='col'>Country</th>
	       <th scope='col'>Account Type</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>";
	    
	    // TAKES IN THE KEY WORD
	    $definedSearch = $conn->real_escape_string($_POST['defineSearch']);
	     
	    //QUERY WHICH SELECTS WHAT DATA TO DISPLAY RELEVANT TO THE KEY WORD 
	    $definedQuery = "SELECT TrainerPal_User.firstName, TrainerPal_User.lastName, TrainerPal_User.email, TrainerPal_User.telephoneNumber, TrainerPal_User.address,
	                            TrainerPal_User.city, TrainerPal_User.postcode, TrainerPal_User.country, TrainerPal_User.accountType, TrainerPal_User.userID
	                            FROM TrainerPal_User WHERE TrainerPal_User.firstName LIKE '%$definedSearch%'
	                            OR (TrainerPal_User.lastName LIKE '%$definedSearch%')
	                            OR (TrainerPal_User.email LIKE '%$definedSearch%')
	                            OR (TrainerPal_User.telephoneNumber LIKE '%$definedSearch%')
	                            OR (TrainerPal_User.address LIKE '%$definedSearch%')
	                            OR (TrainerPal_User.city LIKE '%$definedSearch%')
	                            OR (TrainerPal_User.postcode LIKE '%$definedSearch%')
	                            OR (TrainerPal_User.accountType LIKE '%$definedSearch%')
	                            OR (TrainerPal_User.country LIKE '%$definedSearch%')
	                            OR (TrainerPal_User.accountType LIKE '%$definedSearch%')
	                            OR (TrainerPal_User.userID LIKE '%$definedSearch%')";
	                            
	                            
	                    $definedResult = $conn->query($definedQuery);
	                     if(!$definedResult) {
	                     echo "did not work";
	                     } 
	                $num = $definedResult -> num_rows;
	                
	                // IF NO RESULTS MEET THE KEY WORD THEN THE USER IS INFORMED
	                if($num < 1) {
	                echo"
	                
	                 <font color = 'red'><h3 align = 'center'> No results match your search at this time.</h3></font>";
	                }
	                
	                
	            while($row=$definedResult->fetch_assoc()){
	        
	                        $firstName = $row["firstName"];
	                        $lastName= $row["lastName"];
	                        $email = $row["email"];
	                        $telephoneNumber = $row["telephoneNumber"];
	                        $address = $row["address"];
	                        $city = $row["city"];
	                        $postcode = $row["postcode"];
	                        $country = $row["country"];
	                        $accountType = $row["accountType"];
	                        
	                        $userID =  $row["userID"];
	                          
	  //MULTIPLIES TO A RANDOM VALUE
	  $userID = ($userID*$_SESSION['random']);
	  
	  //ENCODES THE RANDOM VALUE
	  $userID= base64_encode($userID);
	                            
	                    
	                      echo "
	      <th scope='row'></th>
	      <td>$lastName</td>
	      <td>$firstName</td>
	      <td>$email</td>
	      <td>$telephoneNumber</td>
	        <td>$address</td>
	          <td>$city</td>
	            <td>$postcode</td>
	              <td>$country</td>";
	              
	              // IF ACCOUNT TYPE IS 1 THEN USER IS A BASIC USER
	              if($accountType == 1) {
	              echo "    <td>Basic User</td>
	               <td><a class='btn btn-primary' href='adminActions.php?userID=$userID' role='button'>Actions</a></td> 
	         </tr>";
	              }
	              // IF ACCOUNT TYPE IS 2 THEN USER IS A TRAINER
	               if($accountType == 2) {
	              echo "    <td>Trainer</td>
	               <td><a class='btn btn-primary' href='adminActions.php?userID=$userID' role='button'>Actions</a></td> 
	         </tr>";
	              } 
	                        
	}
	echo "</div>";
	}

?>
  </tbody>
</table> 
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