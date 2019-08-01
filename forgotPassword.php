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
	</header><!----RESET PASSWORD FORM----!>
 
       <div id = "regDiv" class = "col-8">
            <h3 style = "padding-top:10px" id = "loginTitle">Reset Password</h3>
            <!== SIGN UP FORM -->
	<form action="processPasswordReset.php" class="loginForm" method="post">
		<div class="form-group">
			<input class="form-control" id='email' maxlength='50' name='email' placeholder="email" required="" type="text">
		</div>
		<div class="form-group">
			<label class="regLabel" for='securityQuestion'></label>
			<h5 class="regTitle"><label class="regLabel" for='securityQuestion'>Security Question:</label></h5><select class="u-full-width" id='securityQuestion' name='securityQuestion'>
				<option value="What is your mother's maiden name?">
					What is your mother's maiden name?
				</option>
				<option value="What was the make of your first car?">
					What was the make of your first car?
				</option>
				<option value="What city were you born in?">
					What city were you born in?
				</option>
				<option value="What is your favourite colour?">
					What is your favourite colour?
				</option>
			</select>
		</div>
		<div class="form-group">
			<input class="form-control" id='securityQuestionAnswer' maxlength='50' name='securityQuestionAnswer' placeholder="Security Question Answer" required="" type="text">
		</div><!-- SUBMISSION BUTTON FOR THIS FORM -->
		<input class="button btn-primary u-full-width" id="resetPassword" name='resetButton' type="submit" value="Reset Password">

            </form>
        </div>
        <div id = "clickDiv" class = "col-8" >
        <p> New User? <br>Click<a href = "register.php"> here to create an account.<p></a>
        </div>
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