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
	<script>

	   
	                   
	           jQuery(document).ready(function () {
	               jQuery('form').submit(function (e) {
	               
	                   var date = jQuery.trim($('#date').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (date.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#dateVal').html("You must fill in this area!");
	                   }
	               
	               var well = jQuery.trim($('#well').val());

	                   /**
	                    * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (well.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#wellVal').html("You must give fill in this area!");
	                   }
	               
	               var notLike = jQuery.trim($('#notLike').val());

	                   /**
	                    * ENSURES ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (notLike.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#notLikeVal').html("You must fill in this area!");
	                   }
	     
	                   var improved = jQuery.trim($('#improved').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (improved.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#improvedVal').html("You must fill in this area!");
	                   }

	                   var nextWeek = jQuery.trim($('#nextWeek').val());

	                   /**
	                    * VALIDATES TO ENSURE ENTRY IS MORE THAN JUST WHITESPACE
	                    */
	                   if (nextWeek.length <= 0) {
	                       e.preventDefault();
	                       jQuery('#nextWeekVal').html("You must fill in this area!");
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
		<h2 align="center">Send Progress Report</h2>
	</div><!--=== INVOICE Form ===-->
	<?php    
	 
	  $userID = htmlentities($_GET['userID']);
	  
	 
	 echo " 
	       <div id = 'regDiv' class = 'col-8'>
	            <h3 id = 'ignUpTitle'>Progress Report</h3>
	            <!-- SIGN UP FORM -->
	            <form class = 'reportForm' action='processProgressReport.php?userID=$userID' method='post' enctype='multipart/form-data' onSubmit='return fileValid()'>
	             
	                 <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                   <font color = 'red'> <div class='notAvailable' id='dateVal'></div></font>
	                      <input class='form-control' type='text' name='date' placeholder = 'Date dd/mm/yy'...' id='date' maxlength='50' required>
	                </div>
	             
	                 
	             <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                   <font color = 'red'> <div class='notAvailable' id='wellVal'></div></font>
	                      <input class='form-control' type='text' name='well' placeholder = 'What went well?...' id='well' maxlength='300' required>
	                </div>

	                <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='notLikeVal'></div> </font>
	                      <input class='form-control' type='text' name='notLike' placeholder = 'What did you not like?...' id='notLike' maxlength='300' required>
	                </div>
	                
	                
	               <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                    <font color = 'red'><div class='notAvailable' id='improvedVal'></div> </font>
	                      <input class='form-control' type='text' name='improved' placeholder = 'What could be improved?...' id='improved' required>
	                </div>
	                
	               <div class='form-group'>
	                    <!-- DISPLAYS VALIDATION MESSAGE -->
	                   <font color = 'red'> <div class='notAvailable' id='nextWeekVal'></div></font>
	                    <input class='form-control' type='text' name='nextWeek' id='nextWeek' placeholder = 'What would you like to do next week?...' maxlength='300' required>
	                </div>

	                <!-- SUBMISSION BUTTON FOR THIS FORM -->
	                <input class='button btn-primary u-full-width' id='report' name='reportButton' type='submit' value='Send Progress Report'>

	            </form>
	        </div>";
	?>
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