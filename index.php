<?php
session_start();
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
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<!--- Navigation =-->
	<header id="navHeader">
		<nav class="navbar navbar-expand-md navbar-light sticky-top" id="navbar" style="background-color:#648CFF;">
			<div class="container-fluid">
				<a href="index.php">
				<h4 id="navTitle"><font color="white">TrainerPal: Health & Fitness</font></h4></a> <button class="navbar-toggler ml-auto" data-target="#navbarResponsive" data-toggle="collapse" id='navDropButton' type="button"><span class="navbar-toggler-icon"></span></button>
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
						</li><?php if(!isset($_SESSION['loggedSession'])) {
						                echo "
						                <li class = 'nav-item active'>
						                <a class = 'nav-link' href='login.php'><font color = 'white'>Login</font></a>
						            </li>";
						            }
						            else {
						            echo"
						            <li class = 'nav-item active'>
						                <a class = 'nav-link' href='account.php'><font color = 'white'>Account</font></a>
						            </li>";
						            }
						            
						            ?>
						<li class="nav-item active">
							<a class="nav-link" href="trainerAccount.php"><font color="white">Trainer Portal</font></a>
						</li><!--== LOG OUT BUTTON APPEARS IN THE NAV BAR WHEN USER IS LOGGED IN ==-->
						<?php if(isset($_SESSION['loggedSession'])) {
						            
						            $activeID = $_SESSION['loggedSession']; 
						            
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
	</header><!--- Main Home Page slider images =-->
	<section id="sliderSection">
		<div class="carousel slide" data-ride="carousel" id="mainImages">
			<ol class="carousel-indicators">
				<li class="active" data-slide-to="0" data-target="#mainImages"></li>
				<li data-slide-to="1" data-target="#mainImages"></li>
				<li data-slide-to="2" data-target="#mainImages"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="img/background7.jpg">
					<div class="carousel-caption">
						<h3 class="carouselCaption">The Platform dedicated to Personal Trainers and their clients</h3>
						<p><a class="btn btn-primary" href="workouts.php">Get Started</a></p>
					</div>
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="img/background4.jpg">
					<div class="carousel-caption">
						<h3 class="carouselCaption">Your fitness journey starts with TrainerPal, your home of Health & Fitness</h3>
						<p><a class="btn btn-primary" href="workouts.php">Get Started</a></p>
					</div>
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="img/background5.jpg">
					<div class="carousel-caption">
						<h3 class="carouselCaption">Looking a personal trainer? Find the best trainer suited to your goals</h3>
						<p><a class="btn btn-primary" href="workouts.php">Get Started</a></p>
					</div>
				</div>
			</div>
		</div><a class="carousel-control-prev" data-slide="prev" href="#mainImages" role="button"><span aria-hidden="true" class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a> <a class="carousel-control-next" data-slide="next" href="#mainImages" role="button"><span aria-hidden="true" class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a> 
	</section><!--- Information Section =-->
	<section id="informationSection" style='border-bottom: blue 3px solid'>
		<div class="container-fluid padding">
			<div class="row text-center padding">
				<div class="col-12">
					<h4>Workouts & Exercises</h4>
					<p><font color="grey" size="2px;">Follow a number of our fantastic workout plans & individual exercises - this is just the start of your fitness journey.</font></p>
				</div>
				<div class="col-12">
					<h4>Find a Trainer</h4>
					<p><font color="grey" size="2px;">Find a verified Personal Trainer registered with TrainerPal to help you with your individual goals & aspirations.</font></p>
				</div>
				<div class="col-12">
					<h4>Client Management</h4>
					<p><font color="grey" size="2px;">For the trainers - Manage all of your clients in one place, advertise your services to potential new clients & instant chat at any time!</font></p>
				</div>
			</div>
		</div>
	</section><!--- About/Contact Section =-->
	<section id="aboutSection">
		<div class="row text-center padding">
			<div class="col-12">
				<h4><font color="white">Contact Us</font></h4>
				<p class="contactList">Telephone Number: +44 7894267692</p>
				<p class="contactList">Email: nheatley03@qub.ac.uk</p>
				<p class="contactList">Office Address:<br>
				85 Salisbury Avenue<br>
				Belfast, BT15 5EA<br>
				Antrim<br>
				Ireland</p>
			</div>
		</div>
	</section><!--- Footer Section =-->
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