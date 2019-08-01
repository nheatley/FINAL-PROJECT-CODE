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
	</header><!--- SECOND ACCOUNT NAVIGATION =--><!-- second fixed navbar-->
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
	</section><?php

	     $exerciseID = htmlentities($_GET['exerciseID']);
	    // INPUTS FROM THE INSERT EXERCISE FORM

	      //DECODES THE VALUE
	  $exerciseID= base64_decode($exerciseID);
	  
	  //DIVIDES VALUE TO ORIGINAL VALUE
	  $exerciseID = ($exerciseID/$_SESSION['random']);  

	    $youtubeVideoURL = $conn->real_escape_string($_POST['youtubeVideoURL']);
	    
	    $_SESSION['youtubeVideoURL'] = $youtubeVideoURL;
	    $_SESSION['carryExerciseID'] = $exerciseID;
	        
	    $videoJson = "http://www.youtube.com/oembed?url=$youtubeVideoURL&format=json";
	    $headers = get_headers($videoJson);
	    $code = substr($headers[0], 9, 3);
	    
	        
	/**
	 * Fetch YouTube ID from different URL TYPES
	 *
	 * @param string $url
	 * @return string
	 */
	function get_youtube_videoID( $youtubeVideoURL ){
	    $regex = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i';
	    $youtube_id = preg_replace( $regex, '$1', $youtubeVideoURL );
	    
	    echo "
	    
	        <div style = 'padding-top:10px;' align = 'center'>
	        <h3> Is this the video you expected?</h3>
	    <div class='thumbnail'>
	        <div id='videoDiv'>
	        
	                  <iframe width='300' height='345' src=https://www.youtube.com/embed/$youtube_id?autoplay=1'>             
	</iframe>
	        </div>
	    </div>";
	    return $youtube_id;
	    
	}
	    
	if ($code != "404") {

	//get_youtube_videoID($youtubeVideoURL);
	  unset($_SESSION['carryExerciseID']);
	  
	  $api_key = 'AIzaSyC2VirUwP1W5dqK0_-ZuFsdNnfttUTjUZo';
	  
	  $video_url = $youtubeVideoURL;
	  
	  $api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . get_youtube_videoID($youtubeVideoURL) . '&key=' . $api_key;
	        
	  $data = json_decode(file_get_contents($api_url));
	  
	  //MULTIPLIES TO RANDOM VALUE
	  $exerciseID = ($exerciseID*$_SESSION['random']); 
	  
	  //ENCODES THE VALUE
	  $exerciseID= base64_encode($exerciseID);
	  
	  // Accessing Video Info
	  echo 'Title: ' . $data->items[0]->snippet->title . '<br>';
	  echo 'Duration:' . $data->items[0]->contentDetails->duration . '<br>';
	  echo 'Views:' . $data->items[0]->statistics->viewCount . '<br>';
	  echo 
	  "<div align = 'center' style = 'padding-top:10px'>
	  
	                                         <form class='subform' id='youtubeVideoURLForm'  action='processEditExercise.php?exerciseID=$exerciseID' method='POST'>
	                      <input class='btn btn-success btn-lg' id='youtubeVideoURLSub' name='youtubeVideoURLSubButton' type='submit' value='Yes, this is correct'>
	                
	            </form>
	         </div>
	<div align = 'center' style = 'padding-top:10px'>
	<a class='btn btn-warning btn-lg' href='editExercise.php?exerciseID=$exerciseID' name = 'noButton' role='button'>No, this is wrong.</a>
	         </div> ";

	}else {


	$_SESSION['carryExerciseID'] = $exerciseID;
	header('Location: editExercise.php');
	}
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