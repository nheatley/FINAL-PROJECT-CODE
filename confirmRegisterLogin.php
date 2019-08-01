<?php
session_start();
if(isset($_SESSION['loggedSession'])) {
 header("location: account.php");
}
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
	<script>
	           /**
	            * HIDES AND SHOWS PASSWORDS AT USERS DISCRETION
	            * @returns {undefined}
	            */
	           function hidePassword() {
	               var pw = document.getElementById("password");
	               if (pw.type === "password") {
	                   pw.type = "text";
	               } else {
	                   pw.type = "password";
	               }
	           }
	</script>
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
	</header><!---- LOGIN FORM ----!>
 
      
       <div id = "regDiv" class = "col-8">
            <h3 id = "loginTitle">Login</h3>
            <h4> Thank you for Registering with TrainerPal, please Login below. </h4>
            <!== SIGN UP FORM -->
	<form action="authenticateSession.php" class="loginForm" method="post">
		<div class="form-group">
			<input class="form-control" id='email' maxlength='50' name='email' placeholder="email" required="" type="text">
		</div>
		<div class="form-group">
			<input class="form-control" id="password" name='password' placeholder="password" required="" type="password">
		</div>
		<div class="col-8">
			<!-- TOGGLE BUTTON FOR HIDE PASSWORD -->
			<div class="input-group checkboxes">
				<label for='hidePass'><font color="black" size="3px"><u>Show Password</u></font></label> <input id='hidePass' onclick="hidePassword()" tabindex="0" type="checkbox">
			</div>
		</div><!-- SUBMISSION BUTTON FOR THIS FORM -->
		<input class="button btn-primary u-full-width" id="Login" name='loginButton' type="submit" value="Login">
            </form>
        </div>
	
	        
        <div id = "clickDiv" class = "col-8" >
        <p> New User? <br>Click<a href = "register.php"> here to create an account.<p></a>
        </div>
	          <!--- Footer Section --->    
     
<section id="footerSection">
<div class = "container-fluid padding">
<div class="row text-center padding">
	<div class = "col-12">
		<p><font color="white" size="2px;">TrainerPal: Health & Fitness <br> Copyright &copy; 2019</font></p>
		</div>
	
	</section>
</body>
</html>