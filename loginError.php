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
			
			<?php if(!isset($_SESSION['loggedSession'])) {
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
			<li class = "nav-item active">
				<a class = "nav-link" href="trainerAccount.php"><font color = "white">Trainer Portal</font></a>
			</li>
			
			<!---- LOG OUT BUTTON APPEARS IN THE NAV BAR WHEN USER IS LOGGED IN ---->
			
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
</nav>
</header>


 <!------------- LOGIN FORM------------!>
 
      
       <div id = "regDiv" class = "col-8">
			<h3 style = "padding-top:10px" id = "loginTitle">Login</h3>
			<h5> <font color = "red"> You have entered incorrect login credentials! Please try again. </font> </h5>
			<h6> If you have forgotten your password, click <a href= "forgotPassword.php">here to reset.</a> </h6>
            <!-- SIGN UP FORM -->
            <form class = "loginForm" action="authenticateSession.php" method="post">
                 
             <div class="form-group">
                      <input class="form-control" type="text" placeholder = "email" name='email' id='email' maxlength='50' required>
                </div>
                       
                <div class = "form-group">       
                <input class="form-control" type="password" placeholder="password" name='password' id = "password" required>
                </div>
				
				<div class = "col-8" >
                <!-- TOGGLE BUTTON FOR HIDE PASSWORD -->
                
                <div class="input-group checkboxes" >
                 <label for='hidePass'><font size = "3px" color = "black" ><u>Show Password </u></font></label>
                    <input type="checkbox" id='hidePass' onclick="hidePassword()" tabindex="0">
                    
                </div>
                </div>
                
                           <!-- SUBMISSION BUTTON FOR THIS FORM -->
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